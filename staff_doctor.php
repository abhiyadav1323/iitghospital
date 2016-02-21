<?php
session_start();

if(!isset($_SESSION['id']))
    header("Location: index.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page - Doctor</title>
</head>
<body>
<div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top" style="height: 10%">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html" ><b>HOSPITAL - Indian Institute of Technology Guwahati</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php?logout">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="row" style="padding-top: 4%">
</div>
<h3>
    <?php echo "Hello Doctor. Your id is ".$_SESSION['id']; ?>
</h3>

</body>
</html>
