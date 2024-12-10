<?php
session_start();
require_once "connect.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
date_default_timezone_set('Asia/Manila');
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Orthodental Clinic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='dist/index.global.js'></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <script src="https://kit.fontawesome.com/ea5990c723.js" crossorigin="anonymous"></script>
  <style>
  i{
	color:white;
}

.active{
  background-color: skyblue;
  color: white;
}

  @media print {
	#printPageButton {
    display: none;
  }
  .printPageButton{
	   display: none;
  }
  #DataTables_Table_0_filter,#DataTables_Table_0_length,#DataTables_Table_0_paginate{
	  
	   display: none;
  }
  .printHeader1{
	   background:#fff;
  }
}
  #calendar-container {
    position: fixed;
    width:80%;
    height:60%;
  }
  </style>
  <style>
  #eventModal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  #eventModal > div {
    position: relative;
    margin: auto;
    top: 25%;
    padding: 20px;
    background: #fff;
    width: 300px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()" >
<div class="wrapper">
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"style="background-color:#031b4d;">
    <ul class="navbar-nav">
      <li class="nav-item"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link" style="color:white;">Home</a>
      </li>
    </ul>
  </nav> -->
  <aside class="main-sidebar sidebar-light elevation-4" style="background-color: #f8f9fa; border-right: 1px solid #ccc;">
    <a href="#" class="brand-link" style="background-color: navy; padding: 15px; text-align: center;">
        <span class="brand-text font-weight-dark" style="color:white;"><center> &nbsp Admin Portal</center></span>
    </a>
    
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="img/logo_square.png" alt="Logo" style="width: 220px; border-radius: 50%;">
            </div>
            <div class="info">
                <a href="#" class="d-block" data-toggle="modal" data-target="#editProfile" style="color: navy; font-weight: bold;">
                    <?php  
                        $username = htmlspecialchars($_SESSION["username"]);
                        $q = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'");
                        $f = $q->fetch_array();
                        $u_id = $f['admin_id'];
                        $name = "".$f['fname']." ".$f['mname']." ".$f['lname']."";
                        echo $name;
                    ?>
                </a>
            </div>
        </div>
        <div style="text-primary text-uppercase font-weight-bold text-center">
        <center><b><?php echo $name; ?></b><br>
        <small><?php echo $f['position'];?></small>
        </center>
        </div>
        <hr>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item fw-bold active" >
                    <a href="home.php" class="nav-link" style="color: black;">
                        <i class="fa-solid fa-gauge mr-2" style="color: navy;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item" active>
                    <a href="section.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-calendar-check mr-2" style="color: navy;"></i>
                        <p>Appointment Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="analytics.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-list mr-2" style="color: navy;"></i>
                        <p>Service Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="service.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-table-list mr-2" style="color: navy;"></i>
                        <p>Service Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-message mr-2" style="color: navy;"></i>
                        <p>Contact Management 
                            <?php
                                $q1 = $conn->query("SELECT count(*) as count_msg FROM `chat` WHERE `chat_reps_u_id` = '1' AND `view`=''") or die(mysqli_error($conn));
                                $f1 = $q1->fetch_array();
                                echo "<b style='color:white; background-color:darkblue; padding:3px; border-radius:5px; opacity:70%;'>".$f1['count_msg']."</b>"; 
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="user.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-user mr-2" style="color: navy;"></i>
                        <p>User Management</p>
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#settings" style="color: #333;">
                    
                        <i class="fa-solid fa-gear mr-2" style="color: navy;"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal" style="color: #333;">
                        <i class="fa-solid fa-right-from-bracket mr-2" style="color: navy;"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-light">Dashboard </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
		 
		 </div>
           <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

		
  <div class="row">
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="section.php">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
				<?php 
        
				
		$sql="SELECT count(*) AS total FROM appointment_desc WHERE `appointment_status`='Pending'";
		$result=mysqli_query($conn,$sql);
		$data=mysqli_fetch_assoc($result);
		echo $data['total'];
				
				?></h3>

                <p>Total # of Appointment</p>
              </div>
              <div class="icon">
              <i class="nav-icon"><ion-icon name="calendar" aria-hidden="true"></ion-icon></i>
              </div>
            </div>
            </a>
          </div>
          <!-- /.col -->
		   <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="section-approve.php">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php 
				
		$sql2="SELECT count(*) AS total2 FROM appointment_desc WHERE `appointment_status`='Approved'";
		$result2=mysqli_query($conn,$sql2);
		$data2=mysqli_fetch_assoc($result2);
		echo $data2['total2'];
				
				?></h3>

                <p>Total # of Approve</p>
              </div>
              <div class="icon">
              <i class="nav-icon"><ion-icon name="checkmark-outline" aria-hidden="true"></ion-icon></i>
              </div>
            </div>
            </a>
          </div>
		   
		   <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="section-success.php">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php 
				
		$sql2="SELECT count(*) AS total4 FROM appointment_desc WHERE `appointment_status`='Success'";
		$result1=mysqli_query($conn,$sql2);
		$data1=mysqli_fetch_assoc($result1);
		echo $data1['total4'];
				
				?></h3>

                <p>Total # of Completed</p>
              </div>
              <div class="icon"><i class="nav-icon"><ion-icon name="people-outline" aria-hidden="true"></ion-icon></i>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="section-canceled.php">
            <div class="small-box  bg-danger">
                
              <div class="inner">
                <h3><?php 
				
		$sql2="SELECT count(*) AS total3 FROM appointment_desc WHERE `appointment_status`='Cancelled'";
		$result2=mysqli_query($conn,$sql2);
		$data2=mysqli_fetch_assoc($result2);
		echo $data2['total3'];
				
				?></h3>

                <p>Total # of Cancel</p>
              </div>
              <div class="icon">
              <i class="nav-icon"><ion-icon name="close" aria-hidden="true"></ion-icon></i>
              </div>
              
            </div>
            </a>
          </div>
          <!-- /.col -->
        </div>
     <br>
     <div class="row">
    <div class="col-lg-12 col-6">
        <div id='calendar-container'>
    <div id='calendar'></div>
  </div>
    </div>
