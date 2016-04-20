<?php

$filename='test.json';

$str = file_get_contents($filename);
$json = json_decode($str,true);

$doctorname=$json['doctor'];
$date=$json['date'];
$time=$json['time'];
$number_of_medicines=$json['number_of_medicines'];

$name_of_patient=$json['patient_name'];
$username_of_patient=$json['patient_username'];
$gender=$json['gender']; //taking input 

$html =<<<EOD
<html> 
<body> 

<center> 
<h1> 
IIT Guwahati 
</h1> 
</center>
<hr>
Doctor: $doctorname
Username of patient: $username_of_patient
Name of Patient: $name_of_patient
Gender: $gender
Date: $date
Time: $time
<hr>
<table>
<tbody>
EOD;

for($i=0;$i<$number_of_medicines;$i++)
{
	$html .= "<tr>";
	$name=$json['prescription'][$i]['name_of_medicine'];
	$html .= "<td>$name</td>";
	$quantity=$json['prescription'][$i]['quantity'];
	$html .= "<td>$quantity</td>";
	$freq=$json['prescription'][$i]['frequency'];
	$html .= "<td>$freq</td>";
	$info=$json['prescription'][$i]['basic_information'];
	$html .= "<td>$info</td>";
	$html .= "</tr>";
}

$html.=<<<EOD
</tbody>
</table>

</body>
</html>
EOD;

$myfile=fopen("abcd.html","w") or die("Unable to open file!");
fwrite($myfile,$html);
fclose($myfile);

exec("xvfb-run -a /var/www/html/team1cs243/wkhtmltopdf abcd.html output6.pdf");

?>


