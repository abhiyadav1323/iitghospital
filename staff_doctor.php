<!--
****************************************************************************************************
                                    Web App for IITG Hospital
                                    -------------------------
            The software intends at automating the working of the IITG hospital to ensure 
            that the patient can be given a great experience while visiting the hospital 
            and is given medicines which correspond to the diagnosis.
            Copyright © 2016, team1cs243.
****************************************************************************************************
-->


<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

$id=$_SESSION['id'];
$slquery="SELECT * from staff WHERE id='$id'";
$query_run = mysqli_query($conn,$slquery);
$row=mysqli_fetch_assoc($query_run);


if(isset($_POST["search_med"]))
{
    $que = $_POST["medicinequery"];

        $url = 'https://api.fda.gov/drug/label.json?search=' . urlencode($que);
    
    $proxy = '127.0.0.1:8080';
//$proxyauth = 'user:password';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($ch);

curl_close($ch);
      // $result = json_decode($data, true);
$result = json_decode($data, true); //json decoding
if($result==null&&json_last_error()!=JSON_ERROR_NONE)
{
    echo "Incorrect data! "; // print incorrect data
}
else {
    if(isset($result['results'][0]['indications_and_usage'][0]))
$result_string = $result['results'][0]['indications_and_usage'][0];
//echo $result_string;
} // null
//else echo "No such result!";
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
    <nav class="navbar navbar-default navbar-fixed-top">
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
<div class="row" style="padding-top: 5%; padding-bottom: 2%">
    <div class="col-sm-12"><center>
        <h1><label class="label label-info"><?php echo 'Hello,'.' '.$row['name']; ?></label></h1>
    </center></div>
</div>
<div class="row" style="padding-left: 3%">
    <div class="col-sm-4">
        <div class="box " style="border: solid; border-color: #e08e0b ">
            <div class="box-title">
                <h2 style="color: #8a6d3b"><center><b>Upcoming Patients</b></center></h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-y: scroll; height: 70vh">
                <table class="table table-condensed table-striped">
                    <tbody><tr>
                        <th>S.No.</th>
                        <th>Username</th>
                        <th>Name of Patients</th>
                    </tr>
                    <?php
                    $name=$row["name"];
                    $query1 = "SELECT * from queue WHERE name='$name'";
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
                        if($i==1)
                        {
                            $currpatname=$row2["name"];
                            $currpatid=$row2["username"];
                            $_SESSION["patient_id"]=$row2["username"];//session for one patient starts
                        }

                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row2["username"] ?></td>
                        <td><?php echo $row2["name"] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-sm-8">
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Current Patient</b></center></h2>
            </div>
            <div class="panel-body">
                <?php
                if($currpatid!="")
                {
                    ?>
                    <div class="col-sm-12">
                    <label class="control-label col-sm-6">Username:</label>
                    <label class="control-label col-sm-6"><?php echo $currpatid; ?></label>
                    </div>
                    <div class="col-sm-12">
                        <label class="control-label col-sm-6">Patient Name:</label>
                        <label class="control-label col-sm-6"><?php echo $currpatname; ?></label>
                    </div>
                    <div class="col-sm-offset-4 col-sm-4">
                    <a href="diagnosis.php"><br>
                    <button type="button" name="register" class="btn btn-lg btn-info">Diagnose</button>
                    <br></a>
                    </div>
                <?php
                }
                else
                {
                ?>
                <div class="col-sm-12">
                    <ul class="todo-list">
                    <li style="align-content: center">Currently there is no patient!!!</li>
                    </ul>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-sm-6" style="padding-right: 7%">
        <div class="panel panel-primary">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Search Medicines</b></center></h2>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="staff_doctor.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="medicinequery">Med. Name:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="medicinequery" required id="medicinequery">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-5">
                            <button type="submit" name="search_med" class="btn btn-lg btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="row" style="padding-top: 2%">
    <div class="col-sm-12" style="padding-right: 7%" >
         <div class="panel panel-primary" style="overflow-y: scroll; height: 43vh">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Medicine Details</b></center></h2>
            </div>
            <div class="panel-body">
            <?php
            if(!isset($result_string)&&!isset($_POST["search_med"]))
                echo "<h4><center>Currently no medicine details</center></h4>";
            else if(!empty($result_string)) 
                echo $result_string;
            else 
                echo "<h4><center>Medicine not found</center></h4>";
            ?>
        </div>
         </div>
    </div>
</div>
</div>

</div>
<?php //echo $result_string;?>


</body>
</html>
