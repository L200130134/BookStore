<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "kp_bukulapak");
		if(!$conn){
			echo "Tidak dapat terkoneksi ke database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function rupiahFormat($angka){
        $jumlahdesimal = "0";  
        $pemisahdesimal = ",";  
        $pemisahribuan =".";  
		
		$result = "Rp. " . number_format($angka, $jumlahdesimal, $pemisahdesimal, $pemisahribuan);
		
		return $result;
	}
	
	function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function getBukuDenganIsbn($conn, $isbn){
		$query = "SELECT judul, harga FROM buku WHERE isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil data judul dan harga! " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getHargaBuku($isbn){
		$conn = db_connect();
		$query = "SELECT harga FROM buku WHERE isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil data harga buku! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['harga'];
	}

	function setPelanggan($nama, $alamat, $kota, $postal_kode, $provinsi){
		$conn = db_connect();
		$query = "INSERT INTO pelanggan VALUES 
			('', '" . $nama . "', '" . $alamat . "', '" . $kota . "', '" . $postal_kode . "', '" . $provinsi . "')";

		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal menambahkan pelanggan! " . mysqli_error($conn);
			exit;
		}
		$idpelanggan = mysqli_insert_id($conn);
		return $idpelanggan;
	}
	
	function setStatusOrder($no_tagihan, $id_pelanggan, $tgl_order, $tgl_kirim, $status){
		$conn = db_connect();
		$query = "INSERT INTO status_order VALUES ('" . $no_tagihan . "', 
											'" . $id_pelanggan . "',  
											'" . $tgl_order . "',  
											'" . $tgl_kirim . "',  
											'" . $status . "')";
				
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal menambahkan status order! " . mysqli_error($conn);
			exit;
		}
		$idorder = mysqli_insert_id($conn);
		return $idorder;
	}

	function getNamaPenulis($conn, $id){
		$query = "SELECT nama_penulis FROM penulis WHERE idpenulis = '$id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil data nama penulis! " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Ada kesalahan! Penulis buku tidak ada! Silahkan cek kembali.";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['nama_penulis'];
	}
	
	function getNamaPenerbit($conn, $id){
		$query = "SELECT nama_penerbit FROM penerbit WHERE idpenerbit = '$id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil data nama penerbit! " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Ada kesalahan! Penerbit buku tidak ada! Silahkan cek kembali.";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['nama_penerbit'];
	}

	function getSemuaBuku($conn){
		$query = "SELECT * from buku ORDER BY judul";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua data buku!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
	
	function getStatusOrder($conn){
		$query = "SELECT * from status_order ORDER BY no_tagihan";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua data order!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
	
	function getStatusOrderNoTagihan($conn, $id){
		$query = "SELECT * from status_order WHERE no_tagihan = '$id' ORDER BY no_tagihan";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua no tagihan!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}	
	
	function getPelanggan($conn, $id){
		$query = "SELECT * from pelanggan WHERE idpelanggan = '$id' ORDER BY idpelanggan";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil data pelanggan!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}	
	
	function getSemuaPelanggan($conn){
		$query = "SELECT * from pelanggan ORDER BY idpelanggan";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua data pelanggan!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}	
	
	function getSemuaPenerbit($conn){
		$query = "SELECT * from penerbit ORDER BY idpenerbit";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua data penerbit!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}	
	
	function getSemuaPenulis($conn){
		$query = "SELECT * from penulis ORDER BY idpenulis";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Gagal mengambil semua data penulis!  " . mysqli_error($conn);
			exit;
		}
		return $result;
	}	
	
	function hapusDataStatusOrder($conn, $notagihan){
		$query = "DELETE FROM status_order WHERE no_tagihan = '$notagihan'";
		return mysqli_query($conn, $query);
	}
?>