<?php include 'header2.php'; ?>

<div class="container">
	
	<div class="panel">
		<div class="panel-heading">
			<h4>Data Transaksi Laundry</h4>
		</div>
		<div class="panel-body">

			<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Invoice</th>
							<th>Tgl. Laundry</th>
							<th width="20%">Pelanggan</th>
							<th width="8%">Berat (Kg)</th>
							<th>Tgl. Selesai</th>
							<th>Harga</th>
							<th>Status</th>				
							<th width="13%">OPSI</th>
						</tr>
					</thead>	
					<tbody>
						<?php 
						// koneksi database
						include '../koneksi.php';

						// mengambil data pelanggan dari database
						$data = mysqli_query($koneksi,"SELECT * FROM pelanggan A INNER JOIN transaksi B ON A.pelanggan_id = B.transaksi_pelanggan where transaksi_status='0' or transaksi_status='1' order by transaksi_id desc limit 100");
						$no = 1;
						// mengubah data ke array dan menampilkannya dengan perulangan while
						while($d=mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td>INVOICE-<?php echo $d['transaksi_id']; ?></td>
								<td><?php echo date("d-F-Y",strtotime($d['transaksi_tgl'])); ?></td>
								<td><?php echo $d['pelanggan_nama']; ?></td>
								<td><?php echo $d['transaksi_berat']; ?></td>
								<td><?php echo date("d-F-Y",strtotime($d['transaksi_tgl_selesai'])); ?></td>
								<td><?php echo "Rp. ".number_format($d['transaksi_harga']) ." ,-"; ?></td>
								<td>
									<?php 
									if($d['transaksi_status']=="0"){
                                        echo "<div class='label label-warning'>PROSES</div>";
                                    } else if ($d['transaksi_status']=="1"){
                                        echo "<div class='label label-info'>DI CUCI</div>";
                                    }
									?>							
								</td>
								<td>
									<a href="transaksi_read.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-warning">Detail</a>
									
									<?php
										if($d['transaksi_status']=="0"){?>
											<a href="transaksi_update.php?id=<?php echo $d['transaksi_id']; ?>&status=1" class="btn btn-sm btn-info">Dicuci</a>
									<?php } else if ($d['transaksi_status']=="1"){ ?>
										<a href="transaksi_update.php?id=<?php echo $d['transaksi_id']; ?>&status=2" class="btn btn-sm btn-success">Selesai</a>
									<?php } ?>
									
								</td>
							</tr>
							<?php 
						}
						?>
						</tbody>
					</table>
		</div>
	</div>
</div>

<?php include '../admin/footer.php'; ?>