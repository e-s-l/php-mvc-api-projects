<?php
    if ($DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }

    require_once __DIR__ .'/config.php';

    require_once __DIR__ .'/SpaceWeatherController.php';

    $controller = new SpaceWeatherController($BOM_KEY);

    $controller->handleRequest();

?>
