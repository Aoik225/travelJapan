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
        // (i) Declare Template SQL with ? Placeholders to select values for SPECIFIC post id
        $sql = "SELECT title, imageurl, comment, websitetitle, websiteurl FROM post WHERE pid=?";
  
        // (ii) Init SQL statement
        $statement = $conn->stmt_init();
  
        // (iii) Prepare + send statement to database to check for errors
        if(!$statement->prepare($sql)){
          // ERROR: Something wrong when preparing the SQL
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

    <!-- end ID via GET ALONG with our POST form data -->
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
      <h2>Edit Post</h2>

      <?php 
        // DYNAMIC ERROR ALERTS FOR EDIT POST
        if(isset($_GET['error'])){
          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (ii) Internal server error 
          } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          }

          // (iii) Dynamic Error Alert based on Variable Value 
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
        }
      ?>

      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title'] ?>">
      </div>  

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['imageurl'] ?>" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment"><?php echo $row['comment'] ?></textarea>
      </div>
      
      <!-- 4. WEBSITE TITLE -->
      <div class="mb-3">
        <label for="websitetitle" class="form-label">Website Title</label>
        <input type="text" class="form-control" name="websitetitle" placeholder="Website Title" value="<?php echo $row['websitetitle'] ?>" >
      </div>

        <!-- 5. WEBSITE URL -->
        <div class="mb-3">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" class="form-control" name="websiteurl" placeholder="Website URL" value="<?php echo $row['websiteurl'] ?>" >
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="edit-submit" class="btn btn-primary w-100">Edit</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>