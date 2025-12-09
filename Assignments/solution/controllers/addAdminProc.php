<?php
require_once __DIR__ . '/../solution/classes/PdoMethods.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PdoMethods();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = strtolower($_POST['status']); // normalize to match ENUM

    $sql = "INSERT INTO admins (name, email, password, status)
            VALUES (:name, :email, :password, :status)";

    $bindings = [
        [":name", $name, "str"],
        [":email", $email, "str"],
        [":password", $password, "str"],
        [":status", $status, "str"]
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === "noerror") {
        $message = "Admin added successfully.";
    } else {
        $message = "Error adding admin.";
    }

    require __DIR__ . '/../views/addAdminForm.php';
}
