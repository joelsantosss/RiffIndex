<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connect.php'; // Include your database connection

// Allow access to login.php, about.php and signup.php without a session
$current_page = basename($_SERVER['PHP_SELF']);
$public_pages = ['login.php', 'signup.php', 'about.php'];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if (!in_array($current_page, $public_pages)) {
        header("Location: login.php");
        exit();
    }
} else {
    // Refresh the user's role from the database
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['role'] = $user['role']; // Update the session role
    } else {
        // If the user no longer exists, log them out
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
