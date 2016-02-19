<?php
	session_start();
	if(!isset($_SESSION['id']))
	{
		header("Location: temp.html");
	}
	else if(isset($_SESSION['id'])!="")
	{
		header("Location: staff_home.php");
	}

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['id']);
		header("Location: temp.html");
	}
?>

