<?php

	session_start();
	require_once "./functions/database_functions.php";
	require_once "./functions/keranjang_functions.php";

	if(isset($_POST['isbn'])){
		$isbn = $_POST['isbn'];
	}

	if(isset($isbn)){
		
		if(!isset($_SESSION['keranjangku'])){
			$_SESSION['keranjangku'] = array();

			$_SESSION['jumlah_barang'] = 0;
			$_SESSION['total_harga'] = '0.00';
		}

		if(!isset($_SESSION['keranjangku'][$isbn])){
			$_SESSION['keranjangku'][$isbn] = 1;
		} elseif(isset($_POST['keranjangku'])){
			$_SESSION['keranjangku'][$isbn]++;
			unset($_POST);
		}
	}

	// jika button simpan perubahan di klik, ubah jumlah masing2 isbn
	if(isset($_POST['simpan_perubahan'])){
		foreach($_SESSION['keranjangku'] as $isbn =>$jumlah){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['keranjangku']["$isbn"]);
			} else {
				$_SESSION['keranjangku']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	require "header.php";

	if(isset($_SESSION['keranjangku']) && (array_count_values($_SESSION['keranjangku']))) {
		$_SESSION['jumlah_barang'] = jumlah_barang($_SESSION['keranjangku']);
		$_SESSION['total_harga'] = total_harga($_SESSION['keranjangku']);
?>
   	<form action="keranjang.php" method="post">
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
			?>
			<tr>
				<td><?php echo $buku['judul']; ?></td>
				<td><?php echo rupiahFormat($buku['harga']); ?></td>
				<td><input type="text" value="<?php echo $jumlah; ?>" size="2" name="<?php echo $isbn; ?>"></td>
				<td><?php echo rupiahFormat($jumlah * $buku['harga']); ?></td>
			</tr>
			<?php } ?>
		    <tr>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['jumlah_barang']; ?></th>
		    	<th><?php echo rupiahFormat($_SESSION['total_harga']);?></th>
		    </tr>
	   	</table>
	   	<input type="submit" class="btn btn-default" name="simpan_perubahan" value="Simpan Perubahan">
	</form>
	<br/><br/>
	<a href="index.php" class="btn btn-danger">Kembali</a>
	<a href="beli.php" class="btn btn-success">Proses Checkout</a> 
<?php
	} else {
		echo "<p class=\"text-warning\">Keranjang masih kosong! Pastikan kamu sudah menambahkan buku ke keranjang!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "footer.php";
?>