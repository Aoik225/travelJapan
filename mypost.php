<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>

  <main class="container p-4 bg-light mt-3">
    <?php
      $id = $_SESSION['userId'];
      // QUERY DATABASE for ALL POSTS
      // (i) Connect to Database
      require './includes/connect.inc.php';

      // (ii) Declare SQL command to DB to retrieve ALL rows from posts table in DB
      $sql = "SELECT pid, uid, title, imageurl, comment, websitetitle, websiteurl FROM post WHERE uid=$id";

      // (iii) Call query & store result in variable
      $result = $conn->query($sql);
    ?>

    <?php 
      // ERROR: ON DELETION OF POST 
      if(isset($_GET['error'])){
        // (i) Internal server error 
        if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
          $errorMsg = "An internal server error has occurred - please try again later";
        }

        // (ii) Dynamic Error Alert based on Variable Value 
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
      
      // SUCCESS: POST CREATE
      } else if(isset($_GET['post']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post created!
        </div>';  

      // SUCCESS: POST EDIT 
      } else if(isset($_GET['edit']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post edited!
        </div>'; 

      // SUCCESS: POST DELETE
      } else if (isset($_GET['delete']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post successfully deleted!
        </div>';    
      }
    ?>

  <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php
      // CHECK FOR POSTS RETURNED RESULT & DISPLAY ON SUCCESS
      // (i) Success: Display Posts
      if($result->num_rows > 0){

        // LOOP DATA INTO OUR BOOTSTRAP CARD TEMPLATE
        // (i) New variable with default state
        $output = "";

        // (ii) Take result -> convert to array & then insert into While Loop
        while($row = $result->fetch_assoc()) {
          if($_SESSION['userId'] == $row['uid']){ 
            // (iii) Join output cards together with .=
           // (iv) Dynamic Data into Cards using Concatenation of Variables
          $output .= '<div class="col">
            <div class="card border-0 mt-3" id="' . $row['pid'] . '">
              <img src="' . $row['imageurl'] . '" class="card-img-top post-image" alt="' . $row['title'] . '">
              <div class="card-body">
                <h5 class="card-title">' . $row['title'] . '</h5>
                <p class="card-text">' . $row['comment'] . '</p>
                <p class="card-text">' . '</p>
                <a href="' . $row['websiteurl'] . '" class="btn btn-primary w-100" target="_blank">' . $row['websitetitle'] . '</a>';
                
                // (v) Restrict Edit/Delete Button ONLY to post authors 
                if(isset($_SESSION['userId']) && $_SESSION['userId'] == $row['uid']){
                  $output .= '
                  <div class="admin-btn">
                    <a href="editpost.php?id=' . $row['pid'] . '" class="btn btn-secondary mt-2">Edit</a>
                     <a href="includes/deletepost.inc.php?id=' . $row['pid'] . '" class="btn btn-danger mt-2" onclick="myFunction()">Delete</a>
                  </div>';
                }
          $output .= '</div>
                        </div>
                      </div>
                      ';
             }       
        }
        // Echo out the result of the loop
        echo $output;

      // Error: Template Error Message
      } else {
        echo "<div class='alert alert-light col-md-6 offset-md-3' role='alert'><p class='text-center h4'>No posts yet. Let's create a post!</p'></div>";
      }
      // Close Connection
      $conn->close();
    ?>
    <script>
    function myFunction(){
      confirm("Are you sure to delete the post?");
    }
  </script>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>