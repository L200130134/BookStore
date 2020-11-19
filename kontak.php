<?php
	require_once "header.php";
	
	$result="";
	
	if(isset($_POST['kirim_email'])){
		require 'PHPMailerAutoload.php';
		require 'credential.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                    		           // Enable verbose debug output
	
		$mail->isSMTP();                                	      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                        	       // Enable SMTP authentication
		$mail->Username = EMAIL;                 				// SMTP username
		$mail->Password = PASS;                         	 	 // SMTP password
		$mail->SMTPSecure = 'tls';                  	          // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                         		           // TCP port to connect to

		$mail->setFrom(EMAIL, 'Kelompok KP');
		$mail->addAddress($_POST['email']);     					// Add a recipient
		$mail->addReplyTo(EMAIL);
		
		//$mail->addAddress('ellen@example.com');           	    // Name is optional
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');      	   // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  	  // Optional name
		$mail->isHTML(true);                                 	 // Set email format to HTML

		$mail->Subject = 'Kontak dari ' . $_POST['nama'];
		$mail->Body    = $_POST['pesan'];
		$mail->AltBody = $_POST['pesan'];

		if(!$mail->send()) {
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
			$result ='<div class="alert alert-danger alert-dismissable"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Gagal!</strong> Pesan tidak berhasil terkirim. 
					</div>';
		} else {
			
			$result ='<div class="alert alert-success alert-dismissable"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Sukses!</strong> Pesan berhasil terkirim. 
					</div>';
		}
  
  }
  
?>
    <div class="row">
        <div class="col-md-3"></div>
		<div class="col-md-6 text-center">
		
			<?php echo $result; ?> 

			<form method="post" action="kontak.php" enctype="multipart/form-data" class="form-horizontal">
			  	<fieldset>
				    <legend>Kontak</legend>
				    <p class="lead">Lengkapi form dibawah untuk kontak email kami.</p>
				    <div class="form-group">
				      	<label for="inputName" class="col-lg-2 control-label">Nama</label>
				      	<div class="col-lg-10">
				        	<input type="text" class="form-control" name="nama" id="inputName" placeholder="Masukkan nama" required>
				      	</div>
				    </div>
				    <div class="form-group">
				      	<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				      	<div class="col-lg-10">
				        	<input type="email" class="form-control" name="email" id="inputEmail" placeholder="Masukkan email" required>
				      	</div>
				    </div>
				    <div class="form-group">
				      	<label for="textArea" class="col-lg-2 control-label">Pesan</label>
				      	<div class="col-lg-10">
				        	<textarea class="form-control" name="pesan" rows="5" id="textArea" required></textarea>
				        	<span class="help-block">Informasi pribadi anda tidak akan di share ke publik.</span>
				      	</div>
				    </div>
				    <div class="form-group">
				      	<div class="col-lg-10 col-lg-offset-2">
							<a href="index.php" class="btn btn-default">Kembali</a>
				        	<button type="submit" name="kirim_email" class="btn btn-primary">Kirim Sekarang</button>
				      	</div>
				    </div>
			  	</fieldset>
			</form>
		</div>
		<div class="col-md-3"></div>
    </div>
<?php
  require_once "footer.php";
?>