<?php
$conn = mysqli_connect("localhost", "root", "", "job_tracker");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>