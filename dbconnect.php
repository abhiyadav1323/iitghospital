<?php
	$uname='root';
	$host='localhost';
	$pass='8787';
	$db='iitghospital';

	$conn=mysqli_connect($host,$uname,$pass,$db);

	if(!$conn)
	{
		echo "Unable to connect to database";
		exit;
	}
?>
