<?php include 'header_admin.php'; ?>
<?php include 'sidebar_content.php'; ?>

<?php
// Filter untuk jenis identifikasi
$jenis_filter = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$where_clause = '';
if ($jenis_filter) {
    $where_clause = "WHERE jenis_diagnosa = '$jenis_filter'";
}

// Query untuk mengambil data identifikasi
$query = "SELECT * FROM tb_diagnosa_siswa $where_clause ORDER BY tanggal_diagnosa DESC";
$result = mysqli_query($kon, $query);
?>
<br>
<main class="page-content">
    <div class="container-fluid">
        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-users mr-2"></i>
                            Rekap Data Identifikasi Siswa
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Filter -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="btn-group" role="group">
                                    <a href="rekap_siswa.php" class="btn btn-outline-primary btn-filter <?php echo !$jenis_filter ? 'active' : ''; ?>">
                                        Semua
                                    </a>
                                    <a href="rekap_siswa.php?jenis=disleksia" class="btn btn-outline-primary btn-filter <?php echo $jenis_filter == 'disleksia' ? 'active' : ''; ?>">
                                        Disleksia
                                    </a>
                                    <a href="rekap_siswa.php?jenis=disgrafia" class="btn btn-outline-primary btn-filter <?php echo $jenis_filter == 'disgrafia' ? 'active' : ''; ?>">
                                        Disgrafia
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-success" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel mr-1"></i> Export Excel
                                </button>
                                <button class="btn btn-danger ml-2" onclick="hapusSemuaData()">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus Semua Data
                                </button>
                            </div>
                        </div>

                        <!-- Tabel Data -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Umur</th>
                                        <th>Jenis Identifikasi</th>
                                        <th>Gejala yang Dipilih</th>
                                        <th>Hasil Identifikasi</th>
                                        <th>CF Tertinggi</th>
                                        <th>Tanggal Identifikasi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($row['umur']) !== '' ? htmlspecialchars($row['umur']) . ' tahun' : ''; ?></td>
                                            <td>
                                                <span style="color: white;" class="badge badge-<?php echo $row['jenis_diagnosa'] == 'disleksia' ? 'info' : 'warning'; ?>">
                                                    <?php echo ucfirst($row['jenis_diagnosa']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <?php
                                                    $gejala_array = explode(', ', $row['gejala_dipilih']);
                                                    foreach ($gejala_array as $gejala) {
                                                        echo "<span class='badge badge-secondary cf-badge'>$gejala</span> ";
                                                    }
                                                    ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if (strtolower($row['hasil_diagnosa']) == 'normal') { ?>
                                                    <span class="badge badge-success">Normal</span>
                                                <?php } else { ?>
                                                    <?php echo htmlspecialchars($row['hasil_diagnosa']); ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?php echo $row['cf_tertinggi'] >= 80 ? 'primary' : ($row['cf_tertinggi'] >= 60 ? 'warning' : 'danger'); ?>">
                                                    <?php echo $row['cf_tertinggi']; ?>%
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_diagnosa'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="detailDiagnosa(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="hapusData(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Statistik -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Identifikasi</h5>
                                        <h3><?php echo mysqli_num_rows($result); ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Disleksia</h5>
                                        <?php
                                        $query_dis = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disleksia'";
                                        $result_dis = mysqli_query($kon, $query_dis);
                                        $dis_count = mysqli_fetch_assoc($result_dis)['total'];
                                        ?>
                                        <h3><?php echo $dis_count; ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Disgrafia</h5>
                                        <?php
                                        $query_dig = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disgrafia'";
                                        $result_dig = mysqli_query($kon, $query_dig);
                                        $dig_count = mysqli_fetch_assoc($result_dig)['total'];
                                        ?>
                                        <h3><?php echo $dig_count; ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Hari Ini</h5>
                                        <?php
                                        $query_today = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE DATE(tanggal_diagnosa) = CURDATE()";
                                        $result_today = mysqli_query($kon, $query_today);
                                        $today_count = mysqli_fetch_assoc($result_today)['total'];
                                        ?>
                                        <h3><?php echo $today_count; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Identifikasi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    });

    function detailDiagnosa(id) {
        console.log('detailDiagnosa called with ID:', id);

        // Cek apakah jQuery tersedia
        if (typeof $ === 'undefined') {
            alert('Error: jQuery tidak tersedia!');
            return;
        }

        // Cek apakah Bootstrap modal tersedia
        if (typeof $.fn.modal === 'undefined') {
            alert('Error: Bootstrap modal tidak tersedia!');
            return;
        }

        $.ajax({
            url: 'detail_diagnosa.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                console.log('AJAX Success - Response:', response);
                $('#detailContent').html(response);
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                alert('Error: ' + error);
            }
        });
    }

    function hapusData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: 'hapus_diagnosa.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    alert('Data berhasil dihapus');
                    location.reload();
                }
            });
        }
    }

    function exportToExcel() {
        window.location.href = 'export_excel.php?jenis=<?php echo $jenis_filter; ?>';
    }

    function hapusSemuaData() {
        if (confirm('Apakah Anda yakin ingin menghapus SEMUA data diagnosa? Tindakan ini tidak dapat dibatalkan!')) {
            $.ajax({
                url: 'hapus_diagnosa.php',
                type: 'POST',
                data: {
                    hapus_semua: 1
                },
                success: function(response) {
                    alert('Semua data berhasil dihapus');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat menghapus semua data: ' + error);
                }
            });
        }
    }
</script>

<?php include 'footer1.php'; ?>