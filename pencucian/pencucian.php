<?php
session_start();
	if ($_SESSION['level']!== 'pencucian') {
		header("location:../cek_session.php");
	}

	include 'header2.php';

	include '../koneksi.php';
?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Dasboard</h4>
		</div>
		<div class="panel-body">

			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-info">
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
					<div class="panel panel-warning">
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
							<b>Verifikasi Data</b>
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
							<b>Penyaluran</b>
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






<?php include '../admin/footer.php'; ?>