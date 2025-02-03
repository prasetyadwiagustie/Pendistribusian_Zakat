<?php
// Menghubungkan dengan koneksi
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$nik = $_POST['nik'];
$kk = $_POST['kk'];
$provinces_id = $_POST['provinces'];
$regencies_id = $_POST['regencies'];
$districts_id = $_POST['districts'];

// Input data ke tabel pelanggan
mysqli_query($koneksi,"INSERT INTO pelanggan VALUES ('','$nama', '$hp', '$alamat', '$nik', '$kk', '$provinces_id', '$regencies_id', '$districts_id')");

// Menangkap pelanggan_id yang baru saja disisipkan
$pelanggan_id = mysqli_insert_id($koneksi);

// Mengarahkan ke halaman mustahikinput.php dengan pelanggan_id sebagai query string
header("Location: mustahikinput.php?pelanggan_id=$pelanggan_id");
exit();
?>
