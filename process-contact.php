<?php
require_once __DIR__ . '/includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $service = strip_tags(trim($_POST["service"] ?? ''));
    $message = trim($_POST["message"] ?? '');

    // Basic validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?status=error");
        exit();
    }

    try {
        // Ensure the consultations table exists in SQLite
        $pdo->exec("CREATE TABLE IF NOT EXISTS consultations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT,
            email TEXT,
            phone TEXT,
            service TEXT,
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Insert the consultation into the database
        $stmt = $pdo->prepare("INSERT INTO consultations (full_name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $service, $message]);

        // Optional mail dispatch
        $to = "chidexconstruction@gmail.com"; 
        $subject = "New Project Inquiry: " . $service . " from " . $name;
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Phone: $phone\n";
        $email_content .= "Service Required: $service\n\n";
        $email_content .= "Message:\n$message\n";
        $headers = "From: $name <$email>";
        @mail($to, $subject, $email_content, $headers);

        header("Location: contact.php?status=success");
        exit();

    } catch (Exception $e) {
        header("Location: contact.php?status=error");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
?>
