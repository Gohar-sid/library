<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $city = $_POST['City'] ?? '';
    $organization = $_POST['Organization'] ?? '';
    $visitor = $_POST['Visitor'] ?? '';
    $day = $_POST['day'] ?? '';
    $name = $_POST['name'] ?? '';
    $cnic = $_POST['cnic'] ?? '';

    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $detail = $_POST['Detail'] ?? '';
    // Generate a random 4-digit number and append it to the name
    $randomNumber = rand(1000, 9999);
    $modifiedName = "{$name}-{$randomNumber}";

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
        $mail->setFrom('obaidullah70783@gmail.com', 'Asian Multimedia & Expo');
        $mail->addAddress('obaidullah70783@gmail.com'); // Send a copy to this address
        $mail->addAddress('bigbrickmarketing@gmail.com'); // Send a copy to this address
        $mail->addAddress('lyall1896@gmail.com'); // Send a copy to this address

        $mail->addAddress($email, $name); // Add recipient email

        $mail->isHTML(true);
        $mail->Subject = 'New Registration Submission';

        // Create email template
        $mail->Body = "
            <h2>New Registration Submission</h2>
            <p><strong>City:</strong> {$city}</p>
            <p><strong>Organization:</strong> {$organization}</p>
            <p><strong>Visitor Type:</strong> {$visitor}</p>
            <p><strong>Day:</strong> {$day}</p>
            <h3>Personal Details</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>CNIC:</strong> {$cnic}</p>
            <p><strong>Ticket No:</strong> {$modifiedName}</p>

            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Details:</strong><br>{$detail}</p>
        ";

        // Send email
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Registration request sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
