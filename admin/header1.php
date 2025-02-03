<?php
if ($_SESSION['username'] = "prasetya") {
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendistribusian Zakat</title>
    <link rel="icon" href="../img/images.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/skins/skin-purple.min.css">
	<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.min.css">
    <style>
        .slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .slideshow img {
                position: absolute;
                min-width: 100vw;
                min-height: 100vh;
                width: auto;
                height: auto;
                object-fit: cover;
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }

                .slideshow img.active {
                    opacity: 1;
                }

        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            max-height: 800px;
            border-radius: 10px;
        }
    </style>
    </style>
</head>
<!--<body style="background: #83bc00;"> <!-- Background yang lebih lembut -->
<body>
     <div class="slideshow">
        <img src="../img/bg.png" class="active">
        <img src="../img/bg2.png">
        <img src="../img/bg3.png">
        <img src="../img/bg4.png">
    </div>
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
</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php" class="text-white" style="line-height: 60px;"><i class="glyphicon glyphicon-home"></i><b> Dashboard</b></a></li>
                <li><a href="pelanggan.php" class="text-white" style="line-height: 60px;"><i class="glyphicon glyphicon-user"></i><b> Mustahik</b></a></li>																		
                <li><a href="validasi.php" class="text-white" style="line-height: 60px;"><i class="glyphicon glyphicon-random"></i><b> Proses</b></a></li>
                <li><a href="laporan.php" class="text-white" style="line-height: 60px;"><i class="glyphicon glyphicon-list-alt"></i><b> Laporan</b></a></li>
                <li class="dropdown">
                    <a href="#" class="text-white" style="line-height: 60px;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i><b> Pengaturan </b><span class="caret"></span></a>
                    <ul class="dropdown-menu">							
                        <!--<li><a href="harga.php" class="text-success"><i class="glyphicon glyphicon-usd"></i> Pengaturan Harga</a></li>-->
                        <li><a href="ganti_password.php" class="text-success"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a></li>
                    </ul>
                </li>
                <li><a href="../logout.php" class="text-white" style="line-height: 60px;"><i class="glyphicon glyphicon-log-out"></i><b> Log Out</b></a></li>
            </ul>				
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text" style="color: #83bc00; line-height: 60px;">Halo, <b><?php echo $_SESSION['username']; ?></b>!</p></li>					
            </ul>
        </div>
    </div>
</nav>
 <script>
        let slides = document.querySelectorAll('.slideshow img');
        let index = 0;
        
        function nextSlide() {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }
        
        setInterval(nextSlide, 5000);
    </script>
	<!-- akhir menu navigasi -->
</body>
</html>
