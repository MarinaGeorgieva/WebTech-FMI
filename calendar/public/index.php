<?php

include_once '../includes/utils.php';  

session_start();

if(isset($_SESSION['user']) != "") {
	redirect_to("home.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Course Calendar</title>

	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" xmlns="">

    <link rel="stylesheet" href="lib/bootstrap-3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<header class="nav navbar-inverse navbar-fixed-top">
	</header>
	<div class="container">
		<div class="navbar-header">
			<a href="" class="navbar-brand">Course Calendar</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="">Home</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<h1>Welcome to Course Calendar System</h1>
	</div>
	<footer>
		<p class="text-center">&copy; Web Tech Course @ FMI 2016</p>
	</footer>	
</body>
</html>