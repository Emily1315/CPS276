<?php
$output = "";
$acknowledgement = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'php/rest_client.php';
    $result = getWeather();
    $acknowledgement = $result[0];
    $output = $result[1];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Weather Lookup</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    table { border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #333; padding: 6px 10px; }
    th { background: #eee; }
  </style>
</head>
<body>
  <h1>Weather Application</h1>

  <!-- acknowledgement message -->
  <?php echo $acknowledgement; ?>

  <!-- form -->
  <form method="post" action="index.php">
    <label for="zip_code">Enter Zip Code:</label>
    <input type="text" id="zip_code" name="zip_code">
    <button type="submit">Get Weather</button>
  </form>

  <!-- output tables and forecast -->
  <?php echo $output; ?>
</body>
</html>
