<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}
$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM login WHERE userid='$uid'"));
if ($DataLogin['role'] !== 'superadmin') {
    echo '<div class="container my-5"><div class="alert alert-danger">Akses hanya untuk Super Admin!</div></div>';
    exit;
}

// Handle tambah user
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($kon, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $toko = mysqli_real_escape_string($kon, $_POST['toko']);
    $logo = '';
    $role = mysqli_real_escape_string($kon, $_POST['role']);
    // Proses upload file logo jika ada
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['logo_file']['name'], PATHINFO_EXTENSION);
        $new_filename = 'logo_new_' . time() . '.' . $ext;
        $target_path = 'icon/' . $new_filename;
        if (move_uploaded_file($_FILES['logo_file']['tmp_name'], $target_path)) {
            $logo = $new_filename;
        }
    }
    mysqli_query($kon, "INSERT INTO login (username, password, toko, logo, role) VALUES ('$username', '$password', '$toko', '$logo', '$role')");
    $_SESSION['user_action'] = 'tambah';
    header('Location: user_crud.php');
    exit;
}
// Handle hapus user
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    if ($id != $uid) { // Tidak bisa hapus diri sendiri
        mysqli_query($kon, "DELETE FROM login WHERE userid=$id");
        $_SESSION['user_action'] = 'hapus';
    }
    header('Location: user_crud.php');
    exit;
}
// Handle edit user
if (isset($_POST['edit'])) {
    $id = intval($_POST['userid']);
    $username = mysqli_real_escape_string($kon, $_POST['username']);
    $toko = mysqli_real_escape_string($kon, $_POST['toko']);
    $role = mysqli_real_escape_string($kon, $_POST['role']);
    $logo = mysqli_real_escape_string($kon, $_POST['logo']);
    // Proses upload file logo jika ada
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['logo_file']['name'], PATHINFO_EXTENSION);
        $new_filename = 'logo_' . $id . '_' . time() . '.' . $ext;
        $target_path = 'icon/' . $new_filename;
        if (move_uploaded_file($_FILES['logo_file']['tmp_name'], $target_path)) {
            $logo = $new_filename;
        }
    }
    $setpass = '';
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $setpass = ", password='$password'";
    }
    mysqli_query($kon, "UPDATE login SET username='$username', toko='$toko', logo='$logo', role='$role' $setpass WHERE userid=$id");
    $_SESSION['user_action'] = 'simpan';
    header('Location: user_crud.php');
    exit;
}
// Ambil semua user
$users = mysqli_query($kon, "SELECT * FROM login ORDER BY userid ASC");
?>
<?php include 'sidebar.php'; ?>
<style>
    @media (max-width: 576px) {
        .hide-mobile {
            display: none !important;
        }

        .scroll-hint {
            font-size: 0.9em;
            color: #888;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .form-row-mobile>.col-md-2 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 8px;
        }

        .stack-mobile {
            display: block !important;
            width: 100% !important;
            margin-bottom: 4px;
            border: none !important;
        }

        .stack-label {
            font-size: 0.85em;
            color: #555;
            font-weight: bold;
            margin-bottom: 2px;
            display: block;
        }

        .table thead {
            display: none;
        }
    }
