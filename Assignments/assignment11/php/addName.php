<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/../classes/PdoMethods.php";

$data = json_decode(file_get_contents("php://input"), true);
$name = trim($data["name"] ?? "");

if ($name === "") {
    echo json_encode(["masterstatus" => "error", "msg" => "Invalid format", "names" => "<p>Invalid format</p>"]);
    exit;
}

$parts = explode(" ", $name);
if (count($parts) == 2) {
    $first = $parts[0];
    $last = $parts[1];
    $formatted = "$last, $first";

    $pdo = new PdoMethods();
    $safeName = addslashes($formatted);
    $sql = "INSERT INTO names (name) VALUES ('$safeName')";
    $result = $pdo->otherNotBinded($sql);

    if ($result === "error") {
        echo json_encode(["masterstatus" => "error", "msg" => "Error inserting name", "names" => "<p>Error inserting name</p>"]);
    } else {
        $records = $pdo->selectNotBinded("SELECT name FROM names ORDER BY name ASC");

        if ($records === "error") {
            echo json_encode(["masterstatus" => "error", "msg" => "Error retrieving names", "names" => "<p>Error retrieving names</p>"]);
        } else {
            if (!is_array($records) || count($records) === 0) {
                echo json_encode(["masterstatus" => "success", "msg" => "No names to display", "names" => "<p>No names to display</p>"]);
            } else {
                $html = "";
                foreach ($records as $row) {
                    $html .= "<p>" . htmlspecialchars($row['name']) . "</p>";
                }
                echo json_encode(["masterstatus" => "success", "msg" => "Name added successfully", "names" => $html]);
            }
        }
    }
} else {
    echo json_encode(["masterstatus" => "error", "msg" => "Invalid format", "names" => "<p>Invalid format</p>"]);
}
