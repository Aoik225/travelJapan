<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
  <main class="container p-4 bg-light mt-3">
    <?php
    // Check User is Logged In + Id passed in via GET
    if(isset($_SESSION['userId']) && isset($_GET['id'])){
      // Connect to DB
      require './includes/connect.inc.php';
  
      // Declare variable called $row to store array with our DB data to display (later)
      $row;
  
      // Collect, escape string & store POST data
      $id = $conn->real_escape_string($_GET['id']); 
      $id = intval($id);
  
      // Declare SQL command to extract data from DB relating to post id (Prepared Statements)
      $sql = "SELECT uname, email FROM user WHERE uid=?";
  
      // (ii) Init SQL statement
      $statement = $conn->stmt_init();
  
      // (iii) Prepare + send statement to database to check for errors
      if(!$statement->prepare($sql)){
        // ERROR: Something wrong when preparing the SQL
        // NOTE: Need to pass in the id BACK to url & the error message.  IMPORTANT - NOTE we are NOT going up a directory!
        header("Location: editpost.php?id=$id&error=sqlerror"); 
        exit();
      }

      // (iv) SUCCESS: Bind our user data with statement
      $statement->bind_param("i", $id);

      // (v) Execute the SQL Statement (to run in DB)
      $statement->execute();

      // (vi) SUCCESS: Store result & convert to array ($row declared above at 2.)
      $result = $statement->get_result();
      $row = $result->fetch_assoc();
  
      // PRE-POPULATE data IF we have it from the $row variable in form below  
      // Restrict Access to Edit Page
      } else {
        header("Location: index.php");
        exit();
      }
     ?>
     <!-- edituser.inc.php - Will process the data from this form-->
    <form action="./includes/edituser.inc.php?id=<?php echo $id ?>" method="POST">
      <h2>Edit Profile</h2>
      <?php 
        if(isset($_GET['error'])){
          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (ii) Invalid Email
          } else if ($_GET['error'] == "invalidmail") {
            $errorMsg = "Invalid email";

          // (v) Internal server error 
          } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          
          // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
          }
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

        } else if(isset($_GET['edituser']) == "success"){
          echo '<div class="alert alert-success" role="alert">Your profile has been successfully updated</div>';
        }
      ?>
      
      <!-- 1. USERNAME -->
      <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input type="text" class="form-control" name="uname" placeholder="Username" value="<?php echo $row['uname'] ?>">
      </div>  

      <!-- 2. EMAIL -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo $row['email'] ?>">
      </div>

      <!-- 3. SUBMIT BUTTON -->
      <button type="submit" name="edit-user-submit" class="btn btn-info btn-lg w-100">Edit</button>
    </form>
  </main>
<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>