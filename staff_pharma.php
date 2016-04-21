<?php
session_start();
const METHOD = 'aes-256-cbc';
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
                <a class="navbar-brand" href="staff_pharma.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
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
<div class="row" >
    <div class="col-sm-5" style="padding-left: 3%; padding-top: 1%">
        <div class="panel panel-danger">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Upcoming Patients</b></center></h2>
            </div>
            <div class="panel-body" style="overflow-y: scroll; height: 60vh">
            <!-- /.box-header -->
                <table class="table table-condensed table-striped">
                    <tbody><tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Name of Patients</th>
                        <th class="text-center">Receipt files</th>
                    </tr>
                    <?php
                    $query = "SELECT * from pharma_queue" ;
                    $run = mysqli_query($conn,$query);
                    $i=0;
                    while($row=mysqli_fetch_assoc($run))
                    {
                        $i+=1;
                        $id=$row["pid"];
                        $query1 = "SELECT * from patients WHERE username='$id'";
                        $run1 = mysqli_query($conn,$query1);
                        $row1=mysqli_fetch_assoc($run1);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $row1["username"]; ?></td>
                        <td class="text-center"><?php echo $row1["name"]; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-primary">View</button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>


<div class="col-sm-7" style="padding-right: 3%; padding-top: 1%">
        <div class="box " style="border: solid; border-color: #e08e0b ">
            <div class="box-title">
                <h2 style="color: #8a6d3b"><center><b>Inventory</b></center></h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-y: scroll; height: 60vh">
                <table class="table table-condensed table-striped">
                    <tbody><tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center">Medicine</th>
                        <th class="text-center">Quantity left</th>
                        <th class="text-center">Expiry Date</th>
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
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $row1["mname"]; ?></td>
                        <td class="text-center"><?php echo $row1["mquantity"]; ?></td>
                        <td class="text-center"><?php echo date_format(date_create($row1["mexpiry"]), 'd/m/Y'); ?></td> 
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