</style>
<div class="container my-5">
    <h2>Manajemen User Login</h2>
    <form method="POST" class="mb-4" enctype="multipart/form-data">
        <div class="row form-row-mobile">
            <div class="col-md-2 mb-2"><input required name="username" class="form-control" placeholder="Username"></div>
            <div class="col-md-2 mb-2 position-relative">
                <input required name="password" type="password" class="form-control" placeholder="Password" id="addPassword">
                <span class="toggle-password" onclick="togglePassword('addPassword', this)" style="position:absolute;top:8px;right:25px;cursor:pointer;">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <div class="col-md-2 mb-2"><input required name="toko" class="form-control" placeholder="Nama Admin"></div>
            <div class="col-md-2 mb-2">
                <input type="file" name="logo_file" accept="image/*" class="form-control mb-1" onchange="previewLogo(this, 'add')">
                <input name="logo" class="form-control" placeholder="Logo (opsional)" type="hidden">
                <div class="mt-1" id="logo-preview-add"></div>
            </div>
            <div class="col-md-2 mb-2">
                <select name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>
            <div class="col-md-2 mb-2"><button type="submit" name="tambah" class="btn btn-success btn-block">Tambah User</button></div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-users mr-2"></i>Daftar User</h5>
                </div>
                <div class="card-body p-2">
                    <div class="d-none d-md-block">
                        <div class="table-responsive" style="overflow-x:auto;">
                            <table class="table table-bordered table-striped dt-responsive nowrap" id="userTable" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Nama Admin</th>
                                        <th>Logo</th>
                                        <th>Role</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($u = mysqli_fetch_assoc($users)) {
                                        if ($u['userid'] == 1) continue; ?>
                                        <tr>
                                            <form method="POST" enctype="multipart/form-data">
                                                <td><?php echo $no++; ?><input type="hidden" name="userid" value="<?php echo $u['userid']; ?>"></td>
                                                <td><input name="username" value="<?php echo htmlspecialchars($u['username']); ?>" class="form-control mb-1"></td>
                                                <td><input name="toko" value="<?php echo htmlspecialchars($u['toko']); ?>" class="form-control mb-1"></td>
                                                <td>
                                                    <input type="file" name="logo_file" accept="image/*" class="form-control mb-1" onchange="previewLogo(this, <?php echo $u['userid']; ?>)">
                                                    <input type="hidden" name="logo" value="<?php echo htmlspecialchars($u['logo']); ?>">
                                                    <?php if (!empty($u['logo'])) { ?>
                                                        <div class="mt-1" id="logo-preview-<?php echo $u['userid']; ?>">
                                                            <img src="icon/<?php echo htmlspecialchars($u['logo']); ?>" alt="Logo" style="max-width:40px;max-height:40px;border-radius:4px;border:1px solid #ccc;">
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="mt-1" id="logo-preview-<?php echo $u['userid']; ?>"></div>
                                                    <?php } ?>
                                                </td>
                                                <td><select name="role" class="form-control mb-1">
                                                        <option value="admin" <?php if ($u['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                        <option value="superadmin" <?php if ($u['role'] == 'superadmin') echo 'selected'; ?>>Super Admin</option>
                                                    </select></td>
                                                <td>
                                                    <div class="position-relative mb-1">
                                                        <input name="password" type="password" class="form-control" placeholder="(Opsional)" id="editPassword<?php echo $u['userid']; ?>">
                                                        <span class="toggle-password" onclick="togglePassword('editPassword<?php echo $u['userid']; ?>', this)" style="position:absolute;top:8px;right:12px;cursor:pointer;">
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <button type="submit" name="edit" class="btn btn-info btn-sm mb-1 mr-1">Simpan</button>
                                                        <?php if ($u['userid'] != $uid) { ?>
                                                            <a href="user_crud.php?hapus=<?php echo $u['userid']; ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus user ini?')">Hapus</a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Mobile Card Layout -->
                    <div class="d-block d-md-none">
                        <div class="row">
                            <?php mysqli_data_seek($users, 0);
                            $no_mobile = 1;
                            while ($u = mysqli_fetch_assoc($users)) {
                                if ($u['userid'] == 1) continue; ?>
                                <div class="col-12 mb-3">
                                    <div class="card border shadow-sm">
                                        <div class="card-body p-2">
                                            <form method="POST">
                                                <input type="hidden" name="userid" value="<?php echo $u['userid']; ?>">
                                                <div class="mb-2"><span class="font-weight-bold">ID:</span> <?php echo $no_mobile++; ?></div>
                                                <div class="mb-2"><span class="font-weight-bold">Username:</span><input name="username" value="<?php echo htmlspecialchars($u['username']); ?>" class="form-control"></div>
                                                <div class="mb-2"><span class="font-weight-bold">Nama Admin:</span><input name="toko" value="<?php echo htmlspecialchars($u['toko']); ?>" class="form-control"></div>
                                                <div class="mb-2"><span class="font-weight-bold">Logo:</span><input name="logo" value="<?php echo htmlspecialchars($u['logo']); ?>" class="form-control"></div>
                                                <div class="mb-2"><span class="font-weight-bold">Role:</span><select name="role" class="form-control">
                                                        <option value="admin" <?php if ($u['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                        <option value="superadmin" <?php if ($u['role'] == 'superadmin') echo 'selected'; ?>>Super Admin</option>
                                                    </select></div>
                                                <div class="mb-2"><span class="font-weight-bold">Password:</span>
                                                    <div class="position-relative">
                                                        <input name="password" type="password" class="form-control" placeholder="Password (opsional)" id="editPasswordMobile<?php echo $u['userid']; ?>">
                                                        <span class="toggle-password" onclick="togglePassword('editPasswordMobile<?php echo $u['userid']; ?>', this)" style="position:absolute;top:8px;right:12px;cursor:pointer;">
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <button type="submit" name="edit" class="btn btn-info btn-sm mb-1 mr-1">Simpan</button>
                                                    <?php if ($u['userid'] != $uid) { ?>
                                                        <a href="user_crud.php?hapus=<?php echo $u['userid']; ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus user ini?')">Hapus</a>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['user_action'])) {
    $msg = '';
    if ($_SESSION['user_action'] == 'tambah') $msg = 'User berhasil ditambahkan!';
    if ($_SESSION['user_action'] == 'simpan') $msg = 'Data user berhasil disimpan!';
    if ($_SESSION['user_action'] == 'hapus') $msg = 'User berhasil dihapus!';
    echo "<script>setTimeout(function(){alert('$msg');}, 300);</script>";
    unset($_SESSION['user_action']);
}
?>
<script>
    function togglePassword(inputId, el) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            el.querySelector('i').classList.remove('fa-eye');
            el.querySelector('i').classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            el.querySelector('i').classList.remove('fa-eye-slash');
            el.querySelector('i').classList.add('fa-eye');
        }
    }

    function previewLogo(input, userid) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('logo-preview-' + userid);
                if (preview) {
                    preview.innerHTML = '<img src="' + e.target.result + '" style="max-width:40px;max-height:40px;border-radius:4px;border:1px solid #ccc;">';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php include 'footer1.php'; ?>