<?php
include 'db.php';

// Get the ID from the URL
$id = $_GET['id'];

// Fetch the job details from the database
$result = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// Handle form submission to delete the job
if (isset($_POST['confirm'])) {
    mysqli_query($conn, "DELETE FROM jobs WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="container mt-5">

    <div class="alert alert-danger">
        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h4>
        <p>Are you sure you want to delete the job at <strong><?= $row['company'] ?></strong> for the position of <strong><?= $row['position'] ?></strong>?</p>

        <form method="post">
            <button type="submit" name="confirm" class="btn btn-danger">
                <i class="fas fa-trash"></i> Yes, Delete
            </button>
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-times-circle"></i> Cancel
            </a>
        </form>
    </div>

    <footer class="text-center mt-5 py-3 bg-dark text-white">
        <p>&copy; <?= date('Y'); ?> Job Applicant Tracker. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS (Optional, for modal and other components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
