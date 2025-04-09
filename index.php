<?php

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

echo 'Hello';



// '' => 0
// videogames => 1
// videogames/1 => 2
// videogames/add => 2
// videogames/1/edit => 3