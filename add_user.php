<?php
session_start();
include('top.php');
include('auth_check.php');
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $image = $_FILES['image']['name'] ?: 'default.jpg';
    $image_tmp = $_FILES['image']['tmp_name'];

    // If an image is uploaded, move it to the "uploads" directory
    if ($image_tmp) {
        move_uploaded_file($image_tmp, "uploads/$image");
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (name, email, role, phone, image) 
            VALUES (:name, :email, :role, :phone, :image)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':image', $image);

    // Execute query and provide feedback
    if ($stmt->execute()) {
        echo "User added successfully!";
    } else {
        echo "Error adding user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="band-container">
        <h1>Add User</h1>
        <form action="add_user.php" method="POST" enctype="multipart/form-data" class="band-form">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="role" placeholder="Role (e.g., Admin, Member)" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <input type="file" name="image" accept="image/*">
            <button type="submit" class="btn btn-primary mt-3">Add User</button>
        </form>
    </div>
</body>

</html>

<?php
require "foot.php";
?>