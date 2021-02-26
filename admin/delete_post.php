<?php
require_once 'database/dbconfig.php';

$id = $_POST['delete_id'] ?? null;

if (!$id) {
    header('Location: posts.php');
    exit;
}

$statement = $connection->prepare('DELETE FROM posts WHERE post_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: posts.php');
