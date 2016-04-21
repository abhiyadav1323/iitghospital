<?php
	$uname='root';
	$host='localhost';
	$pass='$unny01'; //password
	$db='iitghospital'; //db name

	$conn=mysqli_connect($host,$uname,$pass,$db);

	if(!$conn)
	{
		echo "Unable to connect to database";
		exit;
	}
?>
