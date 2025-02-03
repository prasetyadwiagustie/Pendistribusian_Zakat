<?php
include 'header1.php';
include '../koneksi.php';

?><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Set file type and id when the update button is clicked
    $('[data-toggle="modal"]').on('click', function() {
        var fileType = $(this).data('file');
        var id = $(this).data('id');
        $('#file-upload-form').attr('action', 'update_file.php?file=' + fileType + '&id=' + id); // Update action URL
        console.log('Setting action URL: ', 'update_file.php?file=' + fileType + '&id=' + id); // Debug
    });

    // Handle form submission
    $("#file-upload-form").on("submit", function(e) {
        e.preventDefault();  // Prevent the default form submission

        console.log("Form submitted!"); // Debugging statement to ensure the form is triggered

        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),  // Use the dynamically set action URL
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Response from server:", response);  // Log the server response
                if (response === "success") {
    $("#response-message").html('<div class="alert alert-success">File berhasil diupdate!</div>').fadeIn().delay(3000).fadeOut(500);
    setTimeout(function() {
        location.reload();  // Reload the page to reflect changes
    }, 2000);
} else {
    var errorMessage = response.split("|")[1];
    $("#response-message").html('<div class="alert alert-danger">' + errorMessage + '</div>').fadeIn().delay(3000).fadeOut(500);
}
},
error: function(xhr, status, error) {
    console.log("AJAX error:", error);  // Log AJAX error
    $("#response-message").html('<div class="alert alert-danger">Terjadi kesalahan saat mengunggah file.</div>').fadeIn().delay(3000).fadeOut(500);
}

        });
    });
});
</script>

