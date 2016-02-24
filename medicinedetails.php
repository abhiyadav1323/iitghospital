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
$result = json_decode($data, true);
$result_string = $result['results'][0]['indications_and_usage'][0];

echo $result_string;

?>