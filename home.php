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

    <style>
        .head{
        display: none;
        }
        
        .fixed-width {
        width: 500px; /* Adjust this value as needed */
        }

        .answer-highlight {
        font-weight: bold;
        color: #007bff; /* Customize the color */
        }
    </style>
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
                        <a href="home.php" class="nav-item nav-link active">Home</a>
                        <!-- appointment dropdown -->
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown" style="text-transform:capitalize;">Appointment</a>     
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
                            <!-- <a class="btn btn-primary ms-2" href="medical-history.php">Update Medical First</a> -->
                        <?php        
                                }else{
                        ?>
                            <!-- <a class="btn btn-primary ms-2" href="#" data-bs-toggle="modal" data-bs-target="#book">Book Now</a> -->
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
                                    //echo $f_e['services_name'] . " - ₱" . number_format($f_e['services_cost'], 2); 
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
<!-- schedule logic -->
<?php 
        if(isset($_POST['Send'])) {
            $schedule_time = $_POST['schedule_time']; // This will be in 24-hour format
            $date = $_POST['date'] . " " . $schedule_time; // Combine date and time
            $user_id = $_POST['user_id'];
            $services = implode(',', $_POST['services'] ?? []); // Handle multiple selected services
        
            // Query to check if the specific date and time are already booked
            $q1 = $conn->query("SELECT COUNT(*) FROM `appointment_desc` WHERE `appointment_date` = '$date'");
            $f1 = $q1->fetch_array(MYSQLI_NUM);
            $count_time = $f1[0]; // Check how many records match this condition
        
            // If the specific time is already booked, show an error message
            if($count_time > 0) {
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
                if (mysqli_query($conn, $sql_sched1)) {
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
    <!-- About Start -->
    <div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Left Side (Images + Years of Experience) -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-0">
                    <div class="col-6">
                        <img class="img-fluid rounded shadow-sm " src="img/about-11.jpg" alt="About Image 1">
                    </div>
                    <div class="col-6">
                        <img class="img-fluid rounded shadow-sm " src="img/about-22.jpg" alt="About Image 2">
                    </div>
                    <div class="col-6">
                        <img class="img-fluid rounded shadow-sm" src="img/about-33.jpg" alt="About Image 3">
                    </div>
                    <div class="col-6">
                        <div class="bg-primary w-100 h-100 mt-n5 ms-n5 d-flex flex-column align-items-center justify-content-center rounded shadow">
                            <div class="icon-box-light mb-2">
                                <i class="bi bi-award text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h1 class="display-3 text-white mb-0" data-toggle="counter-up">10</h1>
                            <small class="fs-5 text-white">Years Experience</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side (Greeting + Message) -->
            <div class="col-lg-6 wow fadeIn" id="about" data-wow-delay="0.5s">
                <h1 class="display-5 mb-4 text-primary">
                    Hello <strong><span class="text-warning"><?php echo $f['fname']; ?>!</span></strong>
                </h1>
                <p class="mb-4 fs-5 text-secondary">
                    Welcome to Orthodental Clinic! <br><br>
                    Thank you for choosing us for your dental care. We’re committed to providing you with a comfortable and friendly experience. Please select a convenient time for your appointment, and don’t hesitate to reach out if you have any questions. We look forward to seeing you soon!
                </p>
                <p class="mb-4 fs-5 text-secondary">
                    Your smile is our priority! <br><br>                    
                </p>
                <!-- Optional Button (if needed) -->
                <?php 
                    $q_count = $conn->query("SELECT count(*) as total FROM `medical_history` WHERE `u_id` = '$u_id'");
                    $f_count = $q_count->fetch_array();
                    ?>

                    <a href="javascript:void(0);" class="btn btn-warning btn-lg rounded-pill px-4 mt-3" id="scheduleButton">
                        Schedule an Appointment
                    </a>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('scheduleButton').addEventListener('click', function() {
                            // Check if the user has a medical history or not
                            var hasMedicalHistory = <?php echo ($f_count['total'] == 0) ? 'false' : 'true'; ?>;
                            
                            if (!hasMedicalHistory) {
                                // If no medical history, show popup
                                Swal.fire({
                                    title: "Medical History Required",
                                    text: "You need to update your medical history before scheduling an appointment.",
                                    icon: "warning",
                                    confirmButtonText: "Update Now",
                                    cancelButtonText: "Cancel",
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "medical-history.php";
                                    }
                                });
                            } else {
                                // If user has medical history, proceed with scheduling
                                // You can redirect to the modal or handle it as you like
                                $('#book').modal('show'); // Assuming you use a Bootstrap modal
                            }
                        });
                    </script>
                
            </div>
        </div>
    </div>
</div>

    <!-- Features Start -->
    <div  class="container-fluid feature mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-12 pt-lg-5">
                    <div class="bg-white p-5 mt-lg-5">
                        <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.3s">
                            Our Mission</h1>
                        <p class="mb-4 wow fadeIn" data-wow-delay="0.4s">Welcome to Dr. Victor 
My Dentist Orthodental Clinic!
A dental clinic serves as a vital hub for oral health care, offering a range of services aimed at maintaining and improving dental wellness. 
Staffed by skilled dentists, hygienists, and support personnel, these clinics provide routine examinations, cleanings, and preventive treatments 
to prevent dental issues such as cavities and gum disease. They also offer restorative procedures like fillings, crowns, and root canals to repair 
damaged teeth, along with cosmetic treatments such as teeth whitening and veneers to enhance smile aesthetics. Advanced dental clinics may specialize in orthodontics, 
oral surgery, or implant dentistry, offering specialized care to address complex dental needs. By promoting regular dental visits and personalized treatment plans, 
dental clinics play a crucial role in helping patients achieve optimal oral health and maintain confident smiles. </p>
                    <div class="row g-5 pt-2 mb-5">
                        </div>
                        <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.3s">
                            Our Vision</h1>
                        <p class="mb-4 wow fadeIn" data-wow-delay="0.4s">Our vision at the dental clinic is to be recognized as a leader in dental care, 
                        known for our commitment to innovation, patient-centered service, and exceptional clinical outcomes. We aspire to create a state-of-the-art 
                        facility where advanced technology and evidence-based practices converge to optimize oral health and enhance smiles. By fostering a culture of continuous 
                        improvement and professional growth, we aim to exceed patient expectations and set new benchmarks in dental excellence. Our vision extends beyond clinical 
                        expertise to encompass a warm, welcoming environment where each patient feels valued and empowered in their journey towards optimal dental health and overall well-being.
                        </p>
                        <!-- <a class="btn btn-primary py-3 px-5 wow fadeIn" data-wow-delay="0.5s" href="">Explore More</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
    <!-- Service Start -->
    <div class="container-fluid container-service py-5" id="service">
    <div class="container pt-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="display-6 mb-3">Services</h1>
            <p class="mb-5"></p>
        </div>
        <div class="row g-6">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item">
                    <div class="icon-box-primary mb-4">
                        <i class="bi bi-bandaid text-dark"></i>
                    </div>
                    <h5 class="mb-3">CLEANING TOOTH</h5>
                    <p class="mb-4">Cleaning teeth enhances their appearance by effectively removing surface stains, plaque, and tartar buildup. This process not only brightens the smile but also contributes to maintaining healthy gums and preventing dental issues such as cavities and gum disease. The removal of plaque, a sticky film of bacteria, and tartar, hardened plaque that cannot be removed by brushing alone, helps teeth regain their natural shine and smooth texture. Additionally, dental cleanings often include polishing, which further enhances the teeth's appearance by eliminating superficial discoloration and leaving them feeling fresh and clean. Regular dental cleanings are essential for maintaining optimal oral health and a confident, radiant smile.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item">
                    <div class="icon-box-primary mb-4">
                        <i class="bi bi-bandaid text-dark"></i>
                    </div>
                    <h5 class="mb-3">BRACE INSTALLATION</h5>
                    <p class="mb-4">The Bracing Dental Clinic is committed to providing the best orthodontic treatment possible, with an emphasis on straightening teeth and promoting dental health. Our orthodontic clinic provides a wide range of services that are customized to each patient's specific needs. To get the best results possible, our skilled orthodontists use cutting-edge methods and cutting-edge technology, whether they are using transparent aligners or traditional braces. We place a high priority on the comfort and pleasure of our patients, creating a warm and friendly atmosphere that helps people of all ages feel knowledgeable and confident during their orthodontic journey. Whether your goal is to straighten your teeth, improve bite function, or repair misalignments, Bracing Dental Clinic is dedicated to providing top-notch service and stunning results.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item">
                    <div class="icon-box-primary mb-4">
                        <i class="bi bi-bandaid text-dark"></i>
                    </div>
                    <h5 class="mb-3">TOOTH EXTRACTION</h5>
                    <p class="mb-4">Extraction Tooth Dental Clinic specializes in delicate and efficient tooth extractions to precisely and carefully treat a range of dental issues. Since extractions can be frightening procedures, our skilled staff puts the comfort and safety of our patients first at every stage. Whether a wisdom tooth is bothering you or your tooth is badly broken and has to be extracted, our dentists use cutting-edge methods and tools to make the process go smoothly and painlessly. To ensure that every patient receives individualized attention and the best possible dental care, we emphasize comprehensive pre-extraction assessments to go over options and answer any concerns. Expert extraction services are available from Removal Tooth Dental Clinic, which is dedicated to providing compassionate care and superior results.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item">
                    <div class="icon-box-primary mb-4">
                        <i class="bi bi-bandaid text-dark"></i>
                    </div>
                    <h5 class="mb-3">PASTA</h5>
                    <p class="mb-4">Pasta Dental Clinic takes great pride in providing complete dental care in a friendly and comfortable setting. From standard examinations and cleanings to cutting-edge procedures like cosmetic dentistry and dental implants, our clinic is dedicated to providing the best possible care. We make sure that every visit is enjoyable by placing a high priority on the comfort and pleasure of our patients. Utilizing the most recent methods and technology, our team of knowledgeable dentists and hygienists provides individualized care that is catered to the particular requirements of every patient. Pasta Dental Clinic is committed to providing you with the tools necessary to achieve a lifetime of beautiful, healthy teeth, regardless of your goals for improving your smile.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item">
                    <div class="icon-box-primary mb-4">
                        <i class="bi bi-bandaid text-dark"></i>
                    </div>
                    <h5 class="mb-3">BRACE ADJUSTMENT</h5>
                    <p class="mb-4">Brace adjustment requires monthly adjustments to ensure steady progress among clients. We utilize new technology to ensure that the service aligns with your goals and achieve optimal results.</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- try map -->
  
    <!-- Service End -->
    <div  class="container-fluid testimonial mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-12 pt-lg-5">
                    <div class="bg-white p-5 mt-lg-5">
                        <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.3s">
                            Our Location</h1>
                        <p class="mb-4 wow fadeIn " data-wow-delay="0.4s">our location is found at Binan Laguna,Olivarez  near Savemore mall and mercury it is a walking distance from savemore to there.</p>
                    <div class="row g-5 pt-2 mb-5">
                        </div>
                        <center>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3865.6385784785093!2d121.0823894!3d14.3324142!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d9e3d9554c35%3A0xb0279dfe390c47df!2sMy%20Dentist%20Ortho-Dental%20Clinic!5e0!3m2!1sen!2sph!4v1727607243495!5m2!1sen!2sph" 
                            class="shadow-lg p-3 mb-5 bg-white rounded" width="100%" height="450" style="border:0; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </center>
                        <!-- <a class="btn btn-primary py-3 px-5 wow fadeIn" data-wow-delay="0.5s" href="">Explore More</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Service Start -->
    <!-- <div class="container-fluid container-service py-5">
        <div class="container pt-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-3"> Your Appointment History</h1>
            </div>
            <div class="row g-4">
            <?php
                                // Fetch data from the dental_history table
                                //     $sql = "SELECT * FROM dental_history WHERE dental_user = $u_id";
                                //     $result = $conn->query($sql);
                                // if ($result->num_rows > 0) {
                                //     // Output data of each row
                                //     while($row = $result->fetch_assoc()) {
                                //         echo '<div class="col-md-4">';
                                //         echo '<div class="card">';
                                //         echo '<div class="card-body">';
                                //         echo '<h5 class="card-title">' . htmlspecialchars($row['dental_user']) . '</h5>';
                                //         echo '<p class="card-text">File: ' . htmlspecialchars($row['dental_file']) . '</p>';
                                //         echo '<p class="card-text">Braces: ' . htmlspecialchars($row['dental_brace']) . '</p>';
                                //         echo '<p class="card-text">Comment: ' . htmlspecialchars($row['dental_comment']) . '</p>';
                                //         echo '<p class="card-text">Status: ' . htmlspecialchars($row['dental_status']) . '</p>';
                                //         echo '<p class="card-text">Date: ' . htmlspecialchars($row['dental_date']) . '</p>';
                                //         echo '<p class="card-text">Description: ' . htmlspecialchars($row['appointment_desc']) . '</p>';
                                //         echo '</div></div></div>';
                                //     }
                                // } else {
                                //     echo '<p>No appointments found.</p>';
                                // }
                                // $conn->close();
                                ?>
            </div>
        </div>
    </div> -->
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
    <br><br><div class="container-fluid copyright bg-dark text-white-50 py-4 mt-auto">
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

