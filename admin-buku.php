<?php
	session_start();
	require_once "./functions/admin.php";
	
	$title = "admin";
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getSemuaBuku($conn);
	
	$errorResult = "";
	$isbn = "";	

	if(isset($_POST['tambahkan'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$judul = trim($_POST['judul']);
		$judul = mysqli_real_escape_string($conn, $judul);

		$penulis = trim($_POST['penulis']);
		$penulis = mysqli_real_escape_string($conn, $penulis);
		
		$penerbit = trim($_POST['penerbit']);
		$penerbit = mysqli_real_escape_string($conn, $penerbit);
		
		$tglterbit = trim($_POST['tglterbit']);
		$tglterbit = mysqli_real_escape_string($conn, $tglterbit);
		
		$deskripsi = trim($_POST['deskripsi']);
		$deskripsi = mysqli_real_escape_string($conn, $deskripsi);
		
		$harga = floatval(trim($_POST['harga']));
		$harga = mysqli_real_escape_string($conn, $harga);
		

		// tambah gambar
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		// cari penerbit dan return idpenerbit
		// Jika data penerbit tidak ada di database, akan buat baru
		$cariPenerbit = "SELECT * FROM penerbit WHERE nama_penerbit = '$penerbit'";
		$queryPenerbit = mysqli_query($conn, $cariPenerbit);
		if(mysqli_num_rows($queryPenerbit) == 0){
			
			$insertPenerbit = "INSERT INTO penerbit(nama_penerbit) VALUES ('$penerbit')";
			$resultPenerbit = mysqli_query($conn, $insertPenerbit);
			if(!resultPenerbit){
				$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penerbit buku. ';
			}
			$idpenerbit = mysqli_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($queryPenerbit);
			$idpenerbit = $row['idpenerbit'];
		}
		
		// cari penulis dan return idpenulis
		// Jika data penulis tidak ada di database, akan buat baru
		$cariPenulis = "SELECT * FROM penulis WHERE nama_penulis = '$penulis'";
		$queryPenulis = mysqli_query($conn, $cariPenulis);
		if(mysqli_num_rows($queryPenulis) == 0){
			
			$insertPenulis = "INSERT INTO penulis(nama_penulis) VALUES ('$penulis')";
			$resultPenulis = mysqli_query($conn, $insertPenulis);
			if(!$resultPenulis){
				$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penulis buku. ';
			}
			$idpenulis = mysqli_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($queryPenulis);
			$idpenulis = $row['idpenulis'];
		}

		$query = "INSERT INTO buku VALUES ('" . $isbn . "', 
											'" . $judul . "', 
											'" . $idpenulis . "', 
											'" . $idpenerbit . "', 
											'" . $tglterbit . "', 
											'" . $image . "', 
											'" . $deskripsi . "', 
											'" . $harga . "')";
		$resultQuery = mysqli_query($conn, $query);
		if(!$resultQuery){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data buku. ';
		} else {
			header("Location: admin-buku.php");
		}
	} else if(isset($_POST['ubah'])){
			$isbn = trim($_POST['isbn']);
			$isbn = mysqli_real_escape_string($conn, $isbn);
			
			$judul = trim($_POST['judul']);
			$judul = mysqli_real_escape_string($conn, $judul);

			$penulis = trim($_POST['penulis']);
			$penulis = mysqli_real_escape_string($conn, $penulis);
			
			$penerbit = trim($_POST['penerbit']);
			$penerbit = mysqli_real_escape_string($conn, $penerbit);
			
			$tglterbit = trim($_POST['tglterbit']);
			$tglterbit = mysqli_real_escape_string($conn, $tglterbit);
			
			$deskripsi = trim($_POST['deskripsi']);
			$deskripsi = mysqli_real_escape_string($conn, $deskripsi);
			
			$harga = floatval(trim($_POST['harga']));
			$harga = mysqli_real_escape_string($conn, $harga);
			

			// tambah gambar
			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
				$image = $_FILES['image']['name'];
				$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
				$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
				$uploadDirectory .= $image;
				move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
			}

			$cariPenerbit = "SELECT * FROM penerbit WHERE nama_penerbit = '$penerbit'";
			$resultPenerbit = mysqli_query($conn, $cariPenerbit);
			if(mysqli_num_rows($resultPenerbit) == 0){
				
				$insertPenerbit = "INSERT INTO penerbit(nama_penerbit) VALUES ('$penerbit')";
				$insertResult = mysqli_query($conn, $insertPenerbit);
				if(!$insertResult){
					$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penerbit. ';
				}
				$idpenerbit = mysqli_insert_id($conn);
			} else {
				$row = mysqli_fetch_assoc($resultPenerbit);
				$idpenerbit = $row['idpenerbit'];
			}
		
			$cariPenulis = "SELECT * FROM penulis WHERE nama_penulis = '$penulis'";
			$resultPenulis = mysqli_query($conn, $cariPenulis);
			if(mysqli_num_rows($resultPenulis) == 0){
				
				$insertPenulis = "INSERT INTO penulis(nama_penulis) VALUES ('$penulis')";
				$insertResult2 = mysqli_query($conn, $insertPenulis);
				if(!$insertResult2){
					$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penulis.';
				}
				$idpenulis = mysqli_insert_id($conn);
			} else {
				$row = mysqli_fetch_assoc($resultPenulis);
				$idpenulis = $row['idpenulis'];
			}

			$update = "UPDATE buku SET judul='" . $judul . "',
										idpenulis='" . $idpenulis . "',
										idpenerbit='" . $idpenerbit . "',
										tgl_terbit='" . $tglterbit . "',
										deskripsi_buku='" . $deskripsi . "',
										harga='" . $harga . "'
										WHERE isbn = '$isbn'";
												
			$updateResult = mysqli_query($conn, $update);
			if(!$updateResult){
				$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data buku.';
			} else {
				header("Location: admin-buku.php");
			}
	}
