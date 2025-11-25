<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/../classes/PdoMethods.php";

$pdo = new PdoMethods();
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
        echo json_encode(["masterstatus" => "success", "msg" => "Names retrieved", "names" => $html]);
    }
}




