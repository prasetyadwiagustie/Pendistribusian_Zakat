<?php
session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);

include 'koneksi.php';

$login = mysqli_query($koneksi, "select * from pengguna where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['level'] == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";

        header("location:cek_session.php");
    } elseif ($data['level'] == "pencucian") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "pencucian";

        header("location:cek_session.php");
    } elseif ($data['level'] == "setrika") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "setrika";

        header("location:cek_session.php");
    } elseif ($data['level'] == "pengemasan") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "pengemasan";

        header("location:cek_session.php");
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Login gagal! Username atau password salah.'); window.location='index.php';</script>";
}
?>
