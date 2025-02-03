<?php 
	$_SESSION['username']="surya";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendistribusian Zakat</title>
    <link rel="icon" href="../img/images.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/skins/skin-purple.min.css">
	<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.min.css">

</head>
<body style="background: #83bc00;"> 

	<!-- menu navigasi -->
	<nav class="navbar navbar-light" style="background-color: #ffffff; height: 60px;"> <!-- Atur tinggi navbar -->
    <div class="container-fluid">			
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<a class="navbar-brand" href="index.php" style="padding: 0; display: flex; align-items: center;">
				 <img src="../img/logo.png" alt="Logo IZI" style="height: 60px; margin: 0 30px;">
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="pencucian.php" class="text-success" style="line-height: 60px;"><i class="glyphicon glyphicon-home"></i><b> Dashboard</b></a></li>
					<li><a href="wawancara.php" class="text-success" style="line-height: 60px;"><i class="glyphicon glyphicon-random"></i><b> Transaksi</b></a></li>
					<li><a href="ganti_password.php" class="text-success" style="line-height: 60px;"><i class="glyphicon glyphicon-lock"></i><b> Ganti Password</b></a></li>	
					<li><a href="../logout.php" class="text-success" style="line-height: 60px;"><i class="glyphicon glyphicon-log-out"></i><b> Log Out</b></a></li>
				</ul>				
				<ul class="nav navbar-nav navbar-right">
					<li><p class="navbar-text" style="color: #83bc00">Halo, <b><?php echo $_SESSION['username']; ?></b>!</p></li>					
				</ul>
			</div>
		</div>
	</nav>
	<!-- akhir menu navigasi -->
</body>
</html>