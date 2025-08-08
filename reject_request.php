<?php
session_start();
include 'db_connect.php';
include 'auth_check.php';

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

// Check if request_id is set
if (isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    // Update the request status to 'rejected'
    $sql = "UPDATE band_requests SET status = 'rejected' WHERE id = :request_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':request_id', $request_id);
    $stmt->execute();

    // Send success response
    echo json_encode(['success' => true, 'message' => 'Band request rejected!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
