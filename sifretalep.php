<?php
if($_POST)
{

    session_start();
    require_once ("inc/functions.php");
    require_once ("inc/db.php");
    $islem=temizle($_POST["islem"]);
    ///Kullanıcı verilerini alıyoruz
    if($islem=="onay")
    {
        $kadi = temizle($_POST["kadi"]);
        $captcha = temizle($_POST["captcha"]);
        if($_SESSION["kod"]==$captcha)
        {
            if ( filter_var($kadi, FILTER_VALIDATE_EMAIL) )
            {
                $baglanti = mysqli_query($conn,"Select * from uyeler where email='$kadi'");
                $baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
                $email=$baglanti["email"];
            }
            else
            {
                $baglanti = mysqli_query($conn,"Select * from uyeler where kadi='$kadi'");
                $baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
                $email=$baglanti["email"];
            }
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $dogrulamakodu = uniqid("KGS_PASS_");
                $sifre=sifreolustur();
                $siteadresi ="site.com";
                $mesaj = $siteadresi." şifre değişikliğini onaylamak için doğrulama kodunuz :".$dogrulamakodu;
                $gonderenmail = "iletisim@batuhanozen.com";
                $epostakonu = $siteadresi." YENİ ŞİFRE TALEBİ";
				
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
						  echo'5';
						  
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
					else 
					{
					  $kayit=mysqli_query($conn,"Update uyeler set sifredogrulamakodu='$dogrulamakodu' where email='$email'");
						if($kayit)
						{echo'0';}
						else
						{echo'3';}
					}
            }
            else
            {
                echo '2';// Kullanıcı mevcut değil hatası
            }
        }
        else
        {
            echo'1';//captcha yanlış  hata kodu
        }
    }
    if($islem=="degistir")
    {
        $dogrulamakodu=temizle($_POST["dogrulamakodu"]);
        $baglanti = mysqli_query($conn,"Select * from uyeler where sifredogrulamakodu='$dogrulamakodu'");
        $baglanti = mysqli_fetch_array($baglanti,MYSQLI_ASSOC);
        $kadi=$baglanti["kadi"];
        $email=$baglanti["email"];
        if($kadi!="")
        {
            $sifre=sifreolustur();
            $siteadresi ="site.com";
            $mesaj = $siteadresi." Yeni şifreniz: $sifre ";
            $gonderenmail = "iletisim@site.com";
            $epostakonu = $siteadresi." Yeni Şifre Tanımlaması";

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
					$mail->SetFrom("$gonderenmail", "$siteadresi"); // Mail atıldığında gorulecek isim ve email
					$mail->AddAddress($email); // Mailin gönderileceği alıcı adres
					$mail->Subject = "deneme"; // Email konu başlığı
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
						$sifre=sifreleme2(sifreleme1($sifre));
						$kayit=mysqli_query($conn,"Update uyeler set sifre='$sifre' where kadi='$kadi'");
						if($kayit)
						{echo'0';}
						else
						{echo'2';}
						echo mysqli_error($conn);
					}
        }
        else
        {
            echo'1';//Hatalı doğrulama kodu girildi hatası
        }
    }
}