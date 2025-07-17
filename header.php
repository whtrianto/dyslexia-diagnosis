<?php
include 'koneksi.php';
$sql    = "SELECT * FROM login WHERE role='superadmin' LIMIT 1";
$query  = mysqli_query($kon, $sql);
$data = mysqli_fetch_array($query);
// Siapkan data default jika tidak ada superadmin
$logo = isset($data["logo"]) ? $data["logo"] : 'default_logo.png';
$toko = isset($data["toko"]) ? $data["toko"] : 'Sistem Pakar';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="icon/<?php echo $logo; ?>">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Sistem Pakar Identifikasi Disleksia</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #3B2F2F;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <div class="d-flex justify-content-between justify-content-lg-start w-100 flex-wrap nav-links">
        <a class="navbar-brand" href="index.php">
          <img src="icon/hom.svg" alt=""> Home
        </a>
        <a class="navbar-brand" href="panduan.php">
          <img src="icon/pan.svg" alt=""> Panduan
        </a>
        <a class="navbar-brand" href="informasi.php">
          <img src="icon/diagnosa.svg" alt=""> Cek Disleksia
        </a>
        <a class="navbar-brand" href="1_informasi.php">
          <img src="icon/diagnosa.svg" alt=""> Cek Disgrafia
        </a>
      </div>
    </div>
    <div class="ml-auto text-center">
      <h4><?php echo $toko; ?> | Sistem Pakar Identifikasi Gangguan Belajar</h4>
    </div>
  </nav>
  <br>