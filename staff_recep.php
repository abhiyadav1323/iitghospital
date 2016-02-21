<?php
session_start();

if(!isset($_SESSION['id']))
    header("Location: index.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Receptionist</title>
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
    <?php echo "Hello Receptionist. Your id is ".$_SESSION['id']; ?>
</h3>

</body>
</html>
