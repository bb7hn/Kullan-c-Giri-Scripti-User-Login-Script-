<?php 
	session_start();
	require_once ("inc/db.php");
	if(isset($_SESSION["giris"]))
	{
		require("inc/loggedhead.php");
		
	}
	else
	{
		echo'<meta http-equiv="refresh" content="1;URL=index.php">';
	}
	?>