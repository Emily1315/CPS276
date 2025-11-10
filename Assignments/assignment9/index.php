<?php
require_once "classes/Db_conn.php";
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";
require_once "classes/StickyForm.php";

$stickyForm = new StickyForm();
$pdo = new PdoMethods();   // ✅ matches your class name exactly

// Define form configuration
$formConfig = [
  "masterStatus" => ["error" => false],
  "fields" => [
    "firstName" => [
      "id" => "firstName",
      "name" => "firstName",
      "label" => "First Name",
      "type" => "text",
      "regex" => "name",
      "required" => true,
      "value" => "",
      "error" => ""
    ],
    "lastName" => [
      "id" => "lastName",
      "name" => "lastName",
      "label" => "Last Name",
      "type" => "text",
      "regex" => "name",
      "required" => true,
      "value" => "",
      "error" => ""
    ],
    "email" => [
      "id" => "email",
      "name" => "email",
      "label" => "Email",
      "type" => "text",
      "regex" => "email",
      "required" => true,
      "value" => "",
      "error" => ""
    ],
    "password" => [
      "id" => "password",
      "name" => "password",
      "label" => "Password",
      "type" => "text",
      "regex" => "password",
      "required" => true,
      "value" => "",
      "error" => ""
    ],
    "confirmPassword" => [
      "id" => "confirmPassword",
      "name" => "confirmPassword",
      "label" => "Confirm Password",
      "type" => "text",
      "required" => true,
      "value" => "",
      "error" => ""
    ]
  ]
];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Run validation using StickyForm
  $formConfig = $stickyForm->validateForm($_POST, $formConfig);

  // Confirm password check
  if ($_POST["password"] !== $_POST["confirmPassword"]) {
    $formConfig["fields"]["confirmPassword"]["error"] = "Passwords do not match";
    $formConfig["masterStatus"]["error"] = true;
  }

  // Duplicate email check
  if (!$formConfig["masterStatus"]["error"]) {
    $sql = "SELECT email FROM users WHERE email = :email";
    $bindings = [[":email", $_POST["email"], "str"]];
    $records = $pdo->selectBinded($sql, $bindings);

    if ($records && count($records) > 0) {
      $formConfig["fields"]["email"]["error"] = "Email already exists";
      $formConfig["masterStatus"]["error"] = true;
    }
  }

  // Insert record if no errors
  if (!$formConfig["masterStatus"]["error"]) {
    $sql = "INSERT INTO users (firstName, lastName, email, password) 
            VALUES (:firstName, :lastName, :email, :password)";
    $bindings = [
      [":firstName", $_POST["firstName"], "str"],
      [":lastName", $_POST["lastName"], "str"],
      [":email", $_POST["email"], "str"],
      [":password", password_hash($_POST["password"], PASSWORD_DEFAULT), "str"]
    ];
    $pdo->otherBinded($sql, $bindings);

    // Clear form values after success
    foreach ($formConfig["fields"] as $key => $field) {
      $formConfig["fields"][$key]["value"] = "";
      $formConfig["fields"][$key]["error"] = "";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <style>
    .text-danger { color: red; font-size: 0.9em; }
    .form-control { margin-bottom: 10px; }
  </style>
</head>
<body>
  <h1>User Registration Form</h1>

  <form method="post" action="index.php">
    <?php
      echo $stickyForm->renderInput($formConfig['fields']['firstName']);
      echo $stickyForm->renderInput($formConfig['fields']['lastName']);
      echo $stickyForm->renderInput($formConfig['fields']['email']);
      echo $stickyForm->renderInput($formConfig['fields']['password']);
      echo $stickyForm->renderInput($formConfig['fields']['confirmPassword']);
    ?>
    <input type="submit" value="Register">
  </form>

  <h2>Registered Users</h2>
  <?php
    $sql = "SELECT firstName, lastName, email FROM users";
    $records = $pdo->selectNotBinded($sql);

    if ($records && count($records) > 0) {
      echo "<table border='1'>";
      echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
      foreach ($records as $row) {
        echo "<tr><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['email']}</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No users registered yet.</p>";
    }
  ?>
</body>
</html>
