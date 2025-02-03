<?php include 'header2.php'; ?>

<div class="container">
	
	<div class="panel">
		<div class="panel-heading">
			<h4>Validasi Data Mustahik</h4>
		</div>
		<div class="panel-body">

			
			<br>
			<br>
			<br>
			<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Keperluan</th>
							<th>Tgl. Pengajuan</th>
							<th>Mustahik</th>
							<th>HP</th>
							<th>Status</th>				
							<th width="15%" align="center">OPSI</th>
						</tr>
					</thead>	
					<tbody>
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
                                        if ($d['status'] == "0") {
                                            echo "<div class='label label-warning'>WAWANCARA</div>";
                                        } else if ($d['status'] == "1") {
                                            echo "<div class='label label-info'>VERIFIKASI DATA</div>";
                                        } else if ($d['status'] == "3") {
                                            echo "<div class='label label-primary'>REJECTED</div>";
                                        } else if ($d['status'] == "4") {
                                            echo "<div class='label label-info'>PENYALURAN</div>";
                                        } else if ($d['status'] == "2") {
                                            echo "<div class='label label-success'>LAPORAN</div>";
                                        }
                                        ?>								
								</td>
								<td>
									<a href="transaksi_read.php?id=<?php echo $d['id']; ?>"  class="btn btn-sm btn-warning">Detail</a>	
									
									<?php
										if($d['status']=="0"){?>
											<a href="transaksi_update.php?id=<?php echo $d['id']; ?>&status=1" class="btn btn-sm btn-info">Verfikasi</a>
									<?php } else if ($d['status']=="1"){ ?>
										<a href="transaksi_update.php?id=<?php echo $d['id']; ?>&status=2" class="btn btn-sm btn-success">Selesai</a>
									<?php } ?>
									
								</td>
								<!--<td>

									<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
									<a href="transaksi_edit1.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-info">Update</a>
									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $d['id'];?>">Batalkan</button>
								</td>-->
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