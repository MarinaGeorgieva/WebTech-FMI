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

    <script type="text/javascript" src="js/create-event.js"></script>
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
        			<li><a href="calendar.php">Календар</a></li>
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
        			<li class="active"><a href="create-event.php">Ново Събитие</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a href=""><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $currentUser->get_full_name(); ?></a></li>
        			<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Изход</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>
	<div class="container">
    	<form method="post">
			
			<input id="title" type="text" name="title" placeholder="Заглавие" class="form-control" required>
			<br>
			
			<!-- must be text area ! -->
			<input id="description" type="text" name="description" placeholder="Описание" class="form-control" required>
			<br>
			
			<input id="date" type="datetime-local" name="date" placeholder="Дата и час" class="form-control" required>
			<br>

			
			<select class="form-control" id="category" name="category">
          		<option value="lecture">Лекция</option>
          		<option value="homework">Домашно</option>
          		<option value="exam">Упражнение</option>
          		<option value="test">Контролно</option>
          		<option value="exercise">Проект</option>
          		<option value="external">Външно събитие</option>
        	</select>
        	<br>
			
			<input id="place" type="text" name="place" placeholder="Място" class="form-control">
			<br>
			<!-- add cancel button -->
			<input type="submit" value="Добави" class="btn btn-primary" id="btn-create">
		</form>
    </div>
    <footer>
    	<div class="container">
        	<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>