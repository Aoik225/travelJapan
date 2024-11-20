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

  <title>Japan Travel</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Japan Travel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
      </ul>
    </div>
  </div>
  </nav>
 
  <main class="container p-4 bg-light mt-3">
    <!-- signup.inc.php - Will process the data from this form-->
    <form action="./includes/signup.inc.php" method="POST">
      <h2>Signup</h2>
      <?php 
        if(isset($_GET['error'])){

          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (ii) Invalid Email
          } else if ($_GET['error'] == "invalidmail") {
            $errorMsg = "Invalid email";

          // Invalid Password
          } else if ($_GET['error'] == "invalidpwd") {
            $errorMsg = "Invalid password - please use 1 capital letter, 1 number, 1 special character & minimum of 8 characters";

          // (iii) Password Confirmation Error
          } else if ($_GET['error'] == "passwordcheck") {
            $errorMsg = "Passwords do not match";

          // (iv) Username MATCH in database on save
          } else if ($_GET['error'] == "usertaken") {
            $errorMsg = "Username already taken";

          // (v) Internal server error 
          } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          
          // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
          }
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

        } else if(isset($_GET['signup']) == "success"){
          echo '<div class="alert alert-success" role="alert">You have successfully signed up</div>';
        }
      ?>

      <!-- 1. USERNAME -->
      <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input type="text" class="form-control" name="uname" placeholder="Username">
      </div>  

      <!-- 2. EMAIL -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email Address">
      </div>

      <!-- 3. PASSWORD -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>

      <!-- 4. PASSWORD CONFIRMATION -->
      <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
      </div>
      <!-- 5. SUBMIT BUTTON -->
      <button type="submit" name="signup-submit" class="btn btn-info btn-lg w-100">Signup</button>
    </form>

    <!-- 6. LOGIN BUTTON -->
    <button type="button" class="btn btn-primary btn-lg w-100" id="signup-form-login" data-bs-toggle="modal" data-bs-target="#loginModal">
      Login
    </button>

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
                <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" name="email">
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="User's password" aria-describedby="basic-addon2">
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
  </main>
 <!-- FOOTER.PHP -->
<?php require './templates/footer.php' ?>