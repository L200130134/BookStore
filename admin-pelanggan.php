<?php
	session_start();
	require_once "./functions/admin.php";
	
	$title = "admin";
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getSemuaPelanggan($conn);
	
	if(isset($_POST['tambahkan'])){
		$idpelanggan = trim($_POST['idpelanggan']);
		$idpelanggan = mysqli_real_escape_string($conn, $idpelanggan);
		
		$nama = trim($_POST['nama']);
		$nama = mysqli_real_escape_string($conn, $nama);
		
		$email = trim($_POST['email']);
		$email = mysqli_real_escape_string($conn, $email);
		
		$alamat = trim($_POST['alamat']);
		$alamat = mysqli_real_escape_string($conn, $alamat);
		
		$kota = trim($_POST['kota']);
		$kota = mysqli_real_escape_string($conn, $kota);
		
		$postalkode = trim($_POST['postalkode']);
		$postalkode = mysqli_real_escape_string($conn, $postalkode);
		
		$provinsi = trim($_POST['provinsi']);
		$provinsi = mysqli_real_escape_string($conn, $provinsi);

		$insertPelanggan = "INSERT INTO pelanggan VALUES ('0', 
											'" . $nama . "', 
											'" . $email . "', 
											'" . $alamat . "', 
											'" . $kota . "', 
											'" . $postalkode . "', 
											'" . $provinsi . "')";
		$resultQuery = mysqli_query($conn, $insertPelanggan);
		if(!$resultQuery){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data pelanggan. ';
		} else {
			header("Location: admin-pelanggan.php");
		}
		
	} else if(isset($_POST['ubah'])){
		
		$idpelanggan = trim($_POST['idpelanggan']);
		$idpelanggan = mysqli_real_escape_string($conn, $idpelanggan);
		
		$nama = trim($_POST['nama']);
		$nama = mysqli_real_escape_string($conn, $nama);
		
		$email = trim($_POST['email']);
		$email = mysqli_real_escape_string($conn, $email);
		
		$alamat = trim($_POST['alamat']);
		$alamat = mysqli_real_escape_string($conn, $alamat);
		
		$kota = trim($_POST['kota']);
		$kota = mysqli_real_escape_string($conn, $kota);
		
		$postalkode = trim($_POST['postalkode']);
		$postalkode = mysqli_real_escape_string($conn, $postalkode);
		
		$provinsi = trim($_POST['provinsi']);
		$provinsi = mysqli_real_escape_string($conn, $provinsi);
		
		$update = "UPDATE pelanggan SET nama='" . $nama . "',
										email='" . $email . "',
										alamat='" . $alamat . "',
										kota='" . $kota . "',
										postal_kode='" . $postalkode . "',
										provinsi='" . $provinsi . "'
										WHERE idpelanggan = '$idpelanggan'";
												
		$updateResult = mysqli_query($conn, $update);
		if(!$updateResult){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data pelanggan. ';
		} else {
			header("Location: admin-pelanggan.php");
		}
	}
?>
	<div class="text-center">
		<H3 class="text-center" style="margin-top: 50px;">Data Pelanggan</H3>
		<span class="help-block" style="margin-top: 0px; margin-bottom: 0px;" >Detail informasi mengenai data pelanggan yang telah order buku.</span>
		<a href="#" style="margin-top: 30px; margin-bottom: 50px;" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">Tambah Data Pelanggan</a>
	</div>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID Pelanggan</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Alamat</th>
			<th>Kota</th>
			<th>Postal Kode</th>
			<th>Provinsi</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['idpelanggan']; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['alamat']; ?></td>
			<td><?php echo $row['kota']; ?></td>
			<td><?php echo $row['postal_kode']; ?></td>
			<td><?php echo $row['provinsi']; ?></td>
			<td>
				<a href="#" 
							data-idpelanggan="<?php echo $row['idpelanggan']; ?>"
							data-nama="<?php echo $row['nama']; ?>"
							data-email="<?php echo $row['email']; ?>"
							data-alamat="<?php echo $row['alamat']; ?>"
							data-kota="<?php echo $row['kota']; ?>"
							data-postalkode="<?php echo $row['postal_kode']; ?>"
							data-provinsi="<?php echo $row['provinsi']; ?>"
							data-toggle="modal" data-target="#ubah-data">Ubah</a>
			</td>
			<td><a href="#" data-href="admin-hapus.php?idpelanggan=<?php echo $row['idpelanggan']; ?>" data-toggle="modal" data-target="#konfirmasi-hapus">Hapus</a></td>
			<!--td><a href="admin-hapus.php?isbn=<?php echo $row['isbn']; ?>">Hapus</a></td-->
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
	<div class="modal fade" id="tambah-data" role="dialog" style="margin-top: 5%;">
		<div class="modal-dialog modal-md">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tambah Pelanggan</h4>
			</div>
			
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama</th>
							<td>
								<input type="text" class="col-md-10" placeholder="Nama"  name="nama" required>
								<input type="hidden" class="col-md-10" placeholder="ID Pelanggan"  name="idpelanggan" readonly>
							</td>
						</tr>
						<tr>
							<th>Email</th>
							<td><input type="email" class="col-md-10" placeholder="Email"  name="email" required></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td><input type="text" class="col-md-10" placeholder="Alamat"  name="alamat" required></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td><input type="text" class="col-md-10" placeholder="Kota"  name="kota" required></td>
						</tr>
						<tr>
							<th>Postal Kode</th>
							<td><input type="text" class="col-md-10" placeholder="Postal Kode"  name="postalkode" required></td>
						</tr>
						<tr>
							<th>Provinsi</th>
							<td><input type="text" class="col-md-10" placeholder="Provinsi"  name="provinsi" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="tambahkan" value="Tambahkan Pelanggan" class="btn btn-primary">	
					<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
				</div>
			</div>
			</form>
		</div>
	</div>	
  
	
	<!-- Modal -->
	<div class="modal fade" id="ubah-data" role="dialog" style="margin-top: 5%;">
		<div class="modal-dialog modal-md">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tambah Pelanggan</h4>
			</div>
			
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>ID Pelanggan</th>
							<td><input type="text" class="col-md-10 data-idpelanggan" placeholder="ID Pelanggan"  name="idpelanggan" readonly required></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><input type="text" class="col-md-10 data-nama" placeholder="Nama"  name="nama" required></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><input type="email" class="col-md-10 data-email" placeholder="Email"  name="email" required></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td><input type="text" class="col-md-10 data-alamat" placeholder="Alamat"  name="alamat" required></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td><input type="text" class="col-md-10 data-kota" placeholder="Kota"  name="kota" required></td>
						</tr>
						<tr>
							<th>Postal Kode</th>
							<td><input type="text" class="col-md-10 data-postalkode" placeholder="Postal Kode"  name="postalkode" required></td>
						</tr>
						<tr>
							<th>Provinsi</th>
							<td><input type="text" class="col-md-10 data-provinsi" placeholder="Provinsi"  name="provinsi" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="ubah" value="Ubah Pelanggan" class="btn btn-primary">	
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