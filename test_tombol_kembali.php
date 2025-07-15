<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php';
?>

<style>
    .btn-group-vertical .btn {
        border-radius: 8px !important;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-group-vertical .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d, #495057);
        border: none;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
</style>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <div class="btn-group" role="group">
                    <a class="btn btn-secondary btn-lg mr-2" href="#" style="text-decoration: none; min-width: 120px;">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <a class="btn btn-success btn-lg" href="#" style="text-decoration: none; min-width: 120px;">
                        <i class="fas fa-print mr-2"></i>CETAK
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body" style="background: linear-gradient(to right top, rgba(174, 169, 153, 0.9), rgba(235, 232, 223, 0.9));">
                    <h1 class="text-center mb-4">HASIL IDENTIFIKASI</h1>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle mr-2"></i>Layout Tombol yang Diperbaiki</h5>
                        <p class="mb-0">Tombol "CETAK" dan "Kembali" sekarang ditampilkan dengan:</p>
                        <ul class="mb-0 mt-2">
                            <li>Posisi horizontal (samping kiri dan kanan)</li>
                            <li>Warna yang menarik (hijau untuk CETAK, abu-abu untuk Kembali)</li>
                            <li>Ikon yang sesuai (printer dan panah kiri)</li>
                            <li>Efek hover yang smooth</li>
                            <li>Ukuran yang konsisten</li>
                            <li><strong>Cache-busting untuk mobile</strong> - mencegah masalah PDF lama</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">NAMA:</label>
                        <textarea class="form-control" rows="1" readonly>Contoh Nama Siswa</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">IDENTIFIKASI:</label>
                        <textarea class="form-control" rows="1" readonly>Disleksia Fonologis (CF: 85.5%)</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DEFINISI:</label>
                        <textarea class="form-control" rows="3" readonly>Disleksia fonologis adalah gangguan membaca yang disebabkan oleh kesulitan dalam memproses bunyi bahasa.</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>