<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = trim($_POST["message"]);

    // Basic validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?status=error");
        exit();
    }

    // Chidex Construction Company official email recipient
    $to = "chidexconstruction@gmail.com"; 
    $subject = "New Project Inquiry: " . $service . " from " . $name;
    
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Service Required: $service\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // Attempt to send email (or simulate success for local server testing)
    $success = @mail($to, $subject, $email_content, $headers);

    // For local testing on Termux without a configured mail server, keep this as true:
    $success = true; 

    if ($success) {
        header("Location: contact.php?status=success");
    } else {
        header("Location: contact.php?status=error");
    }
} else {
    header("Location: contact.php");
}
?>
