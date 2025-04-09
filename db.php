<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=jeux_video', 'root', '');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die;
}

function fetchAll($connection, $table) {
    $query = $connection->prepare("SELECT * FROM ".$table);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function fetchById($connection, $table, $id) {
    $query = $connection->prepare("SELECT * FROM ".$table." WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}


