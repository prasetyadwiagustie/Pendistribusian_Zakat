<?php
include '../koneksi.php';

if (isset($_GET['province_name'])) {
    $province_name = $_GET['province_name'];

    // Get the province_id from the provinces table based on the province name
    $province_query = "SELECT id FROM provinces WHERE name = '$province_name'";
    $province_result = mysqli_query($koneksi, $province_query);
    $province = mysqli_fetch_assoc($province_result);

    // If the province exists, get the regencies for that province_id
    if ($province) {
        $province_id = $province['id'];
        $query = "SELECT id, name FROM regencies WHERE province_id = '$province_id'";
        $result = mysqli_query($koneksi, $query);
        
        $regencies = [];
        while ($row = mysqli_fetch_array($result)) {
            $regencies[] = ['id' => $row['id'], 'name' => $row['name']];
        }
        
        echo json_encode($regencies);
    } else {
        echo json_encode([]);  // Return an empty array if province is not found
    }
}
?>
