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
                        
                        <?php
                                $file = '/var/www/html/patients/'.$row1["username"].'/'.$row["reciept"];
                                $fp = fopen( $file, "rb");
                                $med = fread($fp,filesize($file));
                                fclose($fp);
                                $key = $row1["password"];
                                $med = json_decode($med, true);
                                $med['doctor'] = utf8_decode((string)$med['doctor']);
                                $ivsize = openssl_cipher_iv_length(METHOD);
                                $iv = mb_substr($med['doctor'], 0, $ivsize, '8bit');
                                $med['doctor'] = mb_substr($med['doctor'], $ivsize, null, '8bit');
                                $med['doctor'] = openssl_decrypt($med['doctor'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['date'] = utf8_decode($med['date']);
                                $med['date'] = mb_substr($med['date'], $ivsize, null, '8bit');
                                $med['date'] = openssl_decrypt($med['date'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['time'] = utf8_decode($med['time']);
                                $med['time'] = mb_substr($med['time'], $ivsize, null, '8bit');
                                $med['time'] = openssl_decrypt($med['time'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['number_of_medicines'] = utf8_decode($med['number_of_medicines']);
                                $med['number_of_medicines'] = mb_substr($med['number_of_medicines'], $ivsize, null, '8bit');
                                $med['number_of_medicines'] = openssl_decrypt($med['number_of_medicines'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['patient_username'] = utf8_decode($med['patient_username']);
                                $med['patient_username'] = mb_substr($med['patient_username'], $ivsize, null, '8bit');
                                $med['patient_username'] = openssl_decrypt($med['patient_username'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['patient_name'] = utf8_decode($med['patient_name']);
                                $med['patient_name'] = mb_substr($med['patient_name'], $ivsize, null, '8bit');
                                $med['patient_name'] = openssl_decrypt($med['patient_name'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                for($j=0;$j<$med['number_of_medicines'];$j++) 
                                {
                                    $med['prescription'][$j]['name_of_medicine'] = utf8_decode($med['prescription'][$j]['name_of_medicine']);
                                    $med['prescription'][$j]['name_of_medicine'] = mb_substr($med['prescription'][$j]['name_of_medicine'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['name_of_medicine'] = openssl_decrypt($med['prescription'][$j]['name_of_medicine'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['quantity'] = utf8_decode($med['prescription'][$j]['quantity']);
                                    $med['prescription'][$j]['quantity'] = mb_substr($med['prescription'][$j]['quantity'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['quantity'] = openssl_decrypt($med['prescription'][$j]['quantity'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['frequency'] = utf8_decode($med['prescription'][$j]['frequency']);
                                    $med['prescription'][$j]['frequency'] = mb_substr($med['prescription'][$j]['frequency'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['frequency'] = openssl_decrypt($med['prescription'][$j]['frequency'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['basic_information'] = utf8_decode($med['prescription'][$j]['basic_information']);
                                    $med['prescription'][$j]['basic_information'] = mb_substr($med['prescription'][$j]['basic_information'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['basic_information'] = openssl_decrypt($med['prescription'][$j]['basic_information'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                }
                                //var_dump($med);
                            ?>
                            <td class="text-center">
                            <button type="button" onclick="show_receipt('<?php echo $row["reciept"] ?>','<?php echo $row1["password"] ?>','<?php echo $row1["username"] ?>')" class="btn btn-xs btn-primary">View</button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <script>
                        function show_receipt(file_name,key,username,med) {
                            //alert(file_name);
                            var file='/var/www/html/patients/'+username+'/'+file_name;
                            //name[] = '<?php echo json_encode($med); ?>';
                            document.getElementById("view").innerHTML = file;
                        }
                    </script>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>



    <div class="col-sm-7" style="padding-right: 3%; padding-top: 1%">
        <div class="panel panel-danger">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Medicine Receipts</b></center></h2>
            </div>
            <div class="panel-body" id="view" style="overflow-y: scroll; height: 60vh">
            <!-- /.box-header -->
                
            </div>
            <!-- /.box-body -->
        </div>
    </div>





</div>

<div class="row">
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
