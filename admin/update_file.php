<?php
include '../koneksi.php';

if (isset($_GET['file']) && isset($_GET['id']) && isset($_FILES['file_upload'])) {
    $fileType = $_GET['file'];
    $id = $_GET['id'];
    $file = $_FILES['file_upload'];

    // Set upload directory and file path
    $uploadDir = "../uploads/";
    $filePath = $uploadDir . basename($file['name']);

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Update the corresponding file entry in the database
        $updateQuery = "UPDATE persyaratanfix SET $fileType = '$filePath' WHERE transaksi_id = '$id'";
        if (mysqli_query($koneksi, $updateQuery)) {
            echo "success";
        } else {
            echo "error|Database update failed";
        }
    } else {
        echo "error|File upload failed";
    }
} else {
    echo "error|Missing parameters or file";
}
?>
