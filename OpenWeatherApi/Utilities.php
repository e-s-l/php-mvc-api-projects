<?php

class Utilities {

    public static function displayTempUnits(string $unit) : string {
        $units = [
            'celsius' => '°C',
            'fahrenheit' => '°F',
            'kelvin' => 'K'
        ];
        return $units[strtolower($unit)] ?? $unit;
    }
}

?>
