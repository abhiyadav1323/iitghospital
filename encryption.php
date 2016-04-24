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
    	header('Location: staff_doctor.php');
?>
