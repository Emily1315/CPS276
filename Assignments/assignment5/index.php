<?php
require_once "classes/directories.php";

$message = "";
$link = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dirName = $_POST["dirname"] ?? "";
    $fileContent = $_POST["filecontent"] ?? "";

    $Directories = new Directories();
    $result = $Directories->create($dirName, $fileContent);

    if ($result["success"]) {
        $link = "<p><a href='directories/$dirName/readme.txt' target='_blank'>Path where the file is located</a></p>";
    } else {
        $message = "<p>{$result['message']}</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory Creator</title>
</head>
<body>
    <h1>Create Directory and File</h1>
    <?= $link ?>
    <?= $message ?>
    <form method="post">
        <label for="dirname">Directory Name (letters only):</label><br>
        <input type="text" name="dirname" id="dirname" required><br><br>

        <label for="filecontent">File Content:</label><br>
        <textarea name="filecontent" id="filecontent" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
