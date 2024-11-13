<?php 
// 1. Start Session
session_start();

if (isset($_POST['enquiry-submit'])) {
    // Connect to DB
    require './connect.inc.php';

    // Store form data in individual variables
    $cid = $_SESSION['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $image = 'no image';

    // Check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_file = $_FILES['image'];
        $target_dir = "./uploads/";
        
        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Validate the image file type
        $allowed_types = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $image_type = exif_imagetype($image_file["tmp_name"]);
        
        if (!in_array($image_type, $allowed_types)) {
            header("Location: ../contact.php?error=badimage");
            exit();
        }

        // Generate a unique file name and determine the file extension
        $image_extension = image_type_to_extension($image_type, true);
        $image_name = bin2hex(random_bytes(16)) . $image_extension;
        $image_path = $target_dir . $image_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image_file["tmp_name"], $image_path)) {
            $image = $image_path;  // Update image path for storage
        } else {
            header("Location: ../contact.php?error=uploadfail");
            exit();
        }
    }

    // Store data in session
    $_SESSION['enquiry_data'] = [
        'cid' => $cid,
        'name' => $name,
        'email' => $email,
        'title' => $title,
        'message' => $message,
        'image' => $image
    ];

    // Redirect to the confirmation page
    header("Location: confirm_enquiry.php");
    exit();
}
?>
