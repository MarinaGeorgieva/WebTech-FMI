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

if(isset($_SESSION['user']) && $type != "administrator") {
	redirect_to("index.php");
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
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>

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
    	<form method="post" class="form-horizontal" id="create-event-form">
    		<div class="form-group">
    			<label for="title" class="col-lg-2 control-label">Заглавие</label>
    			<div class="col-lg-10">
    				<input id="title" type="text" name="title" placeholder="Заглавие" class="form-control">
    			</div>
    		</div>
    		<div class="form-group">
      			<label for="description" class="col-lg-2 control-label">Описание</label>
      			<div class="col-lg-10">
        			<textarea class="form-control" rows="5" id="description" name="description" placeholder="Кратко описание за събитието..."></textarea>
      			</div>
    		</div>
    		<div class="form-group">
    			<label for="date" class="col-lg-2 control-label">Дата и час</label>
    			<div class="col-lg-10">
    				<input id="date" type="datetime-local" name="date" placeholder="Дата и час" class="form-control">
    			</div>
    		</div>
    		<div class="form-group">
    			<label for="category" class="col-lg-2 control-label">Категория</label>
      			<div class="col-lg-10">
      				<select class="form-control" id="category" name="category">
          				<option value="lecture">Лекция</option>
          				<option value="homework">Домашно</option>
          				<option value="exam">Упражнение</option>
          				<option value="test">Контролно</option>
          				<option value="exercise">Проект</option>
          				<option value="external">Външно събитие</option>
        			</select>
      			</div>
    		</div>
    		<div class="form-group">
    			<label for="place" class="col-lg-2 control-label">Място</label>
    			<div class="col-lg-10">
    				<input id="place" type="text" name="place" placeholder="Място" class="form-control">
    			</div>
    		</div>
			<div class="form-group">
      			<div class="col-lg-10 col-lg-offset-2">
        			<button type="reset" class="btn btn-default">Откажи</button>
        			<button type="submit" value="Добави" class="btn btn-primary" id="btn-create">Добави</button>
      			</div>
    		</div>
			<!-- add cancel button -->
			<!-- <input type="submit" value="Добави" class="btn btn-primary" id="btn-create"> -->
		</form>
    </div>
    <footer>
    	<div class="container">
        	<p class="text-center">&copy; Web Tech Course @ FMI 2016, Created By Marina</p>
      	</div>
    </footer>
</body>
</html>