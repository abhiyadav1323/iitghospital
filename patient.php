<?php
  session_start();
  include_once 'dbconnect.php';
  if(!isset($_SESSION['id']))
    header("Location: index.php");
   
    $id = $_SESSION["id"];
    $query = "SELECT * FROM patients WHERE id = '$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $dir='/var/www/html/patients/'.$row['username'].'/';
    $files = preg_grep('/^([^.])/', scandir($dir, 1));
    $name = $row['name'];
    $email = $row['email'];
    $dob = $row['dob'];
    $username = $row['username'];
    $phone = $row['phone'];
    $gender = $row['gender'];
?>

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
<body>
<div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top" style="height: 10%">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="staff_recep.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="row">
    <div class="col-sm-5" style="padding-top: 8%; padding-left: 10%">
        <!-- Profile Image -->
        <div class="panel panel-primary">
            <center><img src="<?php echo '/../patients/'.$row["username"].'/profile.jpg';?>" class="profile-user-img img-responsive img-circle" 
                style="height: 200px; width: 200px; padding-top: 3%"/></center>
            <div class="panel-title">
        <h2 style="color: #8a6d3b"><center><b>Profile</b></center></h2>
      </div>
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
                      <td><b>Phone:</b></td>
                      <td><?php echo ucfirst($row["phone"]); ?></td> 
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">
                    <div class="col-sm-12"><center>
                        <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#update">Update Details</button>
                    </center>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    
    <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Update Details</b></center></h2>
            </div><br>
            <form class="form-horizontal" role="form" action = "update.php" method="post">
              <div class="form-group">
                        <label class="control-label col-sm-3" for="nm">Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required value="<?php echo $name;?>" id="nm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="username">Username:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled name="username" required value="<?php echo $username;?>" id="username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" required value="<?php echo $email;?>" id="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="phone">Mobile:</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" value="<?php echo $phone;?>" required id="phone" >
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



    <div class="col-sm-5 pull-right" style="padding-top: 8%; padding-right: 10%">
        <!-- Profile Image -->
        <div class="panel panel-primary">
            <div class="panel-title">
        <h2 style="color: #8a6d3b"><center><b>Medical History</b></center></h2>
      </div>
            <div class="panel-body" style="overflow-y: scroll; height: 60vh;">
                <table class="table table-condensed">
                  <tbody>
                    <?php
                    if(count($files)==0)
                    {
                        ?>
                        <center><h4>No medical history found!!</h4></center>
                        <?php
                    }
                    for($i=0;$i<count($files);$i++)
                    {
                        ?>
                        <tr>
                            <td><?php echo $i+1; ?>.</td>
                            <td><?php echo $files[0]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>



</div>

</body>
</html>
