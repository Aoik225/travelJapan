<?php
// Start Session:
session_start();

if (isset($_POST['comment-submit']) && isset($_SESSION['userId'])) {
    // Connect to DB
    require './connect.inc.php';

    date_default_timezone_set('Australia/Sydney');

    // Store form data
    $pid = $_POST['pid'];
    $reviewerid = $_SESSION['userId'];
    $rname = $_POST['rname'];
    $rcomment = $_POST['rcomment'];
    $rimage = "no image";
    $date = date("Y/m/d");


    // VALIDATION: Check empty fields
    if (empty($rname) || empty($rcomment)) {
        header("Location: ../comment.php?error=emptyfields");
        exit();
    }

    // Save data to the DB using Prepared Statements
    $sql = "INSERT INTO review VALUES (NULL, ?, ?, ?, ?, ?)";
    $statement = $conn->stmt_init();

    // Prepare statement and check for errors
    if (!$statement->prepare($sql)) {
        header("Location: ../comment.php?error=sqlerror");
        exit();
    }

    // Bind parameters and execute the statement
    $statement->bind_param("iisss", $pid, $reviewerid, $rname, $rcomment, $date);
    $statement->execute();

    // ERROR
    if ($statement->error) {
        header("Location: ../comment.php?error=servererror");
        exit();
    }

    // SUCCESS
    header("Location: ../posts.php?comment=success");
    exit();
} else {
    header("Location: ../posts.php?error=forbidden");
    exit();
}
?>
