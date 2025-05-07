<?php
// Include database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = $_POST['company'];
    $position = $_POST['position'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO jobs (company, position, status) VALUES ('$company', '$position', '$status')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Add New Job</h2>

    <!-- Add Job Form -->
    <form method="post" class="border p-4 shadow rounded">
        <div class="form-group">
            <label for="company">Company:</label>
            <input type="text" id="company" name="company" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="Interested">Interested</option>
                <option value="Applied">Applied</option>
                <option value="Interview">Interview</option>
                <option value="Offer">Offer</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Add Job
        </button>
        <a href="index.php" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </form>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        <p>&copy; <?= date('Y'); ?> Job Applicant Tracker. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
