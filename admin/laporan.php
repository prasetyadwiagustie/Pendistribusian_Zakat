<?php include 'header1.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Filter Laporan</h4>
		</div>
		<div class="panel-body">		

			<form action="laporan.php" method="get">
				<table class="table table-bordered table-striped">
					<tr>				
						<th>Dari Tanggal</th>
						<th>Sampai Tanggal</th>							
						<th width="1%"></th>
					</tr>
					<tr>
						<td>
							<br/>
							<input type="date" name="tgl_dari" class="form-control">
						</td>
						<td>
							<br/>
							<input type="date" name="tgl_sampai" class="form-control">
							<br/>
						</td>
						<td>
							<br/>
							<input type="submit" class="btn btn-primary" value="Filter">
						</td>
					</tr>

				</table>
			</form>
			
		</div>
	</div>

	<br/>

	<?php 
	if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){

		$dari = $_GET['tgl_dari'];
		$sampai = $_GET['tgl_sampai'];

		?>
		<div class="panel">
			<div class="panel-heading">
				<h4>Data Laporan Penyaluran <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
			</div>
			<div class="panel-body">			

				<!--<a target="_blank" href="cetak_print.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>-->
				<a target="_blank" href="cetak_pdf.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK PDF</a>
				<br/>
				<br/>
				<table class="table table-bordered table-striped">
					<tr>
							<th width="1%">No</th>
							<th>Keperluan</th>
							<th>Tgl. Pengajuan</th>
							<th>Mustahik</th>
							<th>HP</th>
							<th>Status</th>				
						
						</tr>

					<?php 
					// koneksi database
					include '../koneksi.php';

						// mengambil data pelanggan dari database
						$data = mysqli_query($koneksi,"SELECT * FROM pelanggan A INNER JOIN transaksi1 B ON A.pelanggan_id = B.pelanggan_id order by id desc");
						$no = 1;
						// mengubah data ke array dan menampilkannya dengan perulangan while
						while($d=mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $d['keperluan']; ?></td>
								<td><?php echo date("d-F-Y",strtotime($d['tgl_transaksi'])); ?></td>
								<td><?php echo $d['pelanggan_nama']; ?></td>
								<td>
    <?php
	$hp = $d['pelanggan_hp'];
	// Mengganti awalan 0 dengan +62
	$hp_wa = '+62' . ltrim($hp, '0');
	?>
    <a href="https://wa.me/<?php echo $hp_wa; ?>" target="_blank">
        <?php echo $hp; ?>
    </a>
</td>

								<td>
									<?php 
									if($d['status']=="0"){
										echo "<div class='label label-warning'>PROSES</div>";
									}else if($d['status']=="1"){
										echo "<div class='label label-info'>DI CUCI</div>";
									}else if ($d['status']=="3"){
										echo "<div class='label label-primary'>SETRIKA</div>";
									}else if ($d['status']=="4"){
										echo "<div class='label label-info'>DI KEMAS</div>";
									}else if($d['status']=="2"){
										echo "<div class='label label-success'>SELESAI</div>";
									}
									?>							
								</td>						
						</tr>
						<?php 
					}
					?>
				</table>
			</div>
		</div>
		<?php } ?>

	</div>

	<?php include 'footer.php'; ?>