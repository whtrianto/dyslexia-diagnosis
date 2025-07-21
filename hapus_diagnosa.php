<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['log'] != "login") {
    exit('Akses ditolak');
}

if (isset($_POST['hapus_semua']) && $_POST['hapus_semua'] == 1) {
    $userid = $_SESSION['userid'];
    $role = '';
    $res = mysqli_query($kon, "SELECT role FROM login WHERE userid='$userid'");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        $role = $row['role'];
    }
    // Ambil admin yang dipilih dari request
    $assigned_admin = isset($_POST['assigned_admin']) ? $_POST['assigned_admin'] : '';
    if ($role == 'superadmin') {
        if ($assigned_admin) {
            // Superadmin hapus data milik admin yang dipilih
            $query = "DELETE FROM tb_diagnosa_siswa WHERE assigned_admin = '" . mysqli_real_escape_string($kon, $assigned_admin) . "'";
        } else {
            // Superadmin hapus semua data
            $query = "DELETE FROM tb_diagnosa_siswa";
        }
    } else {
        // Admin hapus data miliknya sendiri
        $query = "DELETE FROM tb_diagnosa_siswa WHERE assigned_admin = '$userid'";
    }
    $result = mysqli_query($kon, $query);
    if ($result) {
        echo "OK";
    } else {
        echo "Gagal";
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
