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
    $phone = mysqli_real_escape_string($conn,test_input($_POST['phone'])); //taking input 
    //$username = mysqli_real_escape_string($conn,test_input($_POST['username']));
    //$password = md5(mysqli_real_escape_string($conn,test_input($_POST['password'])));
    if($_POST['page']=="1")
    {
        $id = $_SESSION['patient_id'];
        $query = "UPDATE patients SET name='$name', email='$email', dob='$dob', gender='$gender', phone='$phone' WHERE username='$id'";
        $result = mysqli_query($conn,$query);
        header('Location: view_details.php');
    }
    else
    {
        $id = $_SESSION['id'];
        $query = "UPDATE patients SET name='$name', email='$email', dob='$dob', gender='$gender', phone='$phone' WHERE id='$id'";
        $result = mysqli_query($conn,$query);
        header('Location: patient.php');
    }
    
    //header('Location: patient.php');
    //echo $_POST['page'];
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>