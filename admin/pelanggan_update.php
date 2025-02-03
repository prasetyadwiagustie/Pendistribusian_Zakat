<?php
include '../koneksi.php';

// Capture POST data
$id = $_POST['id'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$nik = $_POST['nik'];
$kk = $_POST['kk'];
$provinces = $_POST['provinces'];
$regencies_id = $_POST['regencies'];
$districts_id = $_POST['districts'];

// Update the database
$query = "UPDATE pelanggan SET pelanggan_nama='$nama', pelanggan_hp='$hp', pelanggan_alamat='$alamat', pelanggan_nik='$nik'  , pelanggan_kk='$kk', provinces='$provinces', regencies='$regencies_id', districts='$districts_id' WHERE pelanggan_id='$id'";

if (mysqli_query($koneksi, $query)) {
    // Redirect or display success message
    header('Location: pelanggan.php');
} else {
    // Display error message if update fails
    echo "Error: " . mysqli_error($koneksi);
}
?>
