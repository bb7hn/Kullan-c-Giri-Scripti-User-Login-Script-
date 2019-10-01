<?php
	if($_POST)
	{
        session_start();
	    require_once ("inc/functions.php");
	    require_once ("inc/db.php");
	    //Mail ile gönderilecek doğrulama kodunu oluşturuyoruz.
		$dogrulamakodu = uniqid("KGS_");
		///Kullanıcı verilerini alıyoruz
		$kadi = temizle($_POST["kadi"]);
		$captcha = temizle($_POST["captcha"]);
		$email = temizle($_POST["email"]);
		$sifre = temizle($_POST["sifre"]);
		$sifretekrar = temizle($_POST["sifretekrar"]);


		if($_SESSION["kod"]==$captcha)
        {
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
                        echo'3';//3 nolu hatayı verdirdik yani email kullanımda
                    }
                    else//Email kullanılabilir durumda ise
                    {
                        $sifre = sifreleme2(sifreleme1($sifre));//şifreyi veritabınında saklamak için şifreleme fonksiyonundan geçiriyoruz.
                        $kayit = "INSERT INTO uyeler (kadi,email,sifre,dogrulamakodu) values ('$kadi','$email','$sifre','$dogrulamakodu')";
                        $kayit = mysqli_query($conn,$kayit);
                        if($kayit)//veritabanı kaydı başarılı ise
                        {
                            //bir oturum başlatıp kullanıcı girişini sağlıyoruz
                            $_SESSION["giris"]	=	1;
                            $_SESSION["kadi"]	=	$kadi;
                            $_SESSION["sifre"]	=	$sifre;

                            $siteadresi ="site.com";
                            $mesaj = $siteadresi." Üyeliğinizi onaylamak için doğrulama kodunuz :$dogrulamakodu";
                            $gonderenmail = "iletisim@site.com";
                            $epostakonu = $siteadresi." ÜYELİK ONAYI";

                            require("class.phpmailer.php");
							$mail = new PHPMailer();
							$mail->IsSMTP();
							$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
							$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
							$mail->SMTPSecure = ''; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
							$mail->Host = "mail.site.com"; // Mail sunucusunun adresi (IP de olabilir)
							$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
							$mail->IsHTML(true);
							$mail->SetLanguage("tr", "phpmailer/language");
							$mail->CharSet  ="utf-8";
							$mail->Username = "$gonderenmail"; // Gönderici adresiniz (e-posta adresiniz)
							$mail->Password = "sifre"; // Mail adresimizin sifresi
							$mail->SetFrom("$gonderenmail", "$epostakonu"); // Mail atıldığında gorulecek isim ve email
							$mail->AddAddress($email); // Mailin gönderileceği alıcı adres
							$mail->Subject = $epostakonu; // Email konu başlığı
							$mail->Body = "$mesaj";
							if(!$mail->Send())
							{
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
                                echo'5';

                            }
                            else
                            {
								// e-posta başarı ile gönderildi
                                $kayit=mysqli_query($conn,"Update uyeler set sifredogrulamakodu='$dogrulamakodu' where email='$email'");
                                if($kayit){echo'0';}
                                else{echo mysqli_error($conn);}
                                
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
		else
        {
            echo'4';//Yanlış Captcha hatası
        }



	}