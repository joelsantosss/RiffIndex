<?php
session_start();
include('top.php');
include 'db_connect.php';
include('auth_check.php');

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

// Fetch pending requests
$sql = "SELECT br.*, u.name AS user_name FROM band_requests br 
        JOIN users u ON br.user_id = u.id 
        WHERE br.status = 'pending'";
$stmt = $conn->query($sql);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Band Requests</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="body-content">
        <div class="band-container">
            <h1 class="text-center mb-4">Review Band Requests</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Band Name</th>
                        <th>Requested By</th>
                        <th>Genre</th>
                        <th>Description</th>
                        <th>Reason</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request['band_name']); ?></td>
                            <td><?php echo htmlspecialchars($request['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($request['genre']); ?></td>
                            <td><?php echo htmlspecialchars($request['description']); ?></td>
                            <td><?php echo htmlspecialchars($request['reason']); ?></td>
                            <td>
                                <!-- Button to trigger modals -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal<?php echo $request['id']; ?>">
                                    Approve
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo $request['id']; ?>">
                                    Reject
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Structure for Approve -->
                        <div class="modal fade" id="approveModal<?php echo $request['id']; ?>" tabindex="-1" aria-labelledby="approveModalLabel<?php echo $request['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="approveModalLabel<?php echo $request['id']; ?>">Confirm Approval</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to approve the band request for "<?php echo htmlspecialchars($request['band_name']); ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" class="approve-form" data-request-id="<?php echo $request['id']; ?>" style="display: inline;">
                                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                            <button type="submit" class="btn btn-success" name="confirm" value="yes">Yes, Approve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Structure for Reject -->
                        <div class="modal fade" id="rejectModal<?php echo $request['id']; ?>" tabindex="-1" aria-labelledby="rejectModalLabel<?php echo $request['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="rejectModalLabel<?php echo $request['id']; ?>">Confirm Rejection</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to reject the band request for "<?php echo htmlspecialchars($request['band_name']); ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" class="reject-form" data-request-id="<?php echo $request['id']; ?>" style="display: inline;">
                                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="confirm" value="yes">Yes, Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Approve request via AJAX
            $('form.approve-form').on('submit', function(event) {
                event.preventDefault();

                const requestId = $(this).data('request-id');
                $.ajax({
                    url: 'approve_request.php',
                    method: 'POST',
                    data: {
                        request_id: requestId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#approveModal' + requestId).modal('hide');
                            location.reload(); // Refresh the page
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });

            // Reject request via AJAX
            $('form.reject-form').on('submit', function(event) {
                event.preventDefault();

                const requestId = $(this).data('request-id');
                $.ajax({
                    url: 'reject_request.php',
                    method: 'POST',
                    data: {
                        request_id: requestId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#rejectModal' + requestId).modal('hide');
                            location.reload(); // Refresh the page
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>

<?php
require "foot.php";
?>