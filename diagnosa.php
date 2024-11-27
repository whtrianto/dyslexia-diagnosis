<?php include 'header.php'; ?>
<br>
<!-- Main Content -->
<div class="container content">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <!-- Diagnosis Form Section -->
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div style="background-color: #3B2F2F;" class="card-header">
                            <h5 class="text-light text-center">Formulir Diagnosa Gejala Disleksia</h5>
                        </div>
                        <div class="card-body p-4" style="background: linear-gradient(to right top, rgba(174, 169, 153, 0.9), rgba(235, 232, 223, 0.9));">
                            <?php include 'koneksi.php'; ?>
                            <form method="POST" action="proses.php">
                                <div style="overflow-y: auto; height: 300px;">
                                    <?php
                                    // cek db gejala
                                    $qry = "SELECT * FROM tb_gejala";
                                    $data = mysqli_query($kon, $qry);
                                    // agar berlaku berulangan sebanyak data yg ada di tb_gejala
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="<?= $d['kode'] ?>" id="gejala<?= $d['id'] ?>" name="gejala[]">
                                            <label class="form-check-label" for="gejala<?= $d['id'] ?>">
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
</div>
<?php include 'footer.php'; ?>