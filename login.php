<?php
ob_start();
session_start();

// Redirect logged-in users away from login.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit();
}

require "top.php";
require "nav.php";
require "db_connect.php";

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean up email and password
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Check if username and password match
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: index.php"); // Redirect to index after successful login
        exit();
    } else {
        $error = "Invalid email or password."; // Error message
    }
}
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">

<div class="container">
    <div class="login-box">
        <div class="login-header">
            <header>Login</header>
        </div>


        <?php if (!empty($error)): ?> <!--display error-->
            <div class="error-message" style="color: red;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- login form with names matching the POST variables in php above -->
        <form method="POST" action="">
            <div class="input-box">
                <input type="text" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
            </div>
            <br>
            <div class="input-submit">
                <button type="submit" class="submit-btn">Sign In</button>
            </div>
        </form>

        <br>

        <div class="sign-up-link">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</div>

<?php
ob_end_flush();
require "foot.php";
?>