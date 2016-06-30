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
    <link href='https://fonts.googleapis.com/css?family=Arimo|Roboto|Nunito' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
    <script src="lib/moment/moment.min.js"></script>

    <script type="text/javascript" src="js/view-events.js"></script>
</head>
<body>
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
        			<li><a href="home.php">Home</a></li>
        			<li><a href="">Calendar</a></li>
        			<li class="dropdown active">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Events <span class="caret"></span></a>
          				<ul class="dropdown-menu" role="menu">
            				<li><a id="lecture" href="view-events.php?category=lecture">Lectures</a></li>
            				<li><a id="homework" href="view-events.php?category=homework">Homeworks</a></li>
            				<li><a id="exercise" href="view-events.php?category=exercise">Exercises</a></li>
            				<li><a id="test" href="view-events.php?category=test">Tests</a></li>
            				<li><a id="project" href="view-events.php?category=project">Projects</a></li>
            				<li class="divider"></li>
            				<li><a id="external" href="view-events.php?category=external">External Events</a></li>
          				</ul>
        			</li>
        			<!-- <li><a href="events.php">Events</a></li> -->
        			<?php 
        			if ($currentUser->get_type() == "administrator") {
        				echo '<li><a href="create-event.php">New Event</a></li>';
        			}

        			?>        			
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a href="">Hello, <?php echo $currentUser->get_full_name(); ?></a></li>
        			<li><a href="logout.php?logout">Logout</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container">
		<div class="list-group">  			
		</div>
	</div>

	<footer>
    	<div class="container">
    		<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>