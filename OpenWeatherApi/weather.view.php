<?php
require_once 'Utilities.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Info</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
</head>
<body>
    <div class='content'>
        <header><h1>Weather</h1></header>
        <main>
        <?php if ($weatherData): ?>

            <div class='display'>
                <h2 class='city'><?php echo htmlspecialchars($weatherData['city']).', '.htmlspecialchars($weatherData['country']); ?></h2>

                <div class='weather-content'>
                    <div class='temperature'>
                        <p><strong>Temperature:</strong> <?php echo htmlspecialchars($weatherData['temperature']['value']) . Utilities::displayTempUnits($weatherData['temperature']['unit']); ?></p>

                        <p><?php echo 'Feels like: '.htmlspecialchars($weatherData['feels_like']['value']) . Utilities::displayTempUnits($weatherData['feels_like']['unit']); ?></p>
                    </div>

                    <div class='atmospherics'>
                        <p><strong>Humidity:</strong> <?php echo htmlspecialchars($weatherData['humidity']['value']) . htmlspecialchars($weatherData['humidity']['unit']); ?></p>

                        <p><strong>Pressure:</strong> <?php echo htmlspecialchars($weatherData['pressure']['value']) . " " . htmlspecialchars($weatherData['pressure']['unit']); ?></p>
                    </div>
                
                    <div class='weather'>
                        <p><strong>Wind: </strong> <?php echo htmlspecialchars($weatherData['wind_speed']['value']) . " " . htmlspecialchars($weatherData['wind_speed']['unit']).' '.htmlspecialchars($weatherData['wind_direction']['code'])?></p>
                        <p>
                        <?php echo htmlspecialchars($weatherData['wind_speed']['description']) ?>
                        </p>
                        <p>
                        <?php echo htmlspecialchars($weatherData['clouds']['description']) ?>
                        </p>
                    </div>

                    <div class='time'>
                        <p><strong>Local Time:</strong><br><?php echo htmlspecialchars($weatherData['time']['local']); ?></p>
                    </div>
                    <div class='sun'>
                        <p><strong>Sunrise:</strong> <?php echo htmlspecialchars($weatherData['sun']['rise']['local']); ?></p>
                        <p><strong>Sunset:</strong> <?php echo htmlspecialchars($weatherData['sun']['set']['local']); ?></p>
                    </div>
                </div>
                <div class='location-map'>
                    <p class='location-info'>
                    <?php echo '<span class="lat">'.htmlspecialchars($weatherData['latitude']).'</span>, <span class="lon">'.htmlspecialchars($weatherData['longitude']).'</span>'?>
                    </p>
                    <div class="map-container">
                        <div id="map">
                        </div>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" id="toggle-map" checked> Show Map
                        </label>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <h2>Sorry.</h2>
            <p>Weather data could not be retrieved.</p>
        <?php endif; ?>

        <a href="index.php">Go Back</a>

        </main>
    </div>
<footer>
    <p> Site loaded: <?php echo date("H:i:s").' UTC'; ?> </p>
</footer>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="scripts/script.js"></script>
</body>
</html>
