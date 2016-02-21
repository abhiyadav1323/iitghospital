<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

//Assuming that the id is provided to the doctor by the queue as $temp
$currdocid = $_SESSION['id'];
$query = "SELECT * from queue WHERE did='$currdocid'";
$query_run = mysqli_query($conn,$query);
$row_cnt = mysqli_num_rows($query_run);

if($row_cnt)
{
     mysqli_data_seek($query_run,0);
    $row = mysqli_fetch_assoc($query_run);
    $temp = $row["pid"];
    $query = "SELECT * from patients WHERE roll='$temp'";
    $query_run = mysqli_query($conn,$query);
    if(!$query_run)
        $err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
    else
    {
        $row = mysqli_fetch_assoc($query_run);
        $name = $row["name"];
        $_SESSION["patient_id"]=$temp;
    }
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
    <?php
    if($row_cnt==0){ echo "You do not have any patients currently! ";}
    else echo "Your current patient is:" . $name  ;  ?>
</h3>
<div>
    <div class="col-sm-4">
        <a href="view_details.php"><button type="button" class="btn btn-block btn-success btn-lg">Do Diagnosis!</button></a>
    </div>
</div>
<div class="col-sm-4 pull-right" style="padding-right: 5%">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="medicinedetails.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="roll">Enter search term:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="medicinequery" required id="roll">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <button type="submit" name="search" class="btn btn-lg btn-success">View Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
 
</body>
</html>
