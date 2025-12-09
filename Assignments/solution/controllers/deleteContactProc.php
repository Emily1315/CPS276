<?php
require_once __DIR__ . '/../classes/PdoMethods.php';
require_once __DIR__ . '/../classes/Db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete'])) {
    $pdo = new PdoMethods();
    $sql = "DELETE FROM contacts WHERE id = :id";

    foreach ($_POST['delete'] as $id) {
        // Build binding array for each selected contact
        $bindings = [
            [":id", $id, "int"]
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result !== "noerror") {
            $message = "Delete failed: " . $result;
            header("Location: ../index.php?page=deleteContacts&message=" . urlencode($message));
            exit;
        }
    }

    $message = "Selected contacts deleted";
    header("Location: ../index.php?page=deleteContacts&message=" . urlencode($message));
    exit;
  } else {
    $message = "No contacts selected";
    header("Location: ../index.php?page=deleteContacts&message=" . urlencode($message));
    exit;
}
