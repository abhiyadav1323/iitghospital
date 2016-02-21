<?php

session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");
$idofpatient = $_SESSION["patient_id"];
$query = "SELECT * from patients WHERE id='$idofpatient'";
$query_run = mysqli_query($conn,$query);
if(!$query_run)
    $err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
else
{
	$row = mysqli_fetch_assoc($query_run);
	$name = $row["name"];
    $email = $row["email"];
    $dob = $row["dob"];
    $gender= $row["gender"];
    $phone = $row["phone"];
    $roll = $row["roll"];

    echo $name . $email . $dob . $gender . $phone . $roll;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Doctor</title>
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
                <a class="navbar-brand" href="index.html" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>

<h3>
Patient Information: <br><br>
Name of Patient: <?php echo $name; ?><br>
Email: <?php echo $email; ?><br>
Date of Birth: <?php echo $dob; ?><br>
Gender: <?php echo $gender; ?><br>
Phone Number: <?php echo $phone ; ?><br>
Roll Number: <?php echo $roll; ?><br>
</h3>
</body>
</html>
