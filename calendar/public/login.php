<?php

include_once '../includes/database.php';
include_once '../includes/user.php';
include_once '../includes/utils.php';

session_start();

if(isset($_SESSION['user']) != "") {
	redirect_to("home.php");
}

if(isset($_POST['btn-login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user = User::get_by_username($username);

	if($user['password'] == md5($password)) {
		$_SESSION['user'] = $user['id'];
		redirect_to("home.php");
	}
	else {
  		?>
        	<script>alert('Invalid username or password');</script>
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
		<form method="post">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" placeholder="Username" class="form-control" required>
			<br>
			<label for="password">Password</label>
			<input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
			<br>
			<input type="submit" value="Login" class="btn btn-lg" name="btn-login">
		</form>
	</div>
	<footer>
		<p class="text-center">&copy; Web Tech Course @ FMI 2016</p>
	</footer>
</body>
</html>