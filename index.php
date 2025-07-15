<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="container hero-section text-center" style="margin-bottom: 80px;">
    <h1 class="text-lig">Pengecekan Gangguan Belajar dengan Mudah dan Cepat</h1>
    <h4 class="text-dar">
        Sistem pakar kami membantu mendeteksi gangguan belajar secara cepat dengan berbasis data terpercaya. Lakukan pengecekan sekarang dan dapatkan panduan untuk penanganan yang cepat dan tepat.
    </h4> <br>
    <div class="btn-cta-group">
        <a href="informasi.php" class="btn btn-cta">Cek Disleksia</a>
        <a href="1_informasi.php" class="btn btn-cta">Cek Disgrafia</a>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="row text-center text-dar">
        <!-- Feature 1 -->
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <img src="icon/cepat.svg" alt="Identifikasi Cepat">
                <h4 class="text-lig">Identifikasi Cepat</h4>
                <p class="text-dark">
                    Sistem kami memungkinkan identifikasi yang cepat dan mudah dalam mendeteksi gejala disleksia pada anak.
                </p>
            </div>
        </div>
        <!-- Feature 2 -->
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <img src="icon/target.svg" alt="Data Akurat">
                <h4 class="text-lig">Data Akurat</h4>
                <p class="text-dark">
                    Identifikasi berdasarkan data yang akurat dan penelitian medis terbaru, memastikan hasil yang dapat diandalkan.
                </p>
            </div>
        </div>
        <!-- Feature 3 -->
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <img src="icon/24w.svg" alt="Akses Mudah">
                <h4 class="text-lig">Akses Kapan Saja</h4>
                <p class="text-dark">
                    Platform kami dapat diakses kapan saja dan di mana saja, memudahkan proses identifikasi secara fleksibel.
                </p>
            </div>
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