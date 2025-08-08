<?php
session_start();
include('top.php');
include('auth_check.php');
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to request a band.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $band_name = $_POST['band_name'];
    $date_created = $_POST['date_created'];
    $members = $_POST['members'];
    $activity_status = $_POST['activity_status'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $reason = $_POST['reason'];
    $status = 'pending';

    // Prepare SQL query for inserting the request
    $sql = "INSERT INTO band_requests (user_id, band_name, date_created, members, activity_status, genre, description, reason, status) 
            VALUES (:user_id, :band_name, :date_created, :members, :activity_status, :genre, :description, :reason, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':band_name', $band_name);
    $stmt->bindParam(':date_created', $date_created);
    $stmt->bindParam(':members', $members);
    $stmt->bindParam(':activity_status', $activity_status);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':status', $status);

    // Execute query and provide feedback
    if ($stmt->execute()) {
        echo "Request submitted successfully!";
    } else {
        echo "Error submitting request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Band</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="band-container">
        <h1>Request a Band</h1>
        <br>
        <form action="request_band.php" method="POST" class="band-form">
            <h6>Request Date:</h6>
            <input type="text" name="band_name" placeholder="Band Name" required>
            <h6>Band Creation:</h6>
            <input type="date" name="date_created" placeholder="Date Created" required>
            <textarea name="members" placeholder="Band Members" required></textarea>
            <select name="activity_status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <input type="text" name="genre" placeholder="Genre" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <textarea name="reason" placeholder="Reason for Request" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
        </form>
    </div>
</body>

</html>

<?php require "foot.php"; ?>