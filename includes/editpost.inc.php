<?php
  // Check User Clicked Edit-Submit Button + Logged In
  session_start();
  if(isset($_POST['edit-submit']) && isset($_SESSION['userId'])){
    // Connect to DB
    require './connect.inc.php';

    // Collect & store POST data
    $id = $conn->real_escape_string($_GET['id']); 
    $id = intval($id);
    $title = $_POST['title'];
    $imageUrl = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteTitle = $_POST['websitetitle'];
    $websiteUrl = $_POST['websiteurl'];
    

    // VALIDATION: Check if any fields are empty
    if (empty($id) || empty($title) || empty($imageUrl) || empty($comment) || empty($websiteTitle) || empty($websiteUrl)) {
      // ERROR: Redirect + error via GET
      header("Location: ../editpost.php?id=$id&error=emptyfields");
      exit();
    }

    // Save (BY UPDATE) Edited Post to DB using Prepared Statements
    // (i) Declare Template SQL with ? Placeholders to update values for row in posts table (6 PLACEHOLDERS!)
    $sql = "UPDATE post SET title=?, imageurl=?, comment=?, websitetitle=?, websiteurl=? WHERE pid=?"; 

    // (ii) Init SQL statement
    $statement = $conn->stmt_init();
  
    // (iii) Prepare + send statement to database to check for errors
    if(!$statement->prepare($sql)){
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../editpost.php?id=$id&error=sqlerror"); 
      exit();
    }

    // (iv) SUCCESS: Bind our user data with statement + escape strings
    $statement->bind_param("sssssi", $title, $imageUrl, $comment, $websiteTitle, $websiteUrl, $id);

    // (v) Execute the SQL Statement with user data
    $statement->execute();
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../editpost.php?id=$id&error=servererror");
      exit();
    }

    // (vi) SUCCESS: Edited post is updated for specific row in "posts" table - redirect with success message
    header("Location: ../posts.php?id=$id&edit=success"); 
    exit();

  // Restrict Access to Edit Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>