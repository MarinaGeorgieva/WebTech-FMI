<?php 

include_once '../database.php';
include_once '../user.php';
include_once '../utils.php';

session_start();

if(isset($_POST['btn-login'])) {
 	$username = trim($_POST['username']);
	$user_password = trim($_POST['password']);
  
  	$password = sha1($user_password);

  	$user = User::get_by_username($username);
  
  	if($user['password'] == $password) {    
    	echo "ok"; // log in
    	$_SESSION['user'] = $user['id'];
   	}
   	else{    
    	echo "Невалидно потребителско име или парола!"; // wrong details 
   	}
}

 ?>