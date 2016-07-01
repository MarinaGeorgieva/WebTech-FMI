<?php

include_once '../includes/database.php';
include_once '../includes/utils.php';

session_start();
if(isset($_SESSION['user']) != "") {
	redirect_to("home.php");
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

    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
	<div class="container">
    	<div class="row">
    		<h1 class="text-center welcome-title"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Course Calendar System</h1>
        	<div class="col-sm-6 col-md-4 col-md-offset-4">            	
            	<div class="account-wall">
            		<h5 class="text-center">Регистрaция</h5>                	
                	<form class="form-user" method="post" id="register-form">   
                		<div id="error"></div>             		
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
            				<button type="submit" id="btn-register" name="btn-register" class="btn btn-primary btn-block">Регистрaция</button>
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