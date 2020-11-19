<?php

	function total_harga($keranjang){
		$harga = 0.0;
		if(is_array($keranjang)){
		  	foreach($keranjang as $isbn => $jumlah){
		  		$hargabuku = getHargaBuku($isbn);
		  		if($hargabuku){
		  			$harga += $hargabuku * $jumlah;
		  		}
		  	}
		}
		return $harga;
	}

	function jumlah_barang($keranjang){
		$barang = 0;
		if(is_array($keranjang)){
			foreach($keranjang as $isbn => $jumlah){
				$barang += $jumlah;
			}
		}
		return $barang;
	}
?>