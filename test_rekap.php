<?php
// Test koneksi database terlebih dahulu
include "koneksi.php";

echo "<h2>Test Koneksi Database</h2>";
if ($kon) {
    echo "<p style='color: green;'>✅ Koneksi database berhasil</p>";

    // Test query tabel tb_diagnosa_siswa
    $test_query = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa";
    $test_result = mysqli_query($kon, $test_query);

    if ($test_result) {
        $count = mysqli_fetch_assoc($test_result)['total'];
        echo "<p style='color: green;'>✅ Query tabel tb_diagnosa_siswa berhasil. Total data: $count</p>";
    } else {
        echo "<p style='color: red;'>❌ Query tabel tb_diagnosa_siswa gagal: " . mysqli_error($kon) . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Koneksi database gagal</p>";
}

echo "<br><p><a href='rekap_siswa.php'>Klik di sini untuk mengakses Rekap Data Siswa</a></p>";
echo "<p><a href='test_sidebar.php'>Klik di sini untuk test sidebar</a></p>";
