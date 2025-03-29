<?php

require_once 'WeatherModel.php';

class WeatherController {
    private $model;

    public function __construct($apiKey) {
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
