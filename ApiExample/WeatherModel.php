<?php

class WeatherModel {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getWeather($city) {

        $url = 'https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.urlencode($city).'&appid='.$this->apiKey;

        return new SimpleXMLElement(
            $url,
            0,
            true
        );
    }
}

?>
