<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>
 
  <main class="container p-4 bg-light mt-3">

    <!-- process the data from this form-->
    <form action="./includes/comment.inc.php" method="POST">
      <h2>Comment</h2>
      
      <!-- DYNAMIC ERROR MESSAGE -->
      <?php
        // VALIDATION
        if(isset($_GET['error'])){
          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (ii) Forbidden request
          } else if ($_GET['error'] == "forbidden") {
            $errorMsg = "Please submit the form correctly";

          // (iii) 500 Internal server error (sql or server)
          } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          }

          // (iv) ERROR CATCH-ALL:
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
        }
      ?>
      
      <!-- 0. POST ID -->
      <div class="mb-3">
        <input type="hidden" class="form-control" id="pid" placeholder="pid" name="pid" value='<?php echo $_GET['id']?>'>
      </div>

      <!-- 1. REVIEWER NAME -->
      <div class="mb-3">
        <label for="rname" class="form-label">Name</label>
        <input type="text" class="form-control" id="raname" name="rname" placeholder="Name">
      </div>  

      <!-- 2. REVIEW COMMENT -->
      <div class="mb-3">
        <label for="rcomment" class="form-label">Comment</label>
        <input type="text" class="form-control pb-5" id="rcomment" name="rcomment" placeholder="Write a comment here">
      </div>

      <!-- 3. SUBMIT BUTTON -->
      <button type="submit" name="comment-submit" class="btn btn-info btn-lg w-100">Submit</button>
    </form>
  </main>
  
<!-- FOOTER.PHP -->
<?php require './templates/footer.php' ?>