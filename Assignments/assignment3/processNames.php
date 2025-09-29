<?php
function addClearNames() {
    session_start();

    // Initialize session array if not set
    if (!isset($_SESSION['names'])) {
        $_SESSION['names'] = [];
    }

    // If Clear button clicked
    if (isset($_POST['clear'])) {
        $_SESSION['names'] = [];
        return "";
    }

    // If Add button clicked
    if (isset($_POST['add'])) {
        $input = $_POST['nameinput'];

        // Split into first and last name
        $parts = explode(" ", $input);
        $firstname = ucfirst(strtolower($parts[0]));
        $lastname = ucfirst(strtolower($parts[1]));

        // Format: Lastname, Firstname
        $formatted = "$lastname, $firstname";

        // Add to session array
        array_push($_SESSION['names'], $formatted);

        // Sort names
        sort($_SESSION['names']);

        // Return as newline-separated string
        return implode("\n", $_SESSION['names']);
    }

    return "";
}
?>
