<?php
// Menghubungkan dengan koneksi database
include '../koneksi.php';

// Pastikan pelanggan_id ada di form
if (empty($_POST['pelanggan_id'])) {
    die("Error: pelanggan_id tidak ditemukan.");
}

$pelanggan_id = $_POST['pelanggan_id'];

// Cek apakah pelanggan_id ada di database
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id = '$pelanggan_id'");
if (mysqli_num_rows($query) == 0) {
    die("Error: pelanggan_id tidak valid.");
}

// Menangkap data lainnya
$keperluan = $_POST['keperluan'];
$tgl_hari_ini = date('Y-m-d');
$status = 0;

// Upload file persyaratan dasar
$ktp = $_FILES['ktp'];
$kk = $_FILES['kk'];
$sktm = $_FILES['sktm'];
$surat_permohonan = $_FILES['surat_permohonan'];

// Fungsi untuk upload file
function uploadFile($file, $folder) {
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $filename = $file['name'];
    $filename = str_replace(' ', '_', $filename);
    $target_dir = "$folder/" . basename($filename);

    if (move_uploaded_file($file['tmp_name'], $target_dir)) {
        return $target_dir;
    } else {
        return false;
    }
}

// Direktori penyimpanan file
$upload_dir = '../uploads';

// Simpan file persyaratan dasar
$ktp_path = uploadFile($ktp, $upload_dir);
$kk_path = uploadFile($kk, $upload_dir);
$sktm_path = uploadFile($sktm, $upload_dir);
$surat_permohonan_path = uploadFile($surat_permohonan, $upload_dir);

// Cek jika file berhasil diupload
if (!$ktp_path || !$kk_path || !$sktm_path || !$surat_permohonan_path) {
    die("Error: Gagal mengupload file persyaratan dasar.");
}

// Simpan data ke tabel transaksi
mysqli_query($koneksi, "INSERT INTO transaksi1 (pelanggan_id, keperluan, tgl_transaksi, status) VALUES ('$pelanggan_id', '$keperluan', '$tgl_hari_ini', '$status')");

// Menyimpan id dari data yang baru saja disimpan
$id_terakhir = mysqli_insert_id($koneksi);
mysqli_query($koneksi, "INSERT INTO persyaratanfix (transaksi_id, ktp, kk, sktm, surat_permohonan) VALUES ('$id_terakhir', '$ktp_path', '$kk_path', '$sktm_path', '$surat_permohonan_path')");


// Simpan file persyaratan dasar dan tambahan ke tabel persyaratan1
if ($keperluan == 'pendidikan') {
    $aktif_sekolah = uploadFile($_FILES['aktif_sekolah'], $upload_dir);
    $rincian_tunggakan = uploadFile($_FILES['rincian_tunggakan'], $upload_dir);
    $raport_terakhir = uploadFile($_FILES['raport_terakhir'], $upload_dir);
    $buku_rekening_sekolah = uploadFile($_FILES['buku_rekening_sekolah'], $upload_dir);

    if ($aktif_sekolah && $rincian_tunggakan && $raport_terakhir && $buku_rekening_sekolah) {
        mysqli_query($koneksi, "INSERT INTO persyaratanfix (transaksi_id, ktp, kk, sktm, surat_permohonan, aktif_sekolah, rincian_tunggakan, raport_terakhir, buku_rekening_sekolah) 
            VALUES ('$id_terakhir', '$ktp_path', '$kk_path', '$sktm_path', '$surat_permohonan_path', '$aktif_sekolah', '$rincian_tunggakan', '$raport_terakhir', '$buku_rekening_sekolah')");
    }
} elseif ($keperluan == 'kontrakan') {
    $pernyataan_kontrakan = uploadFile($_FILES['pernyataan_kontrakan'], $upload_dir);

    if ($pernyataan_kontrakan) {
        mysqli_query($koneksi, "INSERT INTO persyaratanfix (transaksi_id, ktp, kk, sktm, surat_permohonan, pernyataan_kontrakan) 
            VALUES ('$id_terakhir', '$ktp_path', '$kk_path', '$sktm_path', '$surat_permohonan_path', '$pernyataan_kontrakan')");
    }
}

// Redirect ke halaman transaksi
header("location:transaksi.php");
?>
