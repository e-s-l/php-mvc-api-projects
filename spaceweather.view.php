<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aus Space Weather</title>
</head>
<body>
    <h1>Australian Space Weather</h1>

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
                        <option value="Hobart" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Hobart') ? 'selected' : ''; ?> >Hobart</option>
                        <option value="Macquarie Island" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Macquarie Island') ? 'selected' : ''; ?> >Macquarie Island</option>
                        <option value="Casey" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Casey') ? 'selected' : ''; ?> >Casey</option>
                        <option value="Mawson" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Mawson') ? 'selected' : ''; ?> >Mawson</option>
                        <option value="Sydney" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Sydney') ? 'selected' : ''; ?> >Sydney</option>
                        <option value="Melbourne" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Melbourne') ? 'selected' : ''; ?> >Melbourne</option>
                        <option value="Perth" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Perth') ? 'selected' : ''; ?> >Perth</option>
                        <option value="Darwin" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Darwin') ? 'selected' : ''; ?> >Darwin</option>
                        <option value="Canberra" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Canberra') ? 'selected' : ''; ?> >Canberra</option>
                        <option value="Australian region" <?php echo (isset($_GET['location']) && $_GET['location'] == 'Australian region') ? 'selected' : ''; ?> >Australian region</option>
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


    </div>

    <div>
        <h2>Alerts</h2>

        <div>
            <h3>Aurora Alert</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['auroraAlert']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>Aurora Outlook</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['auroraOutlook']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>Aurora Watch</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['auroraWatch']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>Mag Alert</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['magAlert']) ?: 'NA'; ?></p>
        </div>

        <div>
            <h3>Mag Warning</h3>
            <p><?php echo htmlspecialchars($spaceWeatherData['magWarning']) ?: 'NA'; ?></p>
        </div>
    </div>
</body>
</html>
