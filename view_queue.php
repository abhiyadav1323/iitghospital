<?php 
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['id']))
    header("Location: index.html");

echo "Hello doctor! Your queue is: </br>";
$currdocid = $_SESSION['id'];

$query = "SELECT * from queue WHERE did='$currdocid'";
$query_run = mysqli_query($conn,$query);
$row_cnt = mysqli_num_rows($query_run);
if(!$query_run)
			$err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
if($row_cnt)
{
     while ($row = mysqli_fetch_assoc($query_run)) 
     {
 			 echo "Patient ID: " . $row["pid"] . " TIMESTAMP: " . $row["time"] . " Doctor ID: " . $row["did"] . " " . "</br>";  
     }
}

else
{
	echo "The queue is empty! ";
}

 ?>
