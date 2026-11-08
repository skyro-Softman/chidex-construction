<?php
$page_title = "Contact | Request an Engineering Consultation";
include 'includes/header.php';
?>

<main class="container" style="padding: 3rem 0; max-width: 800px;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: var(--primary); font-size: 2.5rem;">Request a Consultation</h1>
        <p style="color: #64748b; margin-top: 0.5rem;">Get in touch for structural design, site supervision, or engineering project inquiries.</p>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 6px; margin-bottom: 2rem; text-align: center; font-weight: bold;">
                Your message has been sent successfully! We will get back to you shortly.
            </div>
        <?php else: ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 2rem; text-align: center; font-weight: bold;">
                There was an error sending your message. Please check your inputs and try again.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="card" style="padding: 2.5rem;">
        <form action="process-contact.php" method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);" for="name">Full Name</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);" for="email">Email Address</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);" for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);" for="service">Service Required</label>
                <select id="service" name="service" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 1rem; background: var(--white);">
                    <option value="Structural Design">Structural Design & Calculations</option>
                    <option value="Site Supervision">Site Supervision & Quality Control</option>
                    <option value="Structural Audit">Structural Integrity Audit</option>
                    <option value="Cost Estimation">Cost Estimation & Feasibility</option>
                    <option value="Other">Other Inquiry</option>
                </select>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary);" for="message">Project Details / Message</label>
                <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 1rem;"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1rem; cursor: pointer; border: none;">Send Inquiry</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
