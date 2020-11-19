<?php
	session_start();
	
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	
	if(isset($_POST['cek_status'])){	
		$result = getStatusOrderNoTagihan($conn, trim($_POST['notagihan']));
	} else {		
		$result = getStatusOrder($conn);
	}
	
	if(isset($_POST['konfirmasi'])){
		$notagihan = trim($_POST['notagihan']);
		$notagihan = mysqli_real_escape_string($conn, $notagihan);
		
		$mstatusorder = trim($_POST['mstatusorder']);
		$mstatusorder = mysqli_real_escape_string($conn, $mstatusorder);
		
		$kodekonfirmasi = trim($_POST['kodekonfirmasi']);
		$kodekonfirmasi = mysqli_real_escape_string($conn, $kodekonfirmasi);
		
		$statusOrder = mysqli_fetch_assoc(getStatusOrderNoTagihan($conn, $notagihan));
		
		if ($statusOrder['kode_konfirmasi'] == $kodekonfirmasi) {
			$update = "UPDATE status_order SET status='" . $mstatusorder . "'
										WHERE no_tagihan = '$notagihan'";
												
			$updateResult = mysqli_query($conn, $update);
			if(!$updateResult){
				$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data status order.';
			} else {
				header("Location: cek-order.php");
			}
		} else {
			$errorResult ='<strong>Kesalahan!</strong> Kode konfirmasi tidak sesuai.';
		}
		
		
	}
?>

	<form class="form-horizontal text-center" style="margin-top: 100px; margin-bottom: 100px" method="post" action="cek-order.php">
		
		<p class="lead">Cek Status Order</p>
		<span class="help-block" style="margin-top: -10px;" >Silahkan masukkan nomor tagihan dibawah untuk melihat status order kamu.</span>
		<div class="form-group" style="margin-top: 50px">
			<label for="user" class="control-label col-md-4">No. Tagihan</label>
			<div class="col-md-5">
				<input type="text" name="notagihan" class="form-control" placeholder="Masukkan nomor tagihan" required>
			</div>
		</div>
		<input type="submit" name="cek_status" value="Cek Status" class="btn btn-primary">
	</form>

	
	<span class="help-block text-center" style="margin-top: 30px">
		<?php 
			$cekdata = mysqli_num_rows($result);			
			if ($cekdata == 0) {
				echo 'Data order belum ada.';
			} else { 	
				echo 'Daftar data order.';
		?>
	</span>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>No. Tagihan</th>
			<th>Order Oleh</th>
			<th>Tanggal Order</th>
			<th>Tanggal Kirim</th>
			<th>Status</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['no_tagihan']; ?></td>
			<td><?php 
				$pelanggan = getPelanggan($conn, trim($row['id_pelanggan']));
				$dataPelanggan = mysqli_fetch_assoc($pelanggan);
				echo $dataPelanggan['nama']; 
			?></td>
			<td><?php echo $row['tgl_order']; ?></td>
			<td><?php echo $row['tgl_kirim']; ?></td>
			<td><?php echo $row['status']; ?></td>
			<td>
				<?php if (trim($row['status']) != 'Selesai') {?>
			
				<a href="#" 
					data-notagihan="<?php echo $row['no_tagihan']; ?>" 
					data-status="<?php echo $row['status']; ?>" 
					data-toggle="modal" data-target="#konfirmasi-order">Konfirmasi</a>
				
				<?php }?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
	
	
	<!-- Modal -->
	<div class="modal fade" id="konfirmasi-order" role="dialog" style="margin-top: 10%;">
		<div class="modal-dialog modal-md">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Konfirmasi Order</h4>
			</div>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Nama Tagihan</th>
							<td><input type="text" class="col-md-9 data-notagihan" placeholder="Nama Tagihan"  name="notagihan" readonly required></td>
						</tr>
						<tr>
							<th>Status Order</th>
							<td>
								<div class="btn-group">
									<input type="textbox" id="statusorder" name="mstatusorder" value="Barang Diterima" class="btn btn-default btn-xs data-status" readonly>	
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul id="statuslist" class="dropdown-menu">
										<li><a href="#">Barang Diterima</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="#">Selesai</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr>
							<th>Kode Konfirmasi</th>
							<td><input type="text" class="col-md-9" placeholder="Kode Konfirmasi"  name="kodekonfirmasi" required></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="konfirmasi" value="Konfirmasi Order" class="btn btn-primary">	
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