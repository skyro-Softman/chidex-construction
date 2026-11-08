<?php
@ini_set('upload_max_filesize', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

session_start();
require_once '../includes/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) or $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$msg = '';
$error = '';

// Handle Project Addition with Multiple Images
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $year = trim($_POST['year']);
    $imagePaths = [];

    // Handle Multiple Image Uploads
    if (isset($_FILES['project_images'])) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileCount = count($_FILES['project_images']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['project_images']['error'][$i] == 0) {
                $fileName = time() . '_' . $i . '_' . basename($_FILES['project_images']['name'][$i]);
                $targetFile = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['project_images']['tmp_name'][$i], $targetFile)) {
                    $imagePaths[] = 'uploads/' . $fileName;
                }
            }
        }
    }

    // Convert array of image paths into a comma-separated string for storage
    $imageString = implode(',', $imagePaths);

    if (!empty($title) and !empty($category) and !empty($description)) {
        $stmt = $pdo->prepare("INSERT INTO projects (title, category, description, year, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $category, $description, $year, $imageString]);
        $msg = "Project and photos added successfully!";
    } else {
        $error = "Please fill in all required fields.";
    }
}

// Handle Project Deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php");
    exit();
}

// Fetch all projects
$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$page_title = "Admin Dashboard | Chidex Construction Company";
include '../includes/header.php';
?>

<main class="container" style="padding: 3rem 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="color: var(--primary); font-size: 2rem;">Engineer Dashboard</h1>
            <p style="color: #64748b;">Welcome back, <?php echo htmlspecialchars($_SESSION['admin_user']); ?>. Manage your portfolio items below.</p>
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <a href="../index.php" class="btn" style="background: #0284c7; color: white; text-decoration: none; font-size: 0.9rem;">View Public Site</a>
            <a href="logout.php" class="btn" style="background: #ef4444; color: white; text-decoration: none; font-size: 0.9rem;">Logout</a>
        </div>
    </div>

    <?php if($msg): ?>
        <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-weight: bold;"><?php echo $msg; ?></div>
    <?php endif; ?>
    <?php if($error): ?>
        <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-weight: bold;"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Add Project Form Card -->
    <div class="card" style="margin-bottom: 3rem; padding: 2rem;">
        <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Add New Construction Project (Multiple Photos Allowed)</h3>
        <form method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Project Title</label>
                    <input type="text" name="title" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Category</label>
                    <input type="text" name="category" placeholder="e.g. Structural Design" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Completion Year</label>
                    <input type="text" name="year" placeholder="e.g. 2026" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Project Photos (Select Multiple)</label>
                    <input type="file" name="project_images[]" accept="image/*" multiple style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; background: white;">
                </div>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);">Project Description</label>
                <textarea name="description" rows="3" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;"></textarea>
            </div>
            <button type="submit" name="add_project" class="btn btn-primary" style="border: none; cursor: pointer;">Upload & Publish Project</button>
        </form>
    </div>

    <!-- Existing Projects Management List -->
    <h3 style="color: var(--primary); margin-bottom: 1.5rem;">Existing Portfolio Projects</h3>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        <?php if(empty($projects)): ?>
            <p style="color: #64748b;">No projects added yet. Use the form above to publish your first project.</p>
        <?php else: ?>
            <?php foreach($projects as $p): ?>
                <div class="card" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem;">
                    <div>
                        <span style="font-size: 0.8rem; font-weight: bold; color: var(--accent); text-transform: uppercase;"><?php echo htmlspecialchars($p['category']); ?> (<?php echo htmlspecialchars($p['year']); ?>)</span>
                        <h4 style="color: var(--primary); font-size: 1.2rem; margin: 0.25rem 0;"><?php echo htmlspecialchars($p['title']); ?></h4>
                        <p style="font-size: 0.9rem; color: #64748b; max-width: 700px;"><?php echo htmlspecialchars($p['description']); ?></p>
                    </div>
                    <div>
                        <a href="dashboard.php?delete=<?php echo $p['id']; ?>" onclick="return confirm('Are you sure you want to delete this project?');" style="background: #fee2e2; color: #991b1b; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem; font-weight: bold;">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
