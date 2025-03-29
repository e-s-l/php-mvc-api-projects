<?php

class WeatherModel {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }
 
    public function getWeather($city) {

        $url = 'https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.urlencode($city).'&appid='.$this->apiKey;

        try{


            $xml = new SimpleXMLElement(
                $url,
                0,
                true
            );

            if (isset($xml->cod) && (int) $xml->cod !== 200) {
                throw new Exception('Invalid xml code.');
            }

            return [
                'city' => (string) $xml->city['name'],
                'country' => (string) $xml->city->country,
                'latitude' => (string) $xml->city->coord['lat'],
                'longitude' => (string) $xml->city->coord['lon'],
                'timezone' => (string) $xml->city['timezone'],
                /*
                'localtime' => getLocalTime()
                getLocalTime() {
                $timezoneOffset = (int) $xml->city['timezone'];
                $utcTime = new DateTime('now', new DateTimeZone('UTC'));
                $localTime = clone $utcTime;
                $localTime->modify("{$timezoneOffset} seconds");
                $localTime->format('Y-m-d H:i:s')
                }
                */
                'temperature' => [
                    'value' => (string) $xml->temperature['value'],
                    'unit' => (string) $xml->temperature['unit']
                ],
                'feels_like' => [
                    'value' => (string) $xml->feels_like['value'],
                    'unit' => (string) $xml->feels_like['unit']
                ],
                'humidity' => [
                    'value' => (string) $xml->humidity['value'],
                    'unit' => (string) $xml->humidity['unit']
                ],
                'pressure' => [
                    'value' => (string) $xml->pressure['value'],
                    'unit' => (string) $xml->pressure['unit']
                ],
                'wind_speed' => [
                    'value' => (string) $xml->wind->speed['value'],
                    'unit' => (string) $xml->wind->speed['unit'],
                    'description' => (string) $xml->wind->speed['name']
                ],
                'wind_direction' => [
                    'value' => (string) $xml->wind->direction['value'],
                    'code' => (string) $xml->wind->direction['code']
                ]
            ];




        }
        catch (Throwable $e) {
            // echo "Error: " . $e->getMessage();
            return null;
        }
    }
}

?>
