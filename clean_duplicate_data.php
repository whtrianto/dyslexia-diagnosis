<?php
include "koneksi.php";

echo "<h2>Pembersihan Data Duplikat</h2>";

// Cek jumlah data sebelum pembersihan
$query_count_before = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa";
$result_count_before = mysqli_query($kon, $query_count_before);
$count_before = mysqli_fetch_assoc($result_count_before)['total'];

echo "<p><strong>Jumlah data sebelum pembersihan:</strong> $count_before</p>";

// Hapus data duplikat berdasarkan nama, gejala, hasil diagnosa, dan tanggal (dalam 1 menit)
$query_delete_duplicates = "
    DELETE t1 FROM tb_diagnosa_siswa t1
    INNER JOIN tb_diagnosa_siswa t2 
    WHERE t1.id > t2.id 
    AND t1.nama = t2.nama 
    AND t1.gejala_dipilih = t2.gejala_dipilih 
    AND t1.hasil_diagnosa = t2.hasil_diagnosa 
    AND ABS(TIMESTAMPDIFF(SECOND, t1.tanggal_diagnosa, t2.tanggal_diagnosa)) < 60
";

$result_delete = mysqli_query($kon, $query_delete_duplicates);

if ($result_delete) {
    $affected_rows = mysqli_affected_rows($kon);
    echo "<p style='color: green;'>✅ Berhasil menghapus $affected_rows data duplikat</p>";
} else {
    echo "<p style='color: red;'>❌ Gagal menghapus data duplikat: " . mysqli_error($kon) . "</p>";
}

// Cek jumlah data setelah pembersihan
$query_count_after = "SELECT COUNT(*) as total FROM tb_diagnosa_siswa";
$result_count_after = mysqli_query($kon, $query_count_after);
$count_after = mysqli_fetch_assoc($result_count_after)['total'];

echo "<p><strong>Jumlah data setelah pembersihan:</strong> $count_after</p>";

// Tampilkan data yang tersisa
echo "<h3>Data yang Tersisa:</h3>";
$query_remaining = "SELECT * FROM tb_diagnosa_siswa ORDER BY tanggal_diagnosa DESC";
$result_remaining = mysqli_query($kon, $query_remaining);

if (mysqli_num_rows($result_remaining) > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Jenis</th><th>Hasil</th><th>CF</th><th>Tanggal</th></tr>";

    while ($row = mysqli_fetch_assoc($result_remaining)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . ucfirst($row['jenis_diagnosa']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hasil_diagnosa']) . "</td>";
        echo "<td>" . $row['cf_tertinggi'] . "%</td>";
        echo "<td>" . date('d/m/Y H:i:s', strtotime($row['tanggal_diagnosa'])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Tidak ada data tersisa.</p>";
}

echo "<br><p><a href='rekap_siswa.php'>Kembali ke Rekap Data Siswa</a></p>";
echo "<p><a href='login.php'>Kembali ke Login</a></p>";
