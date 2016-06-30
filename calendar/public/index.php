<?php

include_once '../includes/utils.php';
include_once '../includes/install.php';

seed_data();  

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
    <link href='https://fonts.googleapis.com/css?family=Arimo|Roboto|Nunito' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- <div class="signin-form">
 		<div class="container">   
        	<form class="form-signin" method="post" id="login-form">
				<h2 class="form-signin-heading">Log In to WebApp.</h2>
				<div id="error">error will be shown here!</div>        
        		<div class="form-group">
        			<input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
        			<span id="check-e"></span>
        		</div>        
        		<div class="form-group">
        			<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        		</div>              
        		<div class="form-group">
            		<button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   					</button> 
        		</div>  
        	</form>
    	</div>
    </div> -->
	<nav class="navbar navbar-default">
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
    	<div class="container">
        	<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>