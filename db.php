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

function save($connection, $table, $data) {
    // INSERT INTO $table (columns...) VALUES (values...);
    // INSERT INTO jeux_video (nom, possesseur) VALUES (:nom, :possesseur)
    $columns = array_keys($data);
    $columnsStr = implode(', ', $columns); // split ; join
    $placeholdersStr = ':' . implode(', :', $columns); // split ; join
    $sql = 'INSERT INTO ' . $table . ' (' . $columnsStr . ') VALUES (' . $placeholdersStr . ');';
    try {
        $query = $connection->prepare($sql);
        foreach ($data as $key => $value) {
            $query->bindValue(':'.$key, $value);
        }
        $query->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        die;
    }
}


