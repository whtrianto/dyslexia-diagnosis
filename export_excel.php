<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['log'] != "login") {
    exit('Akses ditolak');
}

// Filter untuk jenis diagnosa
$jenis_filter = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$where_clause = '';
if ($jenis_filter) {
    $where_clause = "WHERE jenis_diagnosa = '$jenis_filter'";
}

// Query untuk mengambil data diagnosa
$query = "SELECT * FROM tb_diagnosa_siswa $where_clause ORDER BY tanggal_diagnosa DESC";
$result = mysqli_query($kon, $query);

// Set header untuk download Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="rekap_diagnosa_siswa_' . date('Y-m-d') . '.xls"');
header('Cache-Control: max-age=0');

?>
<table border="1">
    <thead>
        <tr>
            <th colspan="9" style="text-align: center; font-size: 16px; font-weight: bold;">
                REKAP DATA SISWA IDENTIFIKASI <?php echo strtoupper($jenis_filter ? $jenis_filter : 'SEMUA JENIS'); ?>
            </th>
        </tr>
        <tr>
            <th colspan="9" style="text-align: center;">
                Tanggal Export: <?php echo date('d/m/Y H:i:s'); ?>
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Umur</th>
            <th>Jenis Identifikasi</th>
            <th>Gejala yang Dipilih</th>
            <th>Hasil Identifikasi</th>
            <th>CF Tertinggi (%)</th>
            <th>Tanggal Identifikasi</th>
            <th>Waktu Identifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['umur'] !== '' ? $row['umur'] . ' tahun' : ''; ?></td>
                <td><?php echo ucfirst($row['jenis_diagnosa']); ?></td>
                <td><?php echo $row['gejala_dipilih']; ?></td>
                <td><?php echo $row['hasil_diagnosa']; ?></td>
                <td><?php echo number_format($row['cf_tertinggi'], 2); ?>%</td>
                <td><?php echo date('d/m/Y', strtotime($row['tanggal_diagnosa'])); ?></td>
                <td><?php echo date('H:i:s', strtotime($row['tanggal_diagnosa'])); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9" style="text-align: center; font-weight: bold;">
                Total Data: <?php echo mysqli_num_rows($result); ?>
            </td>
        </tr>
    </tfoot>
</table>