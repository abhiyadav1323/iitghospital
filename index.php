<!DOCTYPE html>
<html lang="en">
<head>
	<title>IITG Hospital</title>

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

<body background="hospital_photos/small_5.jpg" style="background-repeat: no-repeat; background-attachment: fixed; background-size: cover">
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

<?php
  if(isset($_GET['err']))
  {
    if($_GET['err']==1)
    {
      ?>
      <script>alert('Error while logging you in')</script>
      <?php
    }
  }
?>

<div class="row">

  <div class="col-sm-4" style="padding-left: 6%; padding-top: 12%">
    <div class="panel panel-primary">
        <div class="panel-title">
            <h2 style="color: #8a6d3b"><center><b>Admin Login</b></center></h2>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="login.php">
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input type="password" class="form-control" placeholder="Enter admin key" name="admin_key" required id="admin_key">
                    </div>
                </div>
                <input type="hidden" value="admin" name="post" />
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" name="login" class="btn btn-lg btn-success">Login</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
  </div>





    <div class="col-sm-4 pull-right" style="padding-right: 6%; padding-top: 8%">

      <div class="panel panel-success">
        <div class="panel-body">
            <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#receptionist">
              Login for Receptionist</button>
            <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#doctor">
              Login for Doctor</button>
            <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#pharmacist">
              Login for Pharmacist</button>
              <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#office">
              Login for Office Staff</button>
              <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#patient">
              Login for Patients</button><br>
              <a href="patient_register.php">
              <button type="button" class="btn btn-block btn-warning btn-lg">
              Registration for Patients</button></a>
        
      </div>
        </div>

      <div id="receptionist" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Login for Receptionist</b></center></h2>
            </div>
            <form class="form-horizontal" role="form" action = "login.php" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="username1">Username:</label>
                  <div class="col-sm-8">
                    <input type="username" class="form-control" name="username" id="username1" placeholder="Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pwd1">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="pwd1" placeholder="Enter password" required>
                  </div>
                </div>
                <input type="hidden" value="receptionist" name="post" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-lg btn-success" >Login</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div id="doctor" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Login for Doctor</b></center></h2>
            </div>
            <form class="form-horizontal" role="form" action = "login.php" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="username2">Username:</label>
                  <div class="col-sm-8">
                    <input type="username" class="form-control" name="username" id="username2" placeholder="Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pwd2">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="pwd2" placeholder="Enter password" required>
                  </div>
                </div>
                <input type="hidden" value="doctor" name="post" />
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-lg btn-success" >Login</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div id="pharmacist" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Login for Pharmacist</b></center></h2>
            </div>
            <form class="form-horizontal" role="form" action = "login.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="username">Username:</label>
                  <div class="col-sm-8">
                    <input type="username" class="form-control" name="username" id="username" placeholder="Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pwd">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" required>
                  </div>
                </div>
              <input type="hidden" value="pharmacist" name="post" />
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-lg btn-success" >Login</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div id="office" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Login for Office Staff</b></center></h2>
            </div>
            <form class="form-horizontal" role="form" action = "login.php" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="username1">Username:</label>
                  <div class="col-sm-8">
                    <input type="username" class="form-control" name="username" id="username1" placeholder="Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pwd1">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="pwd1" placeholder="Enter password" required>
                  </div>
                </div>
                <input type="hidden" value="office" name="post" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-lg btn-success" >Login</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div id="patient" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: #8a6d3b"><center><b>Login for Patients</b></center></h2>
            </div>
            <form class="form-horizontal" role="form" action = "login.php" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="username1">Username:</label>
                  <div class="col-sm-8">
                    <input type="username" class="form-control" name="username" id="username1" placeholder="Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pwd1">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="pwd1" placeholder="Enter password" required>
                  </div>
                </div>
                <input type="hidden" value="patient" name="post" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-lg btn-success" >Login</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



    </div>
  </div>
</body>
</html>