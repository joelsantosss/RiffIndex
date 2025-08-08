<?php
session_start();
include('top.php');
include 'db_connect.php';
include('auth_check.php');


if (isset($_GET['id'])) {
    $band_id = $_GET['id'];

    // Fetch the band info before deletion to confirm
    $sql = "SELECT * FROM bands WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $band_id, PDO::PARAM_INT);
    $stmt->execute();
    $band = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$band) {
        echo "Band not found.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
        // Deleting the band
        $sql = "DELETE FROM bands WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $band_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Band deleted successfully.";
            header("Location: band_database.php");
            exit;
        } else {
            echo "Error deleting band.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Band</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="band_styles.css">
</head>

<body>
    <div class="body-content">
        <div class="band-container">
            <h1>Delete Band</h1>

            <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Delete Band "<?php echo htmlspecialchars($band['name']); ?>"
            </button>

            <!-- Modal Structure -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the band "<?php echo htmlspecialchars($band['name']); ?>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <!-- Form for deletion -->
                            <form method="POST" action="delete_band.php?id=<?php echo $band['id']; ?>" style="display: inline;">
                                <input type="hidden" name="band_id" value="<?php echo $band['id']; ?>">
                                <button type="submit" class="btn btn-danger" name="confirm" value="yes">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php require "foot.php"; ?>