<?php
$page_title = "Services | Building Engineering Expertise";
include 'includes/header.php';

// Array of detailed services
$services = [
    [
        "title" => "Structural Design & Calculations",
        "icon" => "📐",
        "description" => "Rigorous mathematical modeling, architectural drafting coordination, and load-bearing calculations to ensure complete structural safety and regulatory compliance.",
        "deliverables" => ["Detailed Blueprints", "Load & Stress Analysis", "Reinforcement Scheduling", "Regulatory Compliance Reports"]
    ],
    [
        "title" => "Site Supervision & Quality Control",
        "icon" => "🏗️",
        "description" => "On-site oversight from breaking ground to finishing. We monitor construction execution to ensure adherence to engineering standards, timeline targets, and budget constraints.",
        "deliverables" => ["Daily Site Inspection", "Material Quality Testing", "Contractor & Labor Oversight", "Progress Milestone Tracking"]
    ],
    [
        "title" => "Structural Integrity Audits",
        "icon" => "🔍",
        "description" => "Comprehensive diagnostic evaluations of existing residential, commercial, or industrial structures to identify defects, stress cracks, or degradation over time.",
        "deliverables" => ["Crack Propagation Analysis", "Retrofitting Recommendations", "Safety Certification Audits", "Foundation Assessment"]
    ],
    [
        "title" => "Cost Estimation & Feasibility",
        "icon" => "📊",
        "description" => "Detailed material take-offs, bill of quantities (BOQ), and financial feasibility studies to ensure your construction project is economically viable before breaking ground.",
        "deliverables" => ["Bill of Quantities (BOQ)", "Material Sourcing Strategy", "Budget Optimization", "Risk Assessment"]
    ]
];
?>

<main class="container" style="padding: 3rem 0;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: var(--primary); font-size: 2.5rem;">Professional Engineering Services</h1>
        <p style="color: #64748b; max-width: 650px; margin: 0.5rem auto 0;">Delivering technical precision, structural safety, and rigorous quality control across every phase of your construction lifecycle.</p>
    </div>

    <div class="grid-3">
        <?php foreach($services as $service): ?>
            <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;"><?php echo $service['icon']; ?></div>
                    <h3 style="margin-bottom: 0.75rem; color: var(--primary);"><?php echo $service['title']; ?></h3>
                    <p style="margin-bottom: 1.5rem; color: #475569; font-size: 0.95rem;"><?php echo $service['description']; ?></p>
                </div>
                
                <div style="border-top: 1px solid #e2e8f0; padding-top: 1rem; margin-top: auto;">
                    <strong style="font-size: 0.85rem; text-transform: uppercase; color: var(--primary); display: block; margin-bottom: 0.5rem;">Key Deliverables:</strong>
                    <ul style="list-style-type: disc; padding-left: 1.2rem; font-size: 0.85rem; color: #64748b;">
                        <?php foreach($service['deliverables'] as $item): ?>
                            <li><?php echo $item; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Call to Action Banner -->
    <div style="background: var(--primary); color: var(--white); padding: 3rem 2rem; border-radius: 8px; text-align: center; margin-top: 4rem;">
        <h2 style="margin-bottom: 1rem; font-size: 2rem;">Have a Specific Engineering Requirement?</h2>
        <p style="color: #cbd5e1; max-width: 600px; margin: 0 auto 2rem;">Let’s discuss your structural specifications, blueprints, or site supervision needs.</p>
        <a href="contact.php" class="btn btn-primary">Request a Consultation</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
