<?php
session_start();
include_once 'dbconnect.php';
    if(!isset($_SESSION['id']))
        header("Location: index.html");

    if(isset($_POST['register']))
    {
        $idofpatient = $_POST['roll'];
        $idofdoctor = $_POST['rolld'];
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
            $sDate = date("Y-m-d H:i:s");
            $query = "INSERT INTO queue (pid, time, did) VALUES ('$idofpatient', '$sDate', '$idofdoctor')";
            $query_run = mysqli_query($conn,$query);
            header("Location: patient_home.php");
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
<div class="row" style="padding-top: 4%">
</div>
<h3>
    <?php echo "Hello Receptionist. Your id is ".$_SESSION['id']; ?>
</h3>
<br>
<br>
<div class="row">
    <div class="col-sm-4">
        <form class="form-horizontal" role="form" method="post" action="staff_recep.php">
            <div class="form-group">
               <h3><label class="control-label col-sm-3" for="roll">Patient Id:</label></h3>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="roll" required id="roll">
                </div>
            </div>
            <div class="form-group">
               <h3><label class="control-label col-sm-3" for="rolld">Id of Preferred Doctor:</label></h3>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="rolld" required id="roll">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-7">
                    <button type="submit" name="register" class="btn btn-lg btn-info">Appointment</button>
                </div>  
            </div>
            </form>    
    </div>
    <div class="col-sm-2">

    </div>
    <div class="col-sm-4">
        <a href="patient_register.php"><button type="button" class="btn btn-block btn-success btn-lg">Register Here</button></a>
    </div>
</div>


</body>
</html>
