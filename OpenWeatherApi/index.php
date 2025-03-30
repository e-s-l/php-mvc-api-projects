<?php

    require_once 'config.php';
    if ($DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }

    require_once 'WeatherController.php';

    $control = new WeatherController($OPEN_WEATHER_KEY);
    $control->handleRequest();
?>
