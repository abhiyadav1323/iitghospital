<?php
session_start();

if(!isset($_SESSION['id']))
	header("Location: temp.html");

echo "Hello ".$_SESSION['id'];
?>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<a href="logout.php?logout">Logout</a>
</body>
</html>
