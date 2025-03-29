<?php

class Utilities {

    public static function displayTempUnits($unit) {
        $units = [
            'celsius' => '°C',
            'fahrenheit' => '°F',
            'kelvin' => 'K'
        ];
        return $units[strtolower($unit)] ?? $unit;
    }
}

?>
