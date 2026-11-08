<?php
$page_title = "About | Chidex Construction Company";
include 'includes/header.php';
?>

<main class="container" style="padding: 3rem 0;">
    <!-- Profile Intro Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; align-items: center; margin-bottom: 4rem;">
        <div>
            <span style="display: inline-block; font-size: 0.85rem; font-weight: bold; color: var(--accent); margin-bottom: 0.5rem; text-transform: uppercase;">Lead CEO & Structural Engineer</span>
            <h1 style="color: var(--primary); font-size: 2.5rem; margin-bottom: 1rem;">Engr. Otti Chidera</h1>
            <p style="color: #475569; margin-bottom: 1rem; line-height: 1.8;">
                At <strong>Chidex Construction Company</strong>, we bring extensive expertise in building engineering, structural calculations, and rigorous site supervision, bridging the gap between architectural vision and safe, durable physical execution.
            </p>
            <p style="color: #475569; margin-bottom: 2rem; line-height: 1.8;">
                Every project—whether a multi-story commercial complex or a residential estate foundation—is approached through first-principles analysis, strict adherence to international building codes, and unwavering quality control.
            </p>
            <a href="contact.php" class="btn btn-primary">Schedule a Consultation</a>
        </div>
        
        <div class="card" style="border-top: 4px solid var(--primary); background: #1e293b; color: var(--white);">
            <h3 style="color: var(--accent); margin-bottom: 1.5rem; font-size: 1.5rem;">Corporate Details & Contact</h3>
            
            <div style="margin-bottom: 1rem;">
                <strong style="color: var(--accent); display: block; font-size: 0.85rem; text-transform: uppercase;">Office Address:</strong>
                <span style="color: #cbd5e1; font-size: 0.95rem;">6d Onuiyi Rd, Nsukka</span>
            </div>

            <div style="margin-bottom: 1rem;">
                <strong style="color: var(--accent); display: block; font-size: 0.85rem; text-transform: uppercase;">Phone / Call:</strong>
                <a href="tel:+2348137570619" style="color: white; font-size: 1.05rem; text-decoration: none;">+234 813 757 0619</a>
            </div>

            <div style="margin-bottom: 1rem;">
                <strong style="color: var(--accent); display: block; font-size: 0.85rem; text-transform: uppercase;">WhatsApp:</strong>
                <a href="https://wa.me/2348137570619" target="_blank" style="color: #34d399; font-size: 1.05rem; text-decoration: none;">Chat on WhatsApp ↗</a>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <strong style="color: var(--accent); display: block; font-size: 0.85rem; text-transform: uppercase;">Email:</strong>
                <a href="mailto:chidexconstruction@gmail.com" style="color: white; font-size: 1.05rem; text-decoration: none;">chidexconstruction@gmail.com</a>
            </div>

            <hr style="border: 0; border-top: 1px solid #334155; margin: 1.5rem 0;">

            <h4 style="color: var(--accent); margin-bottom: 0.75rem; font-size: 1.1rem;">Core Competencies</h4>
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.5rem; color: #cbd5e1; font-size: 0.9rem;">
                <li>✔️ Advanced Structural Load Analysis</li>
                <li>✔️ Foundation Design & Soil Mechanics</li>
                <li>✔️ On-Site Construction Supervision</li>
                <li>✔️ Bill of Quantities & Material Optimization</li>
            </ul>
        </div>
    </div>

    <!-- Engineering Philosophy Grid -->
    <div style="text-align: center; margin-bottom: 3rem;">
        <h2 style="color: var(--primary); font-size: 2rem;">Our Engineering Philosophy</h2>
        <p style="color: #64748b; max-width: 600px; margin: 0.5rem auto 0;">The core pillars that guide every blueprint, calculation, and site inspection.</p>
    </div>

    <div class="grid-3" style="margin-bottom: 4rem;">
        <div class="card">
            <h3>1. Uncompromising Safety</h3>
            <p style="color: #475569;">Structural integrity is non-negotiable. Every load-bearing model is calculated with safety factors that exceed standard regulatory thresholds.</p>
        </div>
        <div class="card">
            <h3>2. Empirical Precision</h3>
            <p style="color: #475569;">We eliminate guesswork. Decisions are driven by rigorous mathematical modeling, material testing, and environmental load assessments.</p>
        </div>
        <div class="card">
            <h3>3. Resource Efficiency</h3>
            <p style="color: #475569;">Optimizing material utilization and labor execution to deliver robust structures on schedule and within budget constraints.</p>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
