<?php
 require_once "connect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

	date_default_timezone_set('Asia/Manila');
	
                                $username = htmlspecialchars($_SESSION["u_id"]);
                                $q = $conn->query("SELECT * FROM `user_account1` WHERE `u_id` = '$username'");
                                $f = $q->fetch_array();
                                    $u_id = $f['u_id'];
                                    $name = "".$f['fname']." ".$f['mname']." ".$f['lname']."";
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orthodental Clinic</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap" 
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Font Awesome (Latest Version) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body onload="myFunction()" class="d-flex flex-column min-vh-100">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="me-3"><i class="fa fa-map-marker-alt me-2"></i>247 National Highway San Vicente, Binãn, Philippines, 4024</small>
                    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 09am - 5pm</small>
                    <i class="fa-regular fa-user"></i>
                </div>
              <div>
                <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat | 09am - 5pm</small>
              </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-black pt-4 pb-5 d-none d-lg-flex">
        <div class="container pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <i class="bi bi-telephone-inbound fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-black mb-0">Call Now</h5>
                        <span>09176286447</span>
                    </div>
                </div>
                <a href="home.php">
                    <img src="img/logo_square.png" alt="Logo" style="width:220px;">
                </a>
                <div class="d-flex">
                    <i class="bi bi-envelope fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-black mb-0">Mail Now</h5>
                        <span>victorherrera@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-0 px-lg-3">
                <a href="index.php" class="navbar-brand d-lg-none">Orthodental</h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="home.php" class="nav-item nav-link ">Home</a>
                        <!-- appointment dropdown -->
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown" style="text-transform:capitalize;">Appointment</a>     
                            <div class="dropdown-menu bg-light m-0">
                                <a href="book-history.php" class="dropdown-item text">Latest</a>
                                <a href="history.php" class="dropdown-item text" >History</a>
                            </div>
                        </div>
                        <!-- ^^dropdown -->
                        <a href="medical-history.php" class="nav-item nav-link ">Medical History</a>
                        <a href="message.php" class="nav-item nav-link">Message  
                        <?php
        					$q1 = $conn->query("SELECT count(*) as count_msg FROM `chat` WHERE `chat_to` = '$u_id' AND `chat_user_id`='11' AND `view`=''") or die(mysqli_error($conn));
        					$f1 = $q1->fetch_array();
                            echo "<b style='color:white; background-color:darkblue; padding:3px; border-radius:5px; opacity:70%;'>".$f1['count_msg']."</b>"; 
                        ?></a>
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-item nav-link dropdown-toggle active" data-bs-toggle="dropdown" style="text-transform:capitalize;"> <?php echo $name;?> </a>     
                            <div class="dropdown-menu bg-light m-0">
                                <a href="user.php" class="dropdown-item text">User</a>
                                <a href="#" class="dropdown-item text" data-bs-toggle="modal" data-bs-target="#settingsModal" >Settings</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto d-none d-lg-flex">
                        <?php 
                        
                                $q_count = $conn->query("SELECT count(*) as total FROM `medical_history` WHERE `u_id` = '$u_id'");
                                $f_count = $q_count->fetch_array();
                                if($f_count['total']==0){
                        ?>
                            <!-- <a class="btn btn-primary ms-2" href="medical-history.php">Update Medical First</a> -->
                        <?php        
                                }else{
                        ?>
                            <a class="btn btn-primary ms-2" href="#" data-bs-toggle="modal" data-bs-target="#book">Book Now</a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    

    <div class="modal fade" id="book" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:50px;">
    <div class="modal-body">
        <!-- Existing Form Fields -->
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Book Date</label>
                <input type="date" class="form-control form-control-user" id="datepicker" name="date" autofocus min="<?php echo date('Y-m-d'); ?>" required>
                <input type="hidden" class="form-control form-control-user" name="user_id" autofocus value="<?php echo $u_id; ?>" required>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Select Time Schedule</label>
                <select name="schedule_time" class="form-control" required>
                    <option value="">Please Time Schedule</option>
                    <?php for ($i = 8; $i <= 17; $i++) {
                        $period = $i < 12 ? 'AM' : 'PM';
                        $hour = $i % 12;
                        $hour = $hour ? $hour : 12;
                        $timeString = sprintf('%02d:00 %s', $hour, $period);
                    ?>
                        <option value="<?php echo sprintf('%02d:00', $i); ?>"><?php echo $timeString; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label>Service List</label>
                <div class="form-check">
                    <?php $q_e = $conn->query("SELECT * FROM `services` WHERE `services_status`='0'");
                    while ($f_e = $q_e->fetch_array()) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="<?php echo $f_e['services_id']; ?>" id="service-<?php echo $f_e['services_id']; ?>">
                            <label class="form-check-label" for="service-<?php echo $f_e['services_id']; ?>" style="text-transform:capitalize;">
                                <?php echo $f_e['services_name']; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <small class="form-text fst-italic text-danger">Price may vary depends on the teeth condition</small>

        <!-- New Health Declaration Section -->
        <div class="form-group mt-4">
            <label><strong>Health Declaration</strong></label>
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="feeling_well" value="yes" id="feeling_well_yes"
                    onclick="this.value = this.checked ? 'yes' : 'no'">
                <span> Are you currently feeling well or experiencing any illness?</span>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="fever_cough" value="yes" id="fever_cough_yes"
                    onclick="this.value = this.checked ? 'yes' : 'no'">
                <span> Do you have a fever, cough, sore throat, or shortness of breath?</span>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="nausea" value="yes" id="nausea_yes"
                    onclick="this.value = this.checked ? 'yes' : 'no'">
                <span> Have you experienced nausea, vomiting, or diarrhea in the past 48 hours?</span>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="tooth_gum_pain" value="yes" id="tooth_gum_pain_yes"
                    onclick="this.value = this.checked ? 'yes' : 'no'">
                <span> Do you currently have any tooth or gum pain?</span>
            </div>
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
            </label>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
        <button class="btn btn-danger" name="Send">Book An Appointment</button>
    </div>
</form>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please read the following terms and conditions carefully before booking:</p>
                <ul>
                    <li>Appointments are subject to availability and confirmation.</li>
                    <li>Cancellations or changes must be made at least 24 hours in advance.</li>
                    <li>Prices may vary depending on the condition of the teeth and the services required.</li>
                    <li>Late arrivals may result in rescheduling or reduced service time.</li>
                    <li>Payment is required at the time of service unless otherwise arranged.</li>
                </ul>
                <p>By agreeing to these terms, you confirm your understanding and acceptance.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
if(isset($_POST['Send'])){
    $schedule_time = $_POST['schedule_time'];
    $date = $_POST['date'] . " - " . $schedule_time; // Combine date and time
    $user_id = $_POST['user_id'];
    $services = implode(',', $_POST['services'] ?? []); // Handle multiple selected services
    
    // Get health screening answers
    $feeling_well = $_POST['feeling_well'];
    $fever_cough = $_POST['fever_cough'];
    $nausea = $_POST['nausea'];
    $tooth_gum_pain = $_POST['tooth_gum_pain'];
    
    // Query to check if the specific date and time are already booked
    $q1 = $conn->query("SELECT COUNT(*) FROM `appointment_desc` WHERE `appointment_date` = '$date'");
    $f1 = $q1->fetch_array(MYSQLI_NUM);
    $count_time = $f1[0];
    
    // If the specific time is already booked, show an error message
    if($count_time > 0){
        echo '<script>
            swal({
                title: "Time Conflict!",
                text: "This time slot is already booked. Please choose another time.",
                icon: "error",
                button: "Ok"
            });
        </script>';
    } else {
        // Proceed to insert the new appointment with health screening data
        $sql_sched1 = "INSERT INTO appointment_desc (
            appointment_id, 
            appointment_desc, 
            appointment_date, 
            why, 
            appointment_update_by, 
            appointment_status,
            feeling_well,
            fever_cough,
            nausea,
            tooth_gum_pain
        ) VALUES (
            '$user_id', 
            '$services', 
            '$date', 
            '', 
            '', 
            'Pending',
            '$feeling_well',
            '$fever_cough',
            '$nausea',
            '$tooth_gum_pain'
        )";
        
        if (mysqli_query($conn, $sql_sched1)){
            echo '<script>
                swal({
                    title: "Success!",
                    text: "Your booking request was submitted successfully!",
                    icon: "success",
                    type: "success"
                }).then(function() {
                    window.location = "home.php";
                });
            </script>';
        } else {
            echo '<script>
                swal({
                    title: "Failed!",
                    text: "Please try again",
                    icon: "error",
                    button: "Ok"
                });
            </script>';
        }
    }
}
?>
      </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <center>Do you want to Signout?</center>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Close</button>
            <a  href="logout.php" class="btn btn-danger" >Logout</a>
        </div>
      </div>
    </div>
    </div>
    
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> <form  method="post" enctype = "multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:50px;">
        <div class="modal-body">
                <div class = "form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-user" name = "email" value="<?php echo $f['email'];?>"  required>
                        <input type="hidden" class="form-control form-control-user" name = "user_id"  autofocus value="<?php echo $u_id?>" required>
                    </div>     
                </div>
                <div class = "form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>First Name</label>
                        <input type="text" class="form-control form-control-user" name = "fname" value="<?php echo $f['fname'];?>"  required>
                    </div>     
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Middle Name</label>
                        <input type="text" class="form-control form-control-user" name = "mname" value="<?php echo $f['mname'];?>"  required>
                    </div>     
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Last Name</label>
                        <input type="text" class="form-control form-control-user" name = "lname" value="<?php echo $f['lname'];?>"  required>
                    </div>     
                </div>
                <div class = "form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-user" name = "password" >
                        <input type="hidden" class="form-control form-control-user" name = "password_current" value="<?php echo $f['password'];?>"  >
                    </div>     
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Confirm</label>
                        <input type="password" class="form-control form-control-user" name = "cpassword"  >
                    </div>     
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Current Password</label>
                        <input type="password" class="form-control form-control-user" name = "current_password"  required>
                    </div>     
                </div>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button  class="btn btn-danger" name="update_data">Update Data</button>
        </div>
        </form>
        <?php
            if(isset($_POST['update_data'])){
                $email   = $_POST['email'];
                $user_id = $_POST['user_id'];
                $fname   = $_POST['fname'];
                $mname   = $_POST['mname'];
                $lname   = $_POST['lname'];
                $password    = $_POST['password'];
                $cpassword   = $_POST['cpassword'];
                $password_current   = $_POST['password_current'];
                $current_password = $_POST['current_password'];
                if($password==null){
                    $password_update = $password_current;
                    $update = $conn->query("UPDATE `user_account1` SET `email` = '$email',`fname`='$fname',`mname`='$mname',`lname`='$lname',`password`='$password_update' WHERE `u_id` = '$user_id'");
                    
    if ($update) {
        echo '<script>
                function myFunction() {
                    swal({
                        title: "Success! ",
                        text: "Successfully Updated Sign In Again",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                        window.location = "logout.php";
                    });
                }
              </script>';
    } else {
        echo '<script>
                function myFunction() {
                    swal({
                        title: "Failed!",
                        text: "Please Try Again",
                        icon: "error",
                        button: "Ok",
                    });
                }
              </script>';
    }
                }elseif($password==$cpassword){
                     if(password_verify($current_password, $password_current)){
                         $password_update = password_hash($password, PASSWORD_DEFAULT);
                         $update = $conn->query("UPDATE `user_account1` SET `email` = '$email',`fname`='$fname',`mname`='$mname',`lname`='$lname',`password`='$password_update' WHERE `u_id` = '$user_id'");
                         
    if ($update) {
        echo '<script>
                function myFunction() {
                    swal({
                        title: "Success! ",
                        text: "Successfully Updated Sign In Again",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                        window.location = "logout.php";
                    });
                }
              </script>';
    } else {
        echo '<script>
                function myFunction() {
                    swal({
                        title: "Failed!",
                        text: "Please Try Again",
                        icon: "error",
                        button: "Ok",
                    });
                }
              </script>';
    }
                     }else{
                                echo '<script>
                                function myFunction() {
                                    swal({
                                        title: "Failed!",
                                        text: "Please Try Again",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                }
                               </script>';
                     }
                }else{
                    
                                echo '<script>
                                function myFunction() {
                                    swal({
                                        title: "Failed!",
                                        text: "Mismatch Password",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                }
                               </script>';
                }
                
                }
                
                    
                
            
        ?>
      </div>
    </div>
    </div>

<!-- Service Start -->
           
<?php
session_start();

// Debug: Check if user is logged in
if (!isset($_SESSION['u_id'])) {
    echo "User not logged in";
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['u_id'];

// Debug: Print user ID
echo "<!-- User ID: " . $user_id . " -->";

// 1. Place functions here, before you use them

/**
 * Get tooth information based on the number and records
 */
function getToothInfo($tooth_number, $records) {
    foreach ($records as $record) {
        $dental_file_numbers = explode(',', $record['dental_file']);
        if (in_array($tooth_number, $dental_file_numbers)) {
            return [
                'status' => $record['dental_status'],
                'color' => getStatusColor($record['dental_status']),
                'data' => $record
            ];
        }
    }
    return null;
}

/**
 * Get color based on the status
 */
function getStatusColor($status) {
    switch (strtolower($status)) {
        case 'completed':
            return '#FF0000'; // Red
        case 'filled':
            return '#00FF00'; // Green
        case 'missing':
            return '#808080'; // Gray
        case 'bridge':
            return '#FFA500'; // Orange
        default:
            return '#007bff'; // Default Blue
    }
}

// Add this function to your existing PHP code
function renderToothModals($records) {
    foreach ($records as $record) {
        $dental_file_numbers = explode(',', $record['dental_file']);
        foreach ($dental_file_numbers as $tooth_number) {
            echo "<div class='tooth-modal' id='modal-{$tooth_number}' style='display:none;'>";
            echo "  <div class='modal-content1'>";
            echo "    <span class='close' onclick='closeModal({$tooth_number})'>&times;</span>";
            echo "    <h3>Tooth #{$tooth_number} Details</h3>";
            echo "    <div class='modal-details'>";
            echo "      <p><strong>Status:</strong> " . htmlspecialchars($record['dental_status']) . "</p>";
            echo "      <p><strong>Date:</strong> " . htmlspecialchars($record['dental_date']) . "</p>";
            echo "      <p><strong>Description:</strong> " . htmlspecialchars($record['dental_brace']) . "</p>";
            echo "      <p><strong>Comment:</strong> " . htmlspecialchars($record['dental_comment']) . "</p>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";
        }
    }
}

/**
 * Adjust brightness of a hex color
 */
function adjustBrightness($hex, $factor) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2)) * $factor;
    $g = hexdec(substr($hex, 2, 2)) * $factor;
    $b = hexdec(substr($hex, 4, 2)) * $factor;
    return sprintf("#%02x%02x%02x", min(255, $r), min(255, $g), min(255, $b));
}

// 2. Fetch dental records for logged-in user
$sql = "SELECT * FROM dental_history WHERE dental_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dental_records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dental_records[] = $row;
    }
}
?>

<?php
// Function to generate the modal header
function renderModalHeader()
{
    return "<div class='text-center mx-auto' data-wow-delay='0.1s' style='max-width: 300px;'>
                <h4 class='display-6 mb-3'>Brace Only</h4>
            </div>";
}

// Function to render teeth based on brace type
function renderTeeth($start, $end, $records, $brace_type) {
    // Find the matching brace record
    $brace_record = null;
    foreach ($records as $record) {
        if ($record['dental_file'] === $brace_type) {
            $brace_record = $record;
            break;
        }
    }
    
    for ($i = $start; $i <= $end; $i++) {
        $hasRecord = ($brace_record !== null && $brace_record['dental_file'] === $brace_type);
        $color = $hasRecord ? getStatusColor1($brace_record['dental_status']) : 'transparent'; // Use transparent instead of #ccc
        
        echo "<div class='dental-chart-brace-tooth-container' style='--angle: " . (-104 + (($i - $start + 1) * 12)) . "deg;'>";
        
        // Only add the has-record class and onclick if there's actually a record
        $classes = 'dental-chart-brace-tooth' . ($hasRecord ? ' has-record' : '');
        $clickHandler = $hasRecord ? "onclick='showModal(\"$brace_type\")'" : '';
        
        echo "<div class='$classes' data-tooth-group='$brace_type' $clickHandler>";
        echo "<i class='fa-solid fa-tooth fa-2x' style='color: $color;'></i>";
        echo "</div>";
        
        echo "</div>";
    }
}

// Function to get color based on status
function getStatusColor1($status)
{
    switch (strtolower($status)) {
        case 'completed':
            return '#FF0000'; // Red for completed
        case 'filled':
            return '#00FF00'; // Green for filled
        case 'missing':
            return '#808080'; // Gray for missing
        case 'bridge':
            return '#FFA500'; // Orange for bridge
        default:
            return '#007bff'; // Default blue
    }
}

// Fetch dental records for the logged-in user
$sql = "SELECT * FROM dental_history WHERE dental_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dental_records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dental_records[] = $row;
    }
}
?>

