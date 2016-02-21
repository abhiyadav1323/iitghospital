<?php
echo "Hi!";

if(isset($_GET['query']))
{
	echo "Hi!";
	if(!empty($_GET['query']))
	{
		$que = $_GET['query'];
		$url = 'https://api.fda.gov/drug/label.json?search=' . urlencode($que);
		echo $url;
		$curlSession = curl_init($url);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
   $data = curl_exec($curlSession);
    
    curl_close($curlSession);
    var_dump(json_decode($data));
var_dump(json_decode($data, true));
  //   $url_array = json_decode($data);
		// $info = $url_array['results'][0]['indications_and_usage']; 
		// echo "Hello!";
		// echo $info;
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