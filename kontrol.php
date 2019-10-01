<?php
	if($_POST)
	{
        session_start();
		require_once("inc/db.php");
		$kadi =temizle($_POST["kadi"]);
		$captcha =temizle($_POST["captcha"]);
		$sifre=temizle($_POST["sifre"]);
		$sifre= sifreleme2(sifreleme1($sifre));
        if ( filter_var($kadi, FILTER_VALIDATE_EMAIL) ){
            $baglanti = mysqli_query($conn,"Select * from uyeler where email='$kadi'");
            $baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
            $kadi=$baglanti["kadi"];
        } else {
            $baglanti = mysqli_query($conn,"Select * from uyeler where kadi='$kadi'");
            $baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
            $kadi=$baglanti["kadi"];
        }

        if($captcha==$_SESSION["kod"])
        {
		    if($baglanti["sifre"]!="" and $kadi!="")
			{
				if($sifre==$baglanti["sifre"])
				{
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
        else
        {
            echo'3';
        }

	}

?>