<?php

require_once __DIR__ .'/SpaceWeatherModel.php';

class SpaceWeatherController {

    private $model;

    public function __construct(string $apiKey) {
        $this->model = new SpaceWeatherModel($apiKey);
    }

    private function preprocessData(array $data) : array {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->preprocessData($value);
            } else {
                $data[$key] = is_string($value) ? ucwords(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) : $value;
            }
        }
        return $data;
    }

    /**
     * Return the view given the model for the requests.
     */
    public function handleRequest() {

        $validLocations = $this->model->listValidLocations();
        //$all_indices = $this->model->listPossibleIndices();
        //$all_alerts = $this->model->listPossibleAlerts();

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
        
        $viewData = [
            'date' => $date,
            'location' => $location,
            'locations' => $validLocations,
            'indices' => $this->model->listPossibleIndices(),
            'alerts' => $this->model->listPossibleAlerts(),
            'data' => $this->preprocessData($spaceWeatherData)
        ];

        include 'spaceweather.view.php';
    }
}
?>
