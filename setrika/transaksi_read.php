<?php include 'header3.php'; ?>

<?php 

// koneksi database
include '../koneksi.php';
?>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Update Transaksi Laundry</h4>
		</div>
		<div class="panel-body">

			

			<div class="col-md-8 col-md-offset-2">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/>
				<br/>
				<?php 
				// menangkap id yang dikirim melalui url
				$id = $_GET['id'];

				// megambil data pelanggan yang ber id di atas dari tabel pelanggan
				$transaksi = mysqli_query($koneksi,"select * from transaksi where transaksi_id='$id'");
				while($t=mysqli_fetch_array($transaksi)){
					?>
					<form method="post" action="transaksi_update.php">
						<!-- menyimpan id transaksi yang di edit dalam form hidden berikut -->
						<input type="hidden" name="id" value="<?php echo $t['transaksi_id']; ?>">

						<div class="form-group">
							<label>Pelanggan</label>
							<select class="form-control" name="pelanggan" required="required" readonly>	
								<option value="">- Pilih Pelanggan</option>						
								<?php 						
								// mengambil data pelanggan dari database
								$data = mysqli_query($koneksi,"select * from pelanggan");						
								// mengubah data ke array dan menampilkannya dengan perulangan while
								while($d=mysqli_fetch_array($data)){
									?>
									<option <?php if($d['pelanggan_id']==$t['transaksi_pelanggan']){echo "selected='selected'";} ?> value="<?php echo $d['pelanggan_id']; ?>"><?php echo $d['pelanggan_nama']; ?></option>								
									<?php 
								}
								?>		
							</select>				
						</div>	

						<div class="form-group" >
							<label>Berat (Kg)</label>
							<input type="number" class="form-control" name="berat" placeholder="Masukkan berat cucian" required="required" value="<?php echo $t['transaksi_berat']; ?>" readonly>
						</div>	

						<div class="form-group">
							<label>Tgl. Selesai</label>
							<input type="date" class="form-control" name="tgl_selesai" required="required" value="<?php echo $t['transaksi_tgl_selesai']; ?>" readonly>
						</div>	

						<br/>


						<table class="table table-bordered table-striped">
							<tr>
								<th>Nama Pakaian</th>
								<th width="20%">Jumlah (pcs)</th>
							</tr>		

							<?php 
							// menyimpan id transaksi ke variabel id_transaksi
							$id_transaksi = $t['transaksi_id'];

							// menampilkan pakaian-pakaian dari transaksi yang ber id di atas
							$pakaian = mysqli_query($koneksi,"select * from pakaian where pakaian_transaksi='$id_transaksi'");

							while($p=mysqli_fetch_array($pakaian)){
								?>					
								<tr>
									<td><input type="text" class="form-control" name="jenis_pakaian[]" value="<?php echo $p['pakaian_jenis']; ?>" readonly></td>
									<td><input type="number" class="form-control" name="jumlah_pakaian[]" value="<?php echo $p['pakaian_jumlah']; ?>" readonly></td>
								</tr>
								<?php } ?>	
							</table>	
						</form>
						<?php 
					}
					?>
				</div>

			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>