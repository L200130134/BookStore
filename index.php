<?php
  session_start();
  $count = 0;
  
  // konek database
  require_once "functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT isbn, gambar_buku FROM buku";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Gagal mengambil data isbn, gambar buku! " . mysqli_error($conn);
    exit;
  }

  require_once "header.php";
?>
  <p class="lead text-muted text-center">Daftar Katalog semua Buku</p>
  <p class="text-muted text-center"><?php if (mysqli_num_rows($result) == 0) echo "Masih belum ada daftar buku." ?></p>
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row text-center">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3 booklist">
            <a href="details-buku.php?isbn=<?php echo $query_row['isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="bootstrap/img/<?php echo $query_row['gambar_buku']; ?>">
            </a>
          </div>
        <?php 
			$count++;
			if($count >= 4){
				$count = 0;
				break;
            }
        } ?> 
      </div>
	<?php }
		if(isset($conn)) { mysqli_close($conn); }
		require_once "footer.php";
	?>