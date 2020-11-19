<?php
	session_start();
	
	$no_isbn = array();
	$judul_buku = array();
	$harga_buku = array();
	$jumlah_order = array();
	
	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: keranjang.php");
	} else {
		unset($_SESSION['err']);
	}

	require_once "./functions/database_functions.php";
	
	require "./header.php";
	
	if(isset($_SESSION['keranjangku']) && (array_count_values($_SESSION['keranjangku']))){
?>
	<table class="table">
		<tr>
	   		<th>Barang</th>
	   		<th>Harga</th>
	  		<th>Jumlah</th>
	   		<th>Total</th>
	    </tr>
	    	<?php
			    foreach($_SESSION['keranjangku'] as $isbn => $jumlah){
					$conn = db_connect();
					$buku = mysqli_fetch_assoc(getBukuDenganIsbn($conn, $isbn));
					
					$no_isbn[] = $isbn;
					$judul_buku[] = $buku['judul'];
					$harga_buku[] = $buku['harga'];
					$jumlah_order[] = $jumlah;
					
					//echo sizeof($judul_buku);
					//echo $judul_buku[1];
			?>
		<tr>
			<td><?php echo $buku['judul'];?></td> <!-- judul -->
			<td><?php echo rupiahFormat($buku['harga']); ?></td> <!-- harga -->
			<td><?php echo $jumlah; ?></td> <!-- jumlah -->
			<td><?php echo rupiahFormat($jumlah * $buku['harga']); ?></td> <!-- total -->
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['jumlah_barang']; ?></th>
			<th><?php echo rupiahFormat($_SESSION['total_harga']); ?></th>
		</tr>
		<tr>
			<td>Biaya Kirim</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Rp. 20.000</td>
		</tr>
		<tr>
			<th>Total Pembayaran</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo rupiahFormat($_SESSION['total_harga'] + 20000); ?></th>
		</tr>
	</table>
	<form method="post" action="proses.php" class="form-horizontal" autocomplete="on">
		<?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
		<?php } ?>
		
        <div class="form-group">
			<p class="lead col-lg-8">Hampir selesai, pastikan data di isi dengan benar:</p>
        </div>
		<div class="form-group">
			<label for="nama" class="control-label col-md-2">Nama</label>
			<div class="col-md-8">
				<input type="text" name="nama" class="col-md-5" required>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="control-label col-md-2">Email</label>
			<div class="col-md-8">
				<input type="email" name="email" class="col-md-5" required>
			</div>
		</div>
		<div class="form-group">
			<label for="alamat" class="control-label col-md-2">Alamat</label>
			<div class="col-md-8">
				<textarea rows="5" id="textArea" name="alamat" class="col-md-5" required></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="kota" class="control-label col-md-2">Kota</label>
			<div class="col-md-8">
				<input type="text" name="kota" class="col-md-5" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="postal_kode" class="control-label col-md-2">Postal Kode</label>
			<div class="col-md-8">
				<input type="text" name="postal_kode" class="col-md-5" required>
			</div>
		</div>
		<div class="form-group">
			<label for="provinsi" class="control-label col-md-2">Provinsi</label>
			<div class="col-md-8">
				<input type="text" name="provinsi" class="col-md-5" required>
				<textarea name="noisbn" style="display:none;"><?php echo json_encode($no_isbn); ?></textarea>
				<textarea name="judul" style="display:none;"><?php echo json_encode($judul_buku); ?></textarea>
				<textarea name="harga" style="display:none;"><?php echo json_encode($harga_buku); ?></textarea>
				<textarea name="jumlah" style="display:none;"><?php echo json_encode($jumlah_order); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="control-label col-md-2"></label>
			<div class="col-md-8">
				<a href="keranjang.php" class="btn btn-danger">Kembali</a>
				<input type="submit" name="order_detail" value="Selesai dan Proses" class="btn btn-success" required>
			</div>
		</div>
		
    </form>
<?php
	} else {
		echo "<p class=\"text-warning\">Keranjang masih kosong! Pastikan kamu sudah menambahkan buku ke keranjang!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "footer.php";
?>