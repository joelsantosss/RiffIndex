<?php
session_start();
ob_start(); // Start output buffering to prevent "headers already sent" error
require "top.php"; // Includes the top section (head, opening body tag)
require "nav.php"; // Includes the navigation bar

// Database connection
require "db_connect.php"; // Adjust to your actual database connection file

// Initialize error message variable
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize password error message
$password_error = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input values and sanitize them
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $phone = htmlspecialchars(trim($_POST['phone'])); // New phone number field

    // Image upload
    $image = $_FILES['image'];
    $image_path = '';

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!preg_match('/^(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password)) {
        // If password does not meet the security requirements
        $password_error = "Password must be at least 8 characters long, include at least one number, and at least one special character.";
    } elseif ($image['error'] === UPLOAD_ERR_OK) {
        // Handle image upload
        $target_dir = "uploads/"; // Directory to store images
        $image_name = basename($image['name']);
        $image_path = $target_dir . uniqid() . "_" . $image_name; // Create unique file name

        // Ensure the uploads directory exists
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($image['tmp_name'], $image_path)) {
            $error = "Failed to upload image.";
        }
    } else {
        $error = "Please upload a valid image.";
    }

    if (empty($error) && empty($password_error)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $role = 'member'; // Default role for new users

        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $error = "Email is already registered.";
        } else {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, phone, image) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $email, $hashed_password, $role, $phone, $image_path])) {
                // Redirect to login page after successful signup
                header("Location: login.php");
                exit(); // Make sure to exit to prevent further output
            } else {
                $error = "Failed to register user.";
            }
        }
    }
}
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">

<div class="container">
    <div class="login-box">
        <div class="login-header">
            <header>Sign Up</header>
        </div>

        <!-- Display error message if exists -->
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Display password error message if the password does not meet security requirements -->
        <?php if (!empty($password_error)): ?>
            <div style="color: red; font-size: 12px;">
                <?php echo $password_error; ?>
            </div>
        <?php endif; ?>

        <!-- Signup form -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="input-box">
                <input type="text" name="name" class="input-field" placeholder="Full Name" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="text" name="phone" class="input-field" placeholder="Phone Number" autocomplete="off" required>
            </div>
            <p>Submit your profile picture: </p>
            <div>
                <input type="file" name="image" class="input-field" accept="image/*" required>
            </div>

            <br>

            <div class="input-submit">
                <button type="submit" class="submit-btn">Sign up</button>
            </div>
        </form>

        <div class="sign-up-link">
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
</div>

<?php
ob_end_flush(); // End output buffering and send output
require "foot.php"; // Includes the footer and closing body/html tags
?>