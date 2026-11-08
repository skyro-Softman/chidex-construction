<?php
$page_title = "Projects | Chidex Construction Company";
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch projects dynamically from SQLite database
$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container" style="padding: 3rem 0;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: var(--primary); font-size: 2.5rem;">Engineering Portfolio</h1>
        <p style="color: #64748b; max-width: 600px; margin: 0.5rem auto 0;">Explore a selection of our completed structural designs, site supervisions, and engineering audits.</p>
    </div>

    <?php if (empty($projects)): ?>
        <div style="text-align: center; padding: 3rem; background: white; border-radius: 6px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <p style="color: #64748b; font-size: 1.1rem;">No projects currently published. Log into the <a href="admin/login.php" style="color: var(--accent); text-decoration: none; font-weight: bold;">Admin Portal</a> to add your first construction project and photos.</p>
        </div>
    <?php else: ?>
        <div class="grid-3">
            <?php foreach($projects as $project): ?>
                <div class="card" style="overflow: hidden; display: flex; flex-direction: column;">
                    <?php if (!empty($project['image'])): 
                        $images = explode(',', $project['image']);
                    ?>
                        <div style="margin: -2rem -2rem 1.5rem -2rem; background: #e2e8f0; display: grid; grid-template-columns: repeat(<?php echo count($images) > 1 ? '2' : '1'; ?>, 1fr); gap: 2px; max-height: 220px; overflow: hidden;">
                            <?php foreach($images as $img): ?>
                                <div style="height: 180px; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars(trim($img)); ?>" alt="Project Photo" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <span style="display: inline-block; font-size: 0.85rem; font-weight: bold; color: var(--accent); margin-bottom: 0.5rem; text-transform: uppercase;">
                        <?php echo htmlspecialchars($project['category']); ?>
                    </span>
                    <h3 style="margin-bottom: 0.75rem; color: var(--primary);"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p style="margin-bottom: 1rem; color: #475569; font-size: 0.95rem;"><?php echo htmlspecialchars($project['description']); ?></p>
                    <div style="font-size: 0.9rem; font-weight: bold; color: var(--primary); margin-top: auto; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                        Completed: <?php echo htmlspecialchars($project['year']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
