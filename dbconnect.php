<!--
****************************************************************************************************
									Web App for IITG Hospital
									-------------------------
			The software intends at automating the working of the IITG hospital to ensure 
			that the patient can be given a great experience while visiting the hospital 
			and is given medicines which correspond to the diagnosis.
			Copyright © 2016, team1cs243.
****************************************************************************************************
-->

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
