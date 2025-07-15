<?php
// Mulai session
session_start();

// Pastikan DOMPDF di-load
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Periksa apakah nama pengguna tersedia di session
if (!isset($_SESSION["nama"])) {
    die("Nama tidak ditemukan di session");
}

// Periksa hasil diagnosa yang disimpan sebelumnya
if (!isset($_SESSION["penyakit"]) || !isset($_SESSION["definisi"]) || !isset($_SESSION["penanganan"]) || !isset($_SESSION["link"]) || !isset($_SESSION["certainty_factors"])) {
    die("Data hasil diagnosa tidak lengkap di session");
}

// Ambil data dari session
$nama = $_SESSION["nama"];
$umur = $_SESSION["umur"];
$penyakit = $_SESSION["penyakit"];
$definisi = $_SESSION["definisi"];
$penanganan = $_SESSION["penanganan"];
$link = $_SESSION["link"];
$certainty_factors = $_SESSION["certainty_factors"];
$best_cf = $_SESSION["best_cf"];

// Ambil daftar gejala yang dipilih dari database jika tersedia di session
$gejala_dipilih = '';
if (isset($_SESSION['gejala_dipilih'])) {
    $gejala_dipilih = $_SESSION['gejala_dipilih'];
} else {
    // Coba ambil dari database jika session tidak ada
    include 'koneksi.php';
    $qry = "SELECT gejala_dipilih FROM tb_diagnosa_siswa WHERE nama='" . mysqli_real_escape_string($kon, $nama) . "' ORDER BY tanggal_diagnosa DESC LIMIT 1";
    $res = mysqli_query($kon, $qry);
    if ($row = mysqli_fetch_assoc($res)) {
        $gejala_dipilih = $row['gejala_dipilih'];
    }
}

// Ambil nama gejala dari kode
$daftar_gejala = [];
if (!empty($gejala_dipilih)) {
    $kode_gejala = array_map('trim', explode(',', $gejala_dipilih));
    // Cek jenis diagnosa dari session atau database
    $jenis_diagnosa = 'disleksia';
    if (isset($_SESSION['jenis_diagnosa'])) {
        $jenis_diagnosa = $_SESSION['jenis_diagnosa'];
    } else {
        // Coba ambil dari database
        $qry = "SELECT jenis_diagnosa FROM tb_diagnosa_siswa WHERE nama='" . mysqli_real_escape_string($kon, $nama) . "' ORDER BY tanggal_diagnosa DESC LIMIT 1";
        $res = mysqli_query($kon, $qry);
        if ($row = mysqli_fetch_assoc($res)) {
            $jenis_diagnosa = $row['jenis_diagnosa'];
        }
    }
    $tabel_gejala = $jenis_diagnosa == 'disgrafia' ? '1_tb_gejala' : 'tb_gejala';
    foreach ($kode_gejala as $kode) {
        $q = "SELECT gejala FROM $tabel_gejala WHERE kode='" . mysqli_real_escape_string($kon, $kode) . "'";
        $r = mysqli_query($kon, $q);
        if ($g = mysqli_fetch_assoc($r)) {
            $daftar_gejala[] = $g['gejala'];
        } else {
            $daftar_gejala[] = $kode;
        }
    }
}

// Siapkan tabel gejala untuk HTML
$html_gejala = '';
if (!empty($daftar_gejala)) {
    $html_gejala = "<div class='form-group'><label>Gejala yang Dipilih:</label><ul style='padding-left:18px;'>";
    foreach ($daftar_gejala as $g) {
        $html_gejala .= "<li>" . htmlspecialchars($g) . "</li>";
    }
    $html_gejala .= "</ul></div>";
}

// Siapkan tabel CF lain
$html_cf = '';
if (!empty($certainty_factors)) {
    // Cek jenis diagnosa
    $jenis_diagnosa = isset($jenis_diagnosa) ? $jenis_diagnosa : 'disleksia';
    $tabel_penyakit = $jenis_diagnosa == 'disgrafia' ? '1_tb_penyakit' : 'tb_penyakit';
    $max_cf = max($certainty_factors);
    $html_cf = "<div class='form-group'><label>Hasil CF Lainnya:</label><table border='1' cellpadding='5' cellspacing='0' width='100%'><tr><th>Jenis " . ucfirst($jenis_diagnosa) . "</th><th>Certainty Factor (%)</th></tr>";
    include 'koneksi.php';
    foreach ($certainty_factors as $id_penyakit => $cf_value) {
        $qry = "SELECT penyakit FROM $tabel_penyakit WHERE id = '" . mysqli_real_escape_string($kon, $id_penyakit) . "'";
        $res = mysqli_query($kon, $qry);
        $penyakit_name = ($row = mysqli_fetch_assoc($res)) ? $row['penyakit'] : $id_penyakit;
        $cf_percent = round($cf_value * 100, 2);
        $style = ($cf_value == $max_cf) ? 'font-weight:bold;color:green;' : 'color:#504b3f;';
        $html_cf .= "<tr><td style='$style'>" . htmlspecialchars($penyakit_name) . "</td><td style='$style'>" . $cf_percent . "%</td></tr>";
    }
    $html_cf .= "</table></div>";
}

