<?php
session_start();
if ($_SESSION['level'] !== 'admin') {
    header("location:../cek_session.php");
}
include 'header1.php';

include '../koneksi.php';
?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Dashboard</h4>
		</div>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-user"></i> 
								<span class="pull-right">
									
									<?php
                                    $pelanggan = mysqli_query($koneksi, "select * from pelanggan");
                                    echo mysqli_num_rows($pelanggan);
                                    ?>
								</span>
							</h1>
							<b>Jumlah Mustahik</b>
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-refresh"></i> 
								<span class="pull-right">
									
									<?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi1 where status='0'");
                                    echo mysqli_num_rows($proses);
                                    ?>
								</span>
							</h1>
							<b>Proses Wawancara</b>
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-info-sign"></i> 
								<span class="pull-right">
									
									<?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi1 where status='1'");
                                    echo mysqli_num_rows($proses);
                                    ?>
								</span>
							</h1>
							<b>Proses Verifikasi Data</b>
						</div>						
					</div>				
				</div>

				<div class="col-md-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-import"></i> 
								<span class="pull-right">
									
									<?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi1 where status='4'");
                                    echo mysqli_num_rows($proses);
                                    ?>
								</span>
							</h1>
							<b>Proses Penyaluran</b>
						</div>						
					</div>				
				</div>

				<div class="col-md-3">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-remove"></i>
								<span class="pull-right">

									<?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi1 where status='3'");
                                    echo mysqli_num_rows($proses);
                                    ?>
								</span>
							</h1>
							<b>Rejected</b>
						</div>
					</div>
				</div>
						
				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-ok-sign"></i> 
								<span class="pull-right">
									
									<?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi1 where status='2'");
                                    echo mysqli_num_rows($proses);
                                    ?>
								</span>
							</h1>
							<b>Laporan</b>
						</div>						
					</div>				
				</div>				
			</div>		

		</div>
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4>Riwayat Pengajuan</h4>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<tr>
							<th width="1%">No</th>
							<th>Keperluan</th>
							<th>Tgl. Pengajuan</th>
							<th>NIK</th>
							<th>Mustahik</th>
							<th>No Handphone</th>
							<th>Status</th>				
						
						</tr>
					</thead>	
					<tbody>
						<?php
                        // koneksi database
                        include '../koneksi.php';

                        // mengambil data pelanggan dari database
                        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan A INNER JOIN transaksi1 B ON A.pelanggan_id = B.pelanggan_id order by id desc");
                        $no = 1;
                        // mengubah data ke array dan menampilkannya dengan perulangan while
                        while ($d = mysqli_fetch_array($data)) {
                            ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $d['keperluan']; ?></td>
								<td><?php echo date("d-F-Y", strtotime($d['tgl_transaksi'])); ?></td>
								<td><?php echo $d['pelanggan_nik']; ?></td>
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
					<?php
                        }
                        ?>
			</table>
		</div>
	</div>


</div>

<?php include 'footer.php'; ?>
