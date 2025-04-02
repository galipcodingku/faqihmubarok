<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan PHPMailer sudah diinstall

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP provider Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'your-email-password'; // Ganti dengan password email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengirim & Penerima
        $mail->setFrom($email, $name);
        $mail->addAddress('your-email@gmail.com'); // Ganti dengan email tujuan

        // Konten Email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "<strong>Name:</strong> $name <br>
                       <strong>Email:</strong> $email <br>
                       <strong>Message:</strong> <br> $message";

        $mail->send();
        echo "Your message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
