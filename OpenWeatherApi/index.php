<?php

    require_once 'config.php';
    require_once 'WeatherController.php';

    if ($DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }

    $control = new WeatherController($OPEN_WEATHER_KEY);

    $control->handleRequest();
?>
