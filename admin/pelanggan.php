<?php include 'header1.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Use jQuery for handling events and DOM manipulation
$(document).ready(function () {
    // Ketika Provinsi berubah
    $('#province').change(function () {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: 'get_regencies.php',
                type: 'GET',
                data: { province_name: provinceId },
                dataType: 'json',
                success: function (data) {
                    var regencySelect = $('#regency');
                    regencySelect.empty();
                    regencySelect.append('<option value="">Pilih Kota</option>');
                    if (data.length > 0) {
                        $.each(data, function (index, regency) {
                            // Gunakan `data-id` untuk menyimpan ID
                            regencySelect.append('<option value="' + regency.name + '" data-id="' + regency.id + '">' + regency.name + '</option>');
                        });
                    } else {
                        regencySelect.append('<option value="">No regencies found</option>');
                    }
                    $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
                }
            });
        }
    });

    // Ketika Kota berubah
    $('#regency').change(function () {
        var selectedOption = $(this).find(':selected');
        var regencyId = selectedOption.data('id'); // Ambil ID dari data-attribute
        var regencyName = selectedOption.val(); // Ambil name sebagai value

        // Logika mengambil kecamatan berdasarkan ID kota
        if (regencyId) {
            $.ajax({
                url: 'get_districts.php',
                type: 'GET',
                data: { regency_id: regencyId },
                dataType: 'json',
                success: function (data) {
                    var districtSelect = $('#district');
                    districtSelect.empty();
                    districtSelect.append('<option value="">Pilih Kecamatan</option>');
                    if (data.length > 0) {
                        $.each(data, function (index, district) {
                            // Gunakan `data-id` untuk menyimpan ID
                            districtSelect.append('<option value="' + district.name + '" data-id="' + district.id + '">' + district.name + '</option>');
                        });
                    } else {
                        districtSelect.append('<option value="">No districts found</option>');
                    }
                }
            });
        }
    });

    // Ketika Kecamatan berubah
    $('#district').change(function () {
        var selectedOption = $(this).find(':selected');
        var districtId = selectedOption.data('id'); // Ambil ID dari data-attribute
        var districtName = selectedOption.val(); // Ambil name sebagai value
    });
});



</script>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Mustahik</h4>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong">Tambah</button>
            <br/><br/><br/><br/>
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th width="15%">Nama</th>
                    <th width="15%">Nomor Handphone</th>
                    <th>Alamat</th>
                    <th>NIK</th>
                    <th>KK</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th width="15%">OPSI</th>
                </tr>
                <?php 
                // koneksi database
                include '../koneksi.php';

                // mengambil data pelanggan dari database
                $data = mysqli_query($koneksi,"select * from pelanggan order by pelanggan_id desc");
                $no = 1;
                // menampilkan data pelanggan
                while($d=mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['pelanggan_nama']; ?></td>
                        <td><?php echo $d['pelanggan_hp']; ?></td>
                        <td><?php echo $d['pelanggan_alamat']; ?></td>
                        <td><?php echo $d['pelanggan_nik']; ?></td>
                        <td><?php echo $d['pelanggan_kk']; ?></td>
                        <td><?php echo $d['provinces']; ?></td>
						<td><?php echo $d['regencies']; ?></td>
                        <td><?php echo $d['districts']; ?></td>

                        <td>
                            <a href="pelanggan_edit.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-info">Update</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $d['pelanggan_id']; ?>">Hapus</button>
                        </td>
                    </tr>
                    <?php 
                }
                ?>
            </table>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php
$data = mysqli_query($koneksi, "select * from pelanggan");
while ($h = mysqli_fetch_array($data)) {
?>
<div class="modal fade" id="exampleModal<?= $h['pelanggan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="exampleModalLabel"><b>Hapus Pelanggan</b></h3>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus <b><?= $h['pelanggan_nama']; ?></b> dari daftar pelanggan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a href="pelanggan_hapus.php?id=<?php echo $h['pelanggan_id']; ?>" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close batal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Mustahik</h5>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" action="pelanggan_aksi.php">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Ketik nama">
                    </div> 

                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="text" class="form-control" name="hp" placeholder="Ketik nomor handphone" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    </div>  

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Ketik alamat">
                    </div>  

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="Ketik NIK" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    </div>  

                    <div class="form-group">
                        <label>KK</label>
                        <input type="text" class="form-control" name="kk" placeholder="Ketik KK" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    </div>  

                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinces" id="province" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM provinces");
                            while ($h = mysqli_fetch_array($data)) {
                                echo "<option value='" . $h['name'] . "'>" . $h['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota</label>
                        <select name="regencies" id="regency" class="form-control hp">
                            <option value="">Pilih Kota</option>
                        </select>
    				<input type="hidden" name="regency_id" id="regency_id">
                    </div>

                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="districts" id="district" class="form-control hp">
                            <option value="">Pilih Kecamatan</option>
							<input type="hidden" name="district_id" id="district_id">
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
