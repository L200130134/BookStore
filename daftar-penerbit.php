<?php
	session_start();
	require_once "functions/database_functions.php";
	
	// get id
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		echo "Salah query id! Silahkan cek kembali.";
		exit;
	}

	// konek database
	$conn = db_connect();
	$namaPenerbit = getNamaPenerbit($conn, $id);

	$query = "SELECT isbn, judul, gambar_buku FROM buku WHERE idpenerbit = '$id'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Saat ini buku penerbit tidak tersedia! Tunggu sampai buku yang baru terbit.";
		exit;
	}

	require "header.php";
?>
	<p class="lead"><a href="penerbit.php">Penerbit</a> > <?php echo $namaPenerbit; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="bootstrap/img/<?php echo $row['gambar_buku'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['judul'];?></h4>
			<a href="details-buku.php?isbn=<?php echo $row['isbn'];?>" class="btn btn-primary">Detail Buku</a>
		</div>
	</div>
	<br>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "footer.php";
?>