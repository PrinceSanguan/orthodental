<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Your PHP code to fetch and display cards goes here -->
        <div class="row g-4">
    <?php
        // Fetch data from the dental_history table
        $sql = "SELECT * FROM dental_history WHERE dental_user = $u_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Create a card that triggers the modal
                echo '<div class="col-md-4">';
                echo '<div class="card" data-toggle="modal" data-target="#detailsModal" 
                      data-date="'.htmlspecialchars($row['dental_date']).'" 
                      data-file="'.htmlspecialchars($row['dental_file']).'" 
                      data-brace="'.htmlspecialchars($row['dental_brace']).'" 
                      data-comment="'.htmlspecialchars($row['dental_comment']).'" 
                      data-status="'.htmlspecialchars($row['dental_status']).'" 
                      data-description="'.htmlspecialchars($row['appointment_desc']).'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['dental_date']) . '</h5>';
                echo '<p class="card-text">File: ' . htmlspecialchars($row['dental_file']) . '</p>';
                echo '<p class="card-text">Braces: ' . htmlspecialchars($row['dental_brace']) . '</p>';
                echo '</div></div></div>';
            }
        } else {
            echo '<center><p>No appointments found.</p></center>';
        }
        $conn->close();
    ?>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Appointment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                <p><strong>File:</strong> <span id="modalFile"></span></p>
                <p><strong>Braces:</strong> <span id="modalBrace"></span></p>
                <p><strong>Comment:</strong> <span id="modalComment"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Description:</strong> <span id="modalDescription"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // jQuery to handle the modal pop-up
        $('#detailsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var date = button.data('date');
            var file = button.data('file');
            var brace = button.data('brace');
            var comment = button.data('comment');
            var status = button.data('status');
            var description = button.data('description');

            // Update the modal's content
            var modal = $(this);
            modal.find('#modalDate').text(date);
            modal.find('#modalFile').text(file);
            modal.find('#modalBrace').text(brace);
            modal.find('#modalComment').text(comment);
            modal.find('#modalStatus').text(status);
            modal.find('#modalDescription').text(description);
        });
    });
</script>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>