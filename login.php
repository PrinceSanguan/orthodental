<?php require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <meta charset="utf-8">
    <title>Orthodental Clinic | Login</title>
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
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            /* background: radial-gradient(circle, rgba(11,43,26,1) 0%, rgba(9,78,69,1) 100%); */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 70vh;
        }

        .login-form, .registration-form {
            backdrop-filter: blur(100px);
            /* color: rgb(255, 255, 255); */
            padding: 40px;
            width: 500px;
            border: 1px solid;
            border-radius: 10px;
        }
        .switch-form-link {
            text-decoration: underline;
            cursor: pointer;
            color: rgb(100, 100, 200);
        }

       
    </style>
</head>
<body onload="myFunction()">
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
                    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 09am - 5pm</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Brand Start -->
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
                <a href="index.php">
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
    <!-- Brand End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-0 px-lg-3">
                <a href="index.php" class="navbar-brand d-lg-none">
                    <h1 class="text-primary m-0">Orthodental</h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <!-- <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#service" class="nav-link nav-link" >Services</a> -->
                    </div>
                    <div class="ms-auto d-none d-lg-flex">
                        <a class="btn btn-primary ms-2" href="registration.php">Create Account</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<!--  -->
<div class="container-fluid py-5">
        
  <div class="container" >

<div class="card o-hidden border-0 shadow-lg my-5" >
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
    <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center" style="border-right: 1px black solid; ">
        <img src="img/logos_clear.png" style="width: 300px;">
    </div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h1 text-white-900 mb-4" >Sign In</h1>
          </div>
          <form class="user"  action="./endpoint/login.php" method="POST" enctype = "multipart/form-data" autocomplete="off">
        
            <div class="modal-body">
                    <!-- <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($email); ?>" name="email" id="exampleInputUser" placeholder="Enter Email..." autofocus>
                        <span class="help-block" style="color:#DC143C;"><?php echo $username_err; ?></span>
                    </div><br>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Enter Password">
                        <span class="help-block" style="color:#DC143C;"><?php echo $password_err; ?></span>
                        <br>
                    </div> -->

                    <div class="form-group">
                        <label for="username" >Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <a href="registration.php" style="color:#45505b;text-decoration:none;">No Account Yet? Create Account</a>
                    <a href="forgot.php" style="color:#45505b;text-decoration:none;float:right;">Forgot Password</a>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
          
            <!-- <button type="submit" class="btn btn-primary btn-user btn-block" style="float:right;" name="register"  id="register" name="register">Register</button> -->
            <!-- <button  class = "btn btn-primary btn-user btn-block" style="float:right;" name="register"  id="register" type="submit"><span class = "glyphicon glyphicon-save"></span> Register Account</button> -->
                        <br>
                        <br>
            <hr>
        
          </form>

          <div class="text-center">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
    </div>

<!--  -->
   
    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark text-white-50 py-4">
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
        const loginForm = document.getElementById('loginForm');
        const registrationForm = document.getElementById('registrationForm');

        registrationForm.style.display = "none";


        function showRegistrationForm() {
            registrationForm.style.display = "";
            loginForm.style.display = "none";
        }

        function showLoginForm() {
            registrationForm.style.display = "none";
            loginForm.style.display = "";
        }

        function sendVerificationCode() {
            const registrationElements = document.querySelectorAll('.registration');

            registrationElements.forEach(element => {
                element.style.display = 'none';
            });

            const verification = document.querySelector('.verification');
            if (verification) {
                verification.style.display = 'none';
            }
        }

    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>