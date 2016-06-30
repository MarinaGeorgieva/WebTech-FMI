<?php 

include_once '../database.php';
include_once '../utils.php';

function get_all($username) {
	global $connection;
	$sql = "SELECT * FROM events e
			WHERE e.id NOT IN (SELECT eu.event_id
                  			   FROM events_users eu
                  			   WHERE eu.username=:username AND eu.subscribed=0);";
	$query = $connection->prepare($sql);
	$query->bindParam(":username", $username);
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

function get_by_category($category) {
	global $connection;	
	$sql = "SELECT * FROM events WHERE category=:category";
	$query = $connection->prepare($sql);
	$query->bindParam(":category", $category);
	$query->execute();
	$data = array();

	while($row=$query->fetch(PDO::FETCH_ASSOC)){
		$data["events"][] = $row;
	}
	
	return json_encode($data);
}

function create($title, $description, $category, $place, $date) {
	global $connection;
	$lastId = $connection->lastInsertId();

	$sql = "";
	if (is_null($date)) {
		$sql = "INSERT INTO events (title, description, category, place, date) 
		VALUES (:title, :description, :category, :place, now())"; 
		$query = $connection->prepare($sql);
	}
	else {
		$sql = "INSERT INTO events (title, description, category, place, date) 
		VALUES (:title, :description, :category, :place, :date)";
		$query = $connection->prepare($sql);
		$query->bindParam(":date", $date);
	}
	
	$query->bindParam(":title", $title);
	$query->bindParam(":description", $description);
	$query->bindParam(":category", $category);
	$query->bindParam(":place", $place);
	$query->execute();

	$newId = $connection->lastInsertId();
	if ($newId != $lastId) {
		return "ok";
	}

	return "err";
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET["id"]) && isset($_GET["user"])) {
	$data = get_all($_GET["user"]);
	echo $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
	$id = $_GET["id"];
	$data = get_by_id($id);
	echo $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["category"])) {
	$category = $_GET["category"];
	$data = get_by_category($category);
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

	if (!isset($event->category)) {
		echo "err";
	}

	$title = $event->title;
	$description = $event->description;
	$category = $event->category;
	$place = isset($event->place) ? $event->place : null;
	$date = isset($event->date) ? $event->date : null;

	$result = create($title, $description, $category, $place, $date);
	echo $result;
}

?>