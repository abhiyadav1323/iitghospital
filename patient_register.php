<!-- <br><br><br><br><br><br><br><br><br> -->
<?php
session_start();
include_once 'dbconnect.php';

$name=$email=$phone=$dob=$gender=$username=$password=$cpassword="";
if(isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn,test_input($_POST['name']));
    $email = mysqli_real_escape_string($conn,test_input($_POST['email']));
    $dob = mysqli_real_escape_string($conn,test_input($_POST['dob']));
    $gender= mysqli_real_escape_string($conn,test_input($_POST['gender']));
    $phone = mysqli_real_escape_string($conn,test_input($_POST['phone']));
    $username = mysqli_real_escape_string($conn,test_input($_POST['username']));
    $cpassword = md5(mysqli_real_escape_string($conn,test_input($_POST['cpassword'])));
    $password = md5(mysqli_real_escape_string($conn,test_input($_POST['password'])));

    $dir = "/var/www/html/patients/";
    $f = $dir . $username . '/' . basename($_FILES["profile"]["name"]);
    $imageFileType = pathinfo($f,PATHINFO_EXTENSION);
    $file = $dir . $username . '/profile.' . $imageFileType;
    $check = getimagesize($_FILES["profile"]["tmp_name"]);

    $slquery = "SELECT * FROM patients WHERE username = '$username'";
    $selectresult = mysqli_query($conn,$slquery);
    // $query = "SELECT * FROM patients WHERE email = '$email'";
    // $result = mysqli_query($conn,$query);
    $sql="INSERT INTO patients (name, username, password, dob, phone, gender, email, file) VALUES ('$name', '$username', '$password', '$dob', '$phone', '$gender', '$email', '$file')";
    
    if(mysqli_num_rows($selectresult)>0)
    {
        $username="";
        ?>
        <script>alert('Username already exists');</script>
        <?php
    }
    
    else if($password != $cpassword)
    {
    ?>
      <script>alert('Password and Confirm password mismatch');</script>
    <?php
    }

    else if($check === false) {?>
        <script>alert("File is not an image.")</script>
        <?php
    
    } 
    
    else if ($_FILES["profile"]["size"] > 500000) {?>
        <script>alert('Sorry, your file is too large.')</script>
        <?php
    }
    
    else if($imageFileType != "jpg" ) {?>
        <script>alert('Sorry, only JPG files are allowed.')</script>
        <?php
    }

    else if(mysqli_query($conn,$sql))
    {
        $path = '/var/www/html/patients/'.$username.'/';
        mkdir($path);
        chmod($path, 0777);
        mkdir($path.'receipts/');
        chmod($path.'receipts/', 0777);
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $file)) {
            chmod($file, 0777);
            $slquery = "SELECT * FROM patients WHERE username = '$username'";
            $selectresult = mysqli_query($conn,$slquery);
            $row = mysqli_fetch_assoc($selectresult);
            $_SESSION['id'] = $row["id"];
            // echo $_SESSION['id'];
            header("Location: patient.php");
        } 
        else {?>
        <script>alert('Sorry, there was an error uploading your file.')</script>
        <?php
        $del_query = "DELETE FROM patients WHERE username = '$username'";
        $del_result = mysqli_query($conn,$del_query);
        }
    }
    else
    {
        $name=$email=$phone=$dob=$gender=$username=$password=$cpassword="";
        ?>
        <script>alert('Error while registering you...');</script>
        <?php
    }
}
else if(isset($_POST['reset']))
    $name=$email=$phone=$dob=$gender=$username=$password=$cpassword="";

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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            
        </div>
    </nav>
</div>
<div class="row" style="padding-top: 3%">
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6" style="padding-top: 5%; padding-bottom: 2%">
        <div class="panel panel-danger" >
            <div class="panel-title">
                <h2 style="color: #66512c;"><center><b>Register Here</b></center></h2></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="patient_register.php">
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
                        <label class="control-label col-sm-3" for="password">Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" required id="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="cpassword">Confirm Password:</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control" name="cpassword" required id="cpassword" >
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

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="dob">Profile Picture: (only .jpg files)</label>

                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="profile" required>
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
</body>
</html>