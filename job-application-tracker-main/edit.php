<?php
include 'db.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = $_POST['company'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE jobs SET company='$company', position='$position', status='$status' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Edit Job</h2>

    <form method="post" class="bg-light p-4 rounded shadow">
        <div class="form-group">
            <label for="company"><i class="fas fa-building"></i> Company</label>
            <input type="text" id="company" name="company" class="form-control" value="<?= $row['company'] ?>" required>
        </div>

        <div class="form-group">
            <label for="position"><i class="fas fa-briefcase"></i> Position</label>
            <input type="text" id="position" name="position" class="form-control" value="<?= $row['position'] ?>" required>
        </div>

        <div class="form-group">
            <label for="status"><i class="fas fa-info-circle"></i> Status</label>
            <select id="status" name="status" class="form-control">
                <option value="Interested" <?= $row['status']=='Interested'?'selected':'' ?>>Interested</option>
                <option value="Applied" <?= $row['status']=='Applied'?'selected':'' ?>>Applied</option>
                <option value="Interview" <?= $row['status']=='Interview'?'selected':'' ?>>Interview</option>
                <option value="Offer" <?= $row['status']=='Offer'?'selected':'' ?>>Offer</option>
                <option value="Rejected" <?= $row['status']=='Rejected'?'selected':'' ?>>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Job
        </button>
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancel
        </a>
    </form>

    <footer class="text-center mt-5 py-3 bg-dark text-white">
        <p>&copy; <?= date('Y'); ?> Job Applicant Tracker. All Rights Reserved.</p>
    </footer>

</body>
</html>
