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
    <link rel='stylesheet' href='lib/fullcalendar/fullcalendar.css' />

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
    <script src="lib/moment/moment.min.js"></script>
    <script src='lib/fullcalendar/fullcalendar.js'></script>
    <script src='lib/fullcalendar/lang/bg.js'></script>

    <script type="text/javascript" src="js/calendar.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
  		<div class="container-fluid">
  			<div class="navbar-header">
  		    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
  		      		<span class="sr-only">Toggle navigation</span>
  		      		<span class="icon-bar"></span>
  		      		<span class="icon-bar"></span>
  		      		<span class="icon-bar"></span>
  		    	</button>
  		    	<a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Course Calendar</a>
  		  	</div>

    		<div class="collapse navbar-collapse" id="navbar">
      			<ul class="nav navbar-nav">
        			<li><a href="home.php">Начало</a></li>
        			<li class="active"><a href="calendar.php">Календар</a></li>
        			<li class="dropdown">
          				<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Събития <span class="caret"></span></a>
          				<ul class="dropdown-menu" role="menu">
            				<li><a id="lecture" href="view-events.php?category=lecture">Лекции</a></li>
            				<li><a id="homework" href="view-events.php?category=homework">Домашни</a></li>
            				<li><a id="exercise" href="view-events.php?category=exercise">Упражнения</a></li>
            				<li><a id="test" href="view-events.php?category=test">Контролни</a></li>
            				<li><a id="project" href="view-events.php?category=project">Проекти</a></li>
            				<li class="divider"></li>
            				<li><a id="external" href="view-events.php?category=external">Външни събития</a></li>
          				</ul>
        			</li>
        			<?php 
        			if ($currentUser->get_type() == "administrator") {
        				echo '<li><a href="create-event.php">Ново Събитие</a></li>';
        			}

        			?>        			
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a href=""><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $currentUser->get_full_name(); ?></a></li>
        			<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Изход</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>
	<div class="container">
    	<div id="calendar"></div>
    </div>
	<div id="fullCalModal" class="modal fade">
    	<div class="modal-dialog">
    	    <div class="modal-content">
    	        <div class="modal-header">
    	            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                	<h4 id="modalTitle" class="modal-title"></h4>
                    <div id="eventId" class="hidden"></div>
            	</div>
            	<div id="modalBody" class="modal-body"></div>
            	<div class="modal-footer">
                    <button id="btn-unsubscribe" class="btn btn-primary" type="button">Премахни от календара</button>
            	    <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>            	    
            	</div>
        	</div>
    	</div>
	</div>
	<div>
		<input class="form-control hidden" id="username-hidden" type="text" value=<?php echo $currentUser->get_username(); ?>>
	</div>
	<footer>
    	<div class="container">
    		<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>