<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$nik = $_POST['nik'];
$kk = $_POST['kk'];
$provinces_id = $_POST['provinces'];
$regencies_id = $_POST['regencies'];
$districts_id = $_POST['districts'];

// input data ke tabel pelanggan
mysqli_query($koneksi,"insert into pelanggan values('','$nama','$hp','$alamat','$nik','$kk','$provinces_id','$regencies_id','$districts_id')");

header("location:pelanggan.php");

?>