<br><br><br><br><br><br><br><br><br>
<?php 
    session_start();
    include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");
    if(!isset($_SESSION['patient_id']))
    header("Location: staff_doctor.php");
    else
    {
    $id=$_SESSION['patient_id'];
         $query2 = "SELECT * from patients WHERE roll='$id'";
                        $run1 = mysqli_query($conn,$query2);
                        $row2=mysqli_fetch_assoc($run1);
                        echo $row2["name"];
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
<div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo ("Patient id : ".$_SESSION['patient_id']);?></h3>

              <p><?php echo ("Name : ". $row2["name"]);?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              Medical info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>

          <div class="small-box bg-yellow" style="padding: 0px">
            <div class="inner">
              <h3><?php echo ("Patient id : ".$_SESSION['patient_id']);?></h3>

              <h3><?php echo ("Name : ". $row2["name"]);?></h3>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              Medical info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>