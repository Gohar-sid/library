<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $detail = $_POST['Detail'] ?? '';

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'obaidullah70783@gmail.com'; // Replace with your email
        $mail->Password = 'gqpwcurxvcdpjats'; // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('obaidullah70783@gmail.com', 'Asian Multi Media & Expo Pvt Limited');
        $mail->addAddress('your@example.com', $name); // Add recipient email
       $mail->addAddress('bigbrickmarketing@gmail.com'); // Send a copy to this address
        $mail->addAddress('lyall1896@gmail.com'); // Send a copy to this address
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';

        // Create email template
        $mail->Body = "
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Details:</strong><br>{$detail}</p>
        ";

        // Send email
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
