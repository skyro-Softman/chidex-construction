<?php
$page_title = "Home | Chidex Construction Company";
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch the latest 3 projects from the database for the homepage preview
$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC LIMIT 3");
$latest_projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1>Precision Engineering & Structural Integrity</h1>
            <p>From foundational design to structural supervision, delivering durable, safe, and modern construction solutions tailored to industry standards.</p>
            <div class="hero-actions">
                <a href="projects.php" class="btn btn-primary">View Portfolio</a>
                <a href="contact.php" class="btn btn-outline">Consult an Engineer</a>
            </div>
        </div>
    </section>

    <!-- Core Services Overview -->
    <section class="services-overview container">
        <h2>Core Engineering Expertise</h2>
        <div class="grid-3">
            <div class="card">
                <h3>Structural Design</h3>
                <p>Comprehensive calculations, blueprints, and load-bearing models engineered for safety and compliance.</p>
            </div>
            <div class="card">
                <h3>Site Supervision</h3>
                <p>Rigorous quality control, timeline management, and on-site oversight from breaking ground to finishing.</p>
            </div>
            <div class="card">
                <h3>Project Consultation</h3>
                <p>Feasibility studies, material cost estimation, and structural integrity assessments for existing properties.</p>
            </div>
        </div>
    </section>

    <!-- Dynamic Recent Projects Section (Linked to Admin Dashboard) -->
    <section style="background: #e2e8f0; padding: 4rem 0; margin-top: 4rem;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem;">
                <div>
                    <span style="font-size: 0.85rem; font-weight: bold; color: var(--accent); text-transform: uppercase;">Recent Site Work</span>
                    <h2 style="color: var(--primary); font-size: 2.2rem; margin-top: 0.2rem;">Latest Featured Projects</h2>
                </div>
                <a href="projects.php" class="btn btn-primary" style="font-size: 0.9rem;">View All Projects &rarr;</a>
            </div>

            <?php if (empty($latest_projects)): ?>
                <div style="background: white; padding: 2rem; border-radius: 6px; text-align: center; color: #64748b;">
                    No construction projects posted yet. Log into the admin portal to publish your recent building sites!
                </div>
            <?php else: ?>
                <div class="grid-3">
                    <?php foreach($latest_projects as $project): ?>
                        <div class="card" style="overflow: hidden; display: flex; flex-direction: column; background: white;">
                            <?php if (!empty($project['image'])): 
                                $images = explode(',', $project['image']);
                            ?>
                                <div style="margin: -2rem -2rem 1.5rem -2rem; background: #cbd5e1; display: grid; grid-template-columns: repeat(<?php echo count($images) > 1 ? '2' : '1'; ?>, 1fr); gap: 2px; max-height: 180px; overflow: hidden;">
                                    <?php foreach($images as $img): ?>
                                        <div style="height: 150px; overflow: hidden;">
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
                            <div style="font-size: 0.85rem; font-weight: bold; color: var(--primary); margin-top: auto; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                                Completed: <?php echo htmlspecialchars($project['year']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
