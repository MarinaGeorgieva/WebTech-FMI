<?php 

include_once 'database.php';

$sql = "SELECT * FROM events";
$query = $connection->prepare($sql);
$query->execute();
$result = $query->fetchAll();

echo json_encode($result);

?>