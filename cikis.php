<html>
	<?php
	require_once("inc/head.php")
	?>
	<body>
	<?php
	session_start();
	session_destroy();
	echo str_repeat("<br>", 8)."<center><h1 style=\"color:lime;\">Çıkış Başarılı</h1></center>";
    echo'<meta http-equiv="refresh" content="1;URL=index.php">';
	return;
	mysqli_close();
?>
</body>