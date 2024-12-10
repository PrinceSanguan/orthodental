<?php
include ('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT `u_id`, `password` FROM `user_account1` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        
        $u_id = $row['u_id'];
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["u_id"] = $u_id; 
            echo "
            <script>               
                window.location.href = 'http://localhost/orthodental/home.php';
            </script>
            "; 
            
        } else {

            echo '
                <!-- Bootstrap CSS (Include this in the head section) -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

                <!-- Modal for Login Failed Alert -->
                <div class="modal fade" id="loginFailedModal" tabindex="-1" aria-labelledby="loginFailedLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h6 class="modal-title" id="loginFailedLabel">Login Failed</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Incorrect Password! Please try again.
                            </div>
                           
                        </div>
                    </div>
                </div>

                <!-- JavaScript to Trigger the Modal and Redirect -->
                <script>
                    document.addEventListener(\'DOMContentLoaded\', function () {
                        var modalEl = document.getElementById(\'loginFailedModal\');
                        var modal = new bootstrap.Modal(modalEl);
                        
                        // Show the modal when the page loads
                        modal.show();

                        // Redirect after the modal is closed
                        modalEl.addEventListener(\'hidden.bs.modal\', function () {
                            window.location.href = \'http://localhost/orthodental/login.php\';
                        });
                    });
                </script>

                <!-- Bootstrap JS (Include this at the end of your HTML file) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                ';
        }
    } else {
        echo '
        <!-- Bootstrap CSS (Include this in the head section) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Modal for Login Failed Alert -->
        <div class="modal fade" id="loginFailedModal" tabindex="-1" aria-labelledby="loginFailedLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h6 class="modal-title" id="loginFailedLabel">Login Failed</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Login Failed, User not Found.
                    </div>
                  
                </div>
            </div>
        </div>

        <!-- JavaScript to Trigger the Modal and Redirect -->
        <script>
            document.addEventListener(\'DOMContentLoaded\', function () {
                var modalEl = document.getElementById(\'loginFailedModal\');
                var modal = new bootstrap.Modal(modalEl);
                
                // Show the modal when the page loads
                modal.show();

                // Redirect after the modal is closed
                modalEl.addEventListener(\'hidden.bs.modal\', function () {
                    window.location.href = \'http://localhost/orthodental/login.php\';
                });
            });
        </script>

        <!-- Bootstrap JS (Include this at the end of your HTML file) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        ';
    }
}

?>