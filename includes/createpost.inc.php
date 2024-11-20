<?php
  // Start Session: 
  session_start();

  // Check user clicked submit button from createpost form + user is logged in
  if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
    // Connect to database
    require './connect.inc.php';

    // Collect & store POST data
    $uid = $_SESSION['userId'];
    $title = $_POST['title'];
    $imageUrl = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteTitle = $_POST['websitetitle'];
    $websiteUrl = $_POST['websiteurl'];

    // VALIDATION: Check if any fields are empty
    if (empty($title ) || empty($imageUrl) || empty($comment) || empty($websiteTitle) || empty($websiteUrl)) {
      // ERROR: Redirect + error via GET
      header("Location: ../createpost.php?error=emptyfields");
      exit();
    }

    // Save Post to DB using Prepared Statements
    // (i) Declare Template SQL with ? Placeholders to save values to table
    $sql = "INSERT INTO post VALUES (NULL, ?, ?, ?, ?, ?, ?)"; 

    // (ii) Init SQL statement
    $statement = $conn->stmt_init();

    // (iii) Prepare + send statement to database to check for errors
    if(!$statement->prepare($sql)){
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../createpost.php?error=sqlerror"); 
      exit();
    }
    // (iv) SUCCESS: Bind our user data with statement + escape strings
    $statement->bind_param("isssss", $uid, $title, $imageUrl, $comment, $websiteTitle, $websiteUrl);

    // (v) Execute the SQL Statement with user data
    $statement->execute();
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../createpost.php?error=servererror");
      exit();
    }

    // (vi) SUCCESS: Post is saved to "posts" table - redirect with success message
    header("Location: ../posts.php?post=success"); 
    exit();

  // Restrict Access to Script Page
  } else {
    header("Location: ../createpost.php?error=forbidden");
    exit();
  }
?>
