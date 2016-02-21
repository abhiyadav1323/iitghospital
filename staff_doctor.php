<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

//Assuming that the id is provided to the doctor by the queue as $temp

$temp = 0;
$query = "SELECT * from patients WHERE id='$temp'";
$query_run = mysqli_query($conn,$query);
if(!$query_run)
    $err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
else
{
    $row = mysqli_fetch_assoc($query_run);
    $name = $row["name"];
    $_SESSION["patient_id"]=$temp;
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

<div class="row" style="padding-top: 4%">
</div>  
<h3>
    <?php echo "Hello Doctor. Your id is ".$_SESSION['id']; ?>
    <br> <br>
    <?php echo "Hello doctor. Your current patient is:" . $name ;?>
</h3>
<div>
    <div class="col-sm-4">
        <a href="view_details.php"><button type="button" class="btn btn-block btn-success btn-lg">Do Diagnosis!</button></a>
    </div>
</div>
 
</body>
</html>
