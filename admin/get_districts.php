<?php
include '../koneksi.php';

if (isset($_GET['regency_id'])) {
    $regency_id = $_GET['regency_id'];
    $query = mysqli_query($koneksi, "SELECT * FROM districts WHERE regency_id = '$regency_id'");
    $districts = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $districts[] = $row;
    }
    echo json_encode($districts);
} else {
    echo json_encode([]);
}
?>
