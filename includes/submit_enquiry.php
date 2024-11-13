<?php
session_start();

// Check if the confirmation form was submitted and if enquiry data exists
if (isset($_POST['confirm-enquiry']) && isset($_SESSION['enquiry_data'])) {
    require './connect.inc.php';
    $data = $_SESSION['enquiry_data'];

    $sql = "INSERT INTO enquiry VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $statement = $conn->stmt_init();

    if (!$statement->prepare($sql)) {
        header("Location: contact.php?error=sqlerror");
        exit();
    }

    $statement->bind_param("isssss", $data['cid'], $data['name'], $data['email'], $data['title'], $data['message'], $data['image']);
    $statement->execute();

    if ($statement->error) {
        header("Location: ../contact.php?error=servererror");
        exit();
    }

    // Clear session data and redirect with success message
    unset($_SESSION['enquiry_data']);
    header("Location: ../contact.php?enquire=success");
    exit();
} else {
    header("Location: ../contact.php");
    exit();
}
?>
