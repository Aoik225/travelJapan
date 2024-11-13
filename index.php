<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5.0 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <!-- External CSS -->
  <link rel="stylesheet" href="./styles.css">
  <title>Japan Travel | Home</title>
</head>

<body>
  <div class="title">
    <h1 class="h1">Japan Travel</h1>
    <p class="h3">Share the beauty of Japan!</p>
  </div>

  <!-- Login Error Message from GET: START -->
  <div class="container mt-3">
      <?php
      // Check $_GET to see if we have any login error messages 
      if(isset($_GET['loginerror'])){
        // (i) Empty fields in Login 
        if($_GET['loginerror'] == "emptyfields"){
          $errorMsg = "Please fill in all fields";

        // (ii) 500 ERROR: SQL Error
        } else if ($_GET['loginerror'] == "sqlerror"){
          $errorMsg = "Internal server error - please try again later";

        // (iii) uidUsers / emailUsers do not match
        } else if ($_GET['loginerror'] == "nouser"){
          $errorMsg = "[DEV] The user does not exist";
          // $errorMsg = "Incorrect credentials";
        
        // (iv) Password does NOT match DB 
        } else if ($_GET['loginerror'] == "wrongpwd"){
          $errorMsg = "[DEV] Wrong password";
          // $errorMsg = "Incorrect credentials";
          
        // (iii) loginerror=forbidden
        } else if($_GET['loginerror'] == "forbidden"){
          $errorMsg = "Please submit form correctly";
        }
        // ERROR CATCH-ALL: Display alert with dynamic error message
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

      } else if (isset($_GET['login']) == "success"){
        // SUCCESS: User login successful message
        echo '<div class="alert alert-primary" role="alert">Welcome ' . $_SESSION['uname'] . '</div>';    
      }
    ?>
  </div>
  <!-- Error Message from GET: END -->
    
   <!-- Gallery -->
  <div class="container">
    <div class="css-carousel-slider6">
      <div class="slide-wrap-main">
        <div class="slide">
          <img src="./image/hiroshima.jpg" alt="Itsukushima shrine in Hiroshima">
        </div>
      </div>    
      <div class="slide-wrap">
        <div class="slide">
          <img src="./image/hiroshima.jpg" alt="Itsukushima shrine in Hiroshima">
        </div>      
        <div class="slide">
          <img src="./image/kyoto.jpg" alt="View of Kyoto">
        </div>
        <div class="slide">
          <img src="./image/hokkaido.jpg" alt="Mountain in Niseko, Hokkaido">
        </div>
        <div class="slide">
          <img src="./image/tokyo.jpg" alt="Shibuya crossing, Tokyo">
        </div>
        <div class="slide">
          <img src="./image/sakura.jpg" alt="Cherry blossoms at night">
        </div>
        <div class="slide">
          <img src="./image/shrine.jpg" alt="Fushimi Inari Taisha, Kyoto">
        </div>
      </div>
    </div>
  </div> 

  <!-- Login/Signup button-->
  <div id="loginandsignup-btn">
    <div id="login">
      <label for="login-btn" class="mx-3">I'm a member!</label>
      <button type="button" name="login-btn" class="btn btn-primary btn-lg" id="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
      Login
      </button>
    </div>

    <form action="./signup.php">
      <label for="signup-btn" class="mx-3">I want to join!</label>
      <input type="submit" class="btn btn-info btn-lg" id="signup-btn" value="Sign Up">
    </form>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal-body -->
        <div class="modal-body">
          <form action="./includes/login.inc.php" method="POST">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Email" aria-label="email" name="email">
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="User's password">
            </div>

            <!-- Modal-footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="login-submit">Login</button>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Modal: END -->

  <?php  include './templates/footer.php' ?>