<style>
    #response-message .alert {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        animation: float 3s ease-in-out forwards;
    }

    @keyframes float {
        0% {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }

        30% {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        70% {
            opacity: 1;
            transform: translateX(-50%) translateY(0); /* Paused state */
        }

        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
    }


    .file-thumbnail {
        width: 200px;
        height: 200px;
    }
    .file-link {
        display: block;
        width: 150px;
        word-wrap: break-word;
    }
</style>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Data Mustahik</h4>
        </div>
        <div class="panel-body">
            <?php
            // Menangkap ID yang dikirim melalui URL
            $id = isset($_GET['id']) ? intval($_GET['id']) : null;

            if ($id) {
                // Query untuk transaksi
                $transaksi1 = mysqli_query($koneksi, "SELECT * FROM transaksi1 WHERE id='$id'");

                if (mysqli_num_rows($transaksi1) > 0) {
                    $t = mysqli_fetch_array($transaksi1);

                    // Query persyaratan
                    $persyaratan_id = $t['id'];
                    $persyaratan = mysqli_query($koneksi, "SELECT * FROM persyaratanfix WHERE transaksi_id='$persyaratan_id'");
                    $ps = mysqli_fetch_array($persyaratan);

                    // Query pelanggan
                    $pelanggan_id = $t['pelanggan_id'];
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id='$pelanggan_id'");
                    $p = mysqli_fetch_array($pelanggan);

                    $keperluan = $t['keperluan']; // Menyesuaikan dengan 
                } else {
                    echo "<div class='alert alert-danger'>Transaksi tidak ditemukan.</div>";
                    exit;
                }
            } else {
                echo "<div class='alert alert-danger'>ID transaksi tidak valid.</div>";
                exit;
            }

            // Fungsi untuk menampilkan file
            function displayFile($file_path, $file_label)
            {
                $allowed_image_extensions = ['jpg', 'jpeg', 'png'];
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

                if (file_exists($file_path)) {
                    if (in_array($file_extension, $allowed_image_extensions)) {
                        echo "<img src='$file_path' alt='$file_label' class='img-thumbnail file-thumbnail'>";
                    } elseif ($file_extension === 'pdf') {
                        echo "<a href='$file_path' target='_blank' class='file-link'>Download $file_label</a>";
                    } else {
                        echo "Format file tidak didukung.";
                    }
                } else {
                    echo "$file_label tidak ditemukan.";
                }
            }

            ?>
            <div class="col-md-8 col-md-offset-2">
                <a href="validasi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br/><br/>

                <div class="form-group">
                    <label>Pelanggan</label>
                    <input type="text" class="form-control" value="<?php echo $p['pelanggan_nama']; ?>" readonly>
                </div>
                      <div class="form-group">
    <label>No. HP</label>
    <input type="text" class="form-control" value="<?php echo $p['pelanggan_hp']; ?>" readonly>
</div>
<div class="form-group">
    <label>Alamat</label>
    <input type="text" class="form-control" value="<?php echo $p['pelanggan_alamat']; ?>" readonly>
</div>
<div class="form-group">
    <label>NIK</label>
    <input type="text" class="form-control" value="<?php echo $p['pelanggan_nik']; ?>" readonly>
</div>
<div class="form-group">
    <label>No. KK</label>
    <input type="text" class="form-control" value="<?php echo $p['pelanggan_kk']; ?>" readonly>
</div>
<div class="form-group">
    <label>Provinsi</label>
    <input type="text" class="form-control" value="<?php echo $p['provinces']; ?>" readonly>
</div>
<div class="form-group">
    <label>Kabupaten/Kota</label>
    <input type="text" class="form-control" value="<?php echo $p['regencies']; ?>" readonly>
</div>
<div class="form-group">
    <label>Kecamatan</label>
    <input type="text" class="form-control" value="<?php echo $p['districts']; ?>" readonly>
</div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>LABEL</th>
                        <th>DISPLAY FILE</th>
                        <th>OPSION</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="post" action="transaksi_update.php">
    <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
    
     <tr>
        <td>KTP</td>
        <td>
            <?php displayFile("../uploads/" . $ps['ktp'], "KTP"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="ktp" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['ktp']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <tr>
        <td>KK</td>
        <td>
            <?php displayFile("../uploads/" . $ps['kk'], "KK"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="kk" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['kk']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>

    <tr>
        <td>SKTM</td>
        <td>
            <?php displayFile("../uploads/" . $ps['sktm'], "SKTM"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="sktm" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['sktm']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>

    <tr>
        <td>Surat Permohonan</td>
        <td>
            <?php displayFile("../uploads/" . $ps['surat_permohonan'], "Surat Permohonan"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="surat_permohonan" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['surat_permohonan']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>

    <?php if ($keperluan === 'pendidikan') { ?>
    <tr>
        <td>Surat Keterangan Aktif Sekolah</td>
        <td>
            <?php displayFile("../uploads/" . $ps['aktif_sekolah'], "Aktif Sekolah"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="aktif_sekolah" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['aktif_sekolah']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <tr>
        <td>Rincian Tunggakan Sekolah</td>
        <td>
            <?php displayFile("../uploads/" . $ps['rincian_tunggakan'], "Rincian Tunggakan"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="rincian_tunggakan" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['rincian_tunggakan']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <tr>
        <td>Raport Terakhir</td>
        <td>
            <?php displayFile("../uploads/" . $ps['raport_terakhir'], "Raport Terakhir"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="raport_terakhir" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['raport_terakhir']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <tr>
        <td>Buku Rekening Sekolah</td>
        <td>
            <?php displayFile("../uploads/" . $ps['buku_rekening_sekolah'], "Buku Rekening Sekolah"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="buku_rekening_sekolah" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['buku_rekening_sekolah']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <?php } ?>

    <?php if ($keperluan === 'kontrakan') { ?>
    <tr>
        <td>Surat Pernyataan Kontrakan</td>
        <td>
            <?php displayFile("../uploads/" . $ps['pernyataan_kontrakan'], "Pernyataan Kontrakan"); ?>
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#fileUploadModal" data-file="pernyataan_kontrakan" data-id="<?php echo $id; ?>">Update</a>
            <a href="../uploads/<?php echo $ps['pernyataan_kontrakan']; ?>" class="btn btn-sm btn-info" download>Download</a>
        </td>
    </tr>
    <?php } ?>


                </tbody>
            </table>

            <td>Status</td>
            <td colspan="2">
                <select class="form-control" name="status" required="required">
                    <option <?php if ($t['status'] == "0")
                        echo "selected"; ?> value="0">WAWANCARA</option>
                    <option <?php if ($t['status'] == "1")
                        echo "selected"; ?> value="1">VERIFIKASI DATA</option>
                    <option <?php if ($t['status'] == "3")
                        echo "selected"; ?> value="3">REJECTED</option>
                    <option <?php if ($t['status'] == "4")
                        echo "selected"; ?> value="4">PENYALURAN</option>
                    <option <?php if ($t['status'] == "2")
                        echo "selected"; ?> value="2">LAPORAN</option>
                </select>
            </td><br>

            <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
        </div>
    </div>
</div>


<!-- Modal for file upload -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabel">Update File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="file-upload-form" method="POST" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <label>Choose a new file to upload:</label>
                        <input type="file" name="file_upload" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Replace</button>
                </form>

                <div id="response-message"></div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
