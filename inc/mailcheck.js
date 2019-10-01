function  check()
{
    var sayac = 1;
    var captcha         = document.getElementById("captcha").value ;
    var dogrulamakodu   = document.getElementById("dogrulamakodu").value ;
    if(captcha ==="" || dogrulamakodu==="")
    {
        $("body").overhang({
            type: "Warn",
            message:"Tüm alanları doldurun"
        });
    }
    else
    {
        $.ajax	({
            url:"mailonay.php",
            type:'POST', // post metodu ile
            data:{captcha:captcha,dogrulamakodu:dogrulamakodu}, // değişkenleri sayfaya gönderdik
            success:function(sonuc)
            {
                if(sonuc=="0")
                {
                    $("body").overhang({
                        type: "Success",
                        message:"Doğrulama Başarılı"
                    });
                    setTimeout(function(){ $('body').load('index.php'); }, 3000);
                }
                else if(sonuc=="1")
                {
                    $("body").overhang({
                        type: "Error",
                        message:"Hatalı doğrulama kodu girdiniz. Kontrol edip tekrar deneyin!"
                    });
                    setTimeout(function(){ window.location = "uyelikonay.php" }, 2200);

                }
                else if(sonuc=="2")
                {
                    $("body").overhang({
                        type: "Error",
                        message:"Hatalı Captcha girdiniz. Kontrol edip tekrar deneyin!"
                    });
                    setTimeout(function(){ window.location = "uyelikonay.php" }, 2200);
                }
                else
                {
                    $("body").overhang({
                        type: "Error",
                        message:"Sistemsel bir hata meydana geldi daha sonra tekrar deneyin!"
                    });
                }


            }
        });
    }
}
