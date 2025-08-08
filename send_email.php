<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                           // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     // Enable SMTP authentication
        $mail->Username = 'riffindex@gmail.com';                   // SMTP username
        $mail->Password = 'aucu tfzv dymj ludg';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port = 587;                                          // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);                              // Sender's email and name
        $mail->addAddress('riffindex@gmail.com');                   // Add a recipient email

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Contact Form Message';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";

        // Send the email
        if ($mail->send()) {
            // Redirect back to index.php after a successful email send
            header("Location: index.php?status=success");
            exit; // Don't forget to call exit after header redirect
        } else {
            // If the email is not sent, redirect with an error message
            header("Location: index.php?status=error");
            exit;
        }
    } catch (Exception $e) {
        // Redirect with error if PHPMailer fails
        header("Location: index.php?status=error");
        exit;
    }
}
