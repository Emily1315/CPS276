<?php

// Include the navigation bar safely using __DIR__
require __DIR__ . '/../includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome Page</h1>
        <?php if (isset($_SESSION['name'])): ?>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>! You are logged in.</p>
        <?php else: ?>
            <p>Hello! Please <a href="../index.php?page=login">log in</a> to continue.</p>
        <?php endif; ?>
    </div>
</body>
</html>
