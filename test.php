<?php
include_once 'dbconnect.php';
$output="";
if(isset($_POST["registration"]))
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

if(isset($_POST["receplogin"]))
{
	$cmd = 'curl --data "username=vistaar&password=v&&post=receptionist" http://localhost/team1cs243/login.php --dump-header nx.txt';
	exec('curl --data "username=vistaar&password=v&&post=receptionist" http://localhost/team1cs243/login.php /var/www/html/team1cs243/nx.txt',$output1);
	var_dump($output1);
	$file_name='nx.txt';
	$fp = fopen($file_name,"rb");
	$output = fread($fp,filesize($file_name));
	echo $output;
	fclose($fp);
}

if(isset($_POST["doctorlogin"]))
{
	$cmd = 'curl --data "username=abhishek.cse&password=a&post=doctor" http://localhost/team1cs243/login.php --dump-header nx.txt';
	exec($cmd);
	$fp = fopen("nx.txt","rb");
	$output = fread($fp,filesize("nx.txt"));
	echo $output;
}


?>



<html>
<body>

<form method="post">
<button type="submit" name="registration">
Test Registration in Database
</button>
</form>

<div class="panel-primary">
	<?php
		if(isset($_POST["registration"]))
		{
			if($prev_cnt==$new_cnt)
			{
				echo "No change in table size.<br>";
			}
			else
			{
				echo "Size of Table changed from $prev_cnt => $new_cnt.<br>";
			}
		}




	?>
</div>


<form method="post">
<button type="submit" name="receplogin">
Test login for receptionist
</button>
</form>

<form method="post">
<button type="submit" name="doctorlogin">
Test login for doctor
</button>
</form>

</body>
</html>