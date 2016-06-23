<?php

include_once '../includes/database.php';
include_once '../includes/user.php';
include_once '../includes/utils.php';

session_start();

if(!isset($_SESSION['user'])) {
	redirect_to("index.php");
}

$user_id = $_SESSION['user'];
$user = User::get_by_id($user_id);

$username = $user['username'];
$password = $user['password'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$type = $user['type'];

$currentUser = new User($username, $password, $first_name, $last_name, $type);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Course Calendar</title>

	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" xmlns="">

    <link rel="stylesheet" href="lib/bootstrap-3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel='stylesheet' href='lib/fullcalendar/fullcalendar.css' />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
    <script src="lib/moment/moment.min.js"></script>
    <script src='lib/fullcalendar/fullcalendar.js'></script>

    <script type="text/javascript" src="js/home.js"></script>
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
				<li><a href="">Hello, <?php echo $currentUser->get_full_name(); ?></a></li>
				<li><a href="logout.php?logout">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
    	<div id="calendar"></div>
    </div>
	<footer>
		<p class="text-center">&copy; Web Tech Course @ FMI 2016</p>
	</footer>
</body>
</html>

