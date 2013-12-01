<?php

	ob_start();

	session_start();

	if(isset($_SESSION['access_level']))
	{
		unset($_SESSION['access_level']);
	}

	header("Location: index.php");

	ob_end_flush();

?>
