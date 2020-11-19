<?php
	session_start();
	$isbn = $_GET['isbn'];
	
	// konek database
	require_once "functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM buku WHERE isbn = '$isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Tidak dapat mengambil data buku! " . mysqli_error($conn);
		exit;
	}

	$row = mysqli_fetch_assoc($result);
	if(!$row){
		echo "Saat ini buku tidak tersedia! Tunggu sampai buku yang baru terbit.";
		exit;
	}

	$namaPenulis = getNamaPenulis($conn, $row['idpenulis']);
	$namaPenerbit = getNamaPenerbit($conn, $row['idpenerbit']);
  
	require "header.php";
?>
      <!-- Example row of columns -->
      <p class="lead" style="margin: 25px 0"><a href="index.php">Buku</a> > <?php echo $row['judul']; ?></p>
      <div class="row bodyrow">
        <div class="col-md-3 detailbuku">
          <img class="img-responsive img-thumbnail" src="bootstrap/img/<?php echo $row['gambar_buku']; ?>">
        </div>
        <div class="col-md-6 deskripsibuku">
          <h4>Deskripsi Buku</h4>
          <p><?php echo $row['deskripsi_buku']; ?></p>
          <h4>Details Buku</h4>
          <table class="table">
          	<?php foreach($row as $title => $value){
				if($title == "deskripsi_buku" || $title == "gambar_buku"){
					continue;
				}
				switch($title){
					case "isbn":
						$title = "ISBN";
						break;
					case "judul":
						$title = "Judul";
						break;
					case "idpenulis":
						$title = "Penulis";
						break;
					case "idpenerbit":
						$title = "Penerbit";
						break;
					case "tgl_terbit":
						$title = "Tanggal Terbit";
						break;
					case "harga":
						$title = "Harga";
						break;
				}
            ?>
            <tr>
              <td><?php echo $title; ?></td>
              <td><?php 
			  					 
					if ($title == "Penulis") {
						echo '<a href="daftar-penulis.php?id=' . $row['idpenulis'] .'"> ' . $namaPenulis .' </a>';
					} else if ($title == "Penerbit") {
						echo '<a href="daftar-penerbit.php?id=' . $row['idpenerbit'] .'"> ' . $namaPenerbit .' </a>';
					} else if ($title == "Harga") {
						echo rupiahFormat($row['harga']);
					} else {
						echo $value;
					}						
					?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>
          <form method="post" action="keranjang.php">
            <input type="hidden" name="isbn" value="<?php echo $isbn;?>">
            <input type="submit" value="Beli / Tambah ke keranjang" name="cart" class="btn btn-primary">
          </form>
       	</div>
      </div>
<?php
  require "footer.php";
?>