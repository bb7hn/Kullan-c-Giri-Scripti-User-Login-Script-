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

                        $gonderenisim = "KGS";
                        $siteadresi ="siteadresi.com";
                        $mesaj = "$siteadresi Üyeliğinizi onaylamak için doğrulama kodunuz :$dogrulamakodu";
                        $gonderenmail = "iletisim@batuhanozen.com";
                        $epostakonu = "$siteadresi ÜYELİK ONAYI";


                         require "class.phpmailer.php";
                         $mail = new PHPMailer();
                         $mail->IsSMTP();
                         $mail->From     = $gonderenmail;
                         $mail->Sender   = $gonderenmail;
                         $mail->FromName = "$siteadresi üyeliğiniz";  //göndericinin adı
                         $mail->Host     = "mail.site.com"; //smtp nin kullanacağı mail sunucusu
                         $mail->SMTPAuth = true;
                         $mail->Username = "mail@site.com";  //mail hesabı kullanıcı adı
                         $mail->Password = "sifre";  //mail hesabına ait şifre
                         $mail->Port = "587"; //smtp nin kullanacağı giden mail sunucu portu
                         $mail->CharSet = "utf-8";
                         $mail->WordWrap = 50;
                         $mail->IsHTML(true);
                         $mail->Subject  = $epostakonu;

                         $body = $mesaj;

                         $textBody = strip_tags($mesaj);
                         $mail->Body = $body;
                         $mail->AltBody = $textBody;
                         $mail->AddAddress($email);  //mailin gönderileceği mail adresi
                         //$mail->AddAddress("mail@mail.com");  //maillerin gideceği ek adresler (varsa)
                         return ($mail->Send())?true:false;
                         $mail->ClearAddresses();
                         $mail->ClearAttachments();
                        if($mail->Send()) {
                            // e-posta başarı ile gönderildi
                            echo'0';// ve işlmelerin hatasız gerçekleştiğine dair 0 hata kodumuzu gönderiyoruz
                        } else {
                            // bir sorun var, sorunu log dosyasına kaydedelim
                            if(file_exists("./inc/log.txt"))
                            {
                                $dosya = fopen('./inc/log.txt', 'a');
                                fwrite($dosya, '\n'+$mail->ErrorInfo);
                                fclose($dosya);
                            }
                            else
                            {
                                touch('./inc/log.txt');
                                $dosya = fopen('./inc/log.txt', 'a');
                                fwrite($dosya, '\n'+$mail->ErrorInfo);
                                fclose($dosya);
                            }
                        }
                        }

                    else//değilse
                    {
                        echo'veritabanı hatası';
                        //log kaydı alıyoruz
                        if(file_exists("./inc/log.txt"))
                        {
                            $dosya = fopen('./inc/log.txt', 'a');
                            fwrite($dosya, '\n'+mysqli_error($conn));
                            fclose($dosya);
                        }
                        else
                        {
                            touch('./inc/log.txt');
                            $dosya = fopen('./inc/log.txt', 'a');
                            fwrite($dosya, '\n'+mysqli_error($conn));
                            fclose($dosya);
                        }

                    }
                }
            }



        }
		else {echo'2';}//Şifreler eşleşmiyor hatası
	}