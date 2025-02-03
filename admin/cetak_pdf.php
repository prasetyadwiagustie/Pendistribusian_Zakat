<?php
require_once('../tcpdf/tcpdf.php');

// Periksa apakah parameter tanggal ada
if (isset($_GET['dari']) && isset($_GET['sampai'])) {
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];

    // Membuat instance TCPDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Pengaturan dokumen PDF
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nama Anda');
    $pdf->SetTitle('Laporan Penyaluran');
    $pdf->SetSubject('Laporan');
    $pdf->SetKeywords('Laporan, PDF, Penyaluran');

    // Tambahkan kop surat
    $pdf->SetHeaderData(
        '', // Logo (opsional)
        0,  // Lebar logo
        'KOP SURAT ANDA', // Judul header
        "Alamat: Jalan ABC No. 123, Kota, Provinsi\nTelepon: +62 812 3456 7890 | Email: info@example.com"
    );

    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetHeaderMargin(10);
    $pdf->SetFooterMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Tambahkan halaman baru
    $pdf->AddPage();

    // Judul laporan
    $html = "<h1 style='text-align:center;'>Laporan Penyaluran</h1>";
    $html .= "<h4 style='text-align:center;'>Dari Tanggal: <b>$dari</b> Sampai Tanggal: <b>$sampai</b></h4>";

    // Koneksi database
    include '../koneksi.php';

    // Ambil data dari database
    $query = "SELECT * FROM pelanggan A INNER JOIN transaksi1 B ON A.pelanggan_id = B.pelanggan_id 
              WHERE tgl_transaksi BETWEEN '$dari' AND '$sampai' ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query);

    // Tabel data
    $html .= '<table border="1" cellspacing="0" cellpadding="4" style="width:100%;">';
    $html .= '<thead>
                <tr>
                    <th>No</th>
                    <th>Keperluan</th>
                    <th>Tgl. Pengajuan</th>
                    <th>Mustahik</th>
                    <th>HP</th>
                    <th>Status</th>
                </tr>
              </thead><tbody>';

    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $status = '';
        switch ($row['status']) {
            case '0':
                $status = 'PROSES';
                break;
            case '1':
                $status = 'DI CUCI';
                break;
            case '2':
                $status = 'SELESAI';
                break;
            case '3':
                $status = 'SETRIKA';
                break;
            case '4':
                $status = 'DI KEMAS';
                break;
        }
        $hp_wa = '+62' . ltrim($row['pelanggan_hp'], '0');
        $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['keperluan'] . '</td>
                    <td>' . date("d-F-Y", strtotime($row['tgl_transaksi'])) . '</td>
                    <td>' . $row['pelanggan_nama'] . '</td>
                    <td><a href="https://wa.me/' . $hp_wa . '" target="_blank">' . $row['pelanggan_hp'] . '</a></td>
                    <td>' . $status . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    // Tambahkan konten ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output file PDF
    $pdf->Output('Laporan_Penyaluran.pdf', 'I');
} else {
    echo "<script>alert('Tanggal tidak valid!'); window.close();</script>";
}
