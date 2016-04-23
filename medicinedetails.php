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
else {$result_string = $result['results'][0]['indications_and_usage'][0];echo $result_string;} // null
//else echo "No such result!";


?>