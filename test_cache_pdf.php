<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php';
?>

<style>
    .test-container {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .info-box {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border-left: 4px solid #2196f3;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .warning-box {
        background: linear-gradient(135deg, #fff3e0, #ffcc02);
        border-left: 4px solid #ff9800;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .btn-test {
        background: linear-gradient(135deg, #4caf50, #45a049);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin: 10px 5px;
    }

    .btn-test:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="test-container">
                <h2 class="text-center mb-4">
                    <i class="fas fa-mobile-alt mr-2"></i>
                    Test Cache PDF untuk Mobile
                </h2>

                <div class="info-box">
                    <h5><i class="fas fa-info-circle mr-2"></i>Masalah yang Diperbaiki:</h5>
                    <ul class="mb-0">
                        <li>Browser mobile menyimpan cache PDF lama</li>
                        <li>Ketika cetak hasil baru, yang muncul tetap PDF lama</li>
                        <li>Cache tidak ter-update otomatis</li>
                    </ul>
                </div>

                <div class="warning-box">
                    <h5><i class="fas fa-tools mr-2"></i>Solusi yang Diterapkan:</h5>
                    <ul class="mb-0">
                        <li><strong>Cache-Control Headers:</strong> Mencegah browser menyimpan cache</li>
                        <li><strong>Timestamp Parameter:</strong> Setiap link cetak memiliki timestamp unik</li>
                        <li><strong>No-Cache Headers:</strong> Memaksa browser mengambil data baru</li>
                        <li><strong>Session Cleanup:</strong> Membersihkan session setelah cetak</li>
                    </ul>
                </div>

                <div class="text-center mt-4">
                    <h5>Test Tombol Cetak dengan Cache-Busting:</h5>

                    <a href="generate_pdf.php?t=<?php echo time(); ?>" target="_blank" class="btn-test">
                        <i class="fas fa-print mr-2"></i>Test Cetak Sekarang
                    </a>

                    <a href="generate_pdf.php?t=<?php echo time(); ?>&test=1" target="_blank" class="btn-test">
                        <i class="fas fa-redo mr-2"></i>Test Cetak Lagi
                    </a>
                </div>

                <div class="mt-4">
                    <h6><i class="fas fa-code mr-2"></i>Parameter yang Ditambahkan:</h6>
                    <code>generate_pdf.php?t=<?php echo time(); ?></code>
                    <br><small class="text-muted">Timestamp: <?php echo date('Y-m-d H:i:s'); ?></small>
                </div>

                <div class="mt-4">
                    <h6><i class="fas fa-list mr-2"></i>Header Cache yang Ditambahkan:</h6>
                    <ul class="list-unstyled">
                        <li><code>Cache-Control: no-cache, no-store, must-revalidate</code></li>
                        <li><code>Pragma: no-cache</code></li>
                        <li><code>Expires: 0</code></li>
                        <li><code>Last-Modified: [timestamp]</code></li>
                    </ul>
                </div>

                <div class="alert alert-success mt-4">
                    <h6><i class="fas fa-check-circle mr-2"></i>Cara Test di Mobile:</h6>
                    <ol class="mb-0">
                        <li>Buka halaman ini di browser mobile</li>
                        <li>Klik tombol "Test Cetak Sekarang"</li>
                        <li>PDF akan terbuka di tab baru</li>
                        <li>Kembali ke halaman ini</li>
                        <li>Klik "Test Cetak Lagi" - PDF baru akan muncul</li>
                        <li>Cache lama tidak akan digunakan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>