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
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		
		<div class="panel">
			<div class="panel-heading">
				<h4>Form Pengajuan Bantuan</h4>
			</div>
			<div class="panel-body">

            <?php 
                // koneksi database
                include '../koneksi.php';
                ?>
				<form method="post" action="pelanggan_aksi1.php">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Ketik nama">
					</div>	

					<div class="form-group">
						<label>Nomor Handphone</label>
						<input type="text" class="form-control" name="hp" placeholder="Ketik nomor handphone">
					</div>	

					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" placeholder="Ketik alamat">
					</div>	
					<div class="form-group">
						<label>NIK</label>
						<input type="text" class="form-control hp" name="nik" placeholder="Ketik NIK" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
					</div>	
					<div class="form-group">
						<label>KK</label>
						<input type="text" class="form-control hp" name="kk" placeholder="Ketik KK" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mustahikModal">
  Tambah Mustahik
</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>