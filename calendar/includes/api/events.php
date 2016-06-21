<?php 

include_once '../database.php';

function get_all() {
	global $connection;
	$sql = "SELECT * FROM events";
	$query = $connection->prepare($sql);
	$query->execute();
	$result = $query->fetchAll();
	
	return json_encode($result);
}

function get_by_id($id) {
	global $connection;	
	$sql = "SELECT * FROM events WHERE id=:id";
	$query = $connection->prepare($sql);
	$query->bindParam(":id", $id);
	$query->execute();
	$result = $query->fetch();
	
	return json_encode($result);
}

function create($title, $description, $type) {
	global $connection;
	$lastId = $connection->lastInsertId();

	$sql = "INSERT INTO events (title, description, type) 
		VALUES (:title, :description, :type)";
	$query = $connection->prepare($sql);
	$query->bindParam(":title", $title);
	$query->bindParam(":description", $description);
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
	$json = file_get_contents('php://input');
	$event = json_decode($json);

	$title = $event->title;
	$description = $event->description;
	$type = $event->type;

	$result = create($title, $description, $type);
	echo $result;
}

?>