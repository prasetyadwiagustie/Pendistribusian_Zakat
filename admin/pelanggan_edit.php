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
        var regencyId = selectedOption.data('id');
        var regencyName = selectedOption.val();

        $('#regency_id').val(regencyId);

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
        var districtId = selectedOption.data('id');
        var districtName = selectedOption.val();

        $('#district_id').val(districtId);
    });

    // Menampilkan data Kota & Kecamatan sesuai dengan data dari database
    var selectedProvince = $('#province').val();
    var selectedRegency = $('#regency').data('selected');
    var selectedDistrict = $('#district').data('selected');

    if (selectedProvince) {
        $.ajax({
            url: 'get_regencies.php',
            type: 'GET',
            data: { province_name: selectedProvince },
            dataType: 'json',
            success: function (data) {
                var regencySelect = $('#regency');
                regencySelect.empty();
                regencySelect.append('<option value="">Pilih Kota</option>');
                $.each(data, function (index, regency) {
                    var selected = (regency.name === selectedRegency) ? 'selected' : '';
                    regencySelect.append('<option value="' + regency.name + '" data-id="' + regency.id + '" ' + selected + '>' + regency.name + '</option>');
                });

                var selectedRegencyId = regencySelect.find(':selected').data('id');
                $('#regency_id').val(selectedRegencyId);

                if (selectedRegencyId) {
                    $.ajax({
                        url: 'get_districts.php',
                        type: 'GET',
                        data: { regency_id: selectedRegencyId },
                        dataType: 'json',
                        success: function (data) {
                            var districtSelect = $('#district');
                            districtSelect.empty();
                            districtSelect.append('<option value="">Pilih Kecamatan</option>');
                            $.each(data, function (index, district) {
                                var selected = (district.name === selectedDistrict) ? 'selected' : '';
                                districtSelect.append('<option value="' + district.name + '" data-id="' + district.id + '" ' + selected + '>' + district.name + '</option>');
                            });

                            var selectedDistrictId = districtSelect.find(':selected').data('id');
                            $('#district_id').val(selectedDistrictId);
                        }
                    });
                }
            }
        });
    }
});

</script>
<div class="container">	
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		
		<div class="panel">
			<div class="panel-heading">
				<h4>Edit Pelanggan</h4>
			</div>
			<div class="panel-body">

				<?php 
				// menghubungkan koneksi
				include '../koneksi.php';
				?>

				<?php
				// menangkap id yang dikirim melalui url
		
				$id = $_GET['id'];



				// megambil data pelanggan yang ber id di atas dari tabel pelanggan
				$data = mysqli_query($koneksi,"select * from pelanggan where pelanggan_id='$id'");
				while($d=mysqli_fetch_array($data)){
					?>

					<form method="post" action="pelanggan_update.php">
						<div class="form-group">
							<label>Nama</label>
							<!-- form id pelanggan yang di edit, untuk di kirim ke file aksi -->
							<input type="hidden" name="id" value="<?php echo $d['pelanggan_id']; ?>">
							
							<input type="text" class="form-control" name="nama" value="<?php echo $d['pelanggan_nama']; ?>">
						</div>	

						<div class="form-group">
							<label>HP</label>
							<input type="text" class="form-control" name="hp" value="<?php echo $d['pelanggan_hp']; ?>">
						</div>	

						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="alamat" value="<?php echo $d['pelanggan_alamat']; ?>">
						</div>	
						<div class="form-group">
							<label>NIK</label>
							<input type="text" class="form-control" name="nik" value="<?php echo $d['pelanggan_nik']; ?>">
						</div>	
						<div class="form-group">
							<label>KK</label>
							<input type="text" class="form-control" name="kk" value="<?php echo $d['pelanggan_kk']; ?>">
						</div>	
						 <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinces" id="province" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            <?php
                            $data_provinces = mysqli_query($koneksi, "SELECT * FROM provinces");
                            while ($h = mysqli_fetch_array($data_provinces)) {
                                // Menampilkan provinsi yang sudah terpilih
                                $selected = ($h['name'] == $d['provinces']) ? 'selected' : '';
                                echo "<option value='" . $h['name'] . "' $selected>" . $h['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota</label>
                        <select name="regencies" id="regency" class="form-control" data-selected="<?php echo $d['regencies']; ?>">
                        </select>
    				<input type="hidden" name="regency_id" id="regency_id">
                    </div>

                    <div class="form-group">
                        <label>Kecamatan</label>
                         <select name="districts" id="district" class="form-control" data-selected="<?php echo $d['districts']; ?>">
                        </select>
							<input type="hidden" name="district_id" id="district_id">
                        </select>
                    </div>

						<br/>

						<input type="submit" class="btn btn-success" value="Simpan">
						<a href="pelanggan.php" class="btn btn-danger">Batal</a>	
					</form>

					<?php 
				}
				?>
			</div>
		</div>
	</div>

</div>

<?php include 'footer.php'; ?>