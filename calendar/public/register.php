<?php

include_once '../includes/database.php';
include_once '../includes/utils.php';

session_start();
if(isset($_SESSION['user']) != "") {
	redirect_to("home.php");
}

if(isset($_POST['btn-register'])) {
	$username = $_POST['username'];
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirm_password'];

	if ($password != $confirmPassword) {
		?>
		<script>alert('Password and confirm password do not match!')</script>
		<?php
		redirect_to("register.php");
	}

	$password = sha1($password);

	$sql = "INSERT INTO users (username, password, first_name, last_name) 
		VALUES (:username, :password, :first_name, :last_name)";
	$query = $connection->prepare($sql);

	$query->bindParam(':username', $username);
	$query->bindParam(':password', $password);
	$query->bindParam(':first_name', $firstName);
	$query->bindParam(':last_name', $lastName);


	$is_successful = $query->execute();
	echo $is_successful;

	if($is_successful) {
		?>
        <script>alert('Successfully registered!');</script>
        <?php
 	}
 	else {
 		?>
        <script>alert('Username is taken!');</script>
        <?php
 	}
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
	<!-- <nav class="navbar navbar-default">
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
        			<li><a href="home.php">Home</a></li>
        			<li class="active"><a href="register.php">Register</a></li>
        			<li><a href="login.php">Login</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">     				
      			</ul>
    		</div>
  		</div>
	</nav>
	<div class="container">
		<form method="post">
			<label for="username" class="control-label">Username</label>
			<input id="username" type="text" name="username" placeholder="Username" class="form-control" required>
			<br>
			<label for="password" class="control-label">Password</label>
			<input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
			<br>
			<label for="confirm-password" class="control-label">Confirm Password</label>
			<input id="confirm-password" type="password" name="confirm_password" placeholder="Confirm password" class="form-control" required>
			<br>
			<label for="first-name" class="control-label">First Name</label>
			<input id="first-name" type="text" name="first_name" placeholder="First Name" class="form-control" required>
			<br>
			<label for="last-name" class="control-label">Last Name</label>
			<input id="last-name" type="text" name="last_name" placeholder="Last Name" class="form-control" required>
			<br>
			<input type="submit" value="Register" class="btn btn-primary" name="btn-register">
		</form>
	</div> -->

	<div class="container">
    	<div class="row">
    		<h1 class="text-center welcome-title"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Course Calendar System</h1>
        	<div class="col-sm-6 col-md-4 col-md-offset-4">            	
            	<div class="account-wall">
            		<h5 class="text-center">Регистрaция</h5>                	
                	<form class="form-user" method="post">                		
          				<div class="form-group">	
            				<input id="username" class="form-control" type="text" name="username" placeholder="Потребителско име" required />          
          				</div>
          				<div class="form-group">
            				<input id="password" class="form-control" type="password" name="password" placeholder="Парола" required />   
          				</div>
          				<div class="form-group">
            				<input id="confirm-password" type="password" name="confirm_password" placeholder="Потвърдете паролата" class="form-control" required>   
          				</div>
          				<div class="form-group">
            				<input id="first-name" type="text" name="first_name" placeholder="Име" class="form-control" required>   
          				</div>
          				<div class="form-group">
            				<input id="last-name" type="text" name="last_name" placeholder="Фамилия" class="form-control" required>
          				</div>
          				<div class="form-group">
            				<button type="submit" name="btn-register" class="btn btn-primary btn-block">Регистрaция</button>
          				</div>
                	</form>
            	</div>
        	</div>
    	</div>
	</div>
	<footer>
    	<div class="container">
        	<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>