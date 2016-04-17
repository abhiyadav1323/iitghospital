<?php
session_start();
if(!isset($_SESSION['id']))
    header("Location: index.php");
include_once 'dbconnect.php';
$name=$email=$phone=$dob=$gender=$username=$password="";
if(isset($_POST['update']))
{
    $name = mysqli_real_escape_string($conn,test_input($_POST['name']));
    $email = mysqli_real_escape_string($conn,test_input($_POST['email']));
    $dob = mysqli_real_escape_string($conn,test_input($_POST['dob']));
    $gender= mysqli_real_escape_string($conn,test_input($_POST['gender']));
    $phone = mysqli_real_escape_string($conn,test_input($_POST['phone']));
    $username = mysqli_real_escape_string($conn,test_input($_POST['username']));
    $password = md5(mysqli_real_escape_string($conn,test_input($_POST['password'])));
    $id = $_SESSION['id'];
    $query = "UPDATE patients SET name='$name', email='$email', dob='$dob', gender='$gender', phone='$phone', username='$username' WHERE id='$id'";
    $result = mysqli_query($conn,$query);
    header('Location: patient.php');
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>