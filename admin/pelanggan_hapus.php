<?php
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data id yang dikirim dari url
$id = $_GET['id'];

// hapus data yang ada di persyaratanfix yang memiliki transaksi_id yang terkait
mysqli_query($koneksi, "DELETE FROM persyaratanfix WHERE transaksi_id IN (SELECT id FROM transaksi1 WHERE pelanggan_id='$id')");

// menghapus pelanggan
mysqli_query($koneksi, "DELETE FROM pelanggan WHERE pelanggan_id='$id'");

// alihkan halaman ke halaman pelanggan
header("location:pelanggan.php");
?>
