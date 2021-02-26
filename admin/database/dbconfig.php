<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "artica";

try {
    $connection = new PDO("mysql:host=$server_name; dbname=$db_name", $db_username, $db_password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connected sucesfully';
} catch (PDOException $e) {
    echo 'Failed to conncect with database' . $e->getMessage();
}
