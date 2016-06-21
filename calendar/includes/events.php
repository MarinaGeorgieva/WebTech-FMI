<?php 

include_once 'database.php';

function get_all() {
	$sql = "SELECT * FROM events";
	$query = $connection->prepare($sql);
	$query->execute();
	$result = $query->fetchAll();
	
	return json_encode($result);
}

function get_by_id($id) {	
	$sql = "SELECT * FROM events WHERE id=:id";
	$query = $connection->prepare($sql);
	$query->bindParam(":id", $id);
	$query->execute();
	$result = $query->fetch();
	
	return json_encode($result);
}

function add($title, $description, $place, $date, $type) {
	$lastId = $connection->lastInsertId();

	$sql = "INSERT INTO events (title, description, place, date, type) 
		VALUES (:title, :description, :place, :date, :type)";
	$query = $connection->prepare($sql);
	$query->bindParam(":title", $title);
	$query->bindParam(":description", $description);
	$query->bindParam(":place", $place);
	$query->bindParam(":date", $date);
	$query->bindParam(":type", $type);
	$query->execute();

	$newId = $connection->lastInsertId();
	if ($newId != $lastId) {
		return "ok";
	}

	return "err";
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET["id"])) {
	$data = get_all();
	echo $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
	$id = $_GET["id"];
	$data = get_by_id($id);
	echo $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST["title"];
	$description = $_POST["description"];
	$place = $_POST["place"];
	$date = $_POST["date"];
	$type = $_POST["type"];

	$result = add($title, $description, $place, $date, $type);
	echo $result;
}



?>