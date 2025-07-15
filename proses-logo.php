<?php
include "koneksi.php";
session_start();
if ($_SESSION['log'] != "login") {
    header("location:login.php");
} else {
    $uid = $_SESSION['userid'];
    $ekstensi_diperbolehkan    = array('png', 'jpg', 'svg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 500000) {
            move_uploaded_file($file_tmp, 'icon/' . $nama);
            $query =  mysqli_query($kon, "UPDATE login SET logo='$nama' WHERE userid='$uid'") or die(mysqli_connect_error());
            if ($query) {
                echo '<script>history.go(-1);</script>';
            } else {
                echo '<script>alert("GAGAL MENGUPLOAD GAMBAR");history.go(-1);</script>';
            }
        } else {
            echo '<script>alert("UKURAN FILE TERLALU BESAR, UKURAN YANG DIIJINKAN KURANG DARI 500KB");history.go(-1);</script>';
        }
    } else {
        echo '<script>alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");history.go(-1);</script>';
    }
}