<style>
/* Grid container */
.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two equal columns */
    gap: 20px; /* Space between columns */
    padding: 20px;
    height: 80vh; /* Full viewport height */
}

/* Left column */
.left-column {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Right column */
.right-column {
    background-color: #e0e0e0;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Responsive design */
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr; /* Stack columns on smaller screens */
    }
}
</style>

<div class="grid-container">
    <div class="left-column">
        <h2>Tooth Chart</h2>
        <div class="jaw upper-jaw">
            <?php
            for ($i = 1; $i <= 16; $i++) {
                $toothInfo = getToothInfo($i, $dental_records);
                $hasRecord = !is_null($toothInfo);

                echo "<div class='tooth-container' style='--angle: " . (-100 + ($i * 12)) . "deg;'>";

                echo "<div class='tooth " . ($hasRecord ? 'has-record' : '') . "' 
                        data-tooth-num1='$i'
                        style='" . ($hasRecord ? "cursor: pointer;" : "") . "'>";

                echo "<i class='fa-solid fa-tooth fa-2x' 
                        style='" . ($hasRecord ? "color: {$toothInfo['color']};" : "") . "'></i>";

                echo "</div>"; // End tooth
                echo "</div>"; // End tooth-container
            }
            ?>
        </div>
        <!-- Lower Jaw -->
        <div class="jaw lower-jaw">
            <?php
            for ($i = 17; $i <= 32; $i++) {
                $toothInfo = getToothInfo($i, $dental_records);
                $hasRecord = !is_null($toothInfo);

                echo "<div class='tooth-container' style='--angle: " . (-105 + (($i - 16) * 12)) . "deg;'>";

                echo "<div class='tooth " . ($hasRecord ? 'has-record' : '') . "' 
                        data-tooth-num1='$i'
                        style='" . ($hasRecord ? "cursor: pointer;" : "") . "'>";

                echo "<i class='fa-solid fa-tooth fa-2x' 
                        style='" . ($hasRecord ? "color: {$toothInfo['color']};" : "") . "'></i>";

                echo "</div>"; // End tooth
                echo "</div>"; // End tooth-container
            }

            renderToothModals($dental_records);
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const teeth = document.querySelectorAll('.tooth.has-record');

            // Add click event listeners to teeth with records
            teeth.forEach(tooth => {
                tooth.addEventListener('click', function () {
                    const toothNum = this.getAttribute('data-tooth-num1');
                    const modal = document.getElementById(`modal-${toothNum}`);

                    if (modal) {
                        // Show the modal
                        modal.style.display = 'flex';
                    }
                });
            });

            // Add click event listener to close modals when clicking outside
            window.addEventListener('click', function (event) {
                if (event.target.classList.contains('tooth-modal')) {
                    event.target.style.display = 'none';
                }
            });

            // Close modal using the close button
            window.closeModal = function (toothNum) {
                const modal = document.getElementById(`modal-${toothNum}`);
                if (modal) {
                    modal.style.display = 'none';
                }
            };
        });
    </script>

    <div class="right-column">
        <h2>Tooth Brace Chart</h2>
        <div class="dental-chart-brace">
            <!-- Remove onclick from jaw divs -->
            <div class="jaw upper-jaw mb-4">
                <?php renderTeeth(1, 16, $dental_records, 'brace_upper'); ?>
            </div>
            
            <div class="jaw lower-jaw">
                <?php renderTeeth(17, 32, $dental_records, 'brace_lower'); ?>
            </div>
        </div>
    </div>
