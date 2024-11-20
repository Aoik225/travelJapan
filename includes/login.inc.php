<?php 
  // Check the form is submitted via button click
  if(isset($_POST['login-submit'])){
    // Connect to db
    require './connect.inc.php';

    // Store form fields data in local variables
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    // Validate data by checking for empty fields (redirect on error)
    if(empty($email) || empty($password)){
      header("Location: ../index.php?loginerror=emptyfields");
      exit();
    }

    // LOGIN PART 1: Check for matching user [PREPARED STATEMENT]
    // SQL Template
    $sql = "SELECT * FROM user WHERE uid=? OR email=?";

    // Init SQL Statement + Prepare
    $statement = $conn->stmt_init();
    if(!$statement->prepare($sql)){
      // ERROR: SQL Syntax error
      header("Location: ../index.php?error=sqlerror");
      exit();
    }

    // Bind the data to the statement
    $statement->bind_param("ss", $email, $email);

    // Execute the stmt & store the result
    $statement->execute();
    $result = $statement->get_result();

    // AUTHENTICATION: Check the user exists + their credentials (pwd) is correct
    // i. Check user is in DB
    if($row = $result->fetch_assoc()){
      // USER EXISTS: Now we check password
      $pwdCheck = password_verify($password, $row['password']);
      if(!$pwdCheck){
        // USER HAS WRONG PWD: Authentication error
        header("Location: ../index.php?loginerror=wrongpwd");
        exit();

      } else {
        // USER IS AUTHENTICATED!!
        session_start();

        // Create session tokens (stores the logged in user data)
        $_SESSION['userId'] = $row['uid'];
        $_SESSION['username'] = $row['uname'];

        // Redirect user on success
        header("Location: ../posts.php?login=success");
        exit();
      }
      
    } else {
      // USER DOES NOT EXIST: Authentication error
      header("Location: ../index.php?loginerror=nouser");
      exit();
    }

  } else {
    header("Location: ../index.php?loginerror=forbidden");
    exit();
  }
?>