<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    try {
        // Ensure the consultations table exists with columns matching the form inputs
        $pdo->exec("CREATE TABLE IF NOT EXISTS consultations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT,
            email TEXT,
            phone TEXT,
            service TEXT,
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        if (!empty($full_name) && !empty($email) && !empty($message)) {
            $stmt = $pdo->prepare("INSERT INTO consultations (full_name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $email, $phone, $service, $message]);
            
            header("Location: contact.php?status=success");
            exit();
        }
    } catch (Exception $e) {
        // Log or handle error silently if needed
    }

    header("Location: contact.php?status=error");
    exit();
}
