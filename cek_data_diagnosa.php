<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<h2>Data Diagnosa Siswa</h2>";

// Cek apakah tabel ada
$check_table = "SHOW TABLES LIKE 'tb_diagnosa_siswa'";
$table_exists = mysqli_query($kon, $check_table);

if (mysqli_num_rows($table_exists) == 0) {
    echo "<p style='color: red;'>Tabel tb_diagnosa_siswa tidak ditemukan!</p>";
    exit;
}

echo "<p style='color: green;'>Tabel tb_diagnosa_siswa ditemukan.</p>";

// Ambil semua data
$query = "SELECT * FROM tb_diagnosa_siswa ORDER BY tanggal_diagnosa DESC LIMIT 10";
$result = mysqli_query($kon, $query);

if (!$result) {
    echo "<p style='color: red;'>Error query: " . mysqli_error($kon) . "</p>";
    exit;
}

$count = mysqli_num_rows($result);
echo "<p>Total data: $count</p>";

if ($count > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f0f0f0;'>";
    echo "<th>ID</th>";
    echo "<th>Nama</th>";
    echo "<th>Jenis Diagnosa</th>";
    echo "<th>Hasil Diagnosa</th>";
    echo "<th>CF Tertinggi</th>";
    echo "<th>Tanggal</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . ucfirst($row['jenis_diagnosa']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hasil_diagnosa']) . "</td>";
        echo "<td>" . $row['cf_tertinggi'] . "%</td>";
        echo "<td>" . date('d/m/Y H:i', strtotime($row['tanggal_diagnosa'])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: orange;'>Tidak ada data diagnosa.</p>";
}

echo "<hr>";
echo "<h3>Test Detail Diagnosa</h3>";
echo "<p>Klik link di bawah untuk test detail diagnosa:</p>";

// Ambil ID pertama untuk test
$query_test = "SELECT id FROM tb_diagnosa_siswa ORDER BY tanggal_diagnosa DESC LIMIT 1";
$result_test = mysqli_query($kon, $query_test);
$test_data = mysqli_fetch_assoc($result_test);

if ($test_data) {
    echo "<a href='test_detail.php' target='_blank'>Test Detail Diagnosa</a><br>";
    echo "<a href='rekap_siswa.php' target='_blank'>Halaman Rekap Siswa</a>";
} else {
    echo "<p style='color: red;'>Tidak ada data untuk test.</p>";
}
