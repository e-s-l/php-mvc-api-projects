<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aus Space Weather</title>
</head>
<body>
    <h1>Australian Space Weather</h1>

    <?php

    $hasAlerts = !empty($spaceWeatherData['auroraAlert']) || 
                !empty($spaceWeatherData['auroraOutlook']) || 
                !empty($spaceWeatherData['auroraWatch']) || 
                !empty($spaceWeatherData['magAlert']) || 
                !empty($spaceWeatherData['magWarning']);

    if ($hasAlerts): ?>

        <div>
            <h2>Alerts</h2>

            <?php if (!empty($spaceWeatherData['auroraAlert'])): ?>
            <div>
                <h3>Aurora Alert</h3>
                <p><?php echo htmlspecialchars($spaceWeatherData['auroraAlert']) ?: 'NA'; ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($spaceWeatherData['auroraOutlook'])): ?>
            <div>
                <h3>Aurora Outlook</h3>
                <p><?php echo htmlspecialchars($spaceWeatherData['auroraOutlook']) ?: 'NA'; ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($spaceWeatherData['auroraWatch'])): ?>
            <div>
                <h3>Aurora Watch</h3>
                <p><?php echo htmlspecialchars($spaceWeatherData['auroraWatch']) ?: 'NA'; ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($spaceWeatherData['magAlert'])): ?>
            <div>
                <h3>Mag Alert</h3>
                <p><?php echo htmlspecialchars($spaceWeatherData['magAlert']) ?: 'NA'; ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($spaceWeatherData['magWarning'])): ?>
            <div>
                <h3>Mag Warning</h3>
                <p><?php echo htmlspecialchars($spaceWeatherData['magWarning']) ?: 'NA'; ?></p>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div>
        <h2>Indices</h2>

        <div>
            <form method="GET">
                <div>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $date; ?>" max="<?php echo $today; ?>">
                </div>
                <div>
                    <label for="location">Location:</label>
                    <select name="location" id="location">
                    <?php 
                    foreach (SpaceWeatherController::VALID_LOCATIONS as $loc) {
                            echo '<option value="' . $loc . '" ' . ($loc === $location ? 'selected' : '') . '>' . $loc . '</option>';
                    }
                    ?>
                    </select>
                </div>
                <button type="submit">Reload</button>
            </form>
        </div>

        <div>
            <h3>K-Index</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['kIndex']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>A-Index</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['aIndex']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>DST-Index</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['dstIndex']) ?: 'NA'; ?></p>
        </div>
    </div>
</body>
</html>
