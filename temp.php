<?php


if(isset($_GET['query']))
{
	
	if(!empty($_GET['query']))
	{
		$que = $_GET['query'];
		$url = 'https://api.fda.gov/drug/label.json?search=' . urlencode($que);
	
	$proxy = '172.16.115.19:3128';
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
//print_r($result->results[0]->indications_and_usage);
	//$result_string = $result->$result['results'][0]['indications_and_usage'][0];
	//echo $result_string;
	}
}


?>

<html>
<body>

<form method="get">
	<input type="text" name="query">
	<button type="submit"> Submit! </button>
</form>

</body>
</html>