<!--
****************************************************************************************************
                                    Web App for IITG Hospital
                                    -------------------------
            The software intends at automating the working of the IITG hospital to ensure 
            that the patient can be given a great experience while visiting the hospital 
            and is given medicines which correspond to the diagnosis.
            Copyright © 2016, team1cs243.
****************************************************************************************************
-->


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
        $del_query = "DELETE FROM queue WHERE id = '$del'";
        $del_result = mysqli_query($conn,$del_query);
        //echo $del_result;
      }
    if(isset($_POST['register']))
    {
        $idofpatient = mysqli_real_escape_string($conn,test_input($_POST['username']));
        //echo $idofpatient;
        $query = "SELECT * FROM patients WHERE username = '$idofpatient'";
        $result = mysqli_query($conn,$query);
        $row_cnt = mysqli_num_rows($result);
        if($row_cnt==0)
        {
            ?>
            <script>alert('The username is invalid!');</script>
            <?php
        }
        else
        {
            $_SESSION['patient_id']=$idofpatient;
            header("Location: view_details.php");
        }
    }
    function test_input($data) 
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } 
  $id=$_SESSION['id'];
$slquery="SELECT * from staff WHERE id='$id'";
$query_run = mysqli_query($conn,$slquery);
$row=mysqli_fetch_assoc($query_run);
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
<body><div class="row">
    <nav class="navbar navbar-default navbar-fixed-top">
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
<div class="row" style="padding-top: 5%; padding-bottom: 1%">
    <div class="col-sm-12"><center>
        <h1><label class="label label-info"><?php echo 'Hello,'.' '.$row['name']; ?></label></h1>
    </center></div>
</div>

<div class="row" style="padding-top: 1%">
    <div class="col-sm-4" style="padding-left: 3%">
        <div class="panel panel-primary">
            <div class="panel-title">
                <h2 style="color: #8a6d3b"><center><b>List of Doctors</b></center></h2>
            </div>
            <!-- /.box-header -->
            <div class="panel-body" style="overflow-y: scroll; height: 60vh;">
                <ul class="todo-list ui-sortable table-striped">
                    <?php
                        $post="doctor";
                        $slquery="SELECT * from staff WHERE post='$post'";
                        $query_run = mysqli_query($conn,$slquery);
                        $count = mysqli_num_rows($query_run);
                        $i=0;
                        while($row=mysqli_fetch_assoc($query_run))
                        {
                            $i+=1;?>
                            <li>
                                <span class="handle">
                                    <?php echo $i;?>.
                                </span>
                                <span class="text">
                                    <?php echo $row["name"]; ?>
                                </span>
                                <button class="label label-primary pull-right btn btn-xs btn-success" data-toggle="modal" data-target="#mod<?php echo $i;?>">View Queue</button>

                                <div id="mod<?php echo $i;?>" class="modal fade" style="vertical-align: middle" role="dialog">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span></button>
                                                <h2 style="color: #8a6d3b"><center><b>Upcoming Patients</b></center></h2>
                                            </div>
                                            <div class="modal-body" style="overflow-y: scroll; height: 60vh;">
                                                <div class="row">
                                                    <div class="col-sm-offset-2 col-sm-8">
                                                        <div class="panel panel-danger">
                                                            <div class="panel-body">
                                                                <table class="table table-condensed">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>Username</th>
                                                                        <th class="text-center">Name of Patient</th>
                                                                    </tr>
                                                                    <?php
                                                                    $name=$row["name"];
                                                                    $query1 = "SELECT * from queue WHERE name='$name'";
                                                                    $run = mysqli_query($conn,$query1);
                                                                    while($row1=mysqli_fetch_assoc($run))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $row1['pid'];?></td>
                                                                            <?php
                                                                            $id=$row1["pid"];
                                                                            $query2 = "SELECT * from patients WHERE username='$id'";
                                                                            $run1 = mysqli_query($conn,$query2);
                                                                            $row2=mysqli_fetch_assoc($run1);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $row2["name"]; ?></td>
                                                                            <td><a href="staff_recep.php<?php echo "?del=".$row1["id"];?>">
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
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            </li>


                    <?php
                        }
                    ?>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>

    </div>

    <div class="col-sm-4" >
        <div class="panel panel-primary">
            <div class="panel-title">
               <h2 style="color: #8a6d3b"><center><b>Search by Name</b></center></h2>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="staff_recep.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="roll">Part of Name:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="partofname" id="roll">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" name="reset" class="btn btn-lg btn-danger pull-left">Reset</button>
                            <button type="submit" name="search" class="btn btn-lg btn-success pull-right">Search</button>
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['search']))
                {
                    $tobesearched = mysqli_real_escape_string($conn,test_input($_POST["partofname"]));
                    $query = "SELECT * from patients WHERE name LIKE '%$tobesearched%'";
                    $query_run = mysqli_query($conn,$query);
                    if(!$query_run)
                        $err = 'The query is invalid!' . ' ' . mysql_error() . ' ' . $query;
                    $row_cnt = mysqli_num_rows($query_run);
                    if($row_cnt)
                    {
                    ?>
                        <br>
                        <div class="panel panel-danger">
                            <div class="panel-body" style="overflow-y: scroll; height: 30vh;">
                        <table class="table table-condensed">
                        <tbody>
                    <tr>
                        <th>
                            S. No.
                        </th>
                        <th>
                            Name of Patient
                        </th>
                        <th>
                            Username
                        </th>
                    </tr>
                        <?php
                        $j=0;
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            $j+=1;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $j;?>.
                                </td>
                                <td>
                                    <?php echo $row["name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["username"]; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                                </div>
                            </div>
                        <?php
                    }
                    else
                    {
                        ?>
                <ul class="todo-list ui-sortable table-striped">
                        <li><?php echo "No such person!";?></li>
                    </ul>
                        <?php
                    }
                }

                ?>

            </div>
        </div>
    </div>
<div class="col-sm-4 " style="padding-right: 3%">
    <div class="panel panel-primary">
        <div class="panel-title">
            <h2 style="color: #8a6d3b"><center><b>Search by ID</b></center></h2>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="staff_recep.php">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Patient Username:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="username" required id="username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" name="register" class="btn btn-lg btn-success">View Details</button>
                    </div>
                </div>
                
            </form>
        </div>

    </div>
</div>
</div>

</body>
</html>
