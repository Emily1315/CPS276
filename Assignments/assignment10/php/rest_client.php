<?php
function getWeather() {
    $zip = $_POST['zip_code'] ?? "";

    // Build URL
    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=" . urlencode($zip);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    // Handle errors
    if (isset($data['error'])) {
        return ["<p class='text-danger'>{$data['error']}</p>", ""];
    }

    // Build acknowledgement
    $acknowledgement = "<h2>Weather for {$data['searched_city']['name']}</h2>";

    // Build output
    $output = "<p>Temperature: {$data['searched_city']['temperature']}<br>";
    $output .= "Humidity: {$data['searched_city']['humidity']}</p>";

    // Forecast
    $output .= "<h3>3-Day Forecast</h3><ul>";
    foreach ($data['searched_city']['forecast'] as $day) {
        $output .= "<li>{$day['day']}: {$day['condition']}</li>";
    }
    $output .= "</ul>";

    // Higher temps table (limit to 3)
    if (!empty($data['higher_temperatures'])) {
        $higher = array_slice($data['higher_temperatures'], 0, 3);
        $output .= "<h3>Cities with Higher Temperatures</h3><table><tr><th>City</th><th>Temperature</th></tr>";
        foreach ($higher as $city) {
            $output .= "<tr><td>{$city['name']}</td><td>{$city['temperature']}</td></tr>";
        }
        $output .= "</table>";
    } else {
        $output .= "<p>No cities found with higher temperatures.</p>";
    }

    // Lower temps table (limit to 5)
    if (!empty($data['lower_temperatures'])) {
        $lower = array_slice($data['lower_temperatures'], 0, 5);
        $output .= "<h3>Cities with Lower Temperatures</h3><table><tr><th>City</th><th>Temperature</th></tr>";
        foreach ($lower as $city) {
            $output .= "<tr><td>{$city['name']}</td><td>{$city['temperature']}</td></tr>";
        }
        $output .= "</table>";
    } else {
        $output .= "<p>No cities found with lower temperatures.</p>";
    }

    return [$acknowledgement, $output];
}
?>

