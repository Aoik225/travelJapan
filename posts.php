<?php 
  require "templates/header.php";
?>
<section class="container mx-auto my-3">
  <div class="text-start alert alert-info">
    <h2>Rules for using this website</h2>
    <ul class="lh-login">
      <li>Only use copyright-free images or submit photos with the permission of the copyright owner of the photo.</li>
      <li>Post photos that are relevant to Japan and enjoyable for everyone.</li>
      <li>In order for everyone to use this site safely and happily, please do not make malicious comments or solicitations that are not related to the post.</li>
      <li>If you find an inappropriate post or comment, inform the administrator immediately.</li>
    </ul>
  </div>
</section>

<main class="container p-4 bg-light mt-3">
  <?php  
  require './includes/connect.inc.php';
  $id = $_SESSION['userId'];

  // Prepare SQL query to fetch comments associated with posts
  $sql = "SELECT rid, pid, reviewerid, rname, rcomment, date FROM review";
  $statement = $conn->prepare($sql);
  $statement->execute();
  $result = $statement->get_result();

  // Store comments in an array for later display
  $comments = [];
  while ($row = $result->fetch_assoc()) {
      $comments[$row['pid']][] = $row; // Group comments by post ID
  }
  $statement->close();      
  ?>

  <?php
    // Query to retrieve all posts
    $sql = "SELECT pid, uid, title, imageurl, comment, websitetitle, websiteurl FROM post";
    $result = $conn->query($sql);
  ?>

  <?php 
    // Display messages based on GET parameters
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        echo '<div class="alert alert-danger" role="alert">An internal server error has occurred - please try again later</div>';
      }
    } elseif (isset($_GET['post']) && $_GET['post'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post created!</div>';  
    } elseif (isset($_GET['edit']) && $_GET['edit'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post edited!</div>'; 
    } elseif (isset($_GET['delete']) && $_GET['delete'] == "success") {
      echo '<div class="alert alert-success" role="alert">Post successfully deleted!</div>';    
    } elseif (isset($_GET['deletecomment']) && $_GET['deletecomment'] == "success") {
      echo '<div class="alert alert-success" role="alert">Comment successfully deleted!</div>';   
    }
  ?>

  <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php
      // Check if posts exist and display them
      if($result->num_rows > 0){
        $output = "";
        while($row = $result->fetch_assoc()){
          $output .= '<div class="col">
            <div class="card border-0 mt-3" id="' . $row['pid'] . '">';

          // Only show edit/delete options for the logged-in user who owns the post
          if (isset($_SESSION['userId']) && $_SESSION['userId'] == $row['uid']) {
            $output .= '<div class="admin-btn d-flex justify-content-end p-2">
              <a href="editpost.php?id=' . $row['pid'] . '" class="btn btn-secondary btn-sm me-2">Edit</a>
<<<<<<< HEAD
              <a href="./includes/deletepost.inc.php?id=' . $row['pid'] . '" class="btn btn-danger btn-sm" onclick="myFunction()">Delete</a>
=======
              <a href="./includes/deletepost.inc.php?id=' . $row['pid'] . '" class="btn btn-danger btn-sm">Delete</a>
>>>>>>> c03eb3263243db459f6e4727f7d165a9a7c68411
            </div>';
          }

          // Post Image and Content
          $output .= '
              <img src="' . $row['imageurl'] . '" class="card-img-top post-image" alt="' . $row['title'] . '">
              <div class="card-body">
                <h5 class="card-title">' . $row['title'] . '</h5>
                <p class="card-text">' . $row['comment'] . '</p>
                <p class="card-text">Posted by: User ID ' . $row['uid'] . '</p>
                <a href="' . $row['websiteurl'] . '" class="btn btn-primary w-100" target="_blank">' . $row['websitetitle'] . '</a>
                <a href="./comment.php?id=' . $row['pid'] . '">
                  <button type="submit" class="btn btn-outline-primary mt-2" name="comment-btn">Add Comments</button>
                </a>
                <h5 class="mt-3">Comments</h5>';

          // Comments Section
          if (isset($comments[$row['pid']])) {
            foreach ($comments[$row['pid']] as $comment) {
              $output .= '<div class="container p-2 bg-light border mt-2">
                            <div><strong>' . htmlspecialchars($comment['rname']) . '</strong></div>
                            <div>' . htmlspecialchars($comment['rcomment']) . '</div>
                            <div class="fst-italic">' . htmlspecialchars($comment['date']) . '</div>';
              
          // Show delete button only for the comment's author
          if(isset($_SESSION['userId']) && $_SESSION['userId'] == $comment['reviewerid']){
            $output .= '<a href="includes/deletecomment.inc.php?id=' . $comment['rid'] . '" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCommentModal' . $comment['rid'] . '">Delete</a>
            
            <!-- Delete Comment Modal -->
            <div class="modal fade" id="deleteCommentModal' . $comment['rid'] . '" tabindex="-1" aria-labelledby="deleteCommentModalLabel' . $comment['rid'] . '" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteCommentModalLabel' . $comment['rid'] . '">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete this comment?
                  </div>
                  <div class="modal-footer">
                    <form action="./includes/deletecomment.inc.php?id=' . $comment['rid'] . '" method="POST">
                      <button type="submit" class="btn btn-danger" name="delete-submit">Delete</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>';
          }

          $output .= '</div>';
        }
      } else {
        $output .= '<p>No comments yet.</p>';
      }

      $output .= '</div></div></div>'; // Close card-body, card, and col divs
    }   

    echo $output;

  } else {
    echo "<p>No posts available. Let's create a post!</p>";
  }

  $conn->close();
  ?>
  </div>
<<<<<<< HEAD
  <script>
    function myFunction(){
      confirm("Are you sure to delete the post?");
    }
  </script>
=======
>>>>>>> c03eb3263243db459f6e4727f7d165a9a7c68411
</main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php";
?>