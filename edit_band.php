<?php
session_start();
include('top.php');
include 'db_connect.php';
include('auth_check.php');

// Check if band ID is provided in the URL
if (isset($_GET['id'])) {
    $band_id = $_GET['id'];

    // Fetch band info for editing
    $sql = "SELECT * FROM bands WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $band_id, PDO::PARAM_INT);
    $stmt->execute();
    $band = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no band is found, show error
    if (!$band) {
        echo "Band not found.";
        exit;
    }

    // Handle form submission to update band information
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $date_created = $_POST['date_created'];
        $members = $_POST['members'];
        $genre = $_POST['genre'];
        $activity_status = $_POST['activity_status'];
        $description = $_POST['description'];

        // Update query
        $sql = "UPDATE bands 
                SET name = :name, date_created = :date_created, members = :members, genre = :genre, 
                    activity_status = :activity_status, description = :description 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':date_created', $date_created, PDO::PARAM_STR);
        $stmt->bindParam(':members', $members, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':activity_status', $activity_status, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $band_id, PDO::PARAM_INT);

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
    <title>Edit Band</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="about-page">
        <h1 class="about-title">Edit Band</h1>
        <h2 class="about-subtitle">Update Band Details Below</h2>

        <form action="edit_band.php?id=<?php echo $band['id']; ?>" method="POST">
            <div class="about-section">
                <h3>Band Information</h3>
                <p><b>Band ID:</b> <?php echo $band['id']; ?></p>
                <label for="name">Band Name:</label>
                <input type="text" id="name" name="name" class="input-field" value="<?php echo htmlspecialchars($band['name']); ?>" required>
            </div>

            <div class="about-section">
                <label for="date_created">Date Created:</label>
                <input type="date" id="date_created" name="date_created" class="input-field" value="<?php echo htmlspecialchars($band['date_created']); ?>" required>
            </div>

            <div class="about-section">
                <label for="members">Members:</label>
                <textarea id="members" name="members" class="input-field" required><?php echo htmlspecialchars($band['members']); ?></textarea>
            </div>

            <div class="about-section">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" class="input-field" value="<?php echo htmlspecialchars($band['genre']); ?>" required>
            </div>

            <div class="about-section">
                <label for="activity_status">Activity Status:</label>
                <select id="activity_status" name="activity_status" class="input-field" required>
                    <option value="active" <?php echo ($band['activity_status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo ($band['activity_status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <div class="about-section">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="input-field" required><?php echo htmlspecialchars($band['description']); ?></textarea>
            </div>

            <div class="input-submit">
                <button type="submit" class="submit-btn">Update Band</button>
            </div>
        </form>
    </div>

    <?php if (isset($update_status)): ?>
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header <?php echo ($update_status == 'success') ? 'bg-success text-white' : 'bg-danger text-white'; ?>">
                        <h5 class="modal-title"><?php echo ($update_status == 'success') ? 'Update Successful' : 'Update Failed'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo ($update_status == 'success') ? 'The band was successfully updated.' : 'An error occurred while updating the band.'; ?>
                    </div>
                    <div class="modal-footer">
                        <a href="band_database.php" class="btn <?php echo ($update_status == 'success') ? 'btn-success' : 'btn-danger'; ?>">Return to Database</a>
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