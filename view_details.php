<?php

session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");
else if(!isset($_SESSION['patient_id']))
    header("Location: staff_recep.php");
if(isset($_SESSION['patient_id'])) {
    $idofpatient = $_SESSION["patient_id"];
    $query = "SELECT * from patients WHERE roll='$idofpatient'";
    $query_run = mysqli_query($conn, $query);
    if (!$query_run)
        $err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
    else {
        $row = mysqli_fetch_assoc($query_run);
        $name = $row["name"];
        $email = $row["email"];
        $dob = $row["dob"];
        $gender = $row["gender"];
        $phone = $row["phone"];
        $roll = $row["roll"];

        //echo $name . $email . $dob . $gender . $phone . $roll;
    }
    if(isset($_POST['register']))
    {
        $doc_name = $_POST['name'];
        $sDate = date("Y-m-d H:i:s");
        $query1 = "INSERT INTO queue (pid, time, name) VALUES ('$idofpatient', '$sDate', '$doc_name')";
        $query_run1 = mysqli_query($conn,$query1);
        ?>
        <script type="text/javascript">alert('The appointment has been done successfully!');</script>
        <?php

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

<div class="row" style="padding-top: 8%; padding-left: 5%">

    <div class="col-sm-4">

        <!-- Profile Image -->
        <div class="panel panel-primary">
            <div class="panel-body">
                <center>
                    <img class="profile-user-img img-responsive img-circle"  style="height: 200px; width: 200px" src="hospital_photos/small_5.jpg" alt="User profile picture">
                </center>
                <h3 class="profile-username text-center"><?php echo $name; ?></h3>

                <p class="text-muted text-center">Patient</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right"><?php echo $email; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Date of Birth</b> <a class="pull-right"><?php echo date_format(date_create($dob), 'd/m/Y'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Gender</b> <a class="pull-right"><?php echo ucfirst($gender); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Mobile</b> <a class="pull-right"><?php echo $phone ; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Roll Number</b> <a class="pull-right"><?php echo $roll; ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
</div>
    <div class="col-sm-5 pull-right" style="padding-right: 10%; padding-top: 8%">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="view_details.php">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="name">Name of Doctor:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <button type="submit" name="register" class="btn btn-lg btn-success"> Take Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-5 pull-right" style="padding-right: 10%; padding-top: 1%">
        <div class="panel panel-danger">
            <div class="panel-body">
                <a href="staff_recep.php"><button type="button" class="btn btn-block btn-danger btn-lg">Go Back!!!</button></a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
