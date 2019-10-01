<div id="main">
	<h1>Üye Girişi</h1>
	<hr/>
	<input type="text" id="k_adi" placeholder="Kullanıcı adı / E-mail:">
		<br>
	<input type="password" id="sifre" placeholder="Şifre:">
		<br>
    <img id="imgcaptcha"  src="inc/captcha.php">
		<br>
    <input type="text" id="captcha" placeholder="Captcha:">
		<br>
	<i onclick="$('body').load('kayit.php');" class="pointer blue fa fa-user-plus">Kayıt ol</i>
	<i id="logbutton" onclick="giris()" class="pointer green fa fa-sign-in">Giriş</i>
    <br>
    <i onclick="$('body').load('sifremiunuttum.php');" class="pointer red fa fa-question">Şifremi Unuttum</i>
	
	</div>