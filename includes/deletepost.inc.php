<?php
// Include database connection
require './connect.inc.php';

// Check if post ID is set
if (isset($_GET['id'])) {
    $pid = $_GET['id'];

    // First, delete related reviews from the review table
    $stmt = $conn->prepare("DELETE FROM review WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();

    // Then, delete the post from the post table
    $stmt = $conn->prepare("DELETE FROM post WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        // Redirect to a page with a success message
        header("Location: ../posts.php?delete=success");
        exit();
    } else {
        // Redirect to a page with an error message
        header("Location: ../posts.php?error=sqlerror");
        exit();
    }
} else {
    // Redirect if the ID is not set
    header("Location: ../index.php?error=missingid");
    exit();
}
?>
