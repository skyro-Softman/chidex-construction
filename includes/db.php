<?php
// SQLite database file path (stored in root directory)
$db_file = __DIR__ . '/../database.sqlite';

try {
    $pdo = new PDO("sqlite:" . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create Projects table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT NOT NULL,
        description TEXT NOT NULL,
        year TEXT NOT NULL,
        image TEXT
    )");

    // Create Admins table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL
    )");

    // Insert a default admin account if none exists (Username: admin, Password: password123)
    $stmt = $pdo->query("SELECT COUNT(*) FROM admins");
    if ($stmt->fetchColumn() == 0) {
        $default_user = 'admin';
        $default_pass = password_hash('password123', PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $insert->execute([$default_user, $default_pass]);
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
