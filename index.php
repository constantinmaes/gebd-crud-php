<?php
require_once('db.php');
define('BASE_PATH', '/gebd/index.php/' );

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
// videogames => 1
// videogames/1 => 2
// videogames/add => 2
// videogames/1/edit => 3