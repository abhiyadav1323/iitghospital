<?php
session_start();
include_once 'dbconnect.php';

$name_of_medicine = mysqli_real_escape_string($conn,$_REQUEST["medname"]);
$quantity_of_medicine = mysqli_real_escape_string($conn,$_REQUEST["quantity"]);

$slquery = "SELECT * FROM inventory WHERE mname = '$name_of_medicine'";
$selectresult = mysqli_query($conn,$slquery);
$row_cnt = mysqli_num_rows($selectresult);
$arr = mysqli_fetch_assoc($selectresult);
$available_quantity = $arr["mquantity"];
if($row_cnt==0)
{
	echo "DOES NOT EXIST";
}
else
{
	if($available_quantity<$quantity_of_medicine)
	{
		echo "Less quantity!";
	}
	else
	{
		echo "Available!";
	}
}
?>