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

	$password = md5($password);

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
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<header class="nav navbar-inverse navbar-fixed-top">
	</header>
	<div class="container">
		<div class="navbar-header">
			<a href="" class="navbar-brand">Event System</a>
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
		<form method="post">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" placeholder="Username" class="form-control" required>
			<br>
			<label for="password">Password</label>
			<input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
			<br>
			<label for="confirm-password">Confirm Password</label>
			<input id="confirm-password" type="password" name="confirm_password" placeholder="Confirm password" class="form-control" required>
			<br>
			<label for="first-name">First Name</label>
			<input id="first-name" type="text" name="first_name" placeholder="First Name" class="form-control" required>
			<br>
			<label for="last-name">Last Name</label>
			<input id="last-name" type="text" name="last_name" placeholder="Last Name" class="form-control" required>
			<br>
			<input type="submit" value="Register" class="btn btn-lg" name="btn-register">
		</form>
	</div>
	<footer>
		<p class="text-center">&copy; Web Tech Course @ FMI 2016</p>
	</footer>
</body>
</html>