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

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
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
                        <a href="#" class="nav-item nav-link dropdown-toggle active" data-bs-toggle="dropdown" style="text-transform:capitalize;">Appointment</a>     
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
                        <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown" style="text-transform:capitalize;"> <?php echo $name;?> </a>     
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
                            <a class="btn btn-primary ms-2" href="medical-history.php">Update Medical First</a>
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

        <form  method="post" enctype = "multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:50px;">
        <div class="modal-body">
                <div class = "form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Book Date</label>
                        <input type="date" class="form-control form-control-user" id="datepicker" name = "date"  autofocus min="<?php echo date('m-Y-d')?>" required>
                        <input type="hidden" class="form-control form-control-user" name = "user_id"  autofocus value="<?php echo $u_id?>" required>
                    </div>   
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Select Time Schedule</label>
                        <select name="schedule_time" class="form-control" required>
                            <option value="">Please Time Schedule</option>
                            <?php 
                                for ($i = 8; $i <= 17; $i++) {
                                    // Determine the period (AM/PM)
                                    $period = $i < 12 ? 'AM' : 'PM';
                                    // Convert hour to 12-hour format
                                    $hour = $i % 12;
                                    $hour = $hour ? $hour : 12; // Handle 0 hour as 12

                                    // Format the time string
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
                            <?php
                                $q_e = $conn->query("SELECT * FROM `services` WHERE `services_status`='0'");
                                while($f_e = $q_e->fetch_array()) {
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]" value="<?php echo $f_e['services_id']; ?>" id="service-<?php echo $f_e['services_id']; ?>">
                                <label class="form-check-label" for="service-<?php echo $f_e['services_id']; ?>" style="text-transform:capitalize;">
                                    <?php 
                                    echo $f_e['services_name']; 
                                    // echo $f_e['services_name'] . " - ₱" . number_format($f_e['services_cost'], 2);
                                    ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <small class="form-text  fst-italic text-danger ">Price may vary depends on the teeth condition</small>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button  class="btn btn-danger" name="Send">Book An Appointment</button>
        </div>
        </form>

        <?php 
        if(isset($_POST['Send'])){
            $schedule_time = $_POST['schedule_time'];
            $date = $_POST['date'] . " - " . $schedule_time; // Combine date and time
            $user_id = $_POST['user_id'];
            $services = implode(',', $_POST['services'] ?? []); // Handle multiple selected services as a comma-separated string
        
            // Query to check if the specific date and time are already booked
            $q1 = $conn->query("SELECT COUNT(*) FROM `appointment_desc` WHERE `appointment_date` = '$date'");
            $f1 = $q1->fetch_array(MYSQLI_NUM);
            $count_time = $f1[0]; // Check how many records match this condition
        
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
                // Proceed to insert the new appointment
                $sql_sched1 = "INSERT INTO appointment_desc VALUES(null, '$user_id', '$services', '$date', '', '', 'Pending')";
                if (mysqli_query($conn, $sql_sched1)){
                    echo '<script>
                        swal({
                            title: "Success!",
                            text: "Your booking request was submitted successfully!",
                            icon: "success",
                            type: "success"
                        }).then(function() {
                            window.location = "history.php";
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
    <div class="container-fluid container-service py-5">
        <div class="container pt-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-3"> Your Appointment History</h1>
            </div>
            <div class="row g-4">
            <?php
                                // Fetch data from the dental_history table
                                    $sql = "SELECT * FROM dental_history WHERE dental_user = $u_id";
                                    $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<div class="col-md-4">';
                                        echo '<div class="card">';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">' . htmlspecialchars($row['dental_date']) . '</h5>';
                                        echo '<p class="card-text">File: ' . htmlspecialchars($row['dental_file']) . '</p>';
                                        echo '<p class="card-text">Braces: ' . htmlspecialchars($row['dental_brace']) . '</p>';
                                        echo '<p class="card-text">Comment: ' . htmlspecialchars($row['dental_comment']) . '</p>';
                                        echo '<p class="card-text">Status: ' . htmlspecialchars($row['dental_status']) . '</p>';
                                        // echo '<p class="card-text">Date: ' . htmlspecialchars($row['dental_date']) . '</p>';
                                        echo '<p class="card-text">Description: ' . htmlspecialchars($row['appointment_desc']) . '</p>';
                                        echo '</div></div></div>';
                                    }
                                } else {
                                    echo '<center><p>No appointments found.</p></center>';
                                }
                                
                                ?>
            </div>
        </div>
    </div>
<!--  -->

    <!-- Service End -->




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
<!---This is logic for datepicker -->

</body>

</html>

