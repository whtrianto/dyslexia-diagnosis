<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['log'] != "login") {
    exit('Akses ditolak');
}

if (isset($_POST['hapus_semua']) && $_POST['hapus_semua'] == 1) {
    // Hapus semua data identifikasi
    $query = "DELETE FROM tb_diagnosa_siswa";
    $result = mysqli_query($kon, $query);
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
} elseif (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($kon, $_POST['id']);
    // Hapus data identifikasi
    $query = "DELETE FROM tb_diagnosa_siswa WHERE id = '$id'";
    $result = mysqli_query($kon, $query);
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
