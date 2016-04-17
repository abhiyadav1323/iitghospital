<br><br><br><br><br><br><br><br><br>
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
         $query2 = "SELECT * from patients WHERE roll='$id'";
                        $run1 = mysqli_query($conn,$query2);
                        $row2=mysqli_fetch_assoc($run1);
    }
      /*if(isset($_POST['done']))
        echo  "Diagnosis: ". $_POST["Diagnosis"] . "<br> Medicines " . $_POST["Medicine"] .  $_POST["Med1"] . $_POST["Med2"];*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diagnosis Page</title>
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
<div class="row" style="padding: 0px">
    <nav class="navbar navbar-inverse navbar-fixed-top" style="padding: 0px; height: 10%">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="staff_recep.php" style="font-size: xx-large; padding: 0px"><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-brand" href="logout.php?logout" style="font-size: large ; padding: 0px"><b>Logout</b></a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="small-box bg-yellow" style="padding: 0px">
            <div class="inner">
              <h4><?php echo ("Patient id :  ".$_SESSION['patient_id']);?></h4>
              <h4><?php echo ("Name :   ".$row2["name"]);?></h4>

              <h5><?php echo ("Gender : ". $row2["gender"]);?></h5>
              <h5><?php echo ("Date of Birth : ". $row2["dob"]);?></h5>
              <p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              Medical History <i class="fa fa-arrow-circle-right"></i>
            </a>
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