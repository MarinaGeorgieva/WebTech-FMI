<?php

require_once '../database.php';

function unsubscribe($username, $event_id) {
	global $connection;
	$sql = "SELECT * FROM events_users 
			WHERE username=:username AND event_id=:event_id";
	$query = $connection->prepare($sql);
    $query->bindParam(':username', $username);
    $query->bindParam(':event_id', $event_id);
    $query->execute();    
    $count = $query->rowCount();

    $result = '';

    if ($count == 0) {
        $sql = "INSERT INTO events_users (event_id, username, subscribed) 
                VALUES (:event_id, :username, 0)";
        $query = $connection->prepare($sql);
        $query->bindParam(':event_id', $event_id);
        $query->bindParam(':username', $username);

        if($query->execute()) {
            $result = "unsubscribed";
        }
        else {
            $result = "Не успяхте да премахнете събитието от календара";
        }
    }
    else {
        $sql = "UPDATE events_users SET subscribed=0 
                WHERE event_id=:event_id AND username=:username";
        $query = $connection->prepare($sql);
        $query->bindParam(':event_id', $event_id);
        $query->bindParam(':username', $username);

        if($query->execute()) {
            $result = "unsubscribed";
        }
        else {
            $result = "Не успяхте да премахнете събитието от календара";
        }
    }

    return $result;
} 

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$json = file_get_contents('php://input');
	$data = json_decode($json);

	if (!isset($data->username)) {
		echo "err";
	}

	if (!isset($data->event_id)) {
		echo "err";
	}

	$username = $data->username;
	$event_id = $data->event_id;

	$result = unsubscribe($username, $event_id);
	echo $result;

}

 ?>