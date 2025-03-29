<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'SpaceWeatherModel.php';

class SpaceWeatherController {
    private $model;

    public function __construct($apiKey) {
        $this->model = new SpaceWeatherModel($apiKey);
    }

    public function handleRequest() {

        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
        $location = isset($_GET['location']) ? $_GET['location'] : 'Australian region';

        $spaceWeatherData = $this->model->getSpaceWeatherData($date, $location);

        include 'spaceweather.view.php';
    }
}
?>
