<?php
require_once __DIR__ . '/../includes/navigation.php';
require_once __DIR__ . '/../classes/PdoMethods.php';
require_once __DIR__ . '/../classes/Db_conn.php';
require_once __DIR__ . '/../classes/Validation.php';


$pdo = new PdoMethods();

// Fetch all admins
$records = $pdo->selectNotBinded("SELECT id, name, email, status FROM admins");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Admins</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Delete Admins</h2>

    <?php if (isset($message)) echo "<p class='text-info'>$message</p>"; ?>

    <?php if (!$records || count($records) === 0): ?>
        <p class="text-muted">No admins found.</p>
    <?php else: ?>
        <form method="post" action="controllers/deleteAdminProc.php">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 120px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td class="text-center">
                            <input type="checkbox" name="delete[]" value="<?php echo (int)$row['id']; ?>">
                        </td>
                    </tr>
                 <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-danger">Delete selected</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
