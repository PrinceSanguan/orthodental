<?php
require '../endpoint/phpmailer/src/PHPMailer.php';
require '../endpoint/phpmailer/src/SMTP.php';
require '../endpoint/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $conn = new mysqli('localhost', 'root', '', 'onopack_asdasdsa'); // Update with your DB details

    $user_query = $conn->query("SELECT * FROM user_account1 WHERE u_id = '$user_id'");
    $appointment_query = $conn->query("SELECT * FROM appointment_desc WHERE appointment_id = '$user_id' AND appointment_status = 'Pending'");

    if ($user_query->num_rows > 0 && $appointment_query->num_rows > 0) {
        $user = $user_query->fetch_array();
        $appointment = $appointment_query->fetch_array();

        $email = $user['email'];
        $name = $user['fname'] . " " . $user['lname'];
        $appointment_date = $appointment['appointment_date'];
        $appointment_services = $appointment['appointment_desc'];

        $mail = new PHPMailer(true);
        
        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';// Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'orthobooking123@gmail.com';
            $mail->Password = 'ptoorukoghkjpymd';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Email Details
            $mail->setFrom('orthobooking123@gmail.com', 'Appointment Reminder');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Appointment Reminder';
            $mail->Body = "
                <h1>Appointment Reminder</h1>
                <p>Dear $name,</p>
                <p>This is a reminder for your upcoming appointment on <strong>$appointment_date</strong>.</p>
                <p>Services: $appointment_services</p>
                <p>Thank you!</p>
            ";

            $mail->send();
            echo "Notification sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid user or no pending appointment.";
    }
}
?>