<?php include 'header_admin.php'; ?>
<?php include 'sidebar_content.php'; ?>
<?php
// Ambil role dan userid admin
$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
$role = $DataLogin['role'];

// Ambil daftar admin untuk superadmin
$admin_list = [];
if ($role == 'superadmin') {
    $admin_query = mysqli_query($kon, "SELECT userid, username FROM login WHERE role='admin' ORDER BY username ASC");
    while ($row_admin = mysqli_fetch_assoc($admin_query)) {
        $admin_list[] = $row_admin;
    }
}

// Filter untuk jenis identifikasi
$jenis_filter = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$selected_admin = isset($_GET['admin']) ? $_GET['admin'] : '';
$where_clause = '';
if ($jenis_filter) {
    $where_clause = "WHERE jenis_diagnosa = '$jenis_filter'";
}

// Filter data sesuai role
if ($role == 'superadmin') {
    // Jika superadmin memilih admin, tampilkan data milik admin tsb
    if ($selected_admin) {
        $where_and = $where_clause ? "$where_clause AND" : 'WHERE';
        $query = "SELECT * FROM tb_diagnosa_siswa $where_and assigned_admin = '$selected_admin' ORDER BY tanggal_diagnosa DESC";
    } else {
        // Default: tampilkan semua data
        $query = "SELECT * FROM tb_diagnosa_siswa $where_clause ORDER BY tanggal_diagnosa DESC";
    }
} else {
    // Admin hanya lihat data assigned ke dirinya (assigned_admin = uid)
    $where_and = $where_clause ? "$where_clause AND" : 'WHERE';
    $query = "SELECT * FROM tb_diagnosa_siswa $where_and assigned_admin = '$uid' ORDER BY tanggal_diagnosa DESC";
}
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
                            <div class="col-12 col-md-6 d-flex flex-wrap align-items-center justify-content-center justify-content-md-start">
                                <div class="btn-group flex-wrap" role="group">
                                    <a href="rekap_siswa.php<?php echo $selected_admin ? '?admin=' . $selected_admin : ''; ?>" class="btn btn-outline-primary btn-filter <?php echo !$jenis_filter ? 'active' : ''; ?>">
                                        Semua Jenis
                                    </a>
                                    <a href="rekap_siswa.php?jenis=disleksia<?php echo $selected_admin ? '&admin=' . $selected_admin : ''; ?>" class="btn btn-outline-primary btn-filter <?php echo $jenis_filter == 'disleksia' ? 'active' : ''; ?>">
                                        Disleksia
                                    </a>
                                    <a href="rekap_siswa.php?jenis=disgrafia<?php echo $selected_admin ? '&admin=' . $selected_admin : ''; ?>" class="btn btn-outline-primary btn-filter <?php echo $jenis_filter == 'disgrafia' ? 'active' : ''; ?>">
                                        Disgrafia
                                    </a>
                                </div>
                                <?php if ($role == 'superadmin' && count($admin_list) > 0) { ?>
                                    <form method="get" class="ml-3 d-inline-block" style="min-width:180px;">
                                        <?php if ($jenis_filter) { ?><input type="hidden" name="jenis" value="<?php echo htmlspecialchars($jenis_filter); ?>"><?php } ?>
                                        <select name="admin" class="form-control" onchange="this.form.submit()">
                                            <option value="">Semua Admin</option>
                                            <?php
                                            // Ambil semua user termasuk superadmin
                                            $all_admin_query = mysqli_query($kon, "SELECT userid, username, role FROM login ORDER BY userid ASC");
                                            while ($adm = mysqli_fetch_assoc($all_admin_query)) {
                                                $label = ($adm['role'] == 'superadmin') ? 'Superadmin (' . htmlspecialchars($adm['username']) . ')' : 'Admin ' . ' - ' . htmlspecialchars($adm['username']);
                                                echo '<option value="' . $adm['userid'] . '"' . ($selected_admin == $adm['userid'] ? ' selected' : '') . '>' . $label . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </form>
                                <?php } ?>
                            </div>
                            <div class="col-12 col-md-6 text-center text-md-right mt-2 mt-md-0">
                                <button class="btn btn-success mb-1" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel mr-1"></i> Export Excel
                                </button>
                                <button class="btn btn-danger ml-2 mb-1" onclick="hapusSemuaData()">
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
                                        <th class="hide-mobile">Gejala yang Dipilih</th>
                                        <th>Hasil Identifikasi</th>
                                        <th class="hide-mobile">CF Tertinggi</th>
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
                                            <td><?php
                                                $umur = htmlspecialchars($row['umur']);
                                                if (preg_match('/tahun$/', trim($umur))) {
                                                    echo trim($umur);
                                                } else {
                                                    echo trim($umur) !== '' ? trim($umur) . ' tahun' : '';
                                                }
                                                ?></td>
                                            <td>
                                                <span style="color: white;" class="badge badge-<?php echo $row['jenis_diagnosa'] == 'disleksia' ? 'info' : 'warning'; ?>">
                                                    <?php echo ucfirst($row['jenis_diagnosa']); ?>
                                                </span>
                                            </td>
                                            <td class="hide-mobile">
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
                                            <td class="hide-mobile">
                                                <span class="badge badge-<?php echo $row['cf_tertinggi'] >= 80 ? 'primary' : ($row['cf_tertinggi'] >= 60 ? 'warning' : 'danger'); ?>">
                                                    <?php echo $row['cf_tertinggi']; ?>%
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_diagnosa'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info mb-1" onclick="detailDiagnosa(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                                <button class="btn btn-sm btn-danger mb-1" onclick="hapusData(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="scroll-hint d-block d-sm-none">Geser tabel ke samping untuk melihat data lebih lengkap.</div>
                        </div>

                        <!-- Statistik -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Identifikasi</h5>
                                        <?php
                                        // Statistik mengikuti filter admin, bukan filter jenis
                                        if ($role == 'superadmin' && $selected_admin) {
                                            $query_total = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE assigned_admin = '$selected_admin'";
                                        } elseif ($role == 'superadmin') {
                                            $query_total = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa";
                                        } else {
                                            $query_total = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE assigned_admin = '$uid'";
                                        }
                                        $result_total = mysqli_query($kon, $query_total);
                                        $total_count = mysqli_fetch_assoc($result_total)['total'];
                                        ?>
                                        <h3><?php echo $total_count; ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <h5 class="card-title">Disleksia</h5>
                                        <?php
                                        if ($role == 'superadmin' && $selected_admin) {
                                            $query_dis = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disleksia' AND assigned_admin = '$selected_admin'";
                                        } elseif ($role == 'superadmin') {
                                            $query_dis = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disleksia'";
                                        } else {
                                            $query_dis = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disleksia' AND assigned_admin = '$uid'";
                                        }
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
                                        if ($role == 'superadmin' && $selected_admin) {
                                            $query_dig = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disgrafia' AND assigned_admin = '$selected_admin'";
                                        } elseif ($role == 'superadmin') {
                                            $query_dig = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disgrafia'";
                                        } else {
                                            $query_dig = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE jenis_diagnosa = 'disgrafia' AND assigned_admin = '$uid'";
                                        }
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
                                        if ($role == 'superadmin' && $selected_admin) {
                                            $query_today = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE DATE(tanggal_diagnosa) = CURDATE() AND assigned_admin = '$selected_admin'";
                                        } elseif ($role == 'superadmin') {
                                            $query_today = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE DATE(tanggal_diagnosa) = CURDATE()";
                                        } else {
                                            $query_today = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa WHERE DATE(tanggal_diagnosa) = CURDATE() AND assigned_admin = '$uid'";
                                        }
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
        var jenis = '<?php echo $jenis_filter; ?>';
        var admin = '<?php echo $selected_admin; ?>';
        var params = [];
        if (jenis) params.push('jenis=' + encodeURIComponent(jenis));
        if (admin) params.push('admin=' + encodeURIComponent(admin));
        var url = 'export_excel.php';
        if (params.length > 0) url += '?' + params.join('&');
        window.location.href = url;
    }

    function hapusSemuaData() {
        var adminText = '';
        var assigned_admin = '<?php echo $uid; ?>';
        <?php if ($role == 'superadmin') { ?>
            assigned_admin = '<?php echo $selected_admin ? $selected_admin : ''; ?>';
            adminText = assigned_admin ? 'admin yang dipilih' : 'SEMUA admin';
        <?php } else { ?>
            adminText = 'data Anda';
        <?php } ?>
        var confirmText = 'Apakah Anda yakin ingin menghapus SEMUA data diagnosa ' + adminText + '? Tindakan ini tidak dapat dibatalkan!';
        if (confirm(confirmText)) {
            $.ajax({
                url: 'hapus_diagnosa.php',
                type: 'POST',
                data: {
                    hapus_semua: 1,
                    role: '<?php echo $role; ?>',
                    assigned_admin: assigned_admin
                },
                success: function(response) {
                    if (response.trim() === 'OK') {
                        alert('Semua data berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus data: ' + response);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat menghapus semua data: ' + error);
                }
            });
        }
    }
</script>

<?php include 'footer1.php'; ?>