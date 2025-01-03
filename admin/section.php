<?php
session_start();
require_once "connect.php";
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}

date_default_timezone_set('Asia/Manila');
?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Orthobooking Dental Clinic</title>
  <link href="img/favicon.ico" rel="icon">



  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- Font Awesome -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    i {
      color: white;
    }

    .active {
      background-color: skyblue;
      color: white;
    }

    .head {
      display: none;
    }

    .fixed-width {
      width: 500px;
      /* Adjust this value as needed */
    }

    .answer-highlight {
      font-weight: bold;
      color: #007bff;
      /* Customize the color */
    }

    @media print {
      #printPageButton {
        display: none;
      }

      .head {
        display: block;
      }

      .printPageButton {
        display: none;
      }

      #DataTables_Table_0_filter,
      #DataTables_Table_0_length,
      #DataTables_Table_0_paginate {

        display: none;
      }

      .printHeader1 {
        background: #fff;
      }

      .ui-datepicker-calendar {
        padding: 5 5 5 5;
        background-color: white;
        /* Set background color for the calendar */
      }

      .ui-datepicker-calendar .ui-state-default {
        background-color: #fff;
        /* Set background color for each date */
        padding: 5 5 5 5;
      }

      .ui-datepicker-calendar .ui-state-disabled {
        background-color: #fff;
        /* Set background color for disabled dates */
        padding: 5 5 5 5;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()">
  <div class="wrapper">
    <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light  bg-info">
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
              $name = "" . $f['fname'] . " " . $f['mname'] . " " . $f['lname'] . "";
              echo $name;
              ?>
            </a>
          </div>
        </div>
        <div style="text-primary text-uppercase font-weight-bold text-center">
          <center><b><?php echo $name; ?></b><br>
            <small><?php echo $f['position']; ?></small>
          </center>
        </div>
        <hr>
        <!-- Sidebar Menu -->
        <nav class="mt-2">

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item fw-bold">
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
                  echo "<b style='color:white; background-color:darkblue; padding:3px; border-radius:5px; opacity:70%;'>" . $f1['count_msg'] . "</b>";
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
      <div class="head"> <!--NAVBAR FOR PRINT-->
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

            <h1 class="m-0 text-dark printPageButtons">Appointment List</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div>
      </div>

      <div class="container-fluid">
        <div class="printPageButton">
          <a href="section.php" class="btn-primary btn-m btn">Pending</a>
          <a href="section-approve.php" class="btn-info btn-m btn">Approved</a>
          <a href="section-cancel.php" class="btn-info btn-m btn">Re Sched</a>
          <a href="section-success.php" class="btn-info btn-m btn">Completed</a>
          <a href="section-canceled.php" class="btn-info btn-m btn">Cancelled</a>
          <a href="section-management.php" class="btn-info btn-m btn">Schedule Management</a>
          <a href="#" class="btn-info btn-m btn float-right" onClick="window.print();" style="margin-left:10px;">Print </a>
          <a href="section-excel.php?nav=Pending" class="btn-warning btn-m btn float-right">Download</a>

        </div>

        <div class="card shadow mb-4" style="margin-top:10px;">
          <div class="card-header py-3" style="background-color:navy;">

            <h6 class="m-0 font-weight-bold " style="color:white;">Appointment List
              <b style="color:black;float:right;"></b>
            </h6>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table width="100%" class="display" cellspacing="0">

                <thead style="background-color:navy; color: white;">

                  <tr class=" ">
                    <th>Client Name</th>
                    <th>Services</th>
                    <th>Price</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Felling well?</th>
                    <th>fever or cough?</th>
                    <th>nausea or diarrhea?</th>
                    <th>gumn pain?</th>
                    <th id="printPageButton">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class=" ">
                    <th>Client Name</th>
                    <th>Services</th>
                    <th>Price</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Felling well?</th>
                    <th>fever or cough?</th>
                    <th>nausea or diarrhea?</th>
                    <th>gumn pain?</th>
                    <th id="printPageButton">Action</th>
                  </tr>
                  </thead>
                <tbody>
                  <?php
                  $q_e = $conn->query("SELECT * FROM appointment_desc WHERE appointment_status='Pending'");
                  while ($f_e = $q_e->fetch_array()) {
                    $u_id_user = $f_e['appointment_id'];
                    $original_date_time = $f_e['appointment_date'];
                    $cleaned_date_time = str_replace(" - ", " ", $original_date_time);
                    $time_12hr_format = date("g:i A", strtotime($cleaned_date_time));
                    $converted_datetime = date("Y-m-d H:i:s", strtotime($cleaned_date_time));

                    $q2 = $conn->query("SELECT * FROM user_account1 WHERE u_id = '$u_id_user'");
                    $f2 = $q2->fetch_array();

                    $appointment_services = explode("-", $f_e['appointment_desc']);
                    $services_display = [];
                    $services_cost = 0;

                    foreach ($appointment_services as $service_id) {
                      $service_id = trim($service_id);
                      if (!empty($service_id)) {
                        $q3 = $conn->query("SELECT * FROM services WHERE services_id = '$service_id'");
                        $f3 = $q3->fetch_array();

                        if ($f3) {
                          $services_display[] = $f3['services_name'];
                          $services_cost += floatval($f3['services_cost']);
                        }
                      }
                    }

                    // Count valid services
                    $service_count = count($services_display);
                  ?>
                    <tr>
                      <td style="font-size:14px;text-transform:capitalize;"><?php echo $f2['fname'] . " " . $f2['mname'] . " " . $f2['lname']; ?></td>
                      <td style="font-size:14px;text-transform:capitalize;"><?php echo implode(", ", $services_display); ?></td>
                      <td style="font-size:14px;text-transform:capitalize;"><?php echo $services_cost; ?></td>
                      <td><?php echo date("l, F j, Y", strtotime($cleaned_date_time)); ?></td>
                      <td><?php echo $time_12hr_format; ?></td>
                      <td><?php echo $f_e['appointment_status']; ?></td>
                      <td><?php echo $f_e['feeling_well']; ?></td>
                      <td><?php echo $f_e['fever_cough']; ?></td>
                      <td><?php echo $f_e['nausea']; ?></td>
                      <td><?php echo $f_e['tooth_gum_pain']; ?></td>
                      <td id="printPageButton">
                        <a href="#" class="btn-warning btn-m btn" data-toggle="modal" data-target="#historyModal<?php echo $u_id_user; ?>">View</a>
                        <a href="section.php?id_data_update=<?php echo $f_e['appointment_desc_id']; ?>&update=Approved" class="btn-success btn-m btn">Approve</a>
                        <a href="#" class="btn-info btn-m btn" data-toggle="modal" data-target="#rescheduleModal-<?php echo $f_e['appointment_desc_id']; ?>">Re Schedule</a>
                        <a href="section.php?id_data_update=<?php echo $f_e['appointment_desc_id']; ?>&update=Cancelled" class="btn-danger btn-m btn">Cancel</a>
                        <a href="send_notification.php?user_id=<?php echo $u_id_user; ?>" class="btn-primary btn-m btn">Notify</a>
                        <?php if ($service_count > 1): ?>
                          <a href="#" class="btn-secondary btn-m btn" data-toggle="modal" data-target="#editServicesModal<?php echo $f_e['appointment_desc_id']; ?>">Edit Services</a>
                        <?php endif; ?>
                      </td>
                    </tr>

                    <!-- Edit Services Modal -->
                    <?php if ($service_count > 1): ?>
                      <div class="modal fade" id="editServicesModal<?php echo $f_e['appointment_desc_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editServicesModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editServicesModalLabel">Edit Services</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="update_services.php" method="POST">
                              <div class="modal-body">
                                <input type="hidden" name="appointment_id" value="<?php echo $f_e['appointment_desc_id']; ?>">
                                <?php foreach ($appointment_services as $service_id):
                                  $service_id = trim($service_id);
                                  if (!empty($service_id)) {
                                    $q4 = $conn->query("SELECT * FROM services WHERE services_id = '$service_id'");
                                    $f4 = $q4->fetch_array();
                                    if ($f4):
                                ?>
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                          name="services[]"
                                          value="<?php echo $service_id; ?>"
                                          id="service-<?php echo $f_e['appointment_desc_id']; ?>-<?php echo $service_id; ?>"
                                          checked>
                                        <label class="form-check-label" for="service-<?php echo $f_e['appointment_desc_id']; ?>-<?php echo $service_id; ?>">
                                          <?php echo $f4['services_name']; ?>
                                        </label>
                                      </div>
                                <?php
                                    endif;
                                  }
                                endforeach; ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="update_services">Update Services</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php
                  }
                  ?>

                  <!-- Modal outside the loop -->
                  <div id="rescheduleModal-<?php echo $f_e['appointment_desc_id']; ?>" class="modal fade" role="dialog">

                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Reschedule Appointment</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                              <div class="col-md-6 form-group">
                                <label>Select Date Schedule </label>
                                <input type="date" name="date" id="date" class="form-control" min="<?php echo date('Y-m-d') ?>" required>
                              </div>
                              <div class="col-md-6 form-group">
                                <label>Select Time Schedule </label>
                                <select name="schedule_time" class="form-control" required>
                                  <option value="">Please Time Schedule</option>
                                  <?php
                                  for ($i = 8; $i < 10; $i++) {
                                  ?>
                                    <option value="0<?php echo $i ?>:00">0<?php echo $i ?>:00</option>
                                  <?php } ?>
                                  <?php
                                  for ($i1 = 10; $i1 < 17; $i1++) {
                                  ?>
                                    <option value="<?php echo $i1 ?>:00"><?php echo $i1 ?>:00</option>
                                  <?php } ?>
                                </select>
                                <input type="hidden" value="<?php echo $u_id ?>" name="u_id">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="rescheduleReason">Reason for Rescheduling:</label>
                              <textarea class="form-control" name="rescheduleReason" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="update_id" value="<?php echo $f_e['appointment_desc_id']; ?>">
                            <input type="hidden" name="update" value="Re Schedule">
                            <button type="submit" name="submit_<?php echo $f_e['appointment_desc_id']; ?>" class="btn btn-danger">Reschedule</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  </td>
                  </tr>
                  <?php
                  $id_data = $f_e['appointment_desc_id'];
                  if (isset($_POST['submit_' . $id_data . ''])) {
                    $update_status = $_POST['update'];
                    if ($update_status === 'Re Schedule') {
                      $date          = $_POST['date'];
                      $schedule_time = $date . " - " . $_POST['schedule_time'];
                      $rescheduleReason = $_POST['rescheduleReason'];
                      $update_id = $_POST['update_id'];
                      $update1 = $_POST['update'];

                      // Update the appointment with the reason for rescheduling
                      $update = $conn->query("UPDATE `appointment_desc` SET `appointment_date` = '$schedule_time',`appointment_status` = '$update1', `why` = '$rescheduleReason' WHERE `appointment_desc_id` = '$update_id'");
                    } else {
                      $update_id = $_POST['update_id'];
                      $update1 = $_POST['update'];
                      // Update for Approve without rescheduling
                      $update = $conn->query("UPDATE `appointment_desc` SET `appointment_status` = '$update1' WHERE `appointment_desc_id` = '$update_id'");
                    }

                    if ($update) {
                      echo '<script>
                function myFunction() {
                    swal({
                        title: "Success! ",
                        text: "Appointment Successfully Update",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                        window.location = "section.php";
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
                  }


                  if (isset($_GET['id_data_update'])) {
                    $id_data_update = $_GET['id_data_update'];
                    $update = $_GET['update'];
                    $update1 = $conn->query("UPDATE `appointment_desc` SET `appointment_status` = '$update' WHERE `appointment_desc_id` = '$id_data_update'");
                    if ($update1) {
                      echo '<script>
                                    function myFunction() {
                                        swal({
                                            title: "Success! ",
                                            text: "Appointment Successfully Update",
                                            icon: "success",
                                            type: "success"
                                        }).then(function() {
                                            window.location = "section.php";
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
  <?php
  $q_e1 = $conn->query("SELECT * FROM `user_account1`");
  while ($f_e1 = $q_e1->fetch_array()) {
  ?>
    <div class="modal fade" id="historyModal<?php echo $f_e1['u_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">History</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <div class="container mt-4">
                <?php
                $u_id_data = $f_e1['u_id'];
                $sql = "SELECT * FROM medical_history WHERE `u_id`='$u_id_data' ORDER BY med_id ASC";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card mb-3 shadow-sm">';
                    echo '<div class="card-header bg-primary text-white"><strong>Medical History</strong></div>';
                    echo '<div class="card-body">';

                    // General Information
                    echo '<h5 class="card-title">General Information</h5>';
                    echo '<table class="table table-striped table-bordered">';
                    echo '<tr><th class="fixed-width">Date</th><td>' . htmlspecialchars($row["med_date"]) . '</td></tr>';
                    echo '<tr><th class="fixed-width">Previous Dentist</th><td>' . htmlspecialchars($row["med_prev_dent"]) . '</td></tr>';
                    echo '<tr><th class="fixed-width">Last Visit</th><td>' . htmlspecialchars($row["med_last_vi"]) . '</td></tr>';
                    echo '</table>';

                    // Health Questions
                    echo '<h5 class="card-title mt-4">Health Questions</h5>';
                    echo '<table class="table table-striped table-bordered">';
                    echo '<tr><th class="fixed-width">1.) Are you in good health?</th><td><span class="answer-highlight">' . htmlspecialchars($row["one"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">2.) Are you under medical treatment now?</th><td><span class="answer-highlight">' . htmlspecialchars($row["two"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">If so, what is the condition being treated?</th><td><span class="answer-highlight">' . htmlspecialchars($row["two_answer"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">3.) Have you ever had a serious illness or surgical operation?</th><td><span class="answer-highlight">' . htmlspecialchars($row["three"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">If so, what illness or operation?</th><td><span class="answer-highlight">' . htmlspecialchars($row["three_answer"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">4.) Have you ever been hospitalized?</th><td><span class="answer-highlight">' . htmlspecialchars($row["four"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">If so, when and why?</th><td><span class="answer-highlight">' . htmlspecialchars($row["four_answer"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">5.) Are you taking any prescription/non-prescription medication?</th><td><span class="answer-highlight">' . htmlspecialchars($row["five"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">If so, please specify:</th><td><span class="answer-highlight">' . htmlspecialchars($row["five_answer"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">6.) Do you use tobacco products?</th><td><span class="answer-highlight">' . htmlspecialchars($row["six"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">7.) Do you use alcohol, cocaine, or other dangerous drugs?</th><td><span class="answer-highlight">' . htmlspecialchars($row["seven"]) . '</span></td></tr>';
                    echo '</table>';

                    // Additional Information
                    echo '<h5 class="card-title mt-4">Additional Information</h5>';
                    echo '<table class="table table-striped table-bordered">';
                    echo '<tr><th class="fixed-width">Allergies</th><td><span class="answer-highlight">' . htmlspecialchars($row["allergies_str"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">Pregnant</th><td><span class="answer-highlight">' . htmlspecialchars($row["pregnant"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">Nursing</th><td><span class="answer-highlight">' . htmlspecialchars($row["nursing"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">Pills</th><td><span class="answer-highlight">' . htmlspecialchars($row["pills"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">Blood Type</th><td><span class="answer-highlight">' . htmlspecialchars($row["blood_type"]) . '</span></td></tr>';
                    echo '<tr><th class="fixed-width">Conditions</th><td><span class="answer-highlight">' . htmlspecialchars($row["conditions_str"]) . '</span></td></tr>';
                    echo '</table>';

                    echo '</div>'; // Close card-body
                    echo '</div>'; // Close card
                  }
                } else {
                  echo '<div class="alert alert-warning" role="alert">No records found</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div> -->
    </div>
    </div>
    </div>
  <?php } ?>
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

  <div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:50px;">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12 mb-3 mb-sm-0">
                <label>Username</label>
                <input type="email" class="form-control form-control-user" name="email" value="<?php echo $f['username']; ?>" required>
                <input type="hidden" class="form-control form-control-user" name="user_id" autofocus value="<?php echo $u_id ?>" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>First Name</label>
                <input type="text" class="form-control form-control-user" name="fname" value="<?php echo $f['fname']; ?>" required>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Middle Name</label>
                <input type="text" class="form-control form-control-user" name="mname" value="<?php echo $f['mname']; ?>" required>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Last Name</label>
                <input type="text" class="form-control form-control-user" name="lname" value="<?php echo $f['lname']; ?>" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Password</label>
                <input type="password" class="form-control form-control-user" name="password">
                <input type="hidden" class="form-control form-control-user" name="password_current" value="<?php echo $f['password']; ?>">
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Confirm</label>
                <input type="password" class="form-control form-control-user" name="cpassword">
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Current Password</label>
                <input type="password" class="form-control form-control-user" name="current_password" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button class="btn btn-danger" name="update_data">Update Data</button>
          </div>
        </form>
        <?php
        if (isset($_POST['update_data'])) {
          $email   = $_POST['email'];
          $user_id = $_POST['user_id'];
          $fname   = $_POST['fname'];
          $mname   = $_POST['mname'];
          $lname   = $_POST['lname'];
          $password    = $_POST['password'];
          $cpassword   = $_POST['cpassword'];
          $password_current   = $_POST['password_current'];
          $current_password = $_POST['current_password'];
          if ($password == null) {
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
          } elseif ($password == $cpassword) {
            if (password_verify($current_password, $password_current)) {
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
          } else {

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
  <script src="dist/js/demo.js"></script>
  <script>
    <?php
    $q_e = $conn->query("SELECT * FROM `appointment` WHERE `appointment_status` != 'Success' OR `appointment_status` != 'Pending'");
    $customDates = []; // Initialize an empty array to store the dates

    while ($f_e = $q_e->fetch_array()) {
      $dateWithTime = $f_e['appointment_date']; // Assuming this is in the format 'YYYY-MM-DD - HH:MM'
      $dateWithoutTime = explode(' - ', $dateWithTime)[0]; // Extracting only the date part

      // Convert date from YYYY-MM-DD format to mm/dd/yy format
      $formattedDate = date('d/m/Y', strtotime($dateWithoutTime));

      // Push the formatted date to the customDates array
      $customDates[] = $formattedDate;
    }

    // Count occurrences of each date in the array
    $dateCounts = array_count_values($customDates);

    // Initialize an empty array to store dates that repeat exactly twice
    $filteredDates = [];

    // Iterate through the date counts to find dates that repeat exactly twice
    foreach ($dateCounts as $date => $count) {
      if ($count == 2) {
        $filteredDates[] = $date;
      }
    }

    // Encode the filtered dates array to JSON
    $customDatesJSON = json_encode($filteredDates);
    ?>
    var customDates = <?php echo $customDatesJSON; ?>;

    function disableDates(date) {
      var currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0 for comparison

      // Disable dates before today
      if (date < currentDate) {
        return [false];
      }

      // Check if the date is in the customDates array
      var dateString = $.datepicker.formatDate('dd/mm/yy', date);
      return [customDates.indexOf(dateString) === -1];
    }

    $(function() {
      $("#date").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShowDay: disableDates
      });
    });
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

    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });
    });

    $(document).ready(function() {
      $('table.display').DataTable({
        "order": [
          [0, "asc"]
        ]
      });
    });

    function handleSelect(elm) {
      window.location = elm.value + ".php";
    }
  </script>
</body>

</html>