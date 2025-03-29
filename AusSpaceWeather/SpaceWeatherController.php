<?php

error_reporting(E_ALL);
    ini_set('display_errors', 'On');

require_once __DIR__ .'/SpaceWeatherModel.php';

class SpaceWeatherController {

    private $model;

    public function __construct(string $apiKey) {
        $this->model = new SpaceWeatherModel($apiKey);
    }

    /**
     * Return the view given the model for the requests.
     */
    public function handleRequest() {

        $validLocations = $this->model->getLocations();
        $indices = $this->model->getIndices();
        $alerts = $this->model->getAlerts();

        if (isset($_GET['date'])) {
            $date = $_GET['date'];

            $dateObj = DateTime::createFromFormat('Y-m-d', $date);
            if ($dateObj && $dateObj->format('Y-m-d') === $date) {
                $date = $dateObj->format('Y-m-d');
            } else {
                $date = date('Y-m-d');
            }
        } else {
            $date = date('Y-m-d');
        }

        if (isset($_GET['location'])) {
            $location = $_GET['location'];
            if (!in_array($location, $validLocations)) {
                $location = "Australian region";
            }
        } else {
            $location = "Australian region";
        }

        $spaceWeatherData = $this->model->getSpaceWeatherData($date, $location);
        
        //var_dump($spaceWeatherData);
        //exit;

        include 'spaceweather.view.php';
    }
}
?>