</div> <!-- /.content-wrapper -->

        <!-- /.row -->
        <!-- Main row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
        
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="settings" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> <form  method="post" enctype = "multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:50px;">
        <div class="modal-body">
                <div class = "form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label>Username</label>
                        <input type="email" class="form-control form-control-user" name = "email" value="<?php echo $f['username'];?>"  required>
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
                    $update = $conn->query("UPDATE `admin` SET `username` = '$email',`fname`='$fname',`mname`='$mname',`lname`='$lname',`password`='$password_update' WHERE `admin_id` = '$user_id'");
                    
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
    </div>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for calendar -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Initialize FullCalendar -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      height: '100%',
      expandRows: true,
      slotMinTime: '09:00', // 9 AM
      slotMaxTime: '17:00', // 5 PM
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      initialView: 'dayGridMonth',
      initialDate: '<?php echo date('Y-m-d');?>',
      navLinks: true,
      editable: false,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true,
      events: [
        <?php
         // Join appointment_desc with user_account1 to get fname, mname, lname
         $q_e = $conn->query("SELECT a.*, u.fname, u.mname, u.lname FROM `appointment_desc` a 
                               LEFT JOIN `user_account1` u ON a.appointment_id = u.u_id 
                               WHERE a.appointment_status='Approved' OR a.appointment_status='Remove'");
            while($f_e = $q_e->fetch_array()){
                $appointment_id = $f_e['appointment_id']; // Assuming this is the unique identifier for the appointment
                $original_date_time = $f_e['appointment_date'];
                $cleaned_date_time = str_replace(" - ", " ", $original_date_time);
                
                // Convert to 12-hour format for display
                $time_12hr_format = date("g:i A", strtotime($cleaned_date_time));
                $converted_datetime = date("Y-m-d H:i:s", strtotime($cleaned_date_time));

                $appointment_services = explode(",", $f_e['appointment_desc']); // Split the services string into an array
                $services_display = [];

                foreach ($appointment_services as $service_id) {
                  $q3 = $conn->query("SELECT * FROM `services` WHERE `services_id` = '$service_id'");
                  $f3 = $q3->fetch_array();
                  
                  if ($f3) {
                      $services_display[] = $f3['services_name']; // Store the service name
                  }
              }
        ?>
        {
          <?php if ($f_e['appointment_status'] == 'Remove') { ?>
            title: 'No Schedule',
            color: 'Red',
            description: '<?php echo $f_e['why'];?>',
          <?php } else { ?>
            title: '<?php echo trim($f_e['fname'] . " " . $f_e['mname'] . " " . $f_e['lname']); ?>',
            color: 'Green',
            description: '<?php echo "<hr><strong>Services</strong>: " . implode(", ", $services_display) . "<br>"; // Display all service names ?>
            <?php echo "<strong>Date</strong>: " . date("l, F j, Y", strtotime($cleaned_date_time)) . "<br><strong>Time</strong>: " . $time_12hr_format; ?>
            ',
          <?php } ?>
          
          start: '<?php echo $converted_datetime; ?>', // Ensure this includes time
        },
        <?php } ?>
      ],
      eventClick: function(info) {
        var eventObj = info.event;
        var description = eventObj.extendedProps.description || "No additional details.";
        
        // Populate modal content
        document.getElementById('modalTitle').innerHTML = eventObj.title;
        document.getElementById('modalDescription').innerHTML = description;
        
        // Show the modal
        document.getElementById('eventModal').style.display = 'block';
      }
    });

    calendar.render();
  });
</script>


<!-- pop up for schedules -->
 <!-- Modal Structure -->
 <div id="eventModal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5);">
  <div style="position:relative; margin:auto; top:25%; padding:20px; background:#fff; width:300px; border-radius:5px;">
    <h2 id="modalTitle"></h2>
    <p id="modalDescription"></p>
      <div style="text-align: right;">
        <button onclick="document.getElementById('eventModal').style.display='none'" style="background-color: blue; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px;">
            Close
        </button>
    </div>
  </div>
</div>

</body>
</html>