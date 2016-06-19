<?php
include_once '../includes/database.php';
include_once '../includes/utils.php';

session_start();
if(isset($_SESSION['user']) != "") {
	// header("Location: home.php");
	redirect_to("home.php");
}

if(isset($_POST['btn-signup'])) {
	$username = $connection->quote($_POST['username']);
	$firstName = $connection->quote($_POST['first_name']);
	$lastName = $connection->quote($_POST['last_name']);
	$password = md5($connection->quote($_POST['password']));

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
        	<script>alert('successfully registered ');</script>
        <?php
 	}
 	else {
 		?>
        	<script>alert('error while registering you...');</script>
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
	<center>
		<div id="login-form">
			<form method="post">
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" name="username" placeholder="Username" required /></td>
					</tr>
					<tr>
						<td><input type="text" name="first_name" placeholder="First Name" required /></td>
					</tr>
					<tr>
						<td><input type="text" name="last_name" placeholder="Last Name" required /></td>
					</tr>
					<tr>
						<td><input type="password" name="password" placeholder="Password" required /></td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
					</tr>
					<tr>
						<td><a href="index.php">Sign In Here</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>