</div>

<style>
.jaw {
    position: relative;
    width: 100%;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.upper-jaw {
    transform-origin: bottom center;
}

.lower-jaw {
    transform-origin: top center;
}

.tooth-container {
    position: absolute;
    width: 60px;
    height: 200px;
    transform-origin: center bottom;
    transform: rotate(var(--angle));
    display: flex;
    justify-content: flex-start;
    align-items: center;
    pointer-events: none;
}

.lower-jaw .tooth-container {
    transform-origin: center top;
}

.tooth {
    position: relative;
    width: 50px;
    height: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: auto;
}

.upper-jaw .tooth {
    transform: rotate(calc(-1 * var(--angle)));
}

.lower-jaw .tooth {
    transform: rotate(calc(-1 * var(--angle)));
}

.tooth-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}

.modal-content1 {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    position: relative;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.modal-content1 .close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.modal-content1 .close:hover,
.modal-content1 .close:focus {
    color: #000;
    text-decoration: none;
}

.modal-details {
    margin-top: 15px;
}

.modal-details p {
    margin: 10px 0;
    line-height: 1.6;
}

.modal-details strong {
    display: inline-block;
    width: 120px;
}

.dental-chart-brace-tooth-container {
    position: absolute;
    width: 60px;
    height: 200px;
    transform-origin: center bottom;
    transform: rotate(var(--angle));
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.upper-jaw .dental-chart-brace-tooth-container {
    transform-origin: center bottom;
}

.lower-jaw .dental-chart-brace-tooth-container {
    transform-origin: center top;
}

.dental-chart-brace-tooth {
    position: relative;
    width: 50px;
    height: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: auto;
}

.upper-jaw .dental-chart-brace-tooth {
    transform: rotate(calc(-1 * var(--angle)));
}

.lower-jaw .dental-chart-brace-tooth {
    transform: rotate(calc(-1 * var(--angle)));
}

.dental-chart-brace-tooth:hover {
    transform: rotate(calc(-1 * var(--angle))) scale(1.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.dental-chart-brace-tooth.has-record {
    border-color: #007bff;
}

.modalbraces {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
}

.modalbraces .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.modalbraces .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #aaa;
    cursor: pointer;
}

.modalbraces .close:hover {
    color: #000;
}

.dental-chart-brace-tooth:not(.has-record):hover {
    transform: none;
    box-shadow: none;
    cursor: default;
}
</style>

<!-- Modal Structure -->
<div id="modalbraces" class="modalbraces" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModalBraces()">&times;</span>
        <h3 id="modalbraces-title">Teeth</h3>
    </div>
</div>

<!-- JavaScript for Modal Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Only attach click handlers to teeth with records
        const teeth = document.querySelectorAll('.dental-chart-brace-tooth.has-record');

        teeth.forEach(tooth => {
            tooth.addEventListener('click', function (event) {
                // Stop event from bubbling up to prevent double triggers
                event.stopPropagation();
                const group = this.getAttribute('data-tooth-group');
                showModal(group);
            });
        });
    });

    function showModal(group) {
        const modal = document.getElementById('modalbraces');
        const modalTitle = document.getElementById('modalbraces-title');
        
        // Set the modal title based on the group
        modalTitle.textContent = group === 'brace_upper' ? 'Upper Teeth Braces Only' : 'Lower Teeth braces Only';

        // Show the modal
        modal.style.display = 'flex';
    }

    function closeModalBraces() {
        const modal = document.getElementById('modalbraces');
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modalbraces');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>
<!----------------------------------------BRace only ------------------------------------------------------->


    <!-- Footer Start -->
    <!-- <div class="container-fluid footer position-relative bg-dark text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 py-5">
                <div class="col-lg-6 pe-lg-5">
                    <a href="index.html" class="navbar-brand">
                        <img src="img/logos_clear.png" alt="Logo" style="width:180px;">
                    </a>
                    <p class="fs-5 mb-4"></p>
                    <p><i class="fa fa-map-marker-alt me-2"></i>247 National Highway San Vicente, Binãn, Philippines, 4024</p>
                    <p><i class="fa fa-phone-alt me-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope me-2"></i>inquiry@orthodental.com</p>
                    <div class="d-flex mt-4">
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Quick Links</h4>
                            <a class="btn btn-link" href="">About Us</a>
                            <a class="btn btn-link" href="">Contact Us</a>
                            <a class="btn btn-link" href="">Our Services</a>
                            <a class="btn btn-link" href="">Terms & Condition</a>
                            <a class="btn btn-link" href="">Support</a>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Popular Links</h4>
                            <a class="btn btn-link" href="">About Us</a>
                            <a class="btn btn-link" href="">Contact Us</a>
                            <a class="btn btn-link" href="">Our Services</a>
                            <a class="btn btn-link" href="">Terms & Condition</a>
                            <a class="btn btn-link" href="">Support</a>
                        </div>
                        <div class="col-sm-12">
                            <h4 class="text-light mb-4">Newsletter</h4>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 py-3 px-4" style="background: rgba(255, 255, 255, .1);" placeholder="Your Email Address"><button class="btn btn-primary px-4">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Footer End -->


    <!-- Footer Copyright Start -->
    <div class="container-fluid copyright bg-dark text-white-50 py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#">Orthodental</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <p class="mb-0"> <a href="#"></a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

 <!-- Template Javascript -->
 <script src="js/main.js"></script>
    <script>
       
    document.addEventListener('DOMContentLoaded', function() {
        const datePicker = document.getElementById('datepicker');

        // Object to hold disabled dates and their reasons
        const disabledDates = {};

        <?php
            $q_e = $conn->query("SELECT `appointment_date`, `why` FROM `appointment_desc` WHERE `appointment_status`='Remove'");
            while ($f_e = $q_e->fetch_array()) {
                // Store the date and reason in the JavaScript object
                echo "disabledDates['" . $f_e['appointment_date'] . "'] = '" . addslashes($f_e['why']) . "';";
            }
        ?>

        // Disable specific dates
        datePicker.addEventListener('input', function() {
            const selectedDate = this.value;
            if (disabledDates[selectedDate]) {
                alert('This date is not available.\n\nReason: ' + disabledDates[selectedDate] + '. \n\nPlease select another date.');
                this.value = ''; // Clear the selected date
            }
        });
    });
    </script>

    <!---This is logic for datepicker -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const datePicker = document.getElementById('datepicker');

    // Function to format date as yyyy-mm-dd
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Get today's date and the date for tomorrow
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    // Set min date to tomorrow's date, effectively disabling today
    datePicker.setAttribute('min', formatDate(tomorrow));

    // Disable today's date and tomorrow's date
    datePicker.addEventListener('input', function() {
        const selectedDate = this.value;
        const todayFormatted = formatDate(today);
        const tomorrowFormatted = formatDate(tomorrow);

        if (selectedDate === todayFormatted || selectedDate === tomorrowFormatted) {
            alert('You can\'t book an appointment for today. Please choose a different date.');
            this.value = ''; // Clear the selected date
        }
    });
});
</script>
</body>

</html>

