<html>
	<?php
	require_once("inc/head.php")
	?>
	<body>
	<?
	session_start();
	session_destroy();
	echo str_repeat("<br>", 8)."<center><h1 style=\"color:lime;\">Çıkış Başarılı</h1></center>";
	header("Refresh: 2; url= index.php");
	return;
	mysql_close();
?>
</body>