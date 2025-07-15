<?php include 'header.php';
session_start();
?>
<!-- Main Content -->
<div class="container content">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="row">
                <!-- Diagnosis Form Section -->
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div style="background-color: #3B2F2F;" class="card-header">
                            <h4 class="text-light text-center">Formulir Gejala Disgrafia</h4>
                        </div>
                        <div class="card-body p-4" style="background: linear-gradient(to right top, rgba(174, 169, 153, 0.9), rgba(235, 232, 223, 0.9));">
                            <?php include 'koneksi.php'; ?>
                            <form method="POST" action="1_proses.php">
                                <div style="overflow-y: auto; height: 370px;">
                                    <div class="container">
                                        <div class="row align-items-center ">
                                            <label for="nama" class=" col-form-label">
                                                <h5>
                                                    Nama
                                                </h5>
                                            </label>
                                            <div class=" text-center">
                                                <h5 style="margin-left: 15px;">:</h5>
                                            </div>
                                            <div class="col">
                                                <input autocomplete="off" required class="form-control" type="text" name="nama" id="nama" placeholder="Masukkan nama Anda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row align-items-center ">
                                            <label for="umur" class=" col-form-label">
                                                <h5>
                                                    Umur
                                                </h5>
                                            </label>
                                            <div class=" text-center">
                                                <h5 style="margin-left: 18px;">:</h5>
                                            </div>
                                            <div class="col">
                                                <input autocomplete="off" required class="form-control mb-2" type="number" name="umur" id="umur" placeholder="Umur (tahun)">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h5>
                                        Gejala yang dimiliki :
                                    </h5>
                                    <?php
                                    // cek db gejala
                                    $qry = "SELECT * FROM 1_tb_gejala";
                                    $data = mysqli_query($kon, $qry);
                                    // agar berlaku berulangan sebanyak data yg ada di 1_tb_gejala
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="<?= $d['kode'] ?>" id="gejala<?= $d['id'] ?>" name="gejala[]">
                                            <label class="form-check-label ml-2" for="gejala<?= $d['id'] ?>">
                                                <?= $d['gejala'] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-block mt-4 custom-btn text-light" style="background-color:#908872; border: #333;" name="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br><br>
<?php include 'footer.php'; ?>