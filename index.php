<?php
require_once('db.php');
define('BASE_PATH', '/gebd/index.php/' );

$modelsArray = [
    'videogames' => 'jeux_video',
];

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$requestUri = str_replace(BASE_PATH, '', $requestUri);

$requestUriArray = explode('/', $requestUri);
$requestUriArray = array_filter($requestUriArray, function($value) {
    return $value !== '';
});


if (empty($requestUriArray)) {
//if (count($requestUriArray) === 0) {
    echo 'Homepage';
    die;
}

$model = $requestUriArray[0];

if (count($requestUriArray) === 1) {
    // Vue "liste"
    echo 'Model: ' . $model;
    $tableName  = $modelsArray[$model] ?? false;
    if (!$tableName) {
        echo 'Invalid model';
        die;
    }
    $results = fetchAll($db, $tableName);
    echo '<pre>';
    var_dump($results);
    echo '</pre>';
    die;
}

if (count($requestUriArray) === 2) {
    $isAdd = $requestUriArray[1] === 'add';
    if ($isAdd && $requestMethod === 'GET') {
        // Vue "ajout"
        echo 'Add';
        die;
    }

    if ($isAdd && $requestMethod === 'POST') {
        // Enregistrer le nouveau modèle
        echo 'Save';
        die;
    }

    if (ctype_digit($requestUriArray[1])) {
        // Vue "détail"
        echo 'Detail';
        die;
    }

    echo 'Invalid id or action';
    die;
}

if (count($requestUriArray) === 3) {
    // Vérifier que l'id est numérique
    $isValidId = ctype_digit($requestUriArray[1]); // Vérifier que le 2e element est numérique

    if (!$isValidId) {
        echo 'Invalid ID';
        die;
    }

    // Vérifier que le 3e element est "edit"
    if ($requestUriArray[2] !== 'edit') {
        echo 'Invalid action';
        die;
    }

    echo 'Edit';

    if ($requestMethod === 'GET') {
        // Afficher le formulaire
    }

    if ($requestMethod === 'POST') {
        // Enregistrer les modifications
    }
}

// '' => 0
// videogames => 1 => afficher toutes les données de ce type de ressource
// videogames/1 => 2 => afficher les données de la ressource avec l'id numérique
// videogames/add => 2 => afficher le formulaire d'ajout
// videogames/1/edit => 3 => afficher le formulaire d'édition