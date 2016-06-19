<?php
// require_once("../includes/database.php");
// require_once("../includes/user.php");

include_once '../includes/database.php';
include_once '../includes/user.php';
include_once '../includes/utils.php';

// if (isset($connection)) {
// 	echo "true";
// }
// else {
// 	echo "false";
// }
// echo "<br />";

// $found_user = User::get_by_id(1);
// $id = (int) $found_user['id'];
// $username = $found_user['username'];
// $password = $found_user['password'];
// $first_name = $found_user['first_name'];
// $last_name = $found_user['last_name'];
// $type = $found_user['type'];

// $user = new User($id, $username, $password, $first_name, $last_name, $type);
// echo $user->get_id();
// echo "<br>";
// echo $user->get_full_name();

// $username = "admin";
// $password = "admin";
// $firstName = "Admin";
// $lastName = "Admin";
// $type = "administrator";

// $statement = $connection->prepare('INSERT INTO users (username, password, first_name, last_name, type) 
// 	VALUES (:username, :password, :firstName, :lastName, :type)');

// $statement->bindParam(':username', $username);
// $statement->bindParam(':password', $password);
// $statement->bindParam(':firstName', $firstName);
// $statement->bindParam(':lastName', $lastName);
// $statement->bindParam(':type', $type);

// $resultult = $statement->execute();

// if($resultult) {
// 	echo "Success";
// } 
// else {
// 	echo ":(";
// }

session_start();

if(isset($_SESSION['user']) != "") {
	// header("Location: home.php");
	redirect_to("home.php");
}

if(isset($_POST['btn-login'])) {
	$username = $connection->quote($_POST['username']);
	$password = $connection->quote($_POST['password']);

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
	<center>
		<div id="login-form">
			<form method="post">
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" name="username" placeholder="Username" required /></td>
					</tr>
					<tr>
						<td><input type="password" name="password" placeholder="Password" required /></td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-login">Sign In</button></td>
					</tr>
					<tr>
						<td><a href="register.php">Sign Up Here</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>

?>