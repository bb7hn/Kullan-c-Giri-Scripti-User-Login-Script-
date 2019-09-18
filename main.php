<?php 
	session_start();
	if(isset($_SESSION["giris"]))
	{
		echo'Başarılı';
		
	}
	else
	{
		echo'<meta http-equiv="refresh" content="1;URL=index.php">';
	}
	?>