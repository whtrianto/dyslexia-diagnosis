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
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
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
</body>

</html>