<?php
session_start();
 require_once "connect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

	date_default_timezone_set('Asia/Manila');
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Orthobooking Dental Clinic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Calendar -->
  <script src="https://kit.fontawesome.com/ea5990c723.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-interaction/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ea5990c723.js" crossorigin="anonymous"></script>
  <style>
  i{
	color:white;
}
.head{
  display: none;
}

.active{
  background-color: skyblue;
  color: white;
}
  @media print {
	#printPageButton {
    display: none;
  }
  .head{
  display: block;
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
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()" >
<div class="wrapper">
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info">
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
        <span class="brand-text font-weight-bold" style="color: white;">Admin Portal</span>
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
                <li class="nav-item " >
                    <a href="home.php" class="nav-link" style="color: black;">
                        <i class="fa-solid fa-gauge mr-2" style="color: navy;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item fw-bold active" active>
                    <a href="section.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-calendar-check mr-2" style="color: navy;"></i>
                        <p>Appointment Management</p>
                    </a>
                </li>
                <!-- Only show the Service Management link if the user is a Superadmin -->
              <?php if ($f['position'] == 'Super Admin'): ?>
                <li class="nav-item">
                    <a href="analytics.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-list mr-2" style="color: navy;"></i>
                        <p>Service Report</p>
                    </a>
                </li>
              <?php endif; ?>
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
              <?php if ($f['position'] == 'Super Admin'): ?>
                <li class="nav-item">
                    <a href="user.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-user mr-2" style="color: navy;"></i>
                        <p>User Management</p>
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a href="admin_management.php" class="nav-link" style="color: #333;">
                        <i class="fa-solid fa-table-list mr-2" style="color: navy;"></i>
                        <p>Admin Management</p>
                    </a>
                </li>
              <?php endif; ?>
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
  <div class="head">
    <div class="d-flex justify-content-between">
    <div>
      <small class="me-3"><i class="fa fa-map-marker-alt me-2 "></i>247 National Highway San Vicente, Binãn, Philippines, 4024</small>
      
    </div>
    <nav class="breadcrumb mb-0">
    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 9:00 am - 5:00 pm</small>
    </nav>  
    </div>
    <center>
    <img src="img/logo_square.png" alt="Logo" class="navbar-logo">
    </center>
    <hr>
  </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
       <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark printPageButton">Appointment List</h1>
          </div><!-- /.col -->
           <!-- /.col -->
        </div>
        </div>
			
		<div class="container-fluid"> 	
	    <div class="printPageButton"> 
		<a href="section.php"  class = "btn-info btn-m btn" >Pending</a>
		<a href="section-approve.php"  class = "btn-primary btn-m btn" >Approved</a>
		<a href="section-cancel.php"  class = "btn-info btn-m btn" >Re Sched</a>
		<a href="section-success.php"  class = "btn-info btn-m btn" >Completed</a>
		<a href="section-canceled.php"  class = "btn-info btn-m btn" >Cancelled</a>
		<a href="section-management.php"  class = "btn-info btn-m btn" >Schedule Management</a>
		<a href="#"  class = "btn-info btn-m btn float-right" id="printPageButton" onClick="window.print();" style="margin-left:10px;">Print </a>
		<a href="section-excel.php?nav=Approved"  class = "btn-warning btn-m btn float-right" >Download</a>
			 
		</div>
            <div class="card shadow mb-4"  style="margin-top:10px;">
			<div class='card-header py-3'  style="background-color:navy;">
              <h6 class="m-0 font-weight-bold" style="color:white;" >Appointment List
              <b  style="color:black;float:right;"></b></h6>
            </div>
			
            <div class="card-body" >
              <div class="table-responsive" > 
					<table width="100%" class="display" cellspacing="0">
              
                  <thead style="background-color:navy; color:white;">
				 
                    <tr class=""  >
                      <th>Client Name</th>
                      <th>Services</th>
                      <th>Cost</th>
                      <th>Appointment Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th id="printPageButton">Action</th>
                    </tr>
                  </thead>
                 <tbody>		
	            <?php	
	                error_reporting(0);
	                ini_set('display_errors', 0);
	                
                  $q_e = $conn->query("SELECT * FROM `appointment_desc` WHERE `appointment_status`='Approved' ");
                    while ($f_e = $q_e->fetch_array()) {
                      $u_id_user = $f_e['appointment_id'];

                      $original_date_time = $f_e['appointment_date'];
                      $cleaned_date_time = str_replace(" - ", " ", $original_date_time);
                                  
                      // Convert to 12-hour format for display
                      $time_12hr_format = date("g:i A", strtotime($cleaned_date_time));
                      $converted_datetime = date("Y-m-d H:i:s", strtotime($cleaned_date_time));

                      $q2 = $conn->query("SELECT * FROM `user_account1` WHERE `u_id` = '$u_id_user'");
                      $f2 = $q2->fetch_array();
                      
                      $appointment_services = explode(",", $f_e['appointment_desc']); // Split the services string into an array
                      $services_display = [];
                      $services_cost = 0;
                  
                      foreach ($appointment_services as $service_id) {
                          $q3 = $conn->query("SELECT * FROM `services` WHERE `services_id` = '$service_id'");
                          $f3 = $q3->fetch_array();
                          
                          if ($f3) {
                              $services_display[] = $f3['services_name']; // Store the service name
                              $services_cost += $f3['services_cost']; // Sum up the costs
                          }
                      }
	   ?>
					<tr>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $f2['fname']." ".$f2['mname']." ".$f2['lname'];?></td>	
						<td style="text-size:8px;text-transform:capitalize;"><?php echo implode(", ", $services_display); // Display all service names ?></td>        
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $f3['services_cost'];?></td>		
						<td><?php echo date("l, F j, Y", strtotime($cleaned_date_time))?></td>
            <td><?php echo $time_12hr_format?></td>	
						<td ><?php echo $f_e['appointment_status']?></td>
						<td id="printPageButton">    
						    <a href="view-history.php?id=<?php echo $u_id_user?>"  class = "btn-warning btn-m btn" >View Data </a>
						    <a href="section-approve.php?update_id=<?php echo $f_e['appointment_desc_id']?>&update=Success"  class = "btn-success btn-m btn" >Success Appointment </a>
						</td>
					</tr>
						<?php
						}	
					if(isset($_GET['update_id'])){
					      $id_data_update = $_GET['update_id'];
                          $update1 = $conn->query("UPDATE `appointment_desc` SET `appointment_status` = 'Success' WHERE `appointment_desc_id` = '$id_data_update'");
					      if ($update1) {
                                echo '<script>
                                    function myFunction() {
                                        swal({
                                            title: "Success! ",
                                            text: "Appointment Successfully Update",
                                            icon: "success",
                                            type: "success"
                                        }).then(function() {
                                            window.location = "section-approve.php";
                                        });
                                    }
                                  </script>';
                          }else {
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
					}
								
				?>			
                    </tbody>
                </table>
              </div>
            </div>
			</div>
						
            
      </div>
    </div>
      
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
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
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
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script><script>

var check = function() {
  if (document.getElementById('password2').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('password2').style.border = 'green 2px solid';
    document.getElementById('confirm_password').style.border = 'green 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:green;" class="glyphicon glyphicon-ok-sign"> </span> Password confirm';
  } else {
    document.getElementById('password2').style.border = 'red 2px solid';
    document.getElementById('confirm_password').style.border = 'red 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:red;" class="glyphicon glyphicon-remove-sign"> </span> Password and confirm password is not match';
  }
}
          
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
     
  $(document).ready(function() {
    $('table.display').DataTable({
        "order": [[ 0, "asc" ]]
    });
} );       
 
 function handleSelect(elm)
  {
     window.location = elm.value+".php";
  }  
</script>
</body>
</html>