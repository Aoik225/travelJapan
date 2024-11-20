<?php
  // Check User Clicked Edit button + Logged In
  session_start();
  if(isset($_POST['edit-user-submit']) && isset($_SESSION['userId'])){
    // Connect to DB
    require './connect.inc.php';

    // Collect & store POST data
    $id = $conn->real_escape_string($_GET['id']); 
    $id = intval($id);
    $uname = $_POST['uname'];
    $email = $_POST['email'];


    // VALIDATION: Check if any fields are empty
    if (empty($uname) || empty($email)) {
      // ERROR: Redirect + error via GET
      header("Location: ../edituser.php?id=$id&error=emptyfields");
      exit();
    }

    // Save (BY UPDATE) Edited Post to DB using Prepared Statements
    // (i) Declare Template SQL with ? Placeholders to update values for row in posts table (6 PLACEHOLDERS!)
    $sql = "UPDATE user SET uname=?, email=? WHERE uid=?"; 

    // (ii) Init SQL statement
    $statement = $conn->stmt_init();
  
    // (iii) Prepare + send statement to database to check for errors
    if(!$statement->prepare($sql)){
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../edituser.php?id=$id&error=sqlerror"); 
      exit();
    }

    // (iv) SUCCESS: Bind our user data with statement + escape strings
    $statement->bind_param("ssi", $uname, $email, $id);

    // (v) Execute the SQL Statement with user data
    $statement->execute();
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../edituser.php?id=$id&error=servererror");
      exit();
    }

    // (vi) SUCCESS: Edited post is updated for specific row in "posts" table - redirect with success message
    header("Location: ../posts.php?id=$id&edituser=success"); 
    exit();

  // 10. Restrict Access to Edit Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>