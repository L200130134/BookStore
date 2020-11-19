<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = "";
	
	if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
		header("Location: admin-buku.php");
	}
	
	if(isset($_POST['masuk'])){
		$user = trim($_POST['user']);
		$password = trim($_POST['password']);

		// handle form valid atau tidak
		if($user == "" || $password == ""){
			$result ='<div class="alert alert-danger alert-dismissable"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Kesalahan!</strong> Username atau password tidak boleh kosong. 
					</div>';
		}

		$user = mysqli_real_escape_string($conn, $user);
		$password = mysqli_real_escape_string($conn, $password);

		// get from database
		$query = "SELECT user, password from admin";
		$result = mysqli_query($conn, $query);
		
		if(!$result){
			$result ='<div class="alert alert-danger alert-dismissable"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Database admin kosong!</strong> '. mysqli_error($conn) .'.
					</div>';
		}
		
		$row = mysqli_fetch_assoc($result);

		if($user != $row['user'] || $password != $row['password']){
			$result ='<div class="alert alert-danger alert-dismissable col-md-6 col-md-offset-3 text-center"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Kesalahan!</strong> Username atau password salah. 
					</div>';

			$_SESSION['admin'] = false;
		} else {
			$_SESSION['admin'] = true;
			header("Location: admin-buku.php");
		}

	}
	
	require_once "header.php";
	
?>

	<?php echo $result; ?> 
	
	<form class="form-horizontal text-center" style="margin-top: 120px; margin-bottom: 220px" method="post" action="admin.php">
		
		<p class="lead">Administrator Login</p>
		<div class="form-group" style="margin-top: 50px">
			<label for="user" class="control-label col-md-4">Username</label>
			<div class="col-md-4">
				<input type="text" name="user" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="control-label col-md-4">Password</label>
			<div class="col-md-4">
				<input type="password" name="password" class="form-control" required>
			</div>
		</div>
		<input type="submit" name="masuk" value="Masuk" class="btn btn-primary">
	</form>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "footer.php";
?>