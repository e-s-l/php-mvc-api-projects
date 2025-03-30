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
        <span class="site-info" onclick="openModal('site-info')">&#9432;</span>
    </header>
    <div id="modal-site-info" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('site-info')">&times;</span>
            <h3>Site Information</h3>
            <h4>What does this site do?</h4>
            <h4>How to use this site?</h4>
            <h4>Sources:</h4>
        </div>
    </div>
    <main>
        <?php
        $hasAlerts = false;
        foreach ($viewData['alerts'] as $key => $alertName) {
            if (!empty($viewData['data'][$key])) {
                $hasAlerts = true;
                break;
            }
        }
        if ($hasAlerts): ?>
            <div class='alert-container'>
                <h2>Current Alerts</h2>
                <?php foreach ($viewData['alerts'] as $key => $data): ?>
                    <?php if (!empty($spaceWeatherData[$key])): ?>
                        <div class="alert" onclick="openModal('<?php echo $key; ?>')">
                            <h3><?php echo $data['label']; ?></h3>
                            <p><?php echo $viewData['data'][$key]['cause'] ?? 'Unknown'; ?></p>
                        </div>
                        <div id="modal-<?php echo $key; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('<?php echo $key; ?>')">&times;</span>
                                <h3><?php echo $data['label']; ?></h3>
                                    <p><strong>Issue Time:</strong> <?php echo $viewData['data'][$key]['issue_time'] ?? 'Unknown'; ?></p>
                                    <p><strong>Start Date:</strong> <?php echo $viewData['data'][$key]['start_date'] ?? 'Unknown'; ?></p>
                                    <p><strong>End Date:</strong> <?php echo $viewData['data'][$key]['end_date'] ?? 'Unknown'; ?></p>
                                    <p><strong>Cause:</strong> <?php echo $viewData['data'][$key]['cause'] ?? 'Unknown'; ?></p>
                                    <?php if (!empty($viewData['data'][$key]['activity'])): ?>
                                        <br>
                                        <h4>Activity Forecast:</h4>
                                        <ul>
                                            <?php foreach ($viewData['data'][$key]['activity'] as $activity): ?>
                                                <li><?php echo $activity['date'] . ': ' . $activity['forecast']; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                <br>
                                <h4>About:</h4>
                                <p><?php echo $data['info']; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div>
            <h2>Indices</h2>
            <div class='settings'>
                <form method="GET">
                    <div>
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" value="<?php echo $date; ?>" max="<?php echo $today; ?>">
                    </div>
                    <div>
                        <label for="location">Location:</label>
                        <select name="location" id="location">
                        <?php 
                        foreach ($viewData['locations'] as $loc) {
                                echo '<option value="' . $loc . '" ' . ($loc === $location ? 'selected' : '') . '>' . $loc . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <button type="submit">Reload</button>
                </form>
            </div>
            <div>
                <?php foreach ($viewData['indices'] as $key => $data): ?>
                        <div class="index" onclick="openModal('<?php echo $key; ?>')">
                            <h3><?php echo $data['label']; ?></h3>
                            <p><?php echo is_null($viewData['data'][$key]) ? 'NA' : $viewData['data'][$key]; ?></p>
                        </div>
                        <div id="modal-<?php echo $key; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('<?php echo $key; ?>')">&times;</span>
                                <h3><?php echo $data['label']; ?></h3>
                                <p><?php echo $data['info']; ?></p>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
