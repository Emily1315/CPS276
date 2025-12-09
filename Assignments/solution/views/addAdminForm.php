<?php
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/navigation.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Add Admin</h2>

    <?php if (isset($message)) echo "<p class='text-info'>$message</p>"; ?>

    <form method="post" action="index.php?page=addAdminProc">

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Admin</button>
    </form>
</div>
</body>
</html>
