<?php
// Menghubungkan dengan koneksi
include '../koneksi.php';
include 'header1.php';

// Memeriksa apakah pelanggan_id ada di query string
if (isset($_GET['pelanggan_id'])) {
    $pelanggan_id = $_GET['pelanggan_id'];

    // Cek apakah pelanggan_id ada di database
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id = '$pelanggan_id'");
    if (mysqli_num_rows($query) == 0) {
        die("Error: pelanggan_id tidak valid.");
    }
} else {
    die("Error: pelanggan_id tidak ditemukan.");
}

// Selanjutnya proses input transaksi dan file persyaratan seperti sebelumnya
?>



<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Form File (PDF/JPG)</h4>
        </div>
        <div class="panel-body">

            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br/>
                <br/>
                <form method="post" action="transaksi_aksi1.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Jenis Keperluan</label>
                        <select class="form-control" id="keperluan" name="keperluan" required="required">
                            <option value="">- Pilih Keperluan -</option>
                            <option value="biaya_hidup">Biaya Hidup</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="kontrakan">Kontrakan</option>
                        </select>
                    </div>

                    <!-- Persyaratan dasar dinamis -->
                    <div id="persyaratan-dasar"></div>

                    <!-- Persyaratan tambahan dinamis -->
                    <div id="persyaratan-tambahan"></div>

                    <!-- Menambahkan pelanggan_id ke form sebagai input hidden -->
                    <input type="hidden" id="pelanggan_id" name="pelanggan_id" value="<?php echo $pelanggan_id; ?>">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Script untuk mengatur persyaratan dasar dan tambahan berdasarkan jenis keperluan
const keperluanSelect = document.getElementById('keperluan');
const persyaratanDasarDiv = document.getElementById('persyaratan-dasar');
const persyaratanTambahanDiv = document.getElementById('persyaratan-tambahan');

keperluanSelect.addEventListener('change', function() {
    const keperluan = this.value;
    persyaratanDasarDiv.innerHTML = '';
    persyaratanTambahanDiv.innerHTML = '';

    if (keperluan) {
        // Tampilkan persyaratan dasar
        persyaratanDasarDiv.innerHTML = `
            <div class="form-group">
                <label>Fotocopy KTP</label>
                <input type="file" class="form-control" name="ktp" accept="application/pdf,image/*" required="required">
            </div>
            <div class="form-group">
                <label>Fotocopy KK</label>
                <input type="file" class="form-control" name="kk" accept="application/pdf,image/*" required="required">
            </div>
            <div class="form-group">
                <label>SKTM Asli & Terbaru</label>
                <input type="file" class="form-control" name="sktm" accept="application/pdf,image/*" required="required">
            </div>
            <div class="form-group">
                <label>Surat Permohonan</label>
                <input type="file" class="form-control" name="surat_permohonan" accept="application/pdf,image/*" required="required">
            </div>`;

        // Tampilkan persyaratan tambahan jika diperlukan
        if (keperluan === 'pendidikan') {
            persyaratanTambahanDiv.innerHTML = `
                <div class="form-group">
                    <label>Surat Keterangan Aktif Sekolah</label>
                    <input type="file" class="form-control" name="aktif_sekolah" accept="application/pdf,image/*">
                </div>
                <div class="form-group">
                    <label>Rincian Tunggakan Sekolah</label>
                    <input type="file" class="form-control" name="rincian_tunggakan" accept="application/pdf,image/*">
                </div>
                <div class="form-group">
                    <label>Fotocopy Raport Terakhir</label>
                    <input type="file" class="form-control" name="raport_terakhir" accept="application/pdf,image/*">
                </div>
                <div class="form-group">
                    <label>Fotocopy Buku Rekening Sekolah</label>
                    <input type="file" class="form-control" name="buku_rekening_sekolah" accept="application/pdf,image/*">
                </div>`;
        } else if (keperluan === 'kontrakan') {
            persyaratanTambahanDiv.innerHTML = `
                <div class="form-group">
                    <label>Surat Pernyataan dari Pemilik Kontrakan</label>
                    <input type="file" class="form-control" name="pernyataan_kontrakan" accept="application/pdf,image/*">
                </div>`;
        }
    }
});
</script>

<?php include 'footer.php'; ?>
