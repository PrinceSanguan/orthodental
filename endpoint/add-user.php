<?php
include('../conn/conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['register'])) {
    try {
        $firstName = $_POST['fname'];
        $mname = $_POST['mname'];
        $lastName = $_POST['lname'];
        $position = $_POST['position'];
        $gender = $_POST['gender'];
        $contactNumber = $_POST['contact'];
        $email = $_POST['email2'];
        $bdate = $_POST['bdate'];
        $username = $_POST['username2'];
        $password = $_POST['password2'];
        $address = $_POST['address'];
        $suffix = $_POST['suffix'];

        $conn->beginTransaction();
    
        $stmt = $conn->prepare("SELECT `fname`, `lname` FROM `user_account1` WHERE `fname` = :fname AND `lname` = :lname");
        $stmt->execute([
            'fname' => $firstName,
            'lname' => $lastName
        ]);
        $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (empty($nameExist)) {
            $verificationCode = rand(100000, 999999);
    
            $insertStmt = $conn->prepare("INSERT INTO `user_account1` (`u_id`, `fname`, `mname`, `lname`, `position`, `gender`, `contact`, `email`, `bdate`, `username`, `password`, `address`, `verification_code`, `suffix` ) VALUES (NULL, :fname, :mname, :lname, :position, :gender, :contact, :email, :bdate, :username, :password, :address, :verification_code, :suffix)");

            // $insertStmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
            // $insertStmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
            // $insertStmt->bindParam(':contact', $contactNumber, PDO::PARAM_INT);
            // $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
            // $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
            // $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
            // $insertStmt->bindParam(':verification_code', $verificationCode, PDO::PARAM_INT);
            // $insertStmt->execute();

            $insertStmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
            $insertStmt->bindParam(':mname', $mname, PDO::PARAM_STR);
            $insertStmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
            $insertStmt->bindParam(':position', $position, PDO::PARAM_STR);
            $insertStmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $insertStmt->bindParam(':contact', $contactNumber, PDO::PARAM_INT);
            $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $insertStmt->bindParam(':bdate', $bdate, PDO::PARAM_STR);
            $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
            $insertStmt->bindParam(':address', $address, PDO::PARAM_STR);
            $insertStmt->bindParam(':verification_code', $verificationCode, PDO::PARAM_INT);
            $insertStmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
            $insertStmt->execute();
    
            //Server settings
            $mail->isSMTP(); 
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true; 
            $mail->Username   = 'lorem.ipsum.sample.email@gmail.com';
            $mail->Password   = 'novtycchbrhfyddx';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;                                    
        
            //Recipients
            $mail->setFrom('inquiry@gmail.com', 'Orthodental Clinic');
            $mail->addAddress($email);   
            $mail->addReplyTo('inquiry@orthodental.com', 'Inquiry'); 
        
            //Content
            $mail->isHTML(true);  
            $mail->Subject = 'One-Time Password (OTP)';
            // $mail->Body    = 'Your verification code is: ' . $verificationCode ; 
            $mail->Body = "
    <html>
        <head>
            <style>
                .email-container {
                    font-family: 'Arial', sans-serif;
                    line-height: 1.6;
                    color: #333333;
                    max-width: 600px;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #e6e6e6;
                    border-radius: 8px;
                    background-color: #f9f9f9;
                }
                .email-header {
                    font-size: 20px;
                    font-weight: bold;
                    text-align: center;
                    padding-bottom: 10px;
                    color: #007BFF;
                }
                .otp-code {
                    font-size: 28px;
                    font-weight: bold;
                    text-align: center;
                    color: #007BFF;
                    margin: 20px 0;
                }
                .email-footer {
                    font-size: 12px;
                    text-align: center;
                    color: #999999;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>Your One-Time Password (OTP)</div>
                <p>Hello,</p>
                <p>Thank you for signing up. Please use the following verification code to complete your registration:</p>
                <div class='otp-code'>$verificationCode</div>
                <p>You can only input this code <b>Once</b></p>
                <p>If you did not request this code, please disregard this email.</p>
                <br/>
                <p>Best regards,<br/>The Orthodental Clinic Team</p>
                <div class='email-footer'>© 2024 Orthodental Clinic. All rights reserved.</div>
            </div>
        </body>
    </html>
";
           
            // Success sent message alert
            $mail->send();
            
            session_start();
    
            $userVerificationID = $conn->lastInsertId();
            $_SESSION['user_verification_id'] = $userVerificationID;

            echo "
            <script>
                alert('Check your email for verification code.');
                window.location.href = 'http://localhost/orthodental/verification.php';
            </script>
            ";

            $conn->commit();
        } else {
            echo "
            <script>
                alert('User Already Exists');
                window.location.href = 'http://localhost/orthodental/registration.php';
            </script>
            ";
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['verify'])) {

    try {
        $userVerificationID = $_POST['user_verification_id'];
        $verificationCode = $_POST['verification_code'];
    
        $stmt = $conn->prepare("SELECT `verification_code` FROM `user_account1` WHERE `u_id` = :user_verification_id");
        $stmt->execute([
            'user_verification_id' => $userVerificationID,
        ]);
        $codeExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($codeExist && $codeExist['verification_code'] == $verificationCode) {
            session_destroy();
            echo "
            <script>
                alert('Registered Successfully.');
                window.location.href = 'http://localhost/orthodental/login.php';
            </script>
            ";
        } else {
            $conn->prepare("DELETE FROM `user_account1` WHERE `u_id` = :user_verification_id")->execute([
                'user_verification_id' => $userVerificationID
            ]);

            echo "
            <script>
                alert('Incorrect Verification Code. Register Again.');
                window.location.href = 'http://localhost/orthodental/registration.php';
            </script>
            ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
