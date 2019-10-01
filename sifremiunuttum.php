<div id="main">
    <h1>Şifre Yenileme Talebi</h1>
    <hr/>
    <input type="text" id="k_adi" placeholder="Kullanıcı adı / E-mail:">
    <br>
    <img id="imgcaptcha"  src="inc/captcha.php">
    <br>
    <input type="text" id="captcha" placeholder="Captcha:">
    <br>
    <i onclick="$('body').load('giris.php');" class="pointer blue fa fa-user-plus">Giriş</i>
    <i id="forgetbutton" onclick="sifretalep()" class="pointer green fa fa-sign-in">Yeni Şifre Talep et</i>
</div>