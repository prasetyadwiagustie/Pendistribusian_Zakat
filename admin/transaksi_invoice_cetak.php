<!DOCTYPE html>
<html>
<head>
<title>Sistem Informasi Laundry</title>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>

</head>
<body>
<!-- cek apakah sudah login -->
<?php 
//session_start();
//if($_SESSION['status']!="login"){
//	header("location:../index.php?pesan=belum_login");
//}
?>


<?php 
// koneksi database
include '../koneksi.php';
?>
<div class="container">
	
	<div class="col-md-4 col-md-offset-4">								
		<?php 
		// menangkap id yang dikirim melalui url
		$id = $_GET['id'];

		// megambil data pelanggan yang ber id di atas dari tabel pelanggan
		$transaksi = mysqli_query($koneksi,"select * from transaksi,pelanggan where transaksi_id='$id' and transaksi_pelanggan=pelanggan_id");
		while($pelanggan=mysqli_fetch_array($transaksi)){
			?>
			<h4><b>LAUNDRY Kiloan</b></h5>
			<h5>INVOICE-<?php echo $pelanggan['transaksi_id']; ?></h5>
			
			<br/>
			
			<table class="table">
				<tr>
					<th width="20%">Tgl. Laundry</th>
					<th>:</th>
					<td><?php echo date("d-F-Y",strtotime($pelanggan['transaksi_tgl'])); ?></td>
				</tr>
				<tr>
					<th>Nama Pelanggan</th>
					<th>:</th>
					<td><?php echo $pelanggan['pelanggan_nama']; ?></td>
				</tr>
				<tr>
					<th>HP</th>
					<th>:</th>
					<td><?php echo $pelanggan['pelanggan_hp']; ?></td>
				</tr>
				<tr>
					<th>Alamat</th>
					<th>:</th>
					<td><?php echo $pelanggan['pelanggan_alamat']; ?></td>
				</tr>
				<tr>
					<th>Berat Cucian (Kg)</th>
					<th>:</th>
					<td><?php echo $pelanggan['transaksi_berat']; ?></td>
				</tr>
				<tr>
					<th>Tgl. Selesai</th>
					<th>:</th>
					<td><?php echo date("d-F-Y",strtotime($pelanggan['transaksi_tgl_selesai'])); ?></td>
				</tr>
				<tr>
					<th>Status</th>
					<th>:</th>
					<td>
						<?php 
						if($pelanggan['transaksi_status']=="0"){
							echo "<div class='label label-warning'>PROSES</div>";
						}else if($pelanggan['transaksi_status']=="1"){
							echo "<div class='label label-info'>DI CUCI</div>";
						}else if($pelanggan['transaksi_status']=="2"){
							echo "<div class='label label-success'>SELESAI</div>";
						} 
						?>		
					</td>
				</tr>
				<tr>
					<th>Harga</th>
					<th>:</th>
					<td><?php echo "Rp. ".number_format($pelanggan['transaksi_harga'])." ,-"; ?></td>
				</tr>
			</table>

			<h5 class="text-center">Daftar Cucian</h5>
			<table class="table table-bordered table-striped">
				<tr>
					<th>Jenis Pakaian</th>
					<th width="20%">Jumlah</th>
				</tr>		

				<?php 
				// menyimpan id transaksi ke variabel id_transaksi
				$id = $pelanggan['transaksi_id'];

				// menampilkan pakaian-pakaian dari transaksi yang ber id di atas
				$pakaian = mysqli_query($koneksi,"select * from pakaian where pakaian_transaksi='$id'");

				while($p=mysqli_fetch_array($pakaian)){
					?>					
					<tr>
						<td><?php echo $p['pakaian_jenis']; ?></td>
						<td width="5%"><?php echo $p['pakaian_jumlah']; ?></td>
					</tr>
					<?php } ?>							
				</table>

				<p><center><i>"Terimakasih telah mencuci ditempat kami".</i></center></p>

				<?php 
			}
			?>
		</div>


	</div>

	<script type="text/javascript">
		window.print();
	</script>

</body>
</html>