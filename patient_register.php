<?php
session_start();

if(!isset($_SESSION['id']))
{
    header("Location: index.html");
}
include_once 'dbconnect.php';

$name=$email=$phone=$dob=$gender=$roll="";
if(isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn,test_input($_POST['name']));
    $email = mysqli_real_escape_string($conn,test_input($_POST['email']));
    $dob = mysqli_real_escape_string($conn,test_input($_POST['dob']));
    $gender= mysqli_real_escape_string($conn,test_input($_POST['gender']));
    $phone = mysqli_real_escape_string($conn,test_input($_POST['phone']));
    $roll = mysqli_real_escape_string($conn,test_input($_POST['roll']));

    $slquery = "SELECT * FROM patients WHERE roll = '$roll'";
    $selectresult = mysqli_query($conn,$slquery);
    $query = "SELECT * FROM patients WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    $sql="INSERT INTO patients (name, dob, roll, phone, gender, email) VALUES ('$name', '$dob', '$roll', '$phone', '$gender', '$email')";
    if(mysqli_num_rows($selectresult)>0)
    {
        $roll="";
        ?>
        <script>alert('Roll number already exists');</script>
        <?php
    }
    
    else if(mysqli_num_rows($result)>0)
    {
        $email="";
        ?>
        <script>alert('Email already exists');</script>
        <?php
    }
    else if(mysqli_query($conn,$sql))
    {
        header("Location: staff_recep.php");
    }
    else
    {
        $name=$email=$phone=$dob=$gender=$roll="";
        ?>
        <script>alert('Error while registering you...');</script>
        <?php
    }
}
else if(isset($_POST['reset']))
    $name=$email=$phone=$dob=$gender=$roll="";

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
    <title>Registration - Patients</title>
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
                <form class="form-horizontal" role="form" method="post" action="patient_register.php">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nm">Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required value="<?php echo $name;?>" id="nm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="roll">Roll No.:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="roll" required value="<?php echo $roll;?>" id="roll" />
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
                        <label class="control-label col-sm-6">Already Registered?</label>
                        <label class="control-label">
                            <a href="staff_recep.php">Take Appointment Here</a>
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