// Atur opsi DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Konten HTML yang akan di-render menjadi PDF
$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 32px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 3px solid #bca970;
            display: inline-block;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            display: block;
            margin-bottom: 10px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            color: #555;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            resize: none;
        }
        .form-control:focus {
            border-color: #4a3b0f;
            box-shadow: 0 0 5px rgba(78, 52, 13, 0.5);
            outline: none;
            background-color: #ffffff;
        }
        .form-control[readonly] {
            background-color: #f5f7fa;
            border-color: #ddd;
        }
        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #888;
            background: none;
            padding-bottom: 10px;
        }
        .footer a { color: #888; text-decoration: none; }
        .footer a:hover { text-decoration: underline; color: #bca970; }
        .web { display: none; }
        #nama, #umur, #penyakit {
            height: 25px;
            font-size: 15px;
            font-weight: bold;
        }
        #definisi {
            min-height: 120px;
            line-height: 1.6;
            text-align: justify;
            font-weight: bold;
        }
        #penanganan {
            min-height: 230px;
            line-height: 1.6;
            text-align: justify;
            font-weight: bold;
        }
        a {
            color: #bca970;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        table { border-collapse: collapse; }
        th, td { padding: 6px 10px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Hasil Identifikasi</h1>
        <div class='form-group'>
            <label for='nama'>Nama:</label>
            <textarea class='form-control' id='nama' rows='1' style='font-family: 'Times New Roman', sans-serif;' readonly>$nama</textarea>
        </div>
        <div class='form-group'>
            <label for='umur'>Umur:</label>
            <textarea class='form-control' id='umur' rows='1' style='font-family: 'Times New Roman', sans-serif;' readonly>" . ($umur !== '' ? $umur . ' tahun' : '') . "</textarea>
        </div>
        <div class='form-group'>
            <label for='penyakit'>Identifikasi:</label>
            <textarea class='form-control' id='penyakit' rows='1' style='font-family: 'Times New Roman', sans-serif;' readonly>$penyakit 
            </textarea>
        </div>
        <div class='form-group'>
            <label for='definisi'>Definisi:</label>
            <textarea class='form-control' id='definisi' rows='6' style='font-family: 'Times New Roman', sans-serif;' readonly>$definisi</textarea>
        </div>
        <div class='page-break'></div>
        <div class='form-group'>
            <label for='penanganan'>Penanganan:</label>
            <textarea class='form-control' id='penanganan' rows='10' style='font-family: 'Times New Roman', sans-serif;' readonly>$penanganan</textarea>
        </div>
    </div>
    <div class='footer'>
        &copy; 2025 SIABID | <a href='https://portofolio-wahyu-trianto.vercel.app'>Sistem Pakar Diagnosa Gangguan Belajar</a>
    </div>
    <div class='page-break'></div>
    <div class='container'>
        <h1>Detail Identifikasi</h1>
        $html_gejala
        $html_cf
    </div>
    <div class='footer'>
        &copy; 2025 SIABID | <a href='https://portofolio-wahyu-trianto.vercel.app'>Sistem Pakar Diagnosa Gangguan Belajar</a>
    </div>
</body>
</html>
";

// (CF: " . round($best_cf * 100, 2) . "%)

// Load HTML ke DOMPDF
$dompdf->loadHtml($html);

// (Opsional) Atur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Tentukan nama file berdasarkan nama di session
$filename = $nama . '.pdf';

// Tambahkan timestamp untuk cache-busting
$timestamp = time();

// Kirim header untuk memberitahukan browser bahwa ini adalah file PDF
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// Output PDF ke browser
echo $dompdf->output();

// Hapus semua data sesi setelah cetak
session_unset(); // menghapus semua variabel session
session_destroy(); // menghancurkan sesi
