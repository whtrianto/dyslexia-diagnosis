<?php
include "koneksi.php";

echo "<h2>Status Database dan Tabel</h2>";

// Cek koneksi database
if ($kon) {
    echo "<p style='color: green;'>✅ Koneksi database berhasil</p>";
} else {
    echo "<p style='color: red;'>❌ Koneksi database gagal</p>";
    exit;
}

// Cek apakah tabel tb_diagnosa_siswa sudah ada
$query_check = "SHOW TABLES LIKE 'tb_diagnosa_siswa'";
$result_check = mysqli_query($kon, $query_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "<p style='color: green;'>✅ Tabel tb_diagnosa_siswa sudah ada</p>";

    // Cek struktur tabel
    $query_structure = "DESCRIBE tb_diagnosa_siswa";
    $result_structure = mysqli_query($kon, $query_structure);

    echo "<h3>Struktur Tabel tb_diagnosa_siswa:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";

    while ($row = mysqli_fetch_assoc($result_structure)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Cek jumlah data
    $query_count = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa";
    $result_count = mysqli_query($kon, $query_count);
    $count = mysqli_fetch_assoc($result_count)['total'];

    echo "<p><strong>Jumlah data saat ini:</strong> $count</p>";
} else {
    echo "<p style='color: red;'>❌ Tabel tb_diagnosa_siswa belum ada</p>";
    echo "<p>Silakan jalankan <a href='setup_database.php'>setup_database.php</a> untuk membuat tabel</p>";
}

// Cek tabel lain yang diperlukan
$required_tables = ['tb_penyakit', '1_tb_penyakit', 'tb_gejala', '1_tb_gejala', 'tb_rule', '1_tb_rule'];
echo "<h3>Status Tabel Lain:</h3>";

foreach ($required_tables as $table) {
    $query_table = "SHOW TABLES LIKE '$table'";
    $result_table = mysqli_query($kon, $query_table);

    if (mysqli_num_rows($result_table) > 0) {
        echo "<p style='color: green;'>✅ Tabel $table ada</p>";
    } else {
        echo "<p style='color: red;'>❌ Tabel $table tidak ada</p>";
    }
}

echo "<br><p><a href='login.php'>Kembali ke Login</a></p>";
