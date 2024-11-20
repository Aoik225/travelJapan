<?php 
  session_start();

  // Remove all session values in $_SESSION
  session_unset();

  // End the session (terminate the session id)
  session_destroy();

  // Redirect back to home
  header("Location: ../index.php");
?>