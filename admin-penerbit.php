<?php
	session_start();
	require_once "./functions/admin.php";
	
	$title = "admin";
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getSemuaPenerbit($conn);
	
	$errorResult="";
	
	if(isset($_POST['tambahkan'])){
		$penerbit = trim($_POST['penerbit']);
		$penerbit = mysqli_real_escape_string($conn, $penerbit);

		$insertPenerbit = "INSERT INTO penerbit VALUES ('', '". $penerbit ."')";
		$resultPenerbit = mysqli_query($conn, $insertPenerbit);
		if(!resultPenerbit){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa menambahkan data penerbit buku.';
		} else {
			header("Location: admin-penerbit.php");
		}
	} else if(isset($_POST['ubah'])){
		$idpenerbit = trim($_POST['idpenerbit']);
		$idpenerbit = mysqli_real_escape_string($conn, $idpenerbit);
				
		$penerbit = trim($_POST['penerbit']);
		$penerbit = mysqli_real_escape_string($conn, $penerbit);
		
		$update = "UPDATE penerbit SET nama_penerbit='" . $penerbit . "'
										WHERE idpenerbit = '$idpenerbit'";
												
		$updateResult = mysqli_query($conn, $update);
		if(!$updateResult){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data penerbit buku.';
		} else {
			header("Location: admin-penerbit.php");
		}
	}
?>
	<div class="text-center">
		<H3 class="text-center" style="margin-top: 50px;">Data Penerbit</H3>
		<span class="help-block" style="margin-top: 0px; margin-bottom: 0px;" >Detail informasi mengenai data penerbit dari buku.</span>
		<a href="#" style="margin-top: 30px; margin-bottom: 50px;" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">Tambah Data Penerbit</a>
	</div>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID Penerbit</th>
			<th>Nama Penerbit</th>
			<th>Total Buku</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['idpenerbit']; ?></td>
			<td><?php echo $row['nama_penerbit']; ?></td>
			<td><?php 
				$count = 0; 
				$query = "SELECT idpenerbit FROM buku";
				$resultCompare = mysqli_query($conn, $query);
				if(!$resultCompare){
					echo "Gagal mengambil data idpenerbit buku! " . mysqli_error($conn);
				} else {
					while ($penerbitCompare = mysqli_fetch_assoc($resultCompare)){
						if($penerbitCompare['idpenerbit'] == $row['idpenerbit']){
							$count++;
						}
					}
					echo $count;
				}
				
			?></td>
			<td><a href="#" 	
					data-idpenerbit="<?php echo $row['idpenerbit']; ?>"
					data-penerbit="<?php echo getNamaPenerbit($conn, $row['idpenerbit']); ?>"
					data-toggle="modal" data-target="#ubah-data">Ubah</a>
			</td>
			<td><a href="#" data-href="admin-hapus.php?idpenerbit=<?php echo $row['idpenerbit']; ?>" data-toggle="modal" data-target="#konfirmasi-hapus">Hapus</a></td>
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
			  <h4 class="modal-title">Tambah Penerbit</h4>
			</div>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama Penerbit</th>
							<td><input type="text" class="col-md-9" placeholder="Nama Penerbit"  name="penerbit" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="tambahkan" value="Tambahkan Penerbit" class="btn btn-primary">	
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
			  <h4 class="modal-title">Ubah Penerbit</h4>
			</div>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama Penerbit</th>
							<td><input type="text" class="col-md-9 data-penerbit" placeholder="Nama Penerbit"  name="penerbit" required></td>
							<td><input type="hidden" class="col-md-9 data-idpenerbit"  name="idpenerbit" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="ubah" value="Ubah Penerbit" class="btn btn-primary">	
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