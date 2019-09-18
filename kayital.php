<?php
	if($_POST)
	{
	    require_once ("inc/functions.php");
	    require_once ("inc/db.php");
	    //Mail ile gönderilecek doğrulama kodunu oluşturuyoruz.
		$dogrulamakodu = uniqid("KGS_");
		///Kullanıcı verilerini alıyoruz
		$kadi = temizle($_POST["kadi"]);
		$email = temizle($_POST["email"]);
		$sifre = temizle($_POST["sifre"]);
		$sifretekrar = temizle($_POST["sifretekrar"]);
		if($sifre==$sifretekrar)//şifreler uyuşuyorsa
        {
            $sorgu = " SELECT * FROM uyeler WHERE kadi = '$kadi' ";
            $sorgu = mysqli_query($conn, $sorgu);

            if(mysqli_num_rows($sorgu) > 0)
            {
                echo'1';//1 nolu hatayı verdirdik yani kullanıcı adı kullanılamaz zaten mevcut
            }
            else//Kullanıcı adı kullanılabilir durumdaysa
            {
                $sorgu = " SELECT * FROM uyeler WHERE email = '$email' ";
                $sorgu = mysqli_query($conn, $sorgu);

                if(mysqli_num_rows($sorgu) > 0){
                    echo'3';//1 nolu hatayı verdirdik yani email kullanımda
                }
                else//Email kullanılabilir durumda ise
                {
                    $sifre = sifreleme2(sifreleme1($sifre));//şifreyi veritabınında saklamak için şifreleme fonksiyonundan geçiriyoruz.
                    $kayit = "INSERT INTO uyeler (kadi,email,sifre,dogrulamakodu) values ('$kadi','$email','$sifre','$dogrulamakodu')";
                    $kayit = mysqli_query($conn,$kayit);
                    if($kayit)//veritabanı kaydı başarılı ise
                    {
                        session_start();//bir oturum başlatıp kullanıcı girişini sağlıyoruz
                        $_SESSION["giris"]	=	1;
                        $_SESSION["kadi"]	=	$kadi;
                        $_SESSION["sifre"]	=	$sifre;
                        //mail fonksiyonu ile  doğrulama kodunu gönderecek kodu ekle
                        echo'0';// ve işlmelerin hatasız gerçekleştiğine dair 0 hata kodumuzu gönderiyoruz.
                    }
                    else//değilse
                    {
                        //log kaydı alıyoruz
                    }
                }
            }



        }
		else {echo'2';}//Şifreler eşleşmiyor hatası
	}