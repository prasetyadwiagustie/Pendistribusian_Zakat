<?php
session_start();
    if($_SESSION['level'] == 'admin'){
        header("location:admin/index.php");
    } elseif($_SESSION['level'] == 'pencucian'){
        header("location:pencucian/pencucian.php");
    } elseif($_SESSION['level'] == 'setrika'){
        header("location:setrika/setrika.php");
    } elseif($_SESSION['level'] == 'pengemasan'){
        header("location:pengemasan/pengemasan.php");
    } else {
        header("location:index.php");
    }
?>