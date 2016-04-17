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
						header("Location: staff_doctor.php");
					else if ($row["post"] == "receptionist")
						header("Location: staff_recep.php");
					else if ($row["post"] == "pharmacist")
						header("Location: staff_pharma.php");
					else if ($row["post"] == "office")
						header("Location: staff_office.php");
				}
			}
		}
	}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Script</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="AdminLTE/css/AdminLTE.min.css">
	<link rel="stylesheet" href="AdminLTE/css/skins/_all-skins.min.css">
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap/js/jquery-ui.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="AdminLTE/js/app.js"></script>
</head>

<body>
<div class="row">
	<nav class="navbar navbar-inverse navbar-fixed-top" style="height: 10%">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
			</div>
		</div>
	</nav>
</div>
<div class="row" style="padding-top: 4%">
</div>
<div class="row">
	<div class="col-sm-12">
		
	</div>
</div>
</body>
</html>