?>
		
	<div class="text-center">
		<H3 class="text-center" style="margin-top: 50px;">Data Buku</H3>
		<span class="help-block" style="margin-top: 0px; margin-bottom: 0px;" >Detail informasi mengenai data daftar buku penulis dan penerbit.</span>
		<a href="#tambah" style="margin-top: 30px; margin-bottom: 50px;" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">Tambah Buku Baru</a>
	</div>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Judul</th>
			<th>Gambar</th>
			<th>Deskripsi</th>
			<th>Tgl. Terbit</th>
			<th>Harga</th>
			<th>Penerbit (ID)</th>
			<th>Penulis (ID)</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['isbn']; ?></td>
			<td><?php echo $row['judul']; ?></td>
			<td><?php echo $row['gambar_buku']; ?></td>
			<td><?php echo $row['deskripsi_buku']; ?></td>
			<td><?php echo $row['tgl_terbit']; ?></td>
			<td><?php echo rupiahFormat($row['harga']); ?></td>
			<td><?php echo getNamaPenerbit($conn, $row['idpenerbit']) . ' (' . $row['idpenerbit'] . ')'; ?></td>
			<td><?php echo getNamaPenulis($conn, $row['idpenulis']) . ' ('. $row['idpenulis'] .')'; ?></td>
			<td>	
				<a href="#" 
							data-isbn="<?php echo $row['isbn']; ?>"
							data-judul="<?php echo $row['judul']; ?>"
							data-penulis="<?php echo getNamaPenulis($conn, $row['idpenulis']); ?>"
							data-penerbit="<?php echo getNamaPenerbit($conn, $row['idpenerbit']); ?>"
							data-deskripsi="<?php echo $row['deskripsi_buku']; ?>"
							data-tglterbit="<?php echo $row['tgl_terbit']; ?>"
							data-harga="<?php echo $row['harga']; ?>"
							data-toggle="modal" data-target="#ubah-data">Ubah</a>
				
			</td>
			<td><a href="#" data-href="admin-hapus.php?isbn=<?php echo $row['isbn']; ?>" data-toggle="modal" data-target="#konfirmasi-hapus">Hapus</a></td>
		</tr>
		<?php } ?>
	</table>
			
		
	<!-- Modal -->
	<div class="modal fade" id="konfirmasi-hapus" role="dialog" style="margin-top: 15%;">
		<div class="modal-dialog modal-sm">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
			  <p>Apakah anda yakin ingin menghapus data.</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-danger btn-hapus">Hapus</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
			</div>
		  </div>
		  
		</div>
	</div>
	
		
	<!-- Modal -->
	<div class="modal fade" id="tambah-data" role="dialog" style="margin-top: 2%;">
		<div class="modal-dialog modal-lg">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tambah Buku</h4>
			</div>
			
			<form method="post" action="admin-buku.php" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>ISBN</th>
							<td><input type="text" class="col-md-6" placeholder="Nomor ISBN"  name="isbn" required></td>
						</tr>
						<tr>
							<th>Judul</th>
							<td><input type="text" class="col-md-6" placeholder="Judul Buku"  name="judul" required></td>
						</tr>
						<tr>
							<th>Penulis</th>
							<td><input type="text" class="col-md-6" placeholder="Penulis Buku"  name="penulis" required></td>
						</tr>
						<tr>
							<th>Penerbit</th>
							<td><input type="text" class="col-md-6" placeholder="Penerbit Buku"  name="penerbit" required></td>
						</tr>
						<tr>
							<th>Tanggal Terbit</th>
							<td><input type="text" class="col-md-6" placeholder="Tanggal Terbit"  name="tglterbit" required></td>
						</tr>
						<tr>
							<th>Gambar</th>
							<td><input type="file" class="col-md-6" name="image" required></td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td><textarea name="deskripsi" cols="42" rows="5" required></textarea></td>
						</tr>
						<tr>
							<th>Harga</th>
							<td><input type="text" class="col-md-3" name="harga" placeholder="Rp. " required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="tambahkan" value="Tambahkan Buku" class="btn btn-primary">	
					<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
				</div>
			</div>
			</form>
		</div>
	</div>	
		
	<!-- Modal -->
	<div class="modal fade" id="ubah-data" role="dialog" style="margin-top: 2%;">
		<div class="modal-dialog modal-lg">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Ubah Buku</h4>
			</div>
			
			<form method="post" action="admin-buku.php" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>ISBN</th>
							<td><input type="text" class="col-md-6 data-isbn" placeholder="Nomor ISBN"  name="isbn" required></td>
						</tr>
						<tr>
							<th>Judul</th>
							<td><input type="text" class="col-md-6 data-judul" placeholder="Judul Buku"  name="judul" required></td>
						</tr>
						<tr>
							<th>Penulis</th>
							<td><input type="text" class="col-md-6 data-penulis" placeholder="Penulis Buku"  name="penulis" required></td>
						</tr>
						<tr>
							<th>Penerbit</th>
							<td><input type="text" class="col-md-6 data-penerbit" placeholder="Penerbit Buku"  name="penerbit" required></td>
						</tr>
						<tr>
							<th>Tanggal Terbit</th>
							<td><input type="text" class="col-md-6 data-tglterbit" placeholder="Tanggal Terbit"  name="tglterbit" required></td>
						</tr>
						<tr>
							<th>Gambar</th>
							<td><input type="file" class="col-md-6" name="image"></td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td><textarea name="deskripsi" class="data-deskripsi" cols="42" rows="5"></textarea></td>
						</tr>
						<tr>
							<th>Harga</th>
							<td><input type="text" class="col-md-3 data-harga" name="harga" placeholder="Rp. " required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">	
					<input type="submit" name="ubah" value="Ubah Buku" class="btn btn-primary">	
					<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
				</div>
			</div>
			</form>
		</div>
	</div>

	

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./footer.php";
?>