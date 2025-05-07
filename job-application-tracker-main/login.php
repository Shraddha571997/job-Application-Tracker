<?php
// Start the session to manage login status
session_start();

// Initialize an error variable
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple username and password check
    if ($username == 'admin' && $password == 'admin123') {
        // Store user session
        $_SESSION['user'] = 'admin';

        // Redirect to the main page (index.php)
        header("Location: index.php");
        exit();
    } else {
        // Set error message if invalid login
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <!-- Display error message if login fails -->
    <?php if($error) { ?>
    <div class="alert alert-danger">
        <?= $error; ?>
    </div>
    <?php } ?>

    <!-- Login Form -->
    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>
</body>
</html>
