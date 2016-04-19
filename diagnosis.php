<!-- <br><br><br><br><br><br><br><br><br> -->
<?php 
    session_start();
    include_once 'dbconnect.php';
    if(!isset($_SESSION['id']))
        header("Location: index.html");
    if(!isset($_SESSION['patient_id']))
        header("Location: staff_doctor.php");
    else
    {
        $id=$_SESSION['patient_id'];
        $query = "SELECT * from patients WHERE username='$id'";
        $run = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($run);
        $dir='/var/www/html/patients/'.$row['username'].'/';
        $files = preg_grep('/^([^.])/', scandir($dir, 1));
    }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diagnosis Portal</title>
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
                <a class="navbar-brand" href="staff_doctor.php" style="font-size: xx-large"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="row">
    <div class="col-sm-8 col-sm-offset-2" style="padding-top: 7%">
        <div class="panel panel-success">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>Patient Details</b></center></h2>
            </div>
            <div class="panel-body">
                <div class="col-sm-5" style="padding-top: 2%">
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Username:</b></span>
                        <span class="col-sm-6"><?php echo $row["username"]; ?></span>
                    </div>
                    <div class="col-sm-12"> 
                        <span class="text-right col-sm-6"><b>Patient Name:</b></span>
                        <span class="col-sm-6"><?php echo $row["name"]; ?></span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Email:</b></span>
                        <span class="col-sm-6"><?php echo $row["email"]; ?></span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Gender:</b></span>
                        <span class="col-sm-6"><?php echo ucfirst($row["gender"]); ?></span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Phone:</b></span>
                        <span class="col-sm-6"><?php echo $row["phone"]; ?></span>
                    </div>
                    <div class="col-sm-12">
                        <span class="text-right col-sm-6"><b>Date of Birth:</b></span>
                        <span class="col-sm-6"><?php echo date_format(date_create($row["dob"]), 'd/m/Y'); ?></span>
                    </div>
                </div>
                <div class="pull-right col-sm-3">
                    <center><img src="<?php echo '/../patients/'.$row["username"].'/profile.jpg';?>" class="profile-user-img img-responsive img-circle" 
                style="height: 150px; width: 150px;"/></center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4" style="padding-top: 1%; padding-left: 3%">
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

    <div class="col-sm-8" style="padding-top: 1%; padding-right: 3%">
        <!-- Profile Image -->
        <div class="panel panel-primary">
            <div class="panel-title">
        <h2 style="color: #8a6d3b"><center><b>Diagnosis</b></center></h2>
      </div>
            <div class="panel-body" style="overflow-y: scroll; height: 60vh;">
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</div>






















 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <form action = "diagnosis.php"  method="POST" id = "form1">
 <label for="Diagnosis">Diagnosis</label>
<textarea class="form-control" rows="5" placeholder="Rx." id = "Diagnosis" name = "Diagnosis"></textarea>


<div class="field_wrapper">
    <div>
    <label for="Med[]">Medicines: </label>
        <input  placeholder="Prescription" type="text" size = "100" name = "Med[]" value = ""/>
                      
        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" height="50" width="50" /></a>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var max = 25; 
    var addButton = $('.add_button'); 
    var fwrapper = $('.field_wrapper'); 
    var x = 1; 
    var fieldHTML = '<div><label for="Med[]">Medicines: </label> <input placeholder="Prescription" type="text" size = "100" name="Med[]" value ="" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png" height="30" width="30"/></a></div>'; //New input field html for when add button is clicked
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < max){ //Check maximum number of input fields if not exceeded
            x++; //Increment field counter
            $(fwrapper).append(fieldHTML); // Add field html
        }
    });
    $(fwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<button type="submit" form="form1" value="Submit" name = "done">Submit</button>
</form>
<?php
if(isset($_POST['done'])){
$field_values_array = $_POST['Med'];
foreach($field_values_array as $value){
  echo " Medices $value <br>" ; 
}
}


?>