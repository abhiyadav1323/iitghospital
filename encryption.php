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
	const METHOD = 'aes-256-cbc';
    include_once 'dbconnect.php';
    if(!isset($_SESSION['id']))
        header("Location: index.html");
    if(!isset($_SESSION['patient_id']))
        header("Location: staff_doctor.php");

    $doc_id = $_SESSION['id'];
    $pat_id = $_SESSION['patient_id'];
	$query = "SELECT * from patients WHERE username='$pat_id'";
    $run = mysqli_query($conn,$query);
    $pat = mysqli_fetch_assoc($run);
    $query1 = "SELECT * from staff WHERE id='$doc_id'";
    $run1 = mysqli_query($conn,$query1);
    $doc = mysqli_fetch_assoc($run1);
    $medicines = $_POST['Med'];
    $date = date("d-m-Y");
    $time= date(" H:i:s"); //encryption in format of 

    $key = $pat['password'];
    $ivsize = openssl_cipher_iv_length(METHOD);
  	$iv = openssl_random_pseudo_bytes($ivsize);
 
    $number_of_medicines = count($medicines['name_med']);
    
    $med= array('doctor'=>utf8_encode($iv.openssl_encrypt($doc['name'],METHOD,$key,OPENSSL_RAW_DATA,$iv)),
    	'date'=>utf8_encode($iv.openssl_encrypt($date,METHOD,$key,OPENSSL_RAW_DATA,$iv)),
    	'time'=>utf8_encode($iv.openssl_encrypt($time,METHOD,$key,OPENSSL_RAW_DATA,$iv)), 
    	'number_of_medicines'=>utf8_encode($iv.openssl_encrypt((string)$number_of_medicines,METHOD,$key,OPENSSL_RAW_DATA,$iv)),
    	'patient_username'=>utf8_encode($iv.openssl_encrypt($pat['username'],METHOD,$key,OPENSSL_RAW_DATA,$iv)), 
    	'patient_name'=>utf8_encode($iv.openssl_encrypt($pat['name'],METHOD,$key,OPENSSL_RAW_DATA,$iv)),
        'diagnosis'=>utf8_encode($iv.openssl_encrypt(nl2br($_POST['diagnosis']),METHOD,$key,OPENSSL_RAW_DATA,$iv)));
    
    
    for($i=0;$i<$number_of_medicines;$i++) 
    {
    	$med['prescription'][$i]['name_of_medicine'] = utf8_encode($iv.openssl_encrypt($medicines['name_med'][$i],METHOD,$key,OPENSSL_RAW_DATA,$iv));
    	$med['prescription'][$i]['quantity'] = utf8_encode($iv.openssl_encrypt($medicines['quantity_med'][$i],METHOD,$key,OPENSSL_RAW_DATA,$iv));
    	$med['prescription'][$i]['frequency'] = utf8_encode($iv.openssl_encrypt($medicines['frequency_med'][$i],METHOD,$key,OPENSSL_RAW_DATA,$iv));
    	$med['prescription'][$i]['basic_information'] = utf8_encode($iv.openssl_encrypt($medicines['info_med'][$i],METHOD,$key,OPENSSL_RAW_DATA,$iv));
    }
    $file_name = date("d-m-Y H:i:s").'.json';
    $file='/var/www/html/patients/'.$pat['username'].'/'.$file_name;
    $fp = fopen( $file, "wb");
    chmod($file, 0777);   
    fwrite($fp,json_encode($med));//json data
    fclose($fp);
    $query = "SELECT * from queue WHERE pid='$pat_id'";
    $run = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($run);
    $queue_id = $row["id"];
    $del_query = "DELETE FROM queue WHERE id = '$queue_id'";
    $del_result = mysqli_query($conn,$del_query);
    $sql="INSERT INTO pharma_queue (pid, reciept) VALUES ('$pat_id', '$file_name')";
    $sql_result = mysqli_query($conn,$sql);
    	//header('Location: staff_doctor.php');*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Encryption</title>
    <link rel="stylesheet" href="/var/www/html/team1cs243/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/var/www/html/team1cs243/AdminLTE/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/var/www/html/team1cs243/team1cs243/AdminLTE/css/skins/_all-skins.min.css">
    <script src="/var/www/html/team1cs243/bootstrap/js/jquery.min.js"></script>
    <script src="/var/www/html/team1cs243/bootstrap/js/jquery-ui.js"></script>
    <script src="/var/www/html/team1cs243/bootstrap/js/bootstrap.js"></script>
    <script src="/var/www/html/team1cs243/AdminLTE/js/app.js"></script>
</head>
<body>
<div class="row">
        <div class="col-sm-6 col-sm-offset-3" style="padding-top: 6%">
        <div class="panel panel-danger">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Medical Receipt</b></center></h2>
                                <div class="pull-right col-sm-3">
                        <center><img src="iitg.jpg" class="profile-user-img img-responsive img-circle" 
                    style="height: 100px; width: 100px; ;"/></center>
                    </div>
            </div>
            <div class="panel-body">
            <!-- /.box-header -->
                <div class="col-sm-12" style="padding: 1%">
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Doctor Name: <?php echo $doc['name'];?></b></span>
                        <span class="col-sm-6">
                    </span>
                    </div>
                    <div class="col-sm-12"> 
                        <span class="text-right col-sm-6"><b>Date & Time: <?php echo $date. ' & ' . $time;?></b></span>
                        <span class="col-sm-6">
                        </span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Patient Username: <?php echo $pat['username'];?></b></span>
                        <span class="col-sm-6">
                        </span>
                    </div>
                    <div class="col-sm-12" style="padding-bottom: 2%">
                        <span class="text-right col-sm-6"><b>Patient Name:<?php echo $pat['name'];?></b></span>
                        <span class="col-sm-6">
                        </span>
                    </div>
                    <hr style="border: solid">
                    <div class="col-sm-12">
                        <table class="table table-condensed" style="padding: 1%">
                            <tbody>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Name of Medicine</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Frequency</th>
                                    <th class="text-center">Basic Information</th>
                                </tr>      
   <?php 
    for($j=0;$j<$number_of_medicines;$j++) 
    {
        ?><tr><td class="text-center"><?php
        echo $j+1;
        ?></td><td class="text-center"><?php
        echo $medicines['name_med'][$j];
         ?></td><td class="text-center"><?php
        echo $medicines['quantity_med'][$j];
         ?></td><td class="text-center"><?php
        echo $medicines['frequency_med'][$j];
         ?></td><td class="text-center"><?php
        echo $medicines['info_med'][$j];
        ?></td></tr><?php 
    }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
    <a href="staff_doctor.php">
    <button type="button" class="btn btn-xs btn-primary" style="padding: 1%">Send to pharmacist</button>
</body>
</html>