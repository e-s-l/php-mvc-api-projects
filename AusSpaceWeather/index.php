<?php

// import configuration and program variables
// (including the debug control)
require_once __DIR__ .'/config.php';

if ($DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

// import the controller and instatiate and start
require_once __DIR__ .'/SpaceWeatherController.php';
$controller = new SpaceWeatherController($BOM_KEY);
$controller->handleRequest();

?>
