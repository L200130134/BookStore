<?php
	session_start();
	require_once "functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM penerbit ORDER BY idpenerbit";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Gagal mengambil data penerbit! " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Penerbit belum ada ! Atau ada kesalahan! Silahkan cek kembali.";
		exit;
	}

	require "header.php";
?>
	<p class="lead">Daftar Penerbit</p>
	<ul>
	<?php 
	
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT idpenerbit FROM buku";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Gagal mengambil data idpenerbit buku! " . mysqli_error($conn);
				exit;
			}
			while ($penerbitCompare = mysqli_fetch_assoc($result2)){
				if($penerbitCompare['idpenerbit'] == $row['idpenerbit']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="daftar-penerbit.php?id=<?php echo $row['idpenerbit']; ?>"><?php echo $row['nama_penerbit']; ?></a>
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