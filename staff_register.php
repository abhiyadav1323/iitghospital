<?php
  session_start();
 
  if(isset($_SESSION['id']))
  {
    header("Location: staff_home.php");
  }  
  include_once 'dbconnect.php';

  $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";
  if(isset($_POST['register']))
  {
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
    $cpassword = md5(mysqli_real_escape_string($conn,$_POST['cpassword']));
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $gender= mysqli_real_escape_string($conn,$_POST['gender']);
    $post = mysqli_real_escape_string($conn,$_POST['post']);

    $slquery = "SELECT 6 FROM staff WHERE username = '$username'";
    $selectresult = mysqli_query($conn,$slquery);
    $query = "SELECT 8 FROM staff WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    $sql="INSERT INTO staff (name, dob, gender, post, username, password, email) VALUES ('$name', '$dob', '$gender', '$post', '$username', '$password', '$email')";
    if(mysqli_num_rows($selectresult)>0)
    {
    ?>
      <script>alert('Username already exists');</script>
    <?php
    }
    else if(mysqli_num_rows($result)>0)
    {
    ?>
      <script>alert('Email already exists');</script>
    <?php
    }
    else if($password != $cpassword)
    {
    ?>
      <script>alert('Password and Confirm password mismatch');</script>
    <?php
    }
    else if(mysqli_query($conn,$sql))
    {
      $query1 = "SELECT * FROM staff WHERE username='$username'";
      $query_run=mysqli_query($conn,$query1);
      $row = mysqli_fetch_assoc($query_run);
      $_SESSION['id'] = $row["id"];
      header("Location: staff_home.php");
    }
    else
    {
      $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";
    ?>
      <script>alert('Error while registering you...');</script>
    <?php
    }

  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration - Staff</title>
</head>
<body>
	<form method="post">
	<h3> Register Here</h3>
    Name: <input type="text" name="name" value="<?php echo $name;?>" required/><br>		
    Username: <input type="text" name="username" value="<?php echo $username; ?>" required/><br>	
    Email: <input type="email" name="email" value="<?php echo $email; ?>" required /><br>		
    Password: <input type="password" name="password" required/><br>		
    Confirm Password: <input type="password" name="cpassword" required/><br>
    Date of Birth: <input type="date" name="dob" required/><br>
    Gender: <input type="radio" name="gender" value="female" <?php if(isset($gender) && $gender=="female") echo "checked"; ?> required/>Female
    <input type="radio" name="gender" value="male" <?php if(isset($gender) && $gender=="male") echo "checked"; ?> required/>Male<br>
    Designation: <select name="post">
      <option value="doctor" <?php if(isset($post) && $post=="doctor") echo "selected"; ?>>Doctor</option>
      <option value="pharmacist" <?php if(isset($post) && $post=="pharmacist") echo "selected"; ?>>Pharmacist</option>
      <option value="receptionist" <?php if(isset($post) && $post=="receptionist") echo "selected"; ?>>Receptionist</option>
    </select><br><br>
    <input type="submit" name="register" value="Register">
	</form>
</body>
</html>