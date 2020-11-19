<?php
	$errorResult="";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project KP</title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">BukuLapak</a>
        </div>

        <!--/.navbar-collapse -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<?php if(isset($title) && $title == "admin") {?>
              <li><a href="admin-penerbit.php"><span class="glyphicon glyphicon-paperclip"></span>&nbsp; Penerbit</a></li>
              <li><a href="admin-penulis.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Penulis</a></li>
              <li><a href="admin-buku.php"><span class="glyphicon glyphicon-book"></span>&nbsp; Data Buku</a></li>
              <li><a href="admin-pelanggan.php"><span class="glyphicon glyphicon-user"></span>&nbsp; Data Pelanggan</a></li>
              <li><a href="admin-order.php"><span class="glyphicon glyphicon-th-list"></span>&nbsp; Data Order</a></li>
              <li><a href="admin-logout.php">&nbsp;&nbsp;&nbsp; Keluar</a></li>
			<?php } else { ?>
              <li><a href="penerbit.php"><span class="glyphicon glyphicon-paperclip"></span>&nbsp; Penerbit</a></li>
              <li><a href="penulis.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Penulis</a></li>
              <li><a href="cek-order.php"><span class="glyphicon glyphicon-book"></span>&nbsp; Cek Order</a></li>
              <li><a href="kontak.php"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; Kontak</a></li>
              <li><a href="keranjang.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Keranjang</a></li>	
			<?php } ?>
            </ul>
        </div>
      </div>
    </nav>

    <div class="container" id="main">