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
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$toko = $DataLogin['toko'];
$logo = $DataLogin['logo'];
?>

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
                <span class="user-role">Admin</span>
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
            </div>
        </div>
        <!-- sidebar-header  -->

        <div class="sidebar-menu">
            <ul>
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
                <br>
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
                <br>
                <li class="header-menu">
                    <span>Laporan</span>
                </li>
                <li>
                    <a href="rekap_siswa.php">
                        <i class="fa fa-users"></i>
                        <span>Rekap Data Siswa</span>
                    </a>
                </li>
                <br>
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
        SIABID - <a target="_blank" rel="noopener noreferrer" href="https://ump.ac.id">
            UMP</a>
    </div>
</nav>
<!-- sidebar-wrapper  -->