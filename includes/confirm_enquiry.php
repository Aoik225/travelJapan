<?php
session_start();

// Retrieve enquiry data from session
$enquiry_data = $_SESSION['enquiry_data'] ?? null;

// Check if data exists and handle if not
if ($enquiry_data) {
    $cid = htmlspecialchars($enquiry_data['cid']);
    $name = htmlspecialchars($enquiry_data['name']);
    $email = htmlspecialchars($enquiry_data['email']);
    $title = htmlspecialchars($enquiry_data['title']);
    $message = nl2br(htmlspecialchars($enquiry_data['message']));
    $image = $enquiry_data['image'] !== 'no image' ? htmlspecialchars($enquiry_data['image']) : null;
} else {
    echo "No data available.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap 5.0 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- External CSS -->
  <link rel="stylesheet" href="./styles.css">
        <title>Confirm Enquiry</title>
    </head>
    <body class="text-center">
        <h2 class="py-3" style="background-color: lightsteelblue">Confirm Enquiry Details</h2>
                <p><strong>Name:</strong> <?= $name ?? 'N/A' ?></p>
                <p><strong>Email:</strong> <?= $email ?? 'N/A' ?></p>
                <p><strong>Title:</strong> <?= $title ?? 'N/A' ?></p>
                <p><strong>Message:</strong> <?= $message ?? 'N/A' ?></p>      
        <?php if ($image): ?>
            <img src="<?= $image ?>" alt="Uploaded Image" class="img-fluid">
        <?php else: ?>
            <p>No image uploaded.</p>
        <?php endif; ?>

        <form action="submit_enquiry.php" method="post">
            <button class="btn btn-primary my-2" type="submit" name="confirm-enquiry">Confirm Enquiry</button>
        </form>
        <a href="../contact.php" class="btn btn-info">Edit Enquiry</a>
        <!-- Bootstrap Script Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>
