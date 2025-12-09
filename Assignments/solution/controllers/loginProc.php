require_once '../classes/Db_conn.php';
require_once '../classes/PdoMethods.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $pdo = new PdoMethods();
    $sql = "SELECT * FROM admins WHERE email = :email";

    // Correct binding format: [":placeholder", value, "type"]
    $bindings = [
        [":email", $email, "str"]
    ];

    $records = $pdo->selectBinded($sql, $bindings);

    if ($records && count($records) > 0) {
        if (password_verify($password, $records[0]['password'])) {
            $_SESSION['name'] = $records[0]['name'];
            $_SESSION['status'] = $records[0]['status'];
            header("Location: ../index.php?page=welcome");
            exit;
        } else {
            $error = "Invalid login credentials.";
            require 'views/loginForm.php';
        }
 } else {
        $error = "No account found with that email.";
        require 'views/loginForm.php';
    }
}
