<?php
	session_start();
	require_once "functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM penulis ORDER BY idpenulis";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Gagal mengambil data penulis! " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Penulis belum ada ! Atau ada kesalahan! Silahkan cek kembali.";
		exit;
	}

	require "header.php";
?>
	<p class="lead">Daftar Penulis</p>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT idpenulis FROM buku";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Gagal mengambil data idpenulis buku! " . mysqli_error($conn);
				exit;
			}
			while ($penulisCompare = mysqli_fetch_assoc($result2)){
				if($penulisCompare['idpenulis'] == $row['idpenulis']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="daftar-penulis.php?id=<?php echo $row['idpenulis']; ?>"><?php echo $row['nama_penulis']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="index.php">Lihat daftar semua buku</a>
		</li>
	</ul>
<?php
	mysqli_close($conn);
	require "footer.php";
?>