<?php
session_start();
	if ($_SESSION['level']!== 'setrika') {
		header("location:../cek_session.php");
	}

	include 'header4.php';

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
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-info-sign"></i>
								<span class="pull-right">

								<?php
								$proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status='1'");
								echo mysqli_num_rows($proses);
								?>
							</h1>
							<b>Jumlah Pakaian Dicuci</b>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-flash"></i>
								<span class="pull-right">

									<?php
									$proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status='3'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							<b>Jumlah Pakaian Disetrika</b>
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
									$proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status='4'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							<b>Jumlah Pakaian Dikemas</b>
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
									$proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status='2'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							<b>Jumlah Cucian Selesai</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>








<?php include '../admin/footer.php';