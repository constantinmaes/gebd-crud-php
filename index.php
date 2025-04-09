<?php

define('BASE_PATH', '/gebd/index.php/' );

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$requestUri = str_replace(BASE_PATH, '', $requestUri);

$requestUriArray = explode('/', $requestUri);

var_dump($requestUriArray);


// videogames
// videogames/1
// videogames/add
// videogames/1/edit