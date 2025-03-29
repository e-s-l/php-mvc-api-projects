<?php
require_once 'config.php';

if ($DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

$cities = [];

?>

<html>
<body>
    <h1>Weather Api Example</h1>
<?php
    if (!empty($_POST['search_city'])) {
        $cities = getCityOptions($_POST['search_city'], $OPEN_WEATHER_KEY);
    } elseif (!empty($_POST['city'])) {

        $city = $_POST['city'];

        echo '<h2>Current Weather in '.$city.':</h2>';

        $xml = new SimpleXMLElement(
                'https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.urlencode($city).'&appid='.$OPEN_WEATHER_KEY,
                0,
                true
            );

        echo '<h3>Temperature</h3>';
        echo $xml->temperature['value'].'<br>';
        echo $xml->temperature['min'].'<br>';
        echo $xml->temperature['max'];
        echo $xml->temperature['unit'].'<br>';
        echo '<h3>Feels Like</h3>';
        echo $xml->feels_like['value'];
        echo $xml->feels_like['unit'].'<br>';
        echo '<h3>Humidity</h3>';
        echo $xml->humidity['value'];
        echo $xml->humidity['unit'].'<br>';
        echo '<h3>Pressure</h3>';
        echo $xml->pressure['value'];
        echo $xml->pressure['unit'].'<br>';
        echo '<h3>Wind</h3>';
        echo $xml->wind->speed['value'];
        echo $xml->wind->speed['unit'].'<br>';
        echo $xml->wind->speed['name'].'<br>';
        echo $xml->wind->direction['value'].'<br>';
        echo $xml->wind->direction['code'].'<br>';

        //echo file_get_contents('https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.$city.'&appid='.$OPEN_WEATHER_KEY);
    ?>

<?php
} else {
?>
    <h2>Welcome.</h2>

    <form method="post">
        <label for="city">Select city:</label>
            <select name="city" id="city">
                <option value="London">London</option>
                <option value="Buenos Aires">Buenos Aires</option>
                <option value="New York">New York</option>
                <option value="Paris">Paris</option>
            </select>
        <br>
        <input type="submit" value="Get Weather">
    </form>
<?php
}
?>
</body>
</html>
