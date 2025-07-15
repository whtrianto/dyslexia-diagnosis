<?php include 'header.php'; ?>
<!-- Hero Section -->
<section class="container hero-section1 abc text-justify text-dar">
    <h1 class="text-center text-lig">Apa Itu Disgrafia?</h1>
    <p>
        <span class="text-lig" style="font-size: 1.4em;">Disgrafia</span> adalah gangguan belajar yang memengaruhi kemampuan seseorang untuk menulis dengan rapi, terstruktur, dan sesuai aturan. Gangguan ini seringkali terkait dengan kesulitan dalam mengoordinasikan gerakan motorik halus yang diperlukan untuk menulis.
    </p>
    <p>
        <span class="text-lig" style="font-size: 1.4em;">Disgrafia</span> dapat menyebabkan tulisan tangan yang sulit dibaca, kesalahan dalam mengeja, dan kesulitan menyusun kalimat secara logis. Tanda-tanda lainnya meliputi penempatan huruf yang tidak konsisten, jarak antar kata yang tidak teratur, atau kecepatan menulis yang sangat lambat.
    </p>
    <p>
        Dengan dukungan yang tepat, seperti latihan motorik halus dan strategi belajar khusus, individu dengan disgrafia dapat meningkatkan keterampilan menulis mereka dan mengatasi hambatan dalam kegiatan akademis maupun sehari-hari.
    </p>
    <br>
    <div class="text-center">
        <a href="1_diagnosa.php" class="btn btn-cta">Cek Sekarang</a>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="row text-center text-dar d-flex justify-content-center">
        <?php include 'koneksi.php'; ?>
        <?php
        // cek db penyakit
        $qry = "SELECT * FROM 1_tb_penyakit";
        $data = mysqli_query($kon, $qry);
        // agar berlaku berulangan sebanyak data yg ada di tb_gejala
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <div class="col-md-4 mb-4">
                <a href="<?= $d['link'] ?>.php" style="text-decoration: none;">
                    <div class="feature-card">
                        <img src="icon/<?= $d['link'] ?>.svg" alt="<?= $d['penyakit'] ?>">
                        <h4 class="text-lig"><?= $d['penyakit'] ?></h4>
                        <p class="text-dark">
                            <?= $d['definisi'] ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>
<style>
    .btn-cta {
        font-size: 1.3rem;
        padding: 16px 40px;
        border-radius: 30px;
        background: linear-gradient(90deg, rgb(60, 50, 31) 0%, #908872 100%);
        color: #fff !important;
        font-weight: bold;
        box-shadow: 0 4px 16px rgba(140, 120, 80, 0.15);
        border: none;
        transition: all 0.2s;
        letter-spacing: 1px;
    }

    .btn-cta:hover,
    .btn-cta:focus {
        background: linear-gradient(90deg, #908872 0%, #bca970 100%);
        color: #fff !important;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 8px 24px rgba(140, 120, 80, 0.18);
        text-decoration: none;
    }

    .btn-cta-group {
        display: flex;
        justify-content: center;
        gap: 32px;
        margin: 60px 0 40px 0;
        flex-wrap: wrap;
    }

    .spacer-bottom {
        height: 80px !important;
    }

    .container,
    .page-content,
    .main-content {
        margin-bottom: 80px !important;
    }
</style>