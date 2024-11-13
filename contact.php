<!-- HEADER.PHP -->
<?php 
  require "templates/header.php";
?>
 
  <main class="container p-4 bg-light mt-3">
    <!-- Process the data from this form-->
    <form action="./includes/contact.inc.php" method="POST" enctype="multipart/form-data">
      <h2>Contact form</h2>
      <?php 
        if(isset($_GET['error'])){

          // (i) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields except image";

          // Echo Back Danger Alert with the Dynamic Error Message
          }
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

        } else if(isset($_GET['enquire']) && $_GET['enquire'] == "success"){
          echo '<div class="alert alert-success" role="alert">Thank you for your enquiry. We will normally reply within 3 working days.</div>';
        }
      ?>

      <!-- 1. NAME -->
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Name">
      </div>  

      <!-- 2. EMAIL -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email Address">
      </div>

      <!-- 3. ENQUIRY TITLE-->
      <div class="mb-3">
        <label for="title" class="form-label">Enquiry title</label>
        <input type="text" class="form-control" name="title" placeholder="Title">
      </div>

      <!-- 4. MESSAGE -->
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
          <input type="message" class="form-control" name="message" placeholder="message">
      </div>

      <!-- 5. IMAGE -->
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" name="image" placeholder="image">
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="enquiry-submit" class="btn btn-info btn-lg w-100">Submit</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php require './templates/footer.php' ?>