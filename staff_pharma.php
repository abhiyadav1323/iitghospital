<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

$id=$_SESSION['id'];
$slquery="SELECT * from staff WHERE id='$id'";
$query_run = mysqli_query($conn,$slquery);
$row=mysqli_fetch_assoc($query_run);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Pharmacist</title>
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
                <a class="navbar-brand" href="staff_doctor.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="row" style="padding-top: 5%; padding-bottom: 1%">
    <div class="col-sm-12"><center>
        <h1><label class="label label-info"><?php echo 'Hello,'.' '.$row['name']; ?></label></h1>
    </center></div>
</div>
<div class="row" style="padding-left: 3%">
    <div class="col-sm-6">
        <div class="box " style="border: solid; border-color: #e08e0b ">
            <div class="box-title">
                <h2 style="color: #8a6d3b"><center><b>Medicines</b></center></h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-y: scroll; height: 60vh">
                <table class="table table-condensed table-striped">
                    <tbody><tr>
                        <th>S.No.</th>
                        <th>Username</th>
                        <th>Name of Patients</th>
                        <th>Receipt files</th>
                    </tr>
                    <?php
                    $name=$row["name"];
                    $query1 = "SELECT * from pharma_queue" ;
                    $run = mysqli_query($conn,$query1);
                    $i=0;
                    $currpatid=$currpatname="";
                    while($row1=mysqli_fetch_assoc($run))
                    {
                        $i+=1;
                        $id=$row1["pid"];
                        $query2 = "SELECT * from patients WHERE username='$id'";
                        $run1 = mysqli_query($conn,$query2);
                        $row2=mysqli_fetch_assoc($run1);
                            $currpatname=$row2["name"];
                            $currpatid=$row2["username"];
                            $reciept = $row1["reciept"];

                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row2["username"]; ?></td>
                        <td><?php echo $row2["name"]; ?></td>
                        <td><?php echo $row1["reciept"]; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box " style="border: solid; border-color: #e08e0b ">
            <div class="box-title">
                <h2 style="color: #8a6d3b"><center><b>Inventory</b></center></h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-y: scroll; height: 60vh">
                <table class="table table-condensed table-striped">
                    <tbody><tr>
                        <th>S.No.</th>
                        <th>Medicine</th>
                        <th>Quantity left</th>
                        <th>Expiry Date</th>
                    </tr>
                    <?php
                    $name=$row["name"];
                    $query1 = "SELECT * from inventory" ;
                    $run = mysqli_query($conn,$query1);
                    $i=0;
                    $currpatid=$currpatname="";
                    while($row1=mysqli_fetch_assoc($run))
                    {
                        $i+=1;
                        //$id=$row1["mid"];
                        //$query2 = "SELECT * from patients WHERE username='$id'";
                        //$run1 = mysqli_query($conn,$query2);
                        //$row2=mysqli_fetch_assoc($run1);
                            //$currpatname=$row2["name"];
                            //$currpatid=$row2["username"];
                            //$reciept = $row1["reciept"];

                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row1["mname"]; ?></td>
                        <td><?php echo $row1["mquantity"]; ?></td>
                        <td><?php echo date_format(date_create($row1["mexpiry"]), 'd/m/Y'); ?></td> 
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

</div>


</body>
</html>
