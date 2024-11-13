<?php 
if (isset($_POST['signup-submit'])) {
    // Connect to DB
    require './connect.inc.php';

    // Store form data
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['pwd-repeat'];

    /* Password combinations:
      - must contain a num
      - must contain capital letter
      - must contain a special character
      - must be at least 8 characters
    */
    $pwdReg = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmailuname");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduname&mail=" . $email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uname=" . $username);
        exit();
    } else if (!preg_match($pwdReg, $password)) {
        header("Location: ../signup.php?error=invalidpwd&uname=" . $username . "&mail=" . $email);
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uname=" . $username . "&mail=" . $email);
        exit();
    } else {
        // Check if username or email already exists
        $sql = "SELECT uid FROM user WHERE uname = ? OR email = ?";
        $statement = $conn->stmt_init();
        if (!$statement->prepare($sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }

        // Bind parameters and execute
        $statement->bind_param("ss", $username, $email);
        $statement->execute();
        $statement->store_result();
        
        if ($statement->num_rows > 0) {
            // Username or email is already taken
            header("Location: ../signup.php?error=usertaken");
            exit();
        } else {
            // Insert new user
            $sql = "INSERT INTO user(uname, email, password) VALUES (?, ?, ?)";
            $statement = $conn->stmt_init();
            if (!$statement->prepare($sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }

            // Hash the password and bind parameters
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $statement->bind_param("sss", $username, $email, $hashedPwd);
            if (!$statement->execute()) {
                header("Location: ../signup.php?error=servererror");
                exit();
            } else {
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }
    }

    // Close statement and connection
    $statement->close();
    $conn->close();
} else {
    // 403 ERROR: FORBIDDEN
    header("Location: ../signup.php?error=forbidden");
    exit();
}
?>
