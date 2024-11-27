<?php
$host = 'sql.freedb.tech'; // misalnya '123.45.67.89' atau nama host yang disediakan
$username = 'freedb_dislek'; // misalnya 'root' atau nama pengguna database Anda
$password = 'gF5ndZfA7@8d*4*'; // password yang diberikan oleh penyedia hosting
$dbname = 'freedb_disleksia'; // nama database yang Anda buat di server online
$port = 3306; // port default untuk MySQL adalah 3306

// Koneksi ke database
$kon = mysqli_connect($host, $username, $password, $dbname, $port);
?>
