<!-- <br><br><br><br><br><br><br><br><br> -->
<?php 
    session_start();
    const METHOD = 'aes-256-cbc';
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
<script>
function checkNameValid(id)
{
    var elements = document.getElementsByClassName(id);
    
    var mediname =  elements[0].value;
    if(mediname)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(id).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "checkifexists.php?medname=" + mediname + "&quantity=" + "notrequired", true);
        xmlhttp.send(); 
    }
}

function checkQuantityValid(id)
{

    var elements = document.getElementsByClassName(id);
    
    var mediname =  elements[0].value;
    var quantity = elements[1].value;
    if(mediname&&quantity)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("q"+id).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "checkifexists.php?medname=" + mediname + "&quantity=" + quantity, true);
        xmlhttp.send(); 
    }
}

</script>

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
    <div class="col-sm-3" style="padding-top: 1%; padding-left: 3%">
    <!-- Profile Image -->
    <div class="panel panel-primary">
        <div class="panel-title">
    <h2 style="color: #8a6d3b"><center><b>Medical History</b></center></h2>
  </div>
        <div class="panel-body" style="overflow-y: scroll; height: 60vh;">
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
                        <td><button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#view_med<?php echo $c; ?>">View</button>
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
                                $file='/var/www/html/patients/'.$row["username"].'/'.$file_name;
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
                                $med['diagnosis'] = utf8_decode($med['diagnosis']);
                                $med['diagnosis'] = mb_substr($med['diagnosis'], $ivsize, null, '8bit');
                                $med['diagnosis'] = openssl_decrypt($med['diagnosis'],METHOD,$key,OPENSSL_RAW_DATA,$iv);
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
                                <div class="modal-body" style="overflow-y: scroll; height: 75vh;">
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
                                        <div class="col-sm-12">
                                            <span class="text-right col-sm-2 text-middle"><b>Diagnosis:</b></span>
                                            <span class="col-sm-10"><?php echo $med["diagnosis"]; ?></span>
                                        </div>
                                        <div class="col-sm-12" style="padding-bottom: 3%"></div>
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

    <div class="col-sm-9" style="padding-top: 1%; padding-right: 3%">
        <!-- Profile Image -->
        <div class="panel panel-primary">
            <div class="panel-title">
        <h2 style="color: #8a6d3b"><center><b>Prescription</b></center></h2>
      </div>
      <form class="form-horizontal" role="form" method="post" action="encryption.php">
            <div class="panel-body" style="overflow-y: scroll; height: 51vh;">
                <div class="col-sm-12">
                    <center><textarea type="text" name="diagnosis" rows="5" style="width: 80%" placeholder="Rx."></textarea></center>
                </div>
                    <table class="table table-condensed">
                        <tbody class="field_wrapper">
                            <a href="javascript:void(0);" class="add_button" title="Add field">
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-plus"></i></button></a>
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th class="text-center">Name of Medicine</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Frequency</th>
                                <th class="text-center">Basic Information</th>
                            </tr>                            
                        </tbody>
                    </table>
            </div>
                <div class="form-group">
                    <div class="col-sm-12"><center>
                        <button type="submit" name="submit" class="btn btn-lg btn-success">Submit</button>
                    </center></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
    var addButton = $('.add_button'); 
    var fwrapper = $('.field_wrapper');  
    var fieldHTML;
    var x = 0; 
    $(addButton).click(function(){ //Once add button is clicked
            x++; //Increment the  field counter
            fieldHTML ='<tr>'+
    '<td class="text-center">'+x+'</td>'+
    '<td  class="text-center"><input type="text" class="'+x+'" name="Med[name_med][]" onblur="checkNameValid(this.className)"><span id="'+x+'"></span></td>'+
    '<td  class="text-center"><input type="number" class="'+x+'" name="Med[quantity_med][]" onblur="checkQuantityValid(this.className)"><span id="q'+x+'"></span></td>'+
    '<td  class="text-center"><input type="text" class="'+x+'" name="Med[frequency_med][]"></td>'+
    '<td  class="text-center"><textarea type="text" class="'+x+'" name="Med[info_med][]"></textarea></td>'+
    '</tr>';
            $(fwrapper).append(fieldHTML); // Add field html

    });
});
</script>

<!--  bootstrap style  -->















 


