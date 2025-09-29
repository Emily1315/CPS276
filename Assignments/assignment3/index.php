<?php
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'processNames.php';
    $output = addClearNames();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 3 - Name Formatter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Add Names</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nameinput" class="form-label">Enter Names:</label>
            <input type="text" class="form-control" id="nameinput" name="nameinput">
        </div>
        <div class="mb-3">
            <button type="submit" name="add" class="btn btn-primary">Add Name</button>
            <button type="submit" name="clear" class="btn btn-danger">Clear Names</button>
        </div>
        <div class="mb-3">
            <label for="namelist" class="form-label">List of Names:</label>
            <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo $output ?></textarea>
        </div>
    </form>
</body>
</html>
