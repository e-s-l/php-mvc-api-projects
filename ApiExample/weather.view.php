<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Info</title>
</head>
<body>

<h2>Current Weather in <?php echo htmlspecialchars($_POST['city']); ?>:</h2>

<?php if ($weatherData): ?>
    <h3>Temperature</h3>
    <p><?php echo $weatherData->temperature['value'] . " " . $weatherData->temperature['unit']; ?></p>
    
    <h3>Feels Like</h3>
    <p><?php echo $weatherData->feels_like['value'] . " " . $weatherData->feels_like['unit']; ?></p>

    <h3>Humidity</h3>
    <p><?php echo $weatherData->humidity['value'] . " " . $weatherData->humidity['unit']; ?></p>

    <h3>Pressure</h3>
    <p><?php echo $weatherData->pressure['value'] . " " . $weatherData->pressure['unit']; ?></p>

    <h3>Wind</h3>
    <p><?php echo $weatherData->wind->speed['value'] . " " . $weatherData->wind->speed['unit']; ?></p>
    <p>Direction: <?php echo $weatherData->wind->direction['code']; ?></p>
<?php else: ?>
    <p>Weather data could not be retrieved.</p>
<?php endif; ?>

<a href="index.php">Go Back</a>

</body>
</html>
