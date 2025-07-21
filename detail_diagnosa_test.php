<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($kon, $_POST['id']);
    $query = "SELECT * FROM tb_diagnosa_siswa WHERE id = '$id'";
    $result = mysqli_query($kon, $query);

    if (!$result) {
        echo '<div class="alert alert-danger">Error query: ' . mysqli_error($kon) . '</div>';
        exit;
    }

    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $cf_semua = json_decode($data['cf_semua'], true);
?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama Siswa:</strong></td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Diagnosa:</strong></td>
                        <td>
                            <span class="badge badge-<?php echo $data['jenis_diagnosa'] == 'disleksia' ? 'success' : 'warning'; ?>">
                                <?php echo ucfirst($data['jenis_diagnosa']); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Hasil Diagnosa:</strong></td>
                        <td><?php echo htmlspecialchars($data['hasil_diagnosa']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>CF Tertinggi:</strong></td>
                        <td>
                            <span class="badge badge-<?php echo $data['cf_tertinggi'] >= 80 ? 'success' : ($data['cf_tertinggi'] >= 60 ? 'warning' : 'danger'); ?>">
                                <?php echo $data['cf_tertinggi']; ?>%
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Diagnosa:</strong></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($data['tanggal_diagnosa'])); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6><strong>Gejala yang Dipilih:</strong></h6>
                <div class="mb-3">
                    <?php
                    $gejala_array = explode(', ', $data['gejala_dipilih']);
                    foreach ($gejala_array as $gejala) {
                        echo "<span class='badge badge-info mr-1 mb-1'>$gejala</span>";
                    }
                    ?>
                </div>

                <h6><strong>Detail CF Semua Jenis:</strong></h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Jenis</th>
                                <th>CF (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cf_semua) {
                                foreach ($cf_semua as $id_penyakit => $cf_value) {
                                    // Ambil nama penyakit berdasarkan jenis diagnosa
                                    $table_penyakit = $data['jenis_diagnosa'] == 'disleksia' ? 'tb_penyakit' : '1_tb_penyakit';
                                    $query_penyakit = "SELECT penyakit FROM $table_penyakit WHERE id = $id_penyakit";
                                    $result_penyakit = mysqli_query($kon, $query_penyakit);
                                    $penyakit_data = mysqli_fetch_assoc($result_penyakit);
                                    $nama_penyakit = $penyakit_data ? $penyakit_data['penyakit'] : 'Unknown';

                                    $cf_percent = round($cf_value * 100, 2);
                                    $badge_class = $cf_percent >= 80 ? 'success' : ($cf_percent >= 60 ? 'warning' : 'danger');
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($nama_penyakit); ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo $badge_class; ?>">
                                                <?php echo $cf_percent; ?>%
                                            </span>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php
    } else {
        echo '<div class="alert alert-danger">Data tidak ditemukan untuk ID: ' . $id . '</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID tidak valid</div>';
}
?>