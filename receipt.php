<?php
session_start();
const METHOD = 'aes-256-cbc';
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

$id=$_GET['id'];
$slquery="SELECT * from pharma_queue WHERE id='$id'";
$query_run = mysqli_query($conn,$slquery);
$row=mysqli_fetch_assoc($query_run);

$file_name = $row["reciept"];
$file = '/var/www/html/patients/'.$row["pid"].'/'.$file_name;
$fp = fopen( $file, "rb");
$med = fread($fp,filesize($file));
fclose($fp);

$pat_username = $row['pid'];
$query="SELECT * from patients WHERE username='$pat_username'";
$run = mysqli_query($conn,$query);
$row1=mysqli_fetch_assoc($run);

$key = $row1['password'];
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


$html =<<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Pharmacist</title>
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
            </div>
            <div class="panel-body">
            <!-- /.box-header -->
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Doctor Name:</b></span>
                        <span class="col-sm-6">
EOD;
$html.=$med['doctor'];
$html.=<<<EOD
                    </span>
                    </div>
                    <div class="col-sm-12"> 
                        <span class="text-right col-sm-6"><b>Date & Time:</b></span>
                        <span class="col-sm-6">
EOD;
$html.= $med["date"]. ' & ' . $med["time"];
$html.=<<<EOD
                        </span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Patient Username:</b></span>
                        <span class="col-sm-6">
EOD;
$html.=$med["patient_username"];
$html.=<<<EOD
                        </span>
                    </div>
                    <div class="col-sm-12" style="padding-bottom: 2%">
                        <span class="text-right col-sm-6"><b>Patient Name:</b></span>
                        <span class="col-sm-6">
EOD;
$html.=$med["patient_name"];
$html.=<<<EOD
                        </span>
                    </div>
                    <hr style="border: solid">
                    <div class="col-sm-12">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Name of Medicine</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Frequency</th>
                                    <th class="text-center">Basic Information</th>
                                </tr>      
EOD;
    
    for($j=0;$j<$med['number_of_medicines'];$j++) 
    {
        $html.='<tr><td class="text-center">';
        $html.= $j+1;
        $html.='</td><td class="text-center">';
        $html.=$med['prescription'][$j]['name_of_medicine'];
        $html.='</td><td class="text-center">';
        $html.=$med['prescription'][$j]['quantity'];
        $html.='</td><td class="text-center">';
        $html.=$med['prescription'][$j]['frequency'];
        $html.='</td><td class="text-center">';
        $html.=$med['prescription'][$j]['basic_information'];
        $html.='</td></tr>'; 
    }
$html.=<<<EOD
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
EOD;





$file = '/var/www/html/patients/'.$row["pid"].'/receipts/'.substr($file_name, 0, -5).'.html';
$myfile=fopen($file,"w") or die("Unable to open file!");
fwrite($myfile,$html);
fclose($myfile);
chmod($file, 0777);
$receipt_name = '/var/www/html/patients/'.$row["pid"].'/receipts/'.substr($file_name, 0, -5).'.pdf';
exec("xvfb-run -a /var/www/html/team1cs243/wkhtmltopdf '$file' '$receipt_name'");
chmod($receipt_name, 0777);
$del_query = "DELETE FROM pharma_queue WHERE id = '$id'";
$del_result = mysqli_query($conn,$del_query);
unlink($file);
header('Location: staff_pharma.php');
?>