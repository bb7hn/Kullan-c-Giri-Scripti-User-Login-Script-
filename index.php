<?php
$site_adi="Kullanıcı Giriş Scripti";
?>
<html>
<?php require_once("inc/head.php"); ?>
<body>
	<?php 
	session_start();
	if(isset($_SESSION["giris"]))
	{
	?>
		<script>
		$('body').load('main.php');
		</script>
	<?php
	}
	else
	{
	?>
		<script>
		$('body').load('giris.php');
		</script>
	<?php
	}
	?>
</body>
</html>
