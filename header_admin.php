<?php
include "koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['log'] != "login") {
    header("location:login.php");
}

$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$toko = $DataLogin['toko'];
$logo = $DataLogin['logo'];
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