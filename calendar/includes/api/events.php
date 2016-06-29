<?php 

include_once '../database.php';
include_once '../utils.php';

function get_all() {
	global $connection;
	$sql = "SELECT * FROM events";
	$query = $connection->prepare($sql);
	$query->execute();
	$data = array();

	while($row=$query->fetch(PDO::FETCH_ASSOC)){
		$data["events"][] = $row;
	}
	
	return json_encode($data);
}

function get_by_id($id) {
	global $connection;	
	$sql = "SELECT * FROM events WHERE id=:id";
	$query = $connection->prepare($sql);
	$query->bindParam(":id", $id);
	$query->execute();
	$data = array();

	while($row=$query->fetch(PDO::FETCH_ASSOC)){
		$data["events"][] = $row;
	}
	
	return json_encode($data);
}

function create($title, $description, $type, $place, $date) {
	global $connection;
	$lastId = $connection->lastInsertId();

	$sql = "";
	if (is_null($date)) {
		$sql = "INSERT INTO events (title, description, type, place, date) 
		VALUES (:title, :description, :type, :place, now())"; 
		$query = $connection->prepare($sql);
	}
	else {
		$sql = "INSERT INTO events (title, description, type, place, date) 
		VALUES (:title, :description, :type, :place, :date)";
		$query = $connection->prepare($sql);
		$query->bindParam(":date", $date);
	}
	
	$query->bindParam(":title", $title);
	$query->bindParam(":description", $description);
	$query->bindParam(":type", $type);
	$query->bindParam(":place", $place);
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

	if (!isset($event->title)) {
		echo "err";
	}

	if (!isset($event->description)) {
		echo "err";
	}

	if (!isset($event->type)) {
		echo "err";
	}

	$title = $event->title;
	$description = $event->description;
	$type = $event->type;
	$place = isset($event->place) ? $event->place : "NULL";
	$date = isset($event->date) ? $event->date : null;

	$result = create($title, $description, $type, $place, $date);
	echo $result;
}

?>