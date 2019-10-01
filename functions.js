	function giris()
	{
			var logbutton=document.getElementById("logbutton");
			logbutton.disabled = true;
			logbutton.cursor="default";
			var kadi = document.getElementById("k_adi").value;
			var sifre= document.getElementById("sifre").value;
			var captcha= document.getElementById("captcha").value;
				if(kadi=="" || sifre=="" || captcha=="")
				{
					$("body").overhang({
					  type: "Warn",
					  message:"Bilgilerinizi eksiksiz olarak girmelisiniz" 
					});
					logbutton.disabled = false;
					logbutton.cursor="pointer";
				}
				else
				{
					$.ajax	({
							url:"kontrol.php", 
							type:'POST', // post metodu ile 
							data:{kadi:kadi,sifre:sifre,captcha:captcha}, // değişkenleri sayfaya gönderdik
							success:function(sonuc)
							{// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık	
								if(sonuc=="1")
								{
									$("body").overhang({
									  type: "Success",
									  message:"Giriş Başarılı" 
									});
									setTimeout(function(){ $('body').load('main.php'); }, 2500);
									
								}	
								else if(sonuc=="2")
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									logbutton.disabled = false;
									logbutton.cursor="pointer";
								}
								else if(sonuc=="0")
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									logbutton.disabled = false;
									logbutton.cursor="pointer";
								}
								else if(sonuc==3)
								{
									$("body").overhang({
										type: "Error",
										message:"Hatalı Captcha girdiniz!"
									});
									setTimeout(function(){ window.location = "index.php" }, 2200);
								}
								else
								{
									$("body").overhang({
									  type: "error",
									  message:"Hatalı Giriş" 
									});
									logbutton.disabled = false;
									logbutton.cursor="pointer";
								}
								
							}
						});
					

				}
	}
	function kayit()
	{
			var regbutton=document.getElementById("regbutton");
			regbutton.disabled = true;
			regbutton.cursor="default";

			var kadi = document.getElementById("k_adi").value;
			var captcha = document.getElementById("captcha").value;
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
					regbutton.disabled = false;
					regbutton.cursor="default";
				}
				else
				{
                    if (regex.test(email)==true)
                    {
                        $.ajax	({
                            url:"kayital.php",
                            type:'POST', // post metodu ile
                            data:{kadi:kadi,sifre:sifre,sifretekrar:sifretekrar,email:email,captcha:captcha}, // değişkenleri sayfaya gönderdik
                            success:function(sonuc)
                            {// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık
                                if(sonuc==0)//0 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Success",
                                        message:"Kayıt işlemi başarı ile gerçekleşti doğrulama sayfasına yönlendiriliyorsunuz..."
                                    });//giriş başarılı mesajı verip
                                    setTimeout(function(){ window.location = "uyelikonay.php"; }, 3000);//onay sayfasına yönlendiriyoruz
                                }
                                else if(sonuc==1)//1 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Error",
                                        message:"Seçtiğiniz kullanıcı adı zaten kullanımda başka birtane seçmelisiniz!"
                                    });//gerekli mesajı döndürüyoruz
									regbutton.disabled = false;
									regbutton.cursor="default";
                                }
                                else if(sonuc==2)//2 değeri döndüyse
                                {$("body").overhang({
                                    type: "Error",
                                    message:"Şifreler eşleşmiyor kontrol edip tekrar deneyin!"
                                });//gerekli mesajı döndürüyoruz
									regbutton.disabled = false;
									regbutton.cursor="default";
                                }
                                else if(sonuc==3)//3 değeri döndüyse
                                {
                                    $("body").overhang({
                                        type: "Error",
                                        message:"Bu email adresiyle kayıtlı bir kullanıcı zaten mevcut!"
                                    });//gerekli mesajı döndürüyoruz
									regbutton.disabled = false;
									regbutton.cursor="default";
                                }
                                else if(sonuc==4)
								{
									$("body").overhang({
										type: "Error",
										message:"Hatalı Captcha girdiniz!"
									});//gerekli mesajı döndürüyoruz
									setTimeout(function(){ window.location = "index.php"; }, 2500);
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
	function sifretalep()
	{
		var kadi = document.getElementById("k_adi").value;
		var captcha = document.getElementById("captcha").value;
		var islem="onay";
		if(kadi==""||captcha=="")
		{
			$("body").overhang({
				type: "Warn",
				message:"Bilgileri eksiksiz doldurmalısınız!"
			});
		}
		else
		{
			$.ajax	({
				url:"sifretalep.php",
				type:'POST', // post metodu ile
				data:{kadi:kadi,captcha:captcha,islem:islem}, // değişkenleri sayfaya gönderdik
				success:function(sonuc)
				{// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık
					console.log(sonuc);
					if(sonuc=="0")
					{
						$("body").overhang({
							type: "prompt",
							message: "Mail ile gelen doğrulama kodu:",
							callback: function (value)
							{
								islem="degistir";
								$.ajax	({
									url:"sifretalep.php",
									type:'POST', // post metodu ile
									data:{dogrulamakodu:value,islem:islem}, // değişkenleri sayfaya gönderdik
									success:function(sonuc1)
									{// gonderme işlemi başarılı ise sonuc değişkeni ile gelen değerleri aldık
										if(sonuc1=="0")
										{
											$("body").overhang({
												type: "Success",
												message:"Yeni şifreniz mail adresinize gönderilmiştir!"
											});
										}
										else if(sonuc1=="1")
										{
											$("body").overhang({
												type: "error",
												message:"Hatalı doğrulama kodu!"
											});
										}
										else if(sonuc1=="2")
										{
											$("body").overhang({
												type: "error",
												message:"Hatalı Captcha!"
											});
										}
										else
										{
											alert(sonuc1);
										}
									}});
							}
						});
					}
					else if(sonuc=="1")
					{
						$("body").overhang({
							type: "error",
							message:"Hatalı Captcha!"
						});
					}
					else if(sonuc=="2")
					{
						$("body").overhang({
							type: "error",
							message:"Böyle bir kullanıcı yok!"
						});
					}
					else
					{
						alert(sonuc);
					}
				}});
		}
	}