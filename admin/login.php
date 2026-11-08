<?php
session_start();
require_once '../includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $admin['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

$page_title = "Admin Login | BuildCorp";
include '../includes/header.php';
?>

<main class="container" style="padding: 4rem 0; max-width: 450px;">
    <div class="card" style="padding: 2.5rem;">
        <h2 style="color: var(--primary); margin-bottom: 1.5rem; text-align: center;">Engineer Portal Login</h2>
        
        <?php if($error): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; text-align: center; font-size: 0.9rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Username</label>
                <input type="text" name="username" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; border: none; cursor: pointer;">Secure Login</button>
        </form>
        
        <p style="text-align: center; margin-top: 1.5rem; font-size: 0.85rem; color: #64748b;">
            Default login: <b>admin</b> / <b>password123</b>
        </p>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
