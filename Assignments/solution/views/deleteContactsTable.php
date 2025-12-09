require 'includes/navigation.php';
require_once 'classes/PdoMethods.php';

$pdo = new PdoMethods();

// Fetch all contacts
$records = $pdo->selectNotBinded("SELECT id, fname, lname, email FROM contacts");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Contacts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Delete Contacts</h2>

    <?php if (isset($message)) echo "<p class='text-info'>$message</p>"; ?>

    <?php if (!$records || count($records) === 0): ?>
        <p class="text-muted">No contacts found.</p>
    <?php else: ?>
        <form method="post" action="controllers/deleteContactProc.php">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 120px;">Delete</th>
                    </tr>                                                          </thead>
                <tbody>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="text-center">
                            <input type="checkbox" name="delete[]" value="<?php echo (int)$row['id']; ?>">
                        </td>                                                          </tr>
                <?php endforeach; ?>                                               </tbody>
            </table>

            <button type="submit" class="btn btn-danger">Delete selected</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
       
