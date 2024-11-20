<?php
  // Check User is Logged In + Id passed in via GET
  session_start();
  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // Connect to DB
    require './connect.inc.php';

    // Collect, escape string & store POST data
    $id = $conn->real_escape_string($_GET['id']); 
    $id = intval($id);
 
    // Delete comment from DB 
    // (i) Declare Template SQL with ? Placeholders to delete values from table
    $sql = "DELETE FROM review WHERE rid = ?"; 

    // (ii) Init SQL statement
    $statement = $conn->stmt_init();

    // (iii) Prepare + send statement to database to check for errors
    if(!$statement->prepare($sql)){
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../posts.php?id=$id&error=sqlerror"); 
      exit();
    } 

    // (iv) SUCCESS: Bind our user data with statement + escape integer
    $statement->bind_param("i", $id);

    // (v) Execute the SQL Statement (to run in DB)
    $statement->execute();
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../posts.php?error=servererror");
      exit();
    }
    
    // (vi) SUCCESS: Comment is deleted from "review" table - redirect with success message
    header("Location: ../posts.php?id=$id&deletecomment=success"); 
    exit();

  // Restrict Access to Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>