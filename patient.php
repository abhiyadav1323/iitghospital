<!-- <br><br><br><br><br><br><br><br><br> -->
<?php
const METHOD = 'aes-256-cbc';
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
                <a class="navbar-brand" href="patient.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
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
            <div class="panel-body" style="overflow-y: scroll; height: 70vh;">
                <table class="table table-condensed">
                  <tbody>
                    <?php
                    if(count($files)==1)
                    {
                        ?>
                        <center><h4>No medical history found!!</h4></center>
                        <?php
                    }
                    for($i=0,$c=0;$i<count($files);$i++)
                    {
                        if(strpos($files[$i], 'jpg') === false)
                        {
                            $c++;
                        ?>
                        <tr>
                            <td><?php echo $c; ?>.</td>
                            <td><?php echo $files[$i]; ?></td>
                            <td><button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#view_med<?php echo $c; ?>">View</button>
                            <div id="view_med<?php echo $c; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog ">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span></button>
                                  <h2 style="color: #8a6d3b"><center><b>Medical Receipt</b></center></h2>
                                </div>
                                <?php
                                $file_name = $files[$i];
                                $file='/var/www/html/patients/'.$username.'/'.$file_name;
                                $fp = fopen( $file, "rb");
                                $med = fread($fp,filesize($file));
                                fclose($fp);
                                $key = $row['password'];
                                $med = json_decode($med, true);
                                $med['doctor'] = utf8_decode((string)$med['doctor']);
                                $ivsize = openssl_cipher_iv_length(METHOD);
                                $iv = mb_substr($med['doctor'], 0, $ivsize, '8bit');
                                $med['doctor'] = mb_substr($med['doctor'], $ivsize, null, '8bit');
                                $med['doctor'] = openssl_decrypt($med['doctor'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['date'] = utf8_decode($med['date']);
                                $med['date'] = mb_substr($med['date'], $ivsize, null, '8bit');
                                $med['date'] = openssl_decrypt($med['date'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['time'] = utf8_decode($med['time']);
                                $med['time'] = mb_substr($med['time'], $ivsize, null, '8bit');
                                $med['time'] = openssl_decrypt($med['time'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['number_of_medicines'] = utf8_decode($med['number_of_medicines']);
                                $med['number_of_medicines'] = mb_substr($med['number_of_medicines'], $ivsize, null, '8bit');
                                $med['number_of_medicines'] = openssl_decrypt($med['number_of_medicines'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['patient_username'] = utf8_decode($med['patient_username']);
                                $med['patient_username'] = mb_substr($med['patient_username'], $ivsize, null, '8bit');
                                $med['patient_username'] = openssl_decrypt($med['patient_username'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                $med['patient_name'] = utf8_decode($med['patient_name']);
                                $med['patient_name'] = mb_substr($med['patient_name'], $ivsize, null, '8bit');
                                $med['patient_name'] = openssl_decrypt($med['patient_name'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                for($j=0;$j<$med['number_of_medicines'];$j++) 
                                {
                                    $med['prescription'][$j]['name_of_medicine'] = utf8_decode($med['prescription'][$j]['name_of_medicine']);
                                    $med['prescription'][$j]['name_of_medicine'] = mb_substr($med['prescription'][$j]['name_of_medicine'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['name_of_medicine'] = openssl_decrypt($med['prescription'][$j]['name_of_medicine'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['quantity'] = utf8_decode($med['prescription'][$j]['quantity']);
                                    $med['prescription'][$j]['quantity'] = mb_substr($med['prescription'][$j]['quantity'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['quantity'] = openssl_decrypt($med['prescription'][$j]['quantity'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['frequency'] = utf8_decode($med['prescription'][$j]['frequency']);
                                    $med['prescription'][$j]['frequency'] = mb_substr($med['prescription'][$j]['frequency'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['frequency'] = openssl_decrypt($med['prescription'][$j]['frequency'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                    $med['prescription'][$j]['basic_information'] = utf8_decode($med['prescription'][$j]['basic_information']);
                                    $med['prescription'][$j]['basic_information'] = mb_substr($med['prescription'][$j]['basic_information'], $ivsize, null, '8bit');
                                    $med['prescription'][$j]['basic_information'] = openssl_decrypt($med['prescription'][$j]['basic_information'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
                                }
                                //var_dump($med);
                                ?>
                                <div class="modal-body" style="overflow-y: scroll; height: 60vh;">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <span class="text-right col-sm-6"><b>Doctor Name:</b></span>
                                            <span class="col-sm-6"><?php echo $med['doctor']; ?></span>
                                        </div>
                                        <div class="col-sm-12"> 
                                            <span class="text-right col-sm-6"><b>Date & Time:</b></span>
                                            <span class="col-sm-6"><?php echo $med["date"].' &'.$med["time"]; ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <span class="text-right col-sm-6"><b>Patient Username:</b></span>
                                            <span class="col-sm-6"><?php echo $med["patient_username"]; ?></span>
                                        </div>
                                        <div class="col-sm-12" style="padding-bottom: 2%">
                                            <span class="text-right col-sm-6"><b>Patient Name:</b></span>
                                            <span class="col-sm-6"><?php echo $med["patient_name"]; ?></span>
                                        </div>
                                        <hr style="border: solid">
                                        <table class="table table-condensed">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">S.No.</th>
                                                    <th class="text-center">Name of Medicine</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Frequency</th>
                                                    <th class="text-center">Basic Information</th>
                                                </tr>      
                                        <?php
                                            for($j=0;$j<$med['number_of_medicines'];$j++) 
                                            {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $j+1; ?></td>
                                                    <td class="text-center"><?php echo $med['prescription'][$j]['name_of_medicine']; ?></td>
                                                    <td class="text-center"><?php echo $med['prescription'][$j]['quantity']; ?></td>
                                                    <td class="text-center"><?php echo $med['prescription'][$j]['frequency']; ?></td>
                                                    <td class="text-center"><?php echo $med['prescription'][$j]['basic_information']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          </div>
                          </div>
                          </td>
                        </tr>
                        <?php
                        }
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
