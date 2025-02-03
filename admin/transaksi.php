<?php include 'header1.php'; ?>

<div class="container">
	
	<div class="panel">
		<div class="panel-heading">
			<h4>Data Transaksi Laundry</h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-primary pull-right">Transaksi Baru</a>
			<br>
			<br>
			<br>
			<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Invoice</th>
							<th>Tgl. Laundry</th>
							<th>Pelanggan</th>
							<th width="8%">Berat (Kg)</th>
							<th>Tgl. Selesai</th>
							<th>Harga</th>
							<th>Status</th>				
							<th width="20%">OPSI</th>
						</tr>
					</thead>	
					<tbody>
						<?php 
						// koneksi database
						include '../koneksi.php';

						// mengambil data pelanggan dari database
						$data = mysqli_query($koneksi,"SELECT * FROM pelanggan A INNER JOIN transaksi B ON A.pelanggan_id = B.transaksi_pelanggan order by transaksi_id desc");
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
									}else if($d['transaksi_status']=="1"){
										echo "<div class='label label-info'>DI CUCI</div>";
									}else if ($d['transaksi_status']=="3"){
										echo "<div class='label label-primary'>SETRIKA</div>";
									}else if ($d['transaksi_status']=="4"){
										echo "<div class='label label-info'>DI KEMAS</div>";
									}else if($d['transaksi_status']=="2"){
										echo "<div class='label label-success'>SELESAI</div>";
									}
									?>							
								</td>
								<td>
									<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
									<a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-info">Update</a>
									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $d['transaksi_id'];?>">Batalkan</button>
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

<!-- modal batalkan -->
<?php

	$data = mysqli_query($koneksi,"SELECT * FROM pelanggan A INNER JOIN transaksi B ON A.pelanggan_id = B.transaksi_pelanggan order by transaksi_id desc");
	while($h=mysqli_fetch_array($data)){
?>
<div class="modal fade" id="exampleModal<?= $h['transaksi_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel"><b>Batalkan Transaksi</b></h3>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin batalkan transaksi <?= $h['pelanggan_nama']; ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <a href="transaksi_hapus.php?id=<?php echo $h['transaksi_id']; ?>" class="btn btn-danger">Ya</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- js -->



<?php include 'footer.php'; ?>