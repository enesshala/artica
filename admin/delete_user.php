<?php
require_once 'database/dbconfig.php';

$id = $_POST['delete_id'] ?? null;

if (!$id) {
    header('Location: register.php');
    exit;
}

$statement = $connection->prepare('DELETE FROM users WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: register.php');
