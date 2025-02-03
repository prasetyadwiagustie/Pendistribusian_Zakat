<?php
if (isset($_GET['file']) && isset($_GET['id'])) {
    $file = $_GET['file'];
    $id = $_GET['id'];

    // Path file yang ingin diunduh
    $filePath = "../uploads/" . $ps[$file];

    // Cek jika file ada
    if (file_exists($filePath)) {
        // Set header untuk unduhan
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Baca file dan kirim ke browser
        readfile($filePath);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
}
?>
