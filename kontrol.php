<?php
	if($_POST)
	{
		require_once("inc/db.php");
		$kadi =temizle($_POST["kadi"]);
		$sifre=temizle($_POST["sifre"]);
		$sifre= sifreleme2(sifreleme1($sifre));
		$baglanti = mysqli_query($conn,"Select * from uyeler where kadi='$kadi'");
		$baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
			if($baglanti["sifre"]!="" and $kadi!="")
			{
				if($sifre==$baglanti["sifre"])	
				{
					session_start();
					$_SESSION["giris"]	=	1;
					$_SESSION["kadi"]	=	$kadi;
					$_SESSION["sifre"]	=	$sifre;
					echo'1';
				}
				else
				{
					echo'2';
				}
					
			}
			else
			{
				echo'0';
			}
	}
	
?>