<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'WeatherModel.php';

class WeatherController {
    private $model;

    public function __construct(string $apiKey) {
        $this->model = new WeatherModel($apiKey);
    }

    public function handleRequest() {

        $city = $_POST['search_city'] ?? null;

        if (!empty($city)) {
            $weatherData = $this->model->getWeather($city);
            include 'weather.view.php';
        } else {
            include 'form.view.php';
        }
    }

}
