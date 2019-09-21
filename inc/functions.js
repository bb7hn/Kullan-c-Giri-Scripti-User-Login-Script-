	function giris()
	{
			document.getElementById("k_adi").disabled = true;
			document.getElementById("sifre").disabled = true;
			var kadi = document.getElementById("k_adi").value;
			var sifre= document.getElementById("sifre").value;
				if(kadi=="" || sifre=="")
				{
					$("body").overhang({
					  type: "Warn",
					  message:"Bilgilerinizi eksiksiz olarak girmelisiniz" 
					});
				}
				else
				{
					$.ajax	({
							url:"kontrol.php", 
							type:'POST', // post metodu ile 
							data:{kadi:kadi,sifre:sifre}, // değişkenleri sayfaya gönderdik
							success:function(sonuc)
							{// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık	
								if(sonuc=="1")
								{
									$("body").overhang({
									  type: "Success",
									  message:"Giriş Başarılı" 
									});
									setTimeout(function(){ $('body').load('main.php'); }, 3000);
									
								}	
								else if(sonuc=="2")
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									document.getElementById("k_adi").disabled = false;
									document.getElementById("sifre").disabled = false;
								}
								else if(sonuc=="0")
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									document.getElementById("k_adi").disabled = false;
									document.getElementById("sifre").disabled = false;
								}
								else
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									document.getElementById("k_adi").disabled = false;
									document.getElementById("sifre").disabled = false;

								}
								
							}
						});
					

				}
	}
	function kayit()
	{
			var kadi = document.getElementById("k_adi").value;
			var email = document.getElementById("email").value;
			var sifre= document.getElementById("sifre").value;
			var sifretekrar= document.getElementById("sifretekrar").value;
            var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+([.])+[a-zA-Z0-9.-]{2,4}$/;
                if(kadi=="" || sifre==""|| sifretekrar=="")
				{
					$("body").overhang({
					  type: "Warn",
					  message:"Bilgilerinizi eksiksiz olarak girmelisiniz" 
					});
				}
				else
				{
                    if (regex.test(email)==true)
                    {
                        $.ajax	({
                            url:"kayital.php",
                            type:'POST', // post metodu ile
                            data:{kadi:kadi,sifre:sifre,sifretekrar:sifretekrar,email:email}, // değişkenleri sayfaya gönderdik
                            success:function(sonuc)
                            {// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık
                                if(sonuc==0)//0 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Success",
                                        message:"Kayıt işlemi başarı ile gerçekleşti doğrulama sayfasına yönlendiriliyorsunuz..."
                                    });//giriş başarılı mesajı verip
                                    setTimeout(function(){ window.location = "uyelikonay.php"; }, 3000);//anasayfaya yönlendiriyoruz
                                }
                                else if(sonuc==1)//1 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Error",
                                        message:"Seçtiğiniz kullanıcı adı zaten kullanımda başka birtane seçmelisiniz!"
                                    });//gerekli mesajı döndürüyoruz
                                }
                                else if(sonuc==2)//2 değeri döndüyse
                                {$("body").overhang({
                                    type: "Error",
                                    message:"Şifreler eşleşmiyor kontrol edip tekrar deneyin!"
                                });//gerekli mesajı döndürüyoruz

                                }
                                else if(sonuc==3)//3 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Error",
                                        message:"Bu email adresiyle kayıtlı bir kullanıcı zaten mevcut!"
                                    });//gerekli mesajı döndürüyoruz
                                }
                                else//beklenen değerler dışında bir değer döndüyse
                                {
                                    $("body").overhang({
                                        type: "Error",
                                        message:"Sistemsel bir hata meydana geldi. Lütfen daha sonra tekrar kayıt olmayı deneyin!"
                                    });//gerekli mesajı döndürüyoruz
                                    alert(sonuc);
                                }

                            }
                        });
                    }
                    else
                    {
                        $("body").overhang({
                            type: "Warn",
                            message:"Geçerli bir mail adresi girmelisiniz!"
                        });
                    }

					

				}
	}