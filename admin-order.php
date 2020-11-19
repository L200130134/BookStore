<?php
	session_start();
	require_once "./functions/admin.php";
	
	$title = "admin";
	require_once "./header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getStatusOrder($conn);
	
	$errorResult="";
	
	if(isset($_POST['ubah'])){
		$notagihan = trim($_POST['notagihan']);
		$notagihan = mysqli_real_escape_string($conn, $notagihan);
				
		$tglkirim = trim($_POST['tglkirim']);
		$tglkirim = mysqli_real_escape_string($conn, $tglkirim);
		
		$mstatusorder = trim($_POST['mstatusorder']);
		$mstatusorder = mysqli_real_escape_string($conn, $mstatusorder);
		
		$update = "UPDATE status_order SET tgl_kirim='" . $tglkirim . "', 
										status='" . $mstatusorder . "'
										WHERE no_tagihan = '$notagihan'";
												
		$updateResult = mysqli_query($conn, $update);
		if(!$updateResult){
			$errorResult ='<strong>Kesalahan!</strong> Tidak bisa mengubah data status order.';
		} else {
			header("Location: admin-order.php");
		}
	}
?>
	<H3 class="text-center" style="margin-top: 50px;">Data Order</H3>
	<span class="help-block text-center" style="margin-top: 0px; margin-bottom: 50px;" >Detail informasi mengenai data status order dari pelanggan.</span>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>Nomor Tagihan</th>
			<th>ID Pelanggan</th>
			<th>Tanggal Order</th>
			<th>Tanggal Kirim</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['no_tagihan']; ?></td>
			<td><?php echo $row['id_pelanggan']; ?></td>
			<td><?php echo $row['tgl_order']; ?></td>
			<td><?php echo $row['tgl_kirim']; ?></td>
			<td><?php echo $row['status']; ?></td>
			<td><a href="#" 
					data-notagihan="<?php echo $row['no_tagihan']; ?>" 
					data-tglkirim="<?php echo $row['tgl_kirim']; ?>" 
					data-status="<?php echo $row['status']; ?>" 
					data-toggle="modal" data-target="#konfirmasi-order">Konfirmasi</a></td>
			<td><a href="#" data-href="admin-hapus.php?notagihan=<?php echo $row['no_tagihan']; ?>" data-toggle="modal" data-target="#konfirmasi-hapus">Hapus</a></td>
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
							<th>Tanggal Kirim</th>
							<td><input type="text" class="col-md-9 data-tglkirim" placeholder="Jam, Tanggal"  name="tglkirim" required></td>
						</tr>
						<tr>
							<th>Status Order</th>
							<td>
								<div class="btn-group">
									<input type="textbox" id="statusorder" name="mstatusorder" value="Belum Diproses" class="btn btn-default btn-xs data-status" readonly>	
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul id="statuslist" class="dropdown-menu">
										<li><a href="#">Belum Diproses</a></li>
										<li><a href="#">Order Diproses</a></li>
										<li><a href="#">Barang Dikirim</a></li>
										<li><a href="#">Barang Diterima</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="#">Selesai</a></li>
									</ul>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="ubah" value="Ubah Status" class="btn btn-primary">	
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