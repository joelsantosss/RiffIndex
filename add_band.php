<?php
session_start();
include('top.php');
include('auth_check.php');
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $date_created = $_POST['date_created'];
    $members = $_POST['members'];
    $genre = $_POST['genre'];
    $activity_status = $_POST['activity_status'];
    $description = $_POST['description'];

    // Prepare SQL statement to insert new band
    $sql = "INSERT INTO bands (name, date_created, members, genre, activity_status, description) 
            VALUES (:name, :date_created, :members, :genre, :activity_status, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date_created', $date_created);
    $stmt->bindParam(':members', $members);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':activity_status', $activity_status);
    $stmt->bindParam(':description', $description);

    // Execute query and provide feedback
    if ($stmt->execute()) {
        echo "Band added successfully!";
    } else {
        echo "Error adding band.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Band</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="band-container">
        <h1>Add Band</h1>
        <form action="add_band.php" method="POST" class="band-form">
            <input type="text" name="name" placeholder="Band Name" required>
            <input type="date" name="date_created" placeholder="Founded Date" required>
            <textarea name="members" placeholder="Members (comma-separated)" rows="4" required></textarea>
            <input type="text" name="genre" placeholder="Genre" required>
            <select name="activity_status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <textarea name="description" placeholder="Band Description" rows="5" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Add Band</button>
        </form>
    </div>
</body>

</html>

<?php
require "foot.php";
?>