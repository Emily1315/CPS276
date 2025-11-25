<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/../classes/PdoMethods.php";

$pdo = new PdoMethods();
$sql = "DELETE FROM names";
$result = $pdo->otherNotBinded($sql);

if ($result === "error") {
    echo json_encode(["masterstatus" => "error", "msg" => "Error clearing names", "names" => "<p>Error clearing names</p>"]);
} else {
    echo json_encode(["masterstatus" => "success", "msg" => "All names cleared. No names to display", "names" => "<p>No names to display</p>"]);
}
