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
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
  			<div class="navbar-header">
  		    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
  		      		<span class="sr-only">Toggle navigation</span>
  		      		<span class="icon-bar"></span>
  		      		<span class="icon-bar"></span>
  		      		<span class="icon-bar"></span>
  		    	</button>
  		    	<a class="navbar-brand" href="">Course Calendar</a>
  		  	</div>

    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      			<ul class="nav navbar-nav">
        			<li class="active"><a href="home.php">Home</a></li>
        			<li><a href="register.php">Register</a></li>
        			<li><a href="login.php">Login</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">     				
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container">
		<h1>Welcome to Course Calendar System</h1>
	</div>
	<footer>
		<p class="text-center">&copy; Web Tech Course @ FMI 2016</p>
	</footer>	
</body>
</html>