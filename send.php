<?php
require __DIR__ . '/vendor/autoload.php';   // Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$first = htmlspecialchars($_POST['first_name']);
$last  = htmlspecialchars($_POST['last_name']);
$from  = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$msg   = htmlspecialchars($_POST['message']);

$mail          = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = $_ENV['SMTP_USER'] ?? 'workcv18@gmail.com';
$mail->Password   = $_ENV['SMTP_PASS'] ?? 'pwtuyzwqobjqmwqf';   // 16-char app password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;

$mail->setFrom('workcv18@gmail.com', 'Dress Alterations Website');
$mail->addAddress('thedrk162@gmail.com');                  // destination
$mail->addReplyTo($from, "$first $last");

$mail->Subject = 'New Contact Form Submission';
$mail->Body = "Name: $first $last\nEmail: $from\n\nMessage:\n$msg";

try {
    $mail->send();
    header('Location: contact.php?success=1');
} catch (Exception $e) {
    // log real error server-side; show generic message to user
    error_log('Mailer error: ' . $mail->ErrorInfo);
    header('Location: contact.php?error=1');
}
