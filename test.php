<?php
include_once 'dbconnect.php';
$output="";
if(isset($_POST["submit"]))
{
	$query='SELECT * from staff';
	$run=mysqli_query($conn,$query);
	$prev_cnt=mysqli_num_rows($run);
	echo $prev_cnt."<br>";
	$cmd='curl -s -o /dev/null --data "name=new+admin3&username=new.admin3&email=new.admin2@a.net.in&password=new.admin2&cpassword=new.admin2&dob=15/12/1996&gender=male&post=doctor&register=" http://localhost/team1cs243/admin.php -v';
	//curl -s -D --proxy http://172.16.115.19:3128 http://google.com -o /dev/null > /var/www/html/x.txt
exec($cmd);
//$fp = fopen("/var/www/html/x.txt","rb");
//$output = fread($fp,filesize("/var/www/html/x.txt"));
//var_dump($output);
echo $cmd."<br>";
$query='SELECT * from staff';
	$run=mysqli_query($conn,$query);
	$new_cnt=mysqli_num_rows($run);
	echo $new_cnt;
}
?>

<html>
<body>
<form method="post">
<button type="submit" name="submit">
Click
</button>
</form>
</body>
</html>