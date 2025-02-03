<?php
include '../koneksi.php';

$status = $_GET['status'];
$id = $_GET['id'];
    if($status == 1){
        mysqli_query($koneksi, "update transaksi set transaksi_status='1' where transaksi_id='$id';");
    }else if($status == 2){
        mysqli_query($koneksi, "update transaksi set transaksi_status='2' where transaksi_id='$id';");
    }
header ("location:transaksi.php");
?>