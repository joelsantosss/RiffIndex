<?php
session_start();
include('top.php');
include 'db_connect.php';
include('auth_check.php');

// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user info for editing
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user not found, display an error
    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Handle form submission to update user information
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form input
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];

        // Prepare the update query
        $sql = "UPDATE users 
                SET name = :name, email = :email, role = :role, phone = :phone 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

        // Execute the update query
        if ($stmt->execute()) {
            $update_status = 'success';
        } else {
            $update_status = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="about-page">
        <h1 class="about-title">Edit User</h1>
        <h2 class="about-subtitle">Update User Details Below</h2>

        <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST">
            <div class="about-section">
                <h3>User Information</h3>
                <p><b>User ID:</b> <?php echo $user['id']; ?></p>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="input-field" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="about-section">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="about-section">
                <label for="role">Role:</label>
                <input type="text" id="role" name="role" class="input-field" value="<?php echo htmlspecialchars($user['role']); ?>" required>
            </div>

            <div class="about-section">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" class="input-field" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="input-submit">
                <button type="submit" class="submit-btn">Update User</button>
            </div>
        </form>
    </div>

    <?php if (isset($update_status)): ?>
        <!-- Feedback Modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header <?php echo ($update_status == 'success') ? 'bg-success text-white' : 'bg-danger text-white'; ?>">
                        <h5 class="modal-title"><?php echo ($update_status == 'success') ? 'Update Successful' : 'Update Failed'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo ($update_status == 'success') ? 'The user was successfully updated.' : 'An error occurred while updating the user.'; ?>
                    </div>
                    <div class="modal-footer">
                        <a href="user_database.php" class="btn <?php echo ($update_status == 'success') ? 'btn-success' : 'btn-danger'; ?>">Return to Database</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if (isset($update_status)): ?>
            var myModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
            myModal.show();
        <?php endif; ?>
    </script>
</body>

</html>

<?php
require "foot.php";
?>