<?php
	session_start();
	require_once "./functions/admin.php";
	
	$title = "admin";
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getSemuaPenulis($conn);
	
	$errorResult="";
	
	if(isset($_POST['tambahkan'])){
		$penulis = trim($_POST['penulis']);
		$penulis = mysqli_real_escape_string($conn, $penulis);

		$insertPenerbit = "INSERT INTO penulis VALUES ('', '". $penulis ."')";
		$resultPenerbit = mysqli_query($conn, $insertPenerbit);
		if(!resultPenerbit){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penulis buku.';
		} else {
			header("Location: admin-penulis.php");
		}
	} else if(isset($_POST['ubah'])){
		$idpenulis = trim($_POST['idpenulis']);
		$idpenulis = mysqli_real_escape_string($conn, $idpenulis);
				
		$penulis = trim($_POST['penulis']);
		$penulis = mysqli_real_escape_string($conn, $penulis);
		
		$update = "UPDATE penulis SET nama_penulis='" . $penulis . "'
										WHERE idpenulis = '$idpenulis'";
												
		$updateResult = mysqli_query($conn, $update);
		if(!$updateResult){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data penulis buku.';
		} else {
			header("Location: admin-penulis.php");
		}
	}
?>
	<div class="text-center">
		<H3 class="text-center" style="margin-top: 50px;">Data Penulis</H3>
		<span class="help-block" style="margin-top: 0px; margin-bottom: 0px;" >Detail informasi mengenai data penulis dari buku.</span>
		<a href="#" style="margin-top: 30px; margin-bottom: 50px;" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">Tambah Data Penulis</a>
	</div>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID Penulis</th>
			<th>Nama Penulis</th>
			<th>Total Buku</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['idpenulis']; ?></td>
			<td><?php echo $row['nama_penulis']; ?></td>
			<td><?php 
				$count = 0; 
				$query = "SELECT idpenulis FROM buku";
				$resultCompare = mysqli_query($conn, $query);
				if(!$resultCompare){
					echo "Gagal mengambil data idpenulis buku! " . mysqli_error($conn);
				} else {
					while ($penulisCompare = mysqli_fetch_assoc($resultCompare)){
						if($penulisCompare['idpenulis'] == $row['idpenulis']){
							$count++;
						}
					}
					echo $count;
				}
				
			?></td>
			<td><a href="#" 
					data-idpenulis="<?php echo $row['idpenulis']; ?>"
					data-penulis="<?php echo getNamaPenulis($conn, $row['idpenulis']); ?>"
					data-toggle="modal" data-target="#ubah-data">Ubah</a></td>
			<td><a href="#" data-href="admin-hapus.php?idpenulis=<?php echo $row['idpenulis']; ?>" data-toggle="modal" data-target="#konfirmasi-hapus">Hapus</a></td>
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
	<div class="modal fade" id="tambah-data" role="dialog" style="margin-top: 10%;">
		<div class="modal-dialog modal-md">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tambah Penulis</h4>
			</div>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama Penulis</th>
							<td><input type="text" class="col-md-9" placeholder="Nama Penulis"  name="penulis" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="tambahkan" value="Tambahkan Penulis" class="btn btn-primary">	
					<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div class="modal fade" id="ubah-data" role="dialog" style="margin-top: 10%;">
		<div class="modal-dialog modal-md">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Ubah Penulis</h4>
			</div>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama Penulis</th>
							<td><input type="text" class="col-md-9 data-penulis" placeholder="Nama Penulis"  name="penulis" required></td>
							<td><input type="hidden" class="col-md-9 data-idpenulis"  name="idpenulis" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="ubah" value="Ubah Penulis" class="btn btn-primary">	
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