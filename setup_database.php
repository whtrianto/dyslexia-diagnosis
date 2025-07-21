<?php
include "koneksi.php";

// Script untuk membuat tabel tb_diagnosa_siswa
$sql = "CREATE TABLE IF NOT EXISTS `tb_diagnosa_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gejala_dipilih` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hasil_diagnosa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cf_tertinggi` decimal(5,2) NOT NULL,
  `cf_semua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_diagnosa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_diagnosa` enum('disleksia','disgrafia') NOT NULL DEFAULT 'disleksia',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC";

if (mysqli_query($kon, $sql)) {
    echo "Tabel tb_diagnosa_siswa berhasil dibuat!<br>";
    echo "Fitur rekap data siswa sudah siap digunakan.<br>";
    echo "<a href='login.php'>Klik di sini untuk login admin</a>";
} else {
    echo "Error: " . mysqli_error($kon);
}
