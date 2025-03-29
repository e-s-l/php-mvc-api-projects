<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'SpaceWeatherModel.php';

class SpaceWeatherController {
    private $model;

    const VALID_LOCATIONS = [
        "Sydney", "Melbourne", "Perth", "Hobart", "Darwin", "Canberra", 
        "Macquarie Island", "Casey", "Mawson", "Australian region"
    ];

    public function __construct($apiKey) {
        $this->model = new SpaceWeatherModel($apiKey);
    }

    public function handleRequest() {

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
            if (!in_array($location, SpaceWeatherController::VALID_LOCATIONS)) {
                $location = "Australian region";
            }
        } else {
            $location = "Australian region";
        }

        $spaceWeatherData = $this->model->getSpaceWeatherData($date, $location);

        include 'spaceweather.view.php';
    }
}
?>
