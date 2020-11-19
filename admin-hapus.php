<?php
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['isbn'])){
		
		$isbn = $_GET['isbn'];
		
		$query = "DELETE FROM buku WHERE isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){		
			header("Location: admin-buku.php?status=isbn&hapus=n&message=". mysqli_error($conn) ."");
		} else {
			header("Location: admin-buku.php?status=isbn&hapus=y");
		}
	} else if(isset($_GET['notagihan'])){
		
		$notagihan = $_GET['notagihan'];
		
		$query = "DELETE FROM status_order WHERE no_tagihan = '$notagihan'";
		$result = mysqli_query($conn, $query);
		if(!$result){		
			header("Location: admin-order.php?status=notagihan&hapus=n&message=". mysqli_error($conn) ."");
		} else {
			header("Location: admin-order.php?status=notagihan&hapus=y");
		}
	} else if(isset($_GET['idpelanggan'])){
		
		$idpelanggan = $_GET['idpelanggan'];
		
		$query = "DELETE FROM pelanggan WHERE idpelanggan = '$idpelanggan'";
		$result = mysqli_query($conn, $query);
		if(!$result){		
			header("Location: admin-pelanggan.php?status=idpelanggan&hapus=n&message=". mysqli_error($conn) ."");
		} else {
			header("Location: admin-pelanggan.php?status=idpelanggan&hapus=y");
		}
	}  else if(isset($_GET['idpenulis'])){
		
		$idpenulis = $_GET['idpenulis'];
		
		$query = "DELETE FROM penulis WHERE idpenulis = '$idpenulis'";
		$result = mysqli_query($conn, $query);
		if(!$result){		
			header("Location: admin-penulis.php?status=idpenulis&hapus=n&message=". mysqli_error($conn) ."");
		} else {
			header("Location: admin-penulis.php?status=idpenulis&hapus=y");
		}
	}  else if(isset($_GET['idpenerbit'])){
		
		$idpenerbit = $_GET['idpenerbit'];
		
		$query = "DELETE FROM penerbit WHERE idpenerbit = '$idpenerbit'";
		$result = mysqli_query($conn, $query);
		if(!$result){		
			header("Location: admin-penerbit.php?status=idpenerbit&hapus=n&message=". mysqli_error($conn) ."");
		} else {
			header("Location: admin-penerbit.php?status=idpenerbit&hapus=y");
		}
	} 
?>