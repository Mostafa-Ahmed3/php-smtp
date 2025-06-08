<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php'; // Make sure this points to your vendor folder

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = "thedrk162@gmail.com"; // Your receiving email
    $subject = "New Contact Form Submission";

    // Sanitize input
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $body = "You received a new message:\n\n";
    $body .= "Name: $first_name $last_name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    $mail = new PHPMailer(true);

    try {
        // Debugging (optional — disable in production)
        $mail->SMTPDebug = 2; // Set to 0 to disable debug output
        $mail->Debugoutput = 'html';

        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'workcv18@gmail.com';              // Your Gmail
        $mail->Password   = 'pwtuyzwqobjqmwqf';                // Your Gmail App Password (no spaces)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('workcv18@gmail.com', 'Dress Alterations Website');
        $mail->addAddress($to); // Recipient
        $mail->addReplyTo($email, "$first_name $last_name");

        // Content
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        header("Location: contact.php?success=1");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
} else {
    header("Location: contact.php");
    exit;
}
