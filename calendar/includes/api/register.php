<?php

require_once '../database.php';

if(isset($_POST["btn-register"])) {
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $password = sha1($password);

    $sql = "SELECT * FROM users WHERE username=:username";
    $query = $connection->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();    
    $count = $query->rowCount();

    if ($count == 0) {
        $sql = "INSERT INTO users (username, password, first_name, last_name) 
                VALUES (:username, :password, :first_name, :last_name)";
        $query = $connection->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':first_name', $firstName);
        $query->bindParam(':last_name', $lastName);

        if($query->execute()) {
            echo "registered";
        }
        else {
            echo "Регистрацията е неуспешна!";
        }
    }
    else {
        echo "Потребителското име е заето!";
    }
}

?>