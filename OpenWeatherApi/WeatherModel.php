<?php

error_reporting(E_ALL);
        ini_set('display_errors', 'On');

class WeatherModel {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function getCityTime($timezone) {
        $timezoneOffset = (int) $timezone;
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));
        $localTime = clone $utcTime;
        $localTime->modify("{$timezoneOffset} seconds");
        return $localTime->format('Y-m-d H:i');
    }

    // define a function convertToCityTime
    // which can then pass current time to get the above
    // but also the UTC sunset/sunrise
 
    public function getWeather($city) {

        $url = 'https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.urlencode($city).'&appid='.$this->apiKey;

        try{

            $xml = new SimpleXMLElement(
                $url,
                0,
                true
            );

            // var_dump($xml);

            if (isset($xml->cod) && (int) $xml->cod !== 200) {
                throw new Exception('Invalid xml code.');
            }

            return [
                'city' => (string) $xml->city['name'],
                'country' => (string) $xml->city->country,
                'latitude' => (string) $xml->city->coord['lat'],
                'longitude' => (string) $xml->city->coord['lon'],
                'local_time' => $this->getCityTime($xml->city->timezone),
                'sun_rise' => (string) $xml->city->sun['rise'],
                'sun_set' => (string) $xml->city->sun['set'],
                'temperature' => [
                    'value' => (string) $xml->temperature['value'],
                    'max' => (string) $xml->temperature['max'],
                    'min' => (string) $xml->temperature['min'],
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
                ],
                'clouds' => [
                    'value' => (string) $xml->clouds['value'],
                    'description' => (string) $xml->clouds['name']
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
