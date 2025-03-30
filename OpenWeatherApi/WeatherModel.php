<?php

error_reporting(E_ALL);
        ini_set('display_errors', 'On');

class WeatherModel {
    private $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Given a utc time convert this to the time in the cities location.
     */
    private function getCityTime(string $time, string $timezone) : string {
        $timezoneOffset = (int) $timezone;

        $localTime = DateTime::createFromFormat('Y-m-d\TH:i:s', $time);

        if (!$localTime) {
            throw new Exception("Invalid time format.");
        }

        $localTime->modify("{$timezoneOffset} seconds");
        return $localTime->format('Y-m-d H:i');
    }

    /**
     * Calculate the current local time in the city.
     */
    private function getCurrentCityTime(string $timezone) : string {
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));
        return $this->getCityTime($utcTime->format('Y-m-d\TH:i:s'), $timezone);
    }

    public function getWeather(string $city) : array|null {

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
                'latitude' => number_format((float)$xml->city->coord['lat'], 3),
                'longitude' => number_format((float)$xml->city->coord['lon'], 3),
                'time' => [
                    'zone' => $xml->city->timezone,
                    'local' => $this->getCurrentCityTime($xml->city->timezone),
                ],
                'sun' => [
                    'rise' => [
                        'local' => explode(' ',$this->getCityTime($xml->city->sun['rise'], $xml->city->timezone))[1],
                        'utc' => (string) $xml->city->sun['rise']
                    ],
                    'set' => [
                        'local' => explode(' ', $this->getCityTime($xml->city->sun['set'], $xml->city->timezone))[1],
                        'utc' => (string) $xml->city->sun['set']
                    ]
                ],
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
                    'description' => ucwords((string) $xml->wind->speed['name'])
                ],
                'wind_direction' => [
                    'value' => (string) $xml->wind->direction['value'],
                    'code' => (string) $xml->wind->direction['code']
                ],
                'clouds' => [
                    'value' => (string) $xml->clouds['value'],
                    'description' => ucwords((string) $xml->clouds['name'])
                ]
            ];
        }
        catch (Throwable $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}

?>
