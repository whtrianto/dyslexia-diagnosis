<?php
@ob_start();
session_start();
include 'koneksi.php';
if (!isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($kon, $_POST['username']);
    $pass = mysqli_real_escape_string($kon, $_POST['password']);
    $queryuser = mysqli_query($kon, "SELECT * FROM login WHERE username='$user'");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if (password_verify($pass, $cariuser['password'])) {
        $_SESSION['userid'] = $cariuser['userid'];
        $_SESSION['username'] = $cariuser['username'];
        $_SESSION['log'] = "login";

        if ($cariuser) {
            echo '<script>alert("Data yang anda masukan benar");window.location="rekap_siswa.php"</script>';
        } else {
            echo '<script>alert("Data yang anda masukan salah");history.go(-1);</script>';
        }
        echo '<script>alert("Anda Berhasil Login");window.location="index.php"</script>';
    } else {
        echo '<script>alert("Username atau password salah");history.go(-1);</script>';
    }
};
?>

<?php
include 'koneksi.php';
$sql    = "SELECT * FROM login WHERE role='superadmin' LIMIT 1";
$query  = mysqli_query($kon, $sql);
$data = mysqli_fetch_array($query);
// Siapkan data default jika tidak ada superadmin
$logo = isset($data["logo"]) ? $data["logo"] : 'default_logo.png';
$toko = isset($data["toko"]) ? $data["toko"] : 'Sistem Pakar';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | <?php echo $data["toko"]; ?></title>
    <link rel="icon" href="icon/<?php echo $data["logo"]; ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style1.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-image: url('image/bg11.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .border {
            border-radius: 50%;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-bottom: 10px;
        }

        .input-group-append .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: 0;
            background-color: #f8f9fa;
            border-color: #ced4da;
            color: #6c757d;
        }

        .input-group-append .btn:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
            color: #495057;
        }

        .input-group-append .btn:focus {
            box-shadow: none;
            background-color: #e9ecef;
            border-color: #80bdff;
        }

        .input-group {
            height: auto;
        }

        .input-group .form-control {
            height: 38px;
        }

        .input-group-append .btn {
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>


    <form class="form-signin text-center" method="POST">


        <img class="border mb-4" src="icon/<?php echo $data["logo"] ?>" alt="" width="200" height="200">

        <h2 class="mt-3 mb-3 text-dark"><span class="text-secondary"><?php echo $data["toko"] ?></span></h2>
        <div class="form-group mb-2">
            <label for="inputuser" class="sr-only">Username</label>
            <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>
        <div class="form-group mb-2">
            <label for="inputPassword" class="sr-only">Password</label>
            <div class="input-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
        </div>
        <button class="btn btn-warning btn-block" name="login" style="font-weight:700;" type="submit">Masuk</button>
        <p class="mt-3 mb-3 text-secondary font-weight-bold"><?php echo $data["toko"] ?> - <a target="_blank" rel="noopener noreferrer" href="https://ump.ac.id" class="text-secondary">
                UMP</a></p>
        <div>
            <a class="text-white pr-3" href="index.php">
                <h5 class="mt-3 mb-3 text-dark"><i class="fa fa-home "></i></h5>
            </a>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('inputPassword');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>