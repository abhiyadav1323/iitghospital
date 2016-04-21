<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Receptionist</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="AdminLTE/css/AdminLTE.min.css">
    <link rel="stylesheet" href="AdminLTE/css/skins/_all-skins.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="AdminLTE/js/app.js"></script>
</head>
<?php
session_start();
include_once 'dbconnect.php';

$name_of_medicine = mysqli_real_escape_string($conn,$_REQUEST["medname"]);
$quantity_of_medicine = mysqli_real_escape_string($conn,$_REQUEST["quantity"]);

$slquery = "SELECT * FROM inventory WHERE mname = '$name_of_medicine'";
$selectresult = mysqli_query($conn,$slquery);
$row_cnt = mysqli_num_rows($selectresult);
$arr = mysqli_fetch_assoc($selectresult);
$available_quantity = $arr["mquantity"]; //check medicine exist or not


if($quantity_of_medicine=="notrequired")
{
	if($row_cnt==0)
	{
		?>
		<i class="fa fa-fw fa-close"></i>
		<?php
	}
	else
	{
		?>
		<i class="fa fa-fw fa-check"></i>
		<?php
	}
}

else
{
	if($available_quantity<$quantity_of_medicine)
	{
		?>
		<i class="fa fa-fw fa-close"></i>
		<?php
	}
	else
	{
		?>
		<i class="fa fa-fw fa-check"></i>
		<?php
	}
}


?>

</html>