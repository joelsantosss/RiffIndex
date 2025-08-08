<?php
session_start();
include('top.php');
include('auth_check.php');
include 'db_connect.php';

// Pagination logic
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Fetch total number of bands for pagination
$total_bands_sql = "SELECT COUNT(*) FROM bands";
$total_bands = $conn->query($total_bands_sql)->fetchColumn();
$total_pages = ceil($total_bands / $items_per_page);

// Fetch bands for the current page
$sql = "SELECT * FROM bands LIMIT :offset, :items_per_page";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
$stmt->execute();
$bands = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the user's role from the session
$user_role = $_SESSION['role'] ?? 'member'; // Default to 'member' if not set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Band Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="body-content">
        <div class="band-container">
            <h1 class="text-center mb-4">Band Database</h1>

            <!-- Navigation Buttons -->
            <div class="text-center mb-4">
                <?php if ($user_role === 'admin'): ?>
                    <a href="band_database.php" class="btn btn-primary btn-lg">Band Database</a>
                    <a href="user_database.php" class="btn btn-secondary btn-lg">User Database</a>
                <?php endif; ?>
            </div>

            <!-- Band Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Band Name</th>
                        <th>Founded</th>
                        <th>Members</th>
                        <th>Genre</th>
                        <th>Activity Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bands as $band): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($band['name']); ?></td>
                            <td><?php echo htmlspecialchars($band['date_created']); ?></td>
                            <td><?php echo htmlspecialchars($band['members']); ?></td>
                            <td><?php echo htmlspecialchars($band['genre']); ?></td>
                            <td><?php echo htmlspecialchars($band['activity_status']); ?></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center">
                                    <a href="view_band.php?id=<?php echo $band['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                                    <?php if ($user_role === 'admin'): ?>
                                        <a href="edit_band.php?id=<?php echo $band['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="delete_band.php?id=<?php echo $band['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    <?php endif; ?>
                                </div>
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

            <?php if ($user_role === 'admin'): ?>
                <div class="text-center mt-4">
                    <a href="add_band.php" class="btn btn-success btn-lg">Add New Band</a>
                </div>
                <div class="text-center mt-4">
                    <a href="review_requests.php" class="btn btn-success btn-lg">Review Requests</a>
                </div>
            <?php endif; ?>

            <?php if ($user_role === 'member'): ?>
                <div class="text-center mt-4">
                    <a href="request_band.php" class="btn btn-warning btn-lg">Request Band</a>
                </div>
            <?php endif; ?>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
require "foot.php";
?>