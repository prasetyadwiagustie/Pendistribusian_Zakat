<?php
include '../koneksi.php';

$status = $_GET['status'];
$id = $_GET['id'];

// Check if the form was submitted with hasil_wawancara
if (isset($_POST['hasil_wawancara'])) {
    // Sanitize the input
    $hasil_wawancara = mysqli_real_escape_string($koneksi, $_POST['hasil_wawancara']);

    // Update hasil_wawancara in persyaratanfix table
    $updateHasilWawancara = "UPDATE persyaratanfix SET hasil_wawancara='$hasil_wawancara' WHERE transaksi_id='$id'";
    mysqli_query($koneksi, $updateHasilWawancara);
}

// Update status based on the value of $status
if ($status == 1) {
    mysqli_query($koneksi, "UPDATE transaksi1 SET status='1' WHERE id='$id';");
}

// After processing the updates, redirect back to wawancara.php
header("location:wawancara.php");
exit;
?>
