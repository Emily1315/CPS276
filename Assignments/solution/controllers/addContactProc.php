<?php
require_once __DIR__ . '/../classes/PdoMethods.php';
require_once __DIR__ . '/../classes/Db_conn.php';
require_once __DIR__ . '/../classes/Validation.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = new Validation();
    $errors = $validation->validateContact($_POST);                                                                                       if (empty($errors)) {                                                  $pdo = new PdoMethods();                                           $sql = "INSERT INTO contacts (fname, lname, address, city, state, phone, email, dob, age)
                VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :age)";

        // Build bindings array for PdoMethods
        $bindings = [
            [":fname", $_POST['fname'], "str"],
            [":lname", $_POST['lname'], "str"],
            [":address", $_POST['address'], "str"],
            [":city", $_POST['city'], "str"],
            [":state", $_POST['state'], "str"],
            [":phone", $_POST['phone'], "str"],
            [":email", $_POST['email'], "str"],
            [":dob", $_POST['dob'], "str"],   // MySQL DATE stored as string
            [":age", $_POST['age'], "str"]    // or "int" if numeric
        ];

        // Run the insert and capture the result
        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === "noerror") {
            $message = "Contact Information Added";
        } else {
            $message = "Insert failed: " . $result;
        }
    } else {
        $message = "Errors: " . implode(", ", $errors);
    }

    // Redirect back to index.php so it loads the view
    header("Location: ../index.php?page=addContact&message=" . urlencode($message));
    exit;
}
