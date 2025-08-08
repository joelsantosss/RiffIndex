<?php
session_start();

// Check if the user is an admin before allowing access
if ($_SESSION['role'] !== 'admin') {
    header("Location: band_database.php");
    exit();
}

include('top.php');
include('auth_check.php');
include 'db_connect.php';

// Pagination logic: Define how many items per page
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page from query string, default to 1
$offset = ($page - 1) * $items_per_page; // Calculate the offset for the SQL query

// Fetch total number of users for pagination
$total_users_sql = "SELECT COUNT(*) FROM users";
$total_users = $conn->query($total_users_sql)->fetchColumn();
$total_pages = ceil($total_users / $items_per_page); // Calculate total pages for pagination

// Fetch users for the current page
$sql = "SELECT * FROM users LIMIT :offset, :items_per_page";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT); // Bind the offset for pagination
$stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT); // Bind the limit for pagination
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user_role = $_SESSION['role'] ?? 'member'; // Default to 'member' role if not set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Database</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="body-content">
        <div class="band-container">
            <h1 class="text-center mb-4">User Database</h1>

            <!-- Navigation Buttons -->
            <div class="text-center mb-4">
                <a href="band_database.php" class="btn btn-secondary btn-lg">Band Database</a>
                <a href="user_database.php" class="btn btn-primary btn-lg">User Database</a>
            </div>

            <!-- User Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <!-- Display user image or default if none exists -->
                                <img src="<?php echo htmlspecialchars($user['image'] ?: 'default.jpg'); ?>" alt="User Image"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            </td>
                            <td><?php echo htmlspecialchars($user['name'] ?: 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($user['email'] ?: 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($user['role'] ?: 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($user['phone'] ?: 'N/A'); ?></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center">
                                    <a href="view_user.php?id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                                    <?php if ($user_role === 'admin'): ?>
                                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i === $page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
require "foot.php";
?>