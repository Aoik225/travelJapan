<?php session_start();
?>
<?php
  require './includes/connect.inc.php';

  $id = $_SESSION['userId'];
  $sql = "SELECT uname FROM user WHERE uid=? LIMIT 1";

  $statement = $conn->stmt_init();
  $statement = $conn->prepare($sql);
  $statement->bind_param("i", $id);

  $statement->execute();

  $result = $statement->get_result();
  if($row = $result->fetch_assoc()){
    $uname = $row['uname'];
  }
?>

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
        <li class="nav-item">
          <a class="nav-link" href="./edituser.php?id=<?php echo $_SESSION['userId']?>">Edit Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./posts.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./createpost.php">Create Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-edit" href="./mypost.php">My Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-edit" href="./contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./includes/logout.inc.php" method="POST">Logout</a>
        </li>
      </ul>
      <div><?php echo "<span class='text-primary'>Welcome</span> " . $uname?></div>
    </div>
  </div>
  </nav>