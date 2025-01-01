<?php
// Connection variables
$host = "localhost";
$user = "root";
$password = "";
$database = "onopack_asdasdsa";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../endpoint/phpmailer/src/PHPMailer.php';
require '../endpoint/phpmailer/src/SMTP.php';
require '../endpoint/phpmailer/src/Exception.php';

if (isset($_POST['update_services'])) {
  $appointment_id = $_POST['appointment_id'];

  // Check if at least one service is selected
  if (!isset($_POST['services']) || count($_POST['services']) < 1) {
    echo '<script>
            alert("You must keep at least one service!");
            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    exit;
  }

  // Update services
  $services = implode('-', $_POST['services']);

  // Get appointment details including user information
  $sql = "SELECT a.*, u.email, u.fname, u.mname, u.lname 
            FROM appointment_desc a 
            JOIN user_account1 u ON a.appointment_id = u.u_id 
            WHERE a.appointment_desc_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $appointment_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $appointment = $result->fetch_assoc();

  // Get updated service names
  $service_names = [];
  foreach ($_POST['services'] as $service_id) {
    $q = $conn->query("SELECT services_name FROM services WHERE services_id = '$service_id'");
    if ($service = $q->fetch_assoc()) {
      $service_names[] = $service['services_name'];
    }
  }

  // Update the appointment
  $sql_update = "UPDATE appointment_desc SET appointment_desc = ? WHERE appointment_desc_id = ?";
  $stmt_update = $conn->prepare($sql_update);

  if (!$stmt_update) {
    echo '<script>
            alert("Failed to prepare the statement!");
            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    exit;
  }

  $stmt_update->bind_param("si", $services, $appointment_id);


  // Execute the update
  if ($stmt_update->execute()) {
    // Send email notification
    $mail = new PHPMailer(true);

    try {
      // Server settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'orthobooking123@gmail.com';
      $mail->Password = 'ptoorukoghkjpymd';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Email Details
      $mail->setFrom('orthobooking123@gmail.com', 'Appointment Reminder');
      $mail->addAddress($appointment['email']);

      // Format date for email
      $appointment_date = date("F j, Y", strtotime($appointment['appointment_date']));
      $appointment_time = date("g:i A", strtotime($appointment['appointment_date']));

      // Email content
      $mail->isHTML(true);
      $mail->Subject = 'Your Appointment Services Have Been Updated';

      $body = "Dear " . $appointment['fname'] . " " . $appointment['lname'] . ",<br><br>";
      $body .= "This is to inform you that your appointment services for " . $appointment_date . " at " . $appointment_time . " have been updated.<br><br>";
      $body .= "Your updated services are:<br>";
      $body .= "<ul>";
      foreach ($service_names as $service) {
        $body .= "<li>" . $service . "</li>";
      }
      $body .= "</ul><br>";
      $body .= "If you have any questions about these changes, please don't hesitate to contact us.<br><br>";
      $body .= "Best regards,<br>Your Dental Team";

      $mail->Body = $body;

      $mail->send();

      echo '<script>
                alert("Services updated successfully and notification email sent!");
                window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
            </script>';
    } catch (Exception $e) {
      echo '<script>
                alert("Services updated but failed to send email: ' . $mail->ErrorInfo . '");
                window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
            </script>';
    }
  } else {
    echo '<script>
            alert("Error updating services!");
            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
  }

  $stmt_update->close();
}

$conn->close();
