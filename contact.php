<?php
// Enable error reporting temporarily to debug blank screens
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $service = strip_tags(trim($_POST["service"] ?? ''));
    $message = trim($_POST["message"] ?? '');

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?status=error");
        exit();
    }

    try {
        // Ensure the consultations table exists
        $pdo->exec("CREATE TABLE IF NOT EXISTS consultations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT,
            email TEXT,
            phone TEXT,
            service TEXT,
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO consultations (full_name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $service, $message]);

        header("Location: contact.php?status=success");
        exit();

    } catch (Exception $e) {
        // If something fails, output the error message instead of a white screen
        echo "Database Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
?>
