<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aus Space Weather</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Australian Space Weather</h1>
    </header>

    <main>

        <?php

        $hasAlerts = false;
        foreach ($alerts as $key => $alertName) {
            if (!empty($spaceWeatherData[$key])) {
                $hasAlerts = true;
                break;
            }
        }

        if ($hasAlerts): ?>

            <div>
                <h2>Current Alerts</h2>

                <?php foreach ($alerts as $key => $data): ?>
                    <?php if (!empty($spaceWeatherData[$key])): ?>
                        <div class="alert" onclick="openModal('<?php echo $key; ?>')">
                            <h3><?php echo $data['label']; ?></h3>
                            <p><?php echo htmlspecialchars($spaceWeatherData[$key]) ?: 'NA'; ?></p>
                        </div>

                        <div id="modal-<?php echo $key; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('<?php echo $key; ?>')">&times;</span>
                                <h3><?php echo $data['label']; ?></h3>
                                <p><?php echo $data['info']; ?></p>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
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
                        foreach ($validLocations as $loc) {
                                echo '<option value="' . $loc . '" ' . ($loc === $location ? 'selected' : '') . '>' . $loc . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <button type="submit">Reload</button>
                </form>
            </div>

            <div>
                <?php foreach ($indices as $key => $data): ?>
                    <?php if (isset($spaceWeatherData[$key])): ?>
                        <div class="index" onclick="openModal('<?php echo $key; ?>')">
                            <h3><?php echo $data['label']; ?></h3>
                            <p><?php echo ($spaceWeatherData[$key] === "" || $spaceWeatherData[$key] === null) ? 'NA' : htmlspecialchars($spaceWeatherData[$key]); ?></p>
                        </div>

                        <div id="modal-<?php echo $key; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('<?php echo $key; ?>')">&times;</span>
                                <h3><?php echo $data['label']; ?></h3>
                                <p><?php echo $data['info']; ?></p>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
