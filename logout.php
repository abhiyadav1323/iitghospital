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
	session_start();
	if(!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}

	if(isset($_GET['logout']))
	{
		session_destroy(); 
		unset($_SESSION['id']);
		header("Location: index.php");
	}
?>

