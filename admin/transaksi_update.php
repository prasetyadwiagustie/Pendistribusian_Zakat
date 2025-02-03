<?php
// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$status = $_POST['status'];


// menghitung harga laundry, harga perkilo x berat cucian


// update data transaksi
mysqli_query($koneksi, "update transaksi1 set status='$status' where id='$id'");


// menangkap data form input array (jenis pakaian dan jumlah pakaian)
// menghapus semua pakaian dalam transaksi ini


header("location:validasi.php");

?>