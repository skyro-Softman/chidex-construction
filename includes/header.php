<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$company_name = "Chidex Construction Company";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : $company_name . " | Professional Engineering Portfolio"; ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
        <!-- Admin Bar -->
        <div style="background: #0f172a; color: #f59e0b; padding: 0.5rem 1rem; font-size: 0.85rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155;">
            <span>🔧 Admin Mode Active (Logged in as <?php echo htmlspecialchars($_SESSION['admin_user']); ?>)</span>
            <div>
                <a href="/index.php" style="color: #34d399; margin-right: 1rem; text-decoration: underline;">View Public Site</a>
                <a href="/admin/dashboard.php" style="color: white; margin-right: 1rem; text-decoration: underline;">Dashboard</a>
                <a href="/admin/logout.php" style="color: #ef4444; text-decoration: underline;">Logout</a>
            </div>
        </div>
    <?php endif; ?>

    <header class="site-header">
        <div class="container nav-container">
            <div class="logo">
                <a href="/index.php"><span style="font-size: 1.05rem; font-weight: bold;"><?php echo $company_name; ?></span></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/about.php">About</a></li>
                    <li><a href="/services.php">Services</a></li>
                    <li><a href="/projects.php">Projects</a></li>
                    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                        <li><a href="/admin/dashboard.php" style="color: var(--accent); font-weight: bold;">Admin Panel</a></li>
                    <?php endif; ?>
                    <li><a href="/contact.php" class="btn-cta">Request Quote</a></li>
                </ul>
            </nav>
        </div>
    </header>
