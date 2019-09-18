<?php
		date_default_timezone_set('Europe/Istanbul');
		///***/// Veritabanı Ayarları ///***///
		
		$sunucu = "localhost"; //sunucu
		$kullanici = "root"; //veritabani kullanici adi
		$parola = "12345678"; // veritabani sifresi
		$veritabani = "kgs";// veritabani ismi
        $conn = mysqli_connect($sunucu, $kullanici, $parola,$veritabani);
		mysqli_query($conn,"SET NAMES UTF8");
		require_once("functions.php");
?>