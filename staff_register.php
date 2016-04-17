<?php
  session_start();
  include_once 'dbconnect.php';
  if(isset($_SESSION['id']))
  {
    $id = $_SESSION['id'];
    $first_query = "SELECT * FROM staff WHERE id ='$id'";
    $first_result = mysqli_query($conn,$first_query);
    $first_row = mysqli_fetch_assoc($first_result);
    if ($first_row["post"] == "doctor")
      header("Location: staff_doctor.php");
    else if ($first_row["post"] == "receptionist")
      header("Location: staff_recep.php");
    else if ($first_row["post"] == "pharmacist")
      header("Location: staff_pharma.php");
  }  


  $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";
  if(isset($_POST['register']))
  {
    $name = mysqli_real_escape_string($conn,test_input($_POST['name']));
    $username = mysqli_real_escape_string($conn,test_input($_POST['username']));
    $email = mysqli_real_escape_string($conn,test_input($_POST['email']));
    $password = md5(mysqli_real_escape_string($conn,test_input($_POST['password'])));
    $cpassword = md5(mysqli_real_escape_string($conn,test_input($_POST['cpassword'])));
    $dob = mysqli_real_escape_string($conn,test_input($_POST['dob']));
    $gender= mysqli_real_escape_string($conn,test_input($_POST['gender']));
    $post = mysqli_real_escape_string($conn,test_input($_POST['post']));

    $slquery = "SELECT 6 FROM staff WHERE username = '$username'";
    $selectresult = mysqli_query($conn,$slquery);
    $query = "SELECT 8 FROM staff WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    $sql="INSERT INTO staff (name, dob, gender, post, username, password, email) VALUES ('$name', '$dob', '$gender', '$post', '$username', '$password', '$email')";
    if(mysqli_num_rows($selectresult)>0)
    {
      $username="";
    ?>
      <script>alert('Username already exists');</script>
    <?php
    }
    else if(mysqli_num_rows($result)>0)
    {
      $email="";
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
      if ($row["post"] == "doctor")
        header("Location: staff_doctor.php");
      else if ($row["post"] == "receptionist")
        header("Location: staff_recep.php");
      else if ($row["post"] == "pharmacist")
        header("Location: staff_pharma.php");
    }
    else
    {
      $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";
    ?>
      <script>alert('Error while registering you...');</script>
    <?php
    }
  }
  else if(isset($_POST['reset']))
    $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";

  function test_input($data) 
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration - Staff</title>
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
<body>
<div class="row">
  <nav class="navbar navbar-inverse navbar-fixed-top" style="height: 10%">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
      </div>
    </div>
  </nav>
</div>
<div class="row" style="padding-top: 4%">
</div>
<div class="row">
  <div class="col-sm-offset-3 col-sm-6" style="padding-top: 3%; padding-bottom: 2%">
    <div class="panel panel-danger" >
      <div class="panel-title">
          <h2 style="color: #66512c;"><center><b>Register Here</b></center></h2></div>
      <div class="panel-body">
    <form class="form-horizontal" role="form" method="post" action="staff_register.php">
      <div class="form-group">
        <label class="control-label col-sm-3" for="nm">Name:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="name" required value="<?php echo $name;?>" id="nm">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="username">Username:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="username" required value="<?php echo $username;?>" id="username" />
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="email">Email:</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" name="email" required value="<?php echo $email;?>" id="email" />
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="password">Password:</label>
        <div class="col-sm-8">
          <input type="password" name="password" class="form-control" required id="password" >
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="cpassword">Confirm Password:</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" name="cpassword" required id="cpassword" >
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="dob">Date of Birth:</label>
        <div class="col-sm-8">
          <input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="gender">Gender:</label>
        <div class="col-sm-8">
          <label class="radio-inline">
            <input type="radio" id="gender" name="gender" required value="female" <?php if(isset($gender) && $gender=="female") echo "checked"; ?>>Female</label>
          <label class="radio-inline">
            <input type="radio" id="gender" name="gender" required value="male" <?php if(isset($gender) && $gender=="male") echo "checked"; ?>>Male</label>
          <label class="radio-inline">
            <input type="radio" id="gender" name="gender" required value="other" <?php if(isset($gender) && $gender=="other") echo "checked"; ?>>Other</label>
        </div>
      </div>

      <div class="form-group">
        <label for="sel1" class="control-label col-sm-3">Designation:</label>
        <div class="col-sm-8">
        <select class="form-control" name="post" id="sel1">
          <option value="doctor" <?php if(isset($post) && $post=="doctor") echo "selected"; ?>>Doctor</option>
          <option value="pharmacist" <?php if(isset($post) && $post=="pharmacist") echo "selected"; ?>>Pharmacist</option>
          <option value="receptionist" <?php if(isset($post) && $post=="receptionist") echo "selected"; ?>>Receptionist</option>
          <option value="office" <?php if(isset($post) && $post=="office") echo "selected"; ?>>Office Staff</option>
        </select>
          </div>
      </div>
<br>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-3">
          <button type="submit" name="reset" class="btn btn-lg btn-danger">Reset</button>
        </div>
        <div class="col-sm-4 pull-right">
          <button type="submit" name="register" class="btn btn-lg btn-success">Register</button>
        </div>
      </div>

      <div class="form-group-lg">
          <label class="control-label col-sm-7">Already Registered?</label>
          <label class="control-label">
            <a href="index.php">Sign In Here</a>
          </label>
        </div>
      </div>
    </form>

</div>
</div>
    </div>
  </div>
</body>
</html>