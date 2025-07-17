<?php
include 'sidebar.php';
include 'koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$toko = $DataLogin['toko'];
$logo = isset($DataLogin['logo']) ? $DataLogin['logo'] : 'default_logo.png';
?>
<!-- isinya -->
<?php
if (isset($_POST['SimpanEdit'])) {
    $uname = htmlspecialchars($_POST['username']);
    $ntoko = htmlspecialchars($_POST['nama_toko']);
    $pass = mysqli_real_escape_string($kon, $_POST['password']);

    $queryuser = mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if (password_verify($pass, $cariuser['password'])) {
        if ($cariuser) {
            $cekDataUpdate =  mysqli_query($kon, "UPDATE login SET username='$uname',
        toko='$ntoko'
         WHERE userid='$uid'") or die(mysqli_connect_error());
            if ($cekDataUpdate) {
                echo '<script>history.go(-1);</script>';
            } else {
                echo '<script>alert("Gagal Edit Data");history.go(-1);</script>';
            }
        }
    } else {
        echo '<script>alert("Maaf password salah");history.go(-1);</script>';
    }
};

if (isset($_POST['UpdatePass'])) {
    $pass1 = mysqli_real_escape_string($kon, $_POST['pswd1']);

    $querypass = mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'");
    $caripass = mysqli_fetch_assoc($querypass);

    if (password_verify($pass1, $caripass['password'])) {
        if ($caripass) {

            $pass2 = $_POST['pswd2'];
            $pass3 = password_hash($_POST['pswd3'], PASSWORD_DEFAULT);

            if (password_verify($pass2, $pass3)) {
                $cekPass =  mysqli_query($kon, "UPDATE login SET password='$pass3'
                    WHERE userid='$uid'") or die(mysqli_connect_error());
                if ($cekPass) {
                    echo '<script>alert("Password Berhasil di update");history.go(-1);</script>';
                } else {
                    echo '<script>alert("Gagal update password");history.go(-1);</script>';
                }
            } else {
                echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
            }
        }
    } else {
        echo '<script>alert("Maaf password salah");history.go(-1);</script>';
    }
};
?>
<br>
<h1 class="h3 mb-2">Pengaturan</h1>
<!-- Profile widget -->
<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 bg-coklat" style="border-radius:0.25rem;">
        <div class="media align-items-end profile-header">
            <form method="POST" action="proses-logo.php" enctype="multipart/form-data">
                <div class=" profile mr-3">
                    <label for="logo"><img src="icon/<?php echo $logo ?>" alt="logo" class="border img-cover-profile mb-2 img-thumbnail"></label>
                    <input type="file" class="d-none" id="logo" onchange="form.submit()" name="file" />
                </div>
            </form>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-0"><?php echo $username ?></h4>
                <p class="small mb-4">Admin</p>
            </div>
        </div>
    </div>

    <div class="py-4 px-4 mt-5">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#PageProfile" style="letter-spacing: 1px;">
                    <i class="fa fa-user mr-1"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#PagePassword" style="letter-spacing: 1px;">
                    <i class="fa fa-lock mr-1"></i> Password</a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div id="PageProfile" class="tab-pane active">
                <form method="post">
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label" for="namatoko">Nama<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input name="nama_toko" type="text" class="form-control" value="<?php echo $toko ?>" id="namatoko" placeholder="nama sekolah" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label" for="username">Username<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input name="username" type="text" class="form-control" value="<?php echo $username ?>" id="username" placeholder="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-11 col-lg-7 text-right">
                            <div id="Ada1">
                                <button type="button" class="btn btn-warning px-4" onclick="GetVerif()">Ganti</button>
                            </div>
                            <div style="display:none;width: 100%;" class="cuss" id="Tambah1">
                                <div class="tengah-tengah px-3">
                                    <div class="input-group">
                                        <input name="password" type="password" placeholder="Verifikasi Password" class="form-control mr-2" required>
                                        <div class="input-group-append">
                                            <button type="submit" name="SimpanEdit" class="btn btn-info px-3">Ganti</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div id="PagePassword" class="tab-pane fade"><br>
                <form method="POST">
                    <!-- Password Lama -->
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Lama<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4 input-group">
                            <input type="password" name="pswd1" id="pswd1" placeholder="********" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" onclick="togglePassword('pswd1', this)" style="cursor:pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4 input-group">
                            <input type="password" name="pswd2" id="pswd2" placeholder="********" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" onclick="togglePassword('pswd2', this)" style="cursor:pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4 input-group">
                            <input type="password" name="pswd3" id="pswd3" placeholder="********" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" onclick="togglePassword('pswd3', this)" style="cursor:pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-11 col-lg-7 text-right">
                            <button type="submit" name="UpdatePass" class="btn btn-warning px-4">Ganti</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Script Toggle Password -->
            <script>
                function togglePassword(fieldId, eyeIcon) {
                    const input = document.getElementById(fieldId);
                    if (input.type === "password") {
                        input.type = "text";
                        eyeIcon.textContent = "🙈"; // ganti ikon saat terlihat
                    } else {
                        input.type = "password";
                        eyeIcon.textContent = "👁️";
                    }
                }
            </script>


        </div><!-- End tab -->
    </div>
</div><!-- End profile widget -->

<!-- end isinya -->
</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
                <button type="button" class="btn btn-info px-4 mr-2" data-dismiss="modal">Batal</button>
                <a href="logout.php" class="btn btn-danger px-4">Keluar</a>
            </div>
        </div>
    </div>
    <!-- end Modal Exit -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script>
        function GetVerif() {
            var x = document.getElementById("Ada1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            var y = document.getElementById("Tambah1");
            if (y.style.display === "block") {
                y.style.display = "none";
            } else {
                y.style.display = "block";
            }
        }
    </script>
    </body>

    </html>