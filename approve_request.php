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

    // Fetch the request details
    $sql = "SELECT * FROM band_requests WHERE id = :request_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':request_id', $request_id);
    $stmt->execute();
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($request) {
        // Insert new band into bands table
        $sql = "INSERT INTO bands (name, date_created, members, activity_status, genre, description) 
                VALUES (:band_name, :date_created, :members, :activity_status, :genre, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':band_name', $request['band_name']);
        $stmt->bindParam(':date_created', $request['date_created']);
        $stmt->bindParam(':members', $request['members']);
        $stmt->bindParam(':activity_status', $request['activity_status']);
        $stmt->bindParam(':genre', $request['genre']);
        $stmt->bindParam(':description', $request['description']);
        $stmt->execute();

        // Update the request status to 'approved'
        $sql = "UPDATE band_requests SET status = 'approved' WHERE id = :request_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':request_id', $request_id);
        $stmt->execute();

        // Send success response
        echo json_encode(['success' => true, 'message' => 'Band request approved and band added!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Request not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
