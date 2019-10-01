<div id="main">
	<h1>Üye Kaydı</h1>
	<hr/>
	<input type="text" id="k_adi" placeholder="Kullanıcı adı">
    <br>
	<input type="password" id="sifre" placeholder="Şifre:">
	<br>
	<input type="password" id="sifretekrar" placeholder="Şifre :">
    <br>
    <input type="email" id="email" placeholder="E-mail:">
	<br>
    <img id="imgcaptcha"  src="inc/captcha.php">
    <br>
    <input type="text" id="captcha" placeholder="Captcha:">
    <br>
	<i onclick="$('body').load('giris.php');" class="pointer blue fa fa-sign-in">Giriş</i>
	<i id="regbutton" onclick="kayit()" class="pointer green fa fa-user-plus">Kayıt ol</i>
	
		
	</div>