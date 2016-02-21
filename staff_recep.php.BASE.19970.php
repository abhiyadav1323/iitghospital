<?php
session_start();
include_once 'dbconnect.php';
    if(!isset($_SESSION['id']))
        header("Location: index.html");

    if(isset($_POST['register']))
    {
        $idofpatient = $_POST['roll'];
        $query = "SELECT 4 FROM patients WHERE roll = '$idofpatient'";
        $result = mysqli_query($conn,$query);
        $row_cnt = mysqli_num_rows($result);
        if($row_cnt==0)
        {
            ?>
            <script>alert('The id is invalid!');</script>
            <?php
        }
        else
        {
            $_SESSION['patient_id']=$idofpatient;
            header("Location: view_details.php");
        }
    }
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
                <a class="navbar-brand" href="staff_recep.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="row" style="padding-top: 10%">
</div>
<div class="row">
    <div class="col-sm-4 pull-right" style="padding-right: 5%">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="staff_recep.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="roll">Patient Id:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="roll" required id="roll">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <button type="submit" name="register" class="btn btn-lg btn-success">View Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-10 pull-right" style="padding-right: 5%">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <a href="patient_register.php"><button type="button" class="btn btn-block btn-danger btn-lg">Register</button></a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
