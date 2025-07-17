<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['log'] != "login") {
    header("location:login.php");
}
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}
$uid = $_SESSION['userid'];
// Ambil data superadmin saja untuk logo dan toko
$DataSuperAdmin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE role='superadmin' LIMIT 1"));
$logo = $DataSuperAdmin['logo'];
$toko = $DataSuperAdmin['toko'];
// Data login user tetap diambil untuk role dan username
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$role = $DataLogin['role'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="icon" class="border" href="icon/<?php echo $logo ?>">
    <link rel="icon" class="border" href="icon/<?php echo $logo ?>" type="image/ico">
    <link href="assets/css/stylecoba.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
    <style>
        .bg-coklat {
            background-color: #A43939;
        }

        .border {
            border-radius: 50%;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn-filter {
            margin-right: 10px;
        }

        .cf-badge {
            font-size: 0.8em;
            padding: 2px 6px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper chiller-theme">
        <a id="show-sidebar" class="btn btn-sm btn-dark border-0" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper btn-success">
            <div class="sidebar-content btn-dark ">
                <div class="sidebar-brand">
                    <a href="index.php"><i class="fas fa-home mr-1"></i><?php echo $toko ?></a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header btn-primary">
                    <div class="user-pic" style="height:70px;width:70px;">
                        <img class="border bg-primary img-responsive img-rounded img-thumbnail" src="icon/<?php echo $logo ?>" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?php echo $toko ?>
                        </span>
                        <span class="user-role"><?php echo ($role == 'superadmin') ? 'Super Admin' : 'Admin'; ?></span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->

                <div class="sidebar-menu">
                    <ul>
                        <?php if ($role == 'superadmin') { ?>
                            <li class="header-menu">
                                <span>Disleksia</span>
                            </li>
                            <li>
                                <a href="editd.php">
                                    <i class="fa fa-brain"></i>
                                    <span>Data Disleksia</span>
                                </a>
                            </li>
                            <li>
                                <a href="gejala.php">
                                    <i class="fa fa-clipboard"></i>
                                    <span>Gejala Disleksia</span>
                                </a>
                            </li>
                            <li>
                                <a href="cf.php">
                                    <i class="fa fa-circle-info"></i>
                                    <span>CF Disleksia</span>
                                </a>
                            </li>
                            <li class="header-menu">
                                <span>Disgrafia</span>
                            </li>
                            <li>
                                <a href="editd1.php">
                                    <i class="fa fa-brain"></i>
                                    <span>Data Disgrafia</span>
                                </a>
                            </li>
                            <li>
                                <a href="gejala1.php">
                                    <i class="fa fa-clipboard"></i>
                                    <span>Gejala Disgrafia</span>
                                </a>
                            </li>
                            <li>
                                <a href="cf1.php">
                                    <i class="fa fa-circle-info"></i>
                                    <span>CF Disgrafia</span>
                                </a>
                            </li>
                            <li class="header-menu">
                                <span>Manajemen User</span>
                            </li>
                            <li>
                                <a href="user_crud.php">
                                    <i class="fa fa-users"></i>
                                    <span>Kelola User</span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="header-menu">
                            <span>Laporan</span>
                        </li>
                        <li>
                            <a href="rekap_siswa.php">
                                <i class="fa fa-users"></i>
                                <span>Rekap Data Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="pengaturan.php">
                                <i class="fa fa-cog"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#Exit" data-toggle="modal">
                                <i class="fa fa-power-off"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <div class="sidebar-footer">
                <?php echo $toko ?> - <a target="_blank" rel="noopener noreferrer" href="https://ump.ac.id">
                    UMP</a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">

                <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>