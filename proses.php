<?php
	session_start();

	require_once "./functions/database_functions.php";
	
	require "./header.php";
	
	$conn = db_connect();
	
	$noisbn =  (array) json_decode(trim($_POST['noisbn']), true);
	$judulbuku =  (array) json_decode(trim($_POST['judul']), true);
	$hargabuku =  (array) json_decode(trim($_POST['harga']), true);
	$jumlahorder =  (array) json_decode(trim($_POST['jumlah']), true);
	
	$result="";
	
	$generateKodeKonfirmasi="";
	
	if(isset($_POST['order_detail'])){
		require 'PHPMailerAutoload.php';
		require 'credential.php';

		$queryPelanggan = "INSERT INTO pelanggan VALUES ('0', 
											'" . trim($_POST['nama']) . "', 
											'" . trim($_POST['email']) . "', 
											'" . trim($_POST['alamat']) . "', 
											'" . trim($_POST['kota']) . "', 
											'" . trim($_POST['postal_kode']) . "', 
											'" . trim($_POST['provinsi']) . "')";
		$resultPelanggan = mysqli_query($conn, $queryPelanggan);
			
		if(!$resultPelanggan){
			$result ='<p class="lead text-danger">Tidak bisa menambahkan data pelanggan ke database. '. mysqli_error($conn) .'</p>';
		} else {
				
			$idpelanggan = mysqli_insert_id($conn);
				
			for ($x = 0; $x < sizeof($noisbn); $x++) {	
					
				$queryOrder = "INSERT INTO order_buku VALUES ('0', 
													'" . $noisbn[$x] . "', 
													'" . $jumlahorder[$x] . "', 
													'" . $hargabuku[$x] . "', 
													'" . ($jumlahorder[$x] * $hargabuku[$x]) . "', 
													'" . $idpelanggan . "')";
											
				$resultOrder = mysqli_query($conn, $queryOrder);
				if(!$resultOrder){
					$result ='<p class="lead text-danger">Tidak bisa menambahkan data order ke database. '. mysqli_error($conn) .'</p>';
				} else {	
					
					date_default_timezone_set('Asia/Jakarta');
					$date = date('H:i, d-m-Y', time());
					$generateKodeKonfirmasi = generateRandomString(8);
					
					$queryStatusOrder = "INSERT INTO status_order VALUES ('" . '' . "', 
											'" . $idpelanggan . "',  
											'" . $date . "',  
											'" . '-' . "',  
											'" . 'Belum Diproses' . "',  
											'" . $generateKodeKonfirmasi . "')";
											
					$resultStatusOrder = mysqli_query($conn, $queryStatusOrder);
					if(!$resultStatusOrder){
						$result ='<p class="lead text-danger">Tidak bisa menambahkan data status order ke database. '. mysqli_error($conn) .'</p>';
					} else {
							
						$notagihan = mysqli_insert_id($conn);
						
						$mail = new PHPMailer;

						//$mail->SMTPDebug = 3;                               		// Enable verbose debug output

						$mail->isSMTP();                               		       // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  							// Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                             	  // Enable SMTP authentication
						$mail->Username = EMAIL;               				 	 // SMTP username
						$mail->Password = PASS;                 	       	   	// SMTP password
						$mail->SMTPSecure = 'tls';                  	          // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 587;                         	    	       // TCP port to connect to

						$mail->setFrom(EMAIL, 'BukuLapak');
						$mail->addAddress($_POST['email']);    						 // Add a recipient
						$mail->addReplyTo(EMAIL);
						
						//$mail->addAddress('ellen@example.com');   	           // Name is optional
						//$mail->addCC('cc@example.com');
						//$mail->addBCC('bcc@example.com');

						//$mail->addAttachment('/var/tmp/file.tar.gz');      	   // Add attachments
						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  	  // Optional name
						$mail->isHTML(true);                                 	 // Set email format to HTML

						$daftar_buku = "";
						$total_biaya = 0;
						
						for ($x = 0; $x < sizeof($noisbn); $x++) {
							$total_biaya += ($jumlahorder[$x] * $hargabuku[$x]);
							$daftar_buku .= $x+1 . ". " . $judulbuku[$x] . " (". $jumlahorder[$x] ." x ". rupiahFormat($hargabuku[$x]) .")<br><br>";
						}
						
						$data_diri = "Halo " . trim($_POST['nama']) . ",<br><br>
										Terima kasih Anda telah bertransaksi di BukuLapak<br><br>
										Berikut Data Transaksi Anda :<br>
										<hr>
										<b>DATA DIRI</b><br><br>
										Nama : " . trim($_POST['nama']) . "<br><br>
										Alamat : " . trim($_POST['alamat']) . "<br><br>
										Kota : " . trim($_POST['kota']) . "<br><br>
										Zip : " . trim($_POST['postal_kode']) . "<br><br>
										Provinsi : " . trim($_POST['provinsi']) . "<br><br>
										Email : " . trim($_POST['email']) . "<br>
										<hr>
										<b>DATA ORDER</b><br><br>
										Nomor Tagihan : " . $notagihan . "<br><br>
										Daftar Buku : <br><br>" . $daftar_buku . "
										Biaya Kirim : " . rupiahFormat(20000) . "<br><br>
										Total Biaya : " . rupiahFormat($total_biaya + 20000) . "<br>
										<hr>
										<b>SILAHKAN TRANSFER KE</b><br><br>
										Bank : ABC<br><br>
										No. Rekening : 0012345678<br><br>
										A/n Rekening : PT. Bukulapak<br><br>
										Sebesar : " . rupiahFormat($total_biaya + 20000) . "<br>
										<hr>
										Kode konfirmasi anda <b>" . $generateKodeKonfirmasi . "</b><br>
									";
						
						$mail->Subject = 'Detail Order dari ' . $_POST['nama'];
						$mail->Body    = $data_diri;
						$mail->AltBody = $data_diri;

						if(!$mail->send()) {
							//echo 'Mailer Error: ' . $mail->ErrorInfo;
							$result ='<p class="lead text-danger">Order kamu gagal diproses. Silahkan cek sambungan internet dan coba kembali.</p>';
						} else {	
							
							$result ='<p class="lead text-success">Order kamu berhasil diproses. Silahkan cek email kamu <b><u>'. $_POST['email'] .'</u></b> untuk informasi pembayaran. <br>
								Keranjang kamu sekarang kosong.</p>';

							session_unset();
						}
					}
						
					//$setStatusOrder(mt_rand(1000000000, 9999999999), $idpelanggan, 'saat ini', '-', 'belum diproses');
						
				}
			} 
		}
	}
?>

	<?php echo $result ?>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./footer.php";
?>