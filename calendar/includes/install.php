<?php 

require_once 'database.php';

function seed_data() {
	seed_users();
}

function seed_users() {
	global $connection;
	$sql = "SELECT * FROM users";
	$query = $connection->prepare($sql);
	$query->execute();

	if ($query->rowCount() == 0) {
		add_user("admin", sha1("admin"), "Admin", "Admin", "administrator");
		add_user("janedoe", sha1("12345"), "Jane", "Doe", "user");
	}
}

function add_user($username, $password, $first_name, $last_name, $type) {
	global $connection;
	$sql = "INSERT INTO users(username, password, first_name, last_name, type) 
			VALUES (:username, :password, :first_name, :last_name, :type)";
	$query = $connection->prepare($sql);

	$query->bindParam(':username', $username);
	$query->bindParam(':password', $password);
	$query->bindParam(':first_name', $first_name);
	$query->bindParam(':last_name', $last_name);
	$query->bindParam(':type', $type);
	$result = $query->execute();
	
}

 ?>