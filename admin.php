<!-- <br><br><br><br><br><br><br><br><br> -->
<?php
  session_start();
  include_once 'dbconnect.php';
  if(!isset($_SESSION['id']))
    header("Location: index.php");
  if(isset($_GET['del']))
  {
    $del=$_GET['del'];
    //echo $del;
    $del_query = "DELETE FROM staff WHERE id = '$del'";
    $del_result = mysqli_query($conn,$del_query);
    //echo $del_result;
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
    $post = mysqli_real_escape_string($conn,test_input($_POST['post']));   //checking entries

    $slquery = "SELECT * FROM staff WHERE username = '$username'";
    $selectresult = mysqli_query($conn,$slquery);
    $query = "SELECT * FROM staff WHERE email = '$email'";
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
      $name=$username=$email=$password=$cpaswword=$dob=$gender=$post="";
      unset($_POST['register']);
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
<!--  bootstrap style  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel - IITG Hospital</title>

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
                <a class="navbar-brand" href="admin.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="row">
  <div class="col-sm-6" style="padding-left: 3%; padding-top: 8%; padding-bottom: 3%">
    <div class="panel panel-danger">
      <div class="panel-title">
        <h2 style="color: #8a6d3b"><center><b>List of Hospital Staff Members</b></center></h2>
      </div>
      <div class="panel-body" style="overflow-y: scroll; height: 70vh;">
        <table class="table table-condensed">
          <tbody>
          <?php
            $slquery="SELECT * from staff";
            $query_run = mysqli_query($conn,$slquery);
            $count = mysqli_num_rows($query_run);
            $i=0;
            while($row=mysqli_fetch_assoc($query_run))
            {
              $i+=1;?>
              <tr>
              <td><?php echo $i;?>.</td>
              <td><?php echo $row["name"]; ?></td>
              <td><?php echo ucfirst($row["post"]); ?></td>
              <td>
                <button class="label label-primary btn btn-xs" data-toggle="modal" data-target="#mod<?php echo $i;?>">View Profile</button>
                <div id="mod<?php echo $i;?>" class="modal fade" style="vertical-align: middle" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span></button>
                        <h2 style="color: #8a6d3b"><center><b>Staff Details</b></center></h2>
                      </div>
                      <div class="modal-body" style="overflow-y: scroll; height: 50vh;">
                        <div class="row">
                          <div class="col-sm-offset-2 col-sm-8">
                            <div class="panel panel-danger">
                              <div class="panel-body">
                                <table class="table table-condensed">
                                  <tbody>
                                    <tr>
                                      <td><b>Name:</b></td>
                                      <td><?php echo $row["name"]; ?></td> 
                                    </tr>
                                    <tr>
                                      <td><b>Username:</b></td>
                                      <td><?php echo $row["username"]; ?></td> 
                                    </tr>
                                    <tr>
                                      <td><b>Email:<b></td>
                                      <td><?php echo $row["email"]; ?></td> 
                                    </tr>
                                    <tr>
                                      <td><b>Date of Birth:</b></td>
                                      <td><?php echo date_format(date_create($row["dob"]), 'd/m/Y'); ?></td> 
                                    </tr>
                                    <tr>
                                      <td><b>Gender:</b></td>
                                      <td><?php echo ucfirst($row["gender"]); ?></td> 
                                    </tr>
                                    <tr>
                                      <td><b>Designation:</b></td>
                                      <td><?php echo ucfirst($row["post"]); ?></td> 
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <button class="label label-success btn btn-xs" data-toggle="modal" data-target="#edit<?php echo $i;?>">Update</button>
                <div id="edit<?php echo $i;?>" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Update Details</b></center></h2>
            </div><br>
            <form class="form-horizontal" role="form" action = "update_staff.php" method="post">
              <div class="form-group">
                        <label class="control-label col-sm-3" for="nm">Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required value="<?php echo $row["name"];?>" id="nm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="username">Username:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="username" disabled required value="<?php echo $row["username"];?>" id="username" />
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $row["username"];?>" name="uname" />
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" required value="<?php echo $row["email"];?>" id="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="dob">Date of Birth:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="dob" value="<?php echo $row["dob"]; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="gender">Gender:</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" id="gender" name="gender" required value="female" <?php if(isset($row["gender"]) && $row["gender"]=="female") echo "checked"; ?>>Female</label>
                            <label class="radio-inline">
                                <input type="radio" id="gender" name="gender" required value="male" <?php if(isset($row["gender"]) && $row["gender"]=="male") echo "checked"; ?>>Male</label>
                            <label class="radio-inline">
                                <input type="radio" id="gender" name="gender" required value="other" <?php if(isset($row["gender"]) && $row["gender"]=="other") echo "checked"; ?>>Other</label>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="sel1" class="control-label col-sm-3">Designation:</label>
                    <div class="col-sm-8">
                    <select class="form-control" name="post" id="sel1">
                      <option value="doctor" <?php if(isset($row["post"]) && $row["post"]=="doctor") echo "selected"; ?>>Doctor</option>
                      <option value="pharmacist" <?php if(isset($row["post"]) && $row["post"]=="pharmacist") echo "selected"; ?>>Pharmacist</option>
                      <option value="receptionist" <?php if(isset($row["post"]) && $row["post"]=="receptionist") echo "selected"; ?>>Receptionist</option>
                      <option value="office" <?php if(isset($row["post"]) && $row["post"]=="office") echo "selected"; ?>>Office Staff</option>
                    </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" name="update" class="btn btn-lg btn-success" >Update</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


              </td>
              <td>
                <a href="admin.php<?php echo "?del=".$row["id"];?>">
                  <button class="label label-danger btn btn-xs">Delete</button></a>
              </td>
              </tr>
              <?php
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="col-sm-6" style="padding-top: 8%; padding-right: 3%; padding-bottom: 3%">
    <div class="panel panel-danger" >
      <div class="panel-title">
          <h2 style="color: #66512c;"><center><b>Register Here</b></center></h2></div>
      <div class="panel-body">
      <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label class="control-label col-sm-3" for="name">Name:</label>
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
        </div>
      </form>
      </div>
    </div>
  </div>

</div>


