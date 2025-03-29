<?php
require_once 'Utilities.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Info</title>
</head>
<body>

<?php if ($weatherData): ?>

    <h2>Current Weather in <?php echo htmlspecialchars($weatherData['city']).', '.htmlspecialchars($weatherData['country']); ?>:</h2>

    <h3>Temperature</h3>
    <p><?php echo htmlspecialchars($weatherData['temperature']['value']) . Utilities::displayTempUnits($weatherData['temperature']['unit']); ?></p>

    <p><?php echo 'Feels like: '.htmlspecialchars($weatherData['feels_like']['value']) . Utilities::displayTempUnits($weatherData['feels_like']['unit']); ?></p>

    <h3>Humidity</h3>
    <p><?php echo htmlspecialchars($weatherData['humidity']['value']) . htmlspecialchars($weatherData['humidity']['unit']); ?></p>

    <h3>Pressure</h3>
    <p><?php echo htmlspecialchars($weatherData['pressure']['value']) . " " . htmlspecialchars($weatherData['pressure']['unit']); ?></p>

    <h3>Wind</h3>
    <p><?php echo htmlspecialchars($weatherData['wind_speed']['value']) . " " . htmlspecialchars($weatherData['wind_speed']['unit']).' '.htmlspecialchars($weatherData['wind_direction']['code']); ?></p>
    <p><?php echo htmlspecialchars($weatherData['wind_speed']['description'])?></p>

    <h3> Clouds </h3>
    <p><?php echo htmlspecialchars($weatherData['clouds']['description'])?></p>


    <h3>Location</h3>
    <p><?php echo '('.htmlspecialchars($weatherData['latitude']).', '.htmlspecialchars($weatherData['longitude']).')'; ?></p>

    <h3>Local Time</h3>
    <p><?php echo htmlspecialchars($weatherData['local_time']); ?></p>
    <p><?php echo 'Sunrise: '.htmlspecialchars($weatherData['sun_rise']); ?></p>
    <p><?php echo 'Sunset: '.htmlspecialchars($weatherData['sun_set']); ?></p>
    
<?php else: ?>

    <h2>Sorry.</h2>
    <p>Weather data could not be retrieved.</p>

<?php endif; ?>

<a href="index.php">Go Back</a>
<footer>
    <p> Site loaded: <?php echo date("H:i:s").' UTC'; ?> </p>
</footer>

</body>
</html>
