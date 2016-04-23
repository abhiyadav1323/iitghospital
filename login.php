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
include_once 'dbconnect.php';
if(isset($_POST['post'])&&$_POST['post']=="admin")
{
	if($_POST['admin_key']=="admin")
	{
		$_SESSION['id'] = "admin";
		header('location: admin.php');
	}
	else
		header('location: index.php?err=1');
}


if(isset($_POST['username'])&&isset($_POST['password']))
{
	$err="";
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = mysqli_real_escape_string($conn,$username);
	$password = md5(mysqli_real_escape_string($conn,$password));
	if(!empty($username)&&!empty($password))
	{
		//Check whether the given username and password exist in the directory
		if(isset($_POST['post'])&&$_POST['post']=="patient")
		{
			$query = "SELECT * FROM patients WHERE username='$username' AND password='$password'";
			$query_run=mysqli_query($conn,$query);
			if(!$query_run)
				header('location: index.php?err=1');
				//$err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
			else{

				$row_cnt = mysqli_num_rows($query_run);
			if($row_cnt==0)
				header('location: index.php?err=1');
				//$err = 'The username/password combination is invalid!';
			else
			{
				$row = mysqli_fetch_assoc($query_run);
				$_SESSION['id'] = $row["id"];
				header("Location: patient.php");
				
			}
			}
		}
		else
		{
			$query = "SELECT * FROM staff WHERE username='$username' AND Password='$password'";
			$query_run=mysqli_query($conn,$query);
			if(!$query_run)
				header('location: index.php?err=1');
				//$err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
			else{

				$row_cnt = mysqli_num_rows($query_run);
			if($row_cnt==0)
				header('location: index.php?err=1');
				//$err = 'The username/password combination is invalid!';
			else
			{
				$row = mysqli_fetch_assoc($query_run);
				if(strcmp($row["post"],$_POST['post']))
					header('location: index.php?err=1');
					//$err = "You are not ".$_POST['post']."<br>"."Sign in through login for ".$row['post'];
				else
				{
					$_SESSION['id'] = $row["id"];
					if ($row["post"] == "doctor")
						header("Location: staff_doctor.php");  //redirect to staff doctor page 
					else if ($row["post"] == "receptionist")
						header("Location: staff_recep.php");   // redirect to staff reception page
					else if ($row["post"] == "pharmacist")
						header("Location: staff_pharma.php");  // redirect to pharmecy 
					else if ($row["post"] == "office")
						header("Location: staff_office.php");  // redirect to staff office 
				}
			}
		}
	}
	}
	
}
?>