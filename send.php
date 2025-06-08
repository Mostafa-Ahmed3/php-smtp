<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure this path is correct

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = "thedrk162@gmail.com";  // Your receiving email
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
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'workcv18@gmail.com';     // your Gmail address
        $mail->Password   = 'pwtu yzwq objq mwqf';       // your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('yourgmail@gmail.com', 'Website Contact Form');
        $mail->addAddress($to);
        $mail->addReplyTo($email, "$first_name $last_name");

        // Content
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        header("Location: contact.php?success=1");
        exit;
    } catch (Exception $e) {
        // For debugging, temporarily show the error message
        // Remove echo and just use redirect in production
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
} else {
    header("Location: contact.php");
    exit;
}