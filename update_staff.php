<!-- <br><br><br><br><br><br><br><br> -->
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
    $post = mysqli_real_escape_string($conn,test_input($_POST['post']));
    $username = mysqli_real_escape_string($conn,test_input($_POST['uname']));
    //$password = md5(mysqli_real_escape_string($conn,test_input($_POST['password'])));
   
    //$id = $_SESSION['id'];
    $query = "UPDATE staff SET name='$name', email='$email', dob='$dob', gender='$gender', post='$post' WHERE username='$username'";
    $result = mysqli_query($conn,$query);
    // echo $result;
    header('Location: admin.php');
   
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>