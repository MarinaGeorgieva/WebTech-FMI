<?php

include_once '../includes/utils.php';

session_start();

if(!isset($_SESSION['user'])) {
	redirect_to("index.php");
}

if(isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	redirect_to("index.php");
}

?>