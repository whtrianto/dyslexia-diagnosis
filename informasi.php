<?php include 'header.php'; ?>
<!-- Hero Section -->
<section class="container hero-section1 bg4 text-justify text-dar">
    <h1 class="text-center text-lig">Apa Itu Disleksia?</h1>
    <p>
        <span class="text-lig" style="font-size: 1.4em;">Disleksia</span> adalah gangguan belajar yang memengaruhi kemampuan seseorang untuk membaca, menulis, dan mengeja. Meskipun disleksia tidak terkait dengan tingkat kecerdasan, individu dengan disleksia seringkali mengalami kesulitan dalam memproses simbol bahasa tertulis. Gangguan ini disebabkan oleh perbedaan cara otak memproses informasi terkait huruf, kata, dan suara.
    </p>
    <p>
        <span class="text-lig" style="font-size: 1.4em;">Disleksia</span> dapat muncul dalam berbagai bentuk dan tingkat keparahan. Beberapa tanda umum disleksia meliputi kesulitan mengenali kata-kata yang sudah dikenal, membaca dengan lambat, dan kesulitan dalam memahami apa yang dibaca. Meskipun demikian, banyak individu dengan disleksia yang memiliki kemampuan luar biasa di bidang lain, seperti kreativitas, pemecahan masalah, dan pemikiran analitis.
    </p>
    <p>
        Dengan diagnosis yang tepat dan strategi belajar yang efektif, individu dengan disleksia dapat mengembangkan keterampilan membaca dan menulis yang baik, serta sukses dalam kehidupan akademis dan profesional mereka.
    </p>
    <br>
    <div class="text-center">
        <a href="diagnosa.php" class="btn btn-cta">Cek Sekarang</a>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="row text-center text-dar d-flex justify-content-center">
        <?php include 'koneksi.php'; ?>
        <?php
        // cek db penyakit
        $qry = "SELECT * FROM tb_penyakit";
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