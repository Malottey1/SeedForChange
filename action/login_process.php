<?php
// Include your database connection file
include "../settings/connection.php";

// Start the session
session_start();

// Check if the user is logged in
check_login();

// Check if the form is submitted for login
if (isset($_POST['login'])) {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the form data
    if (!empty($email) && !empty($password)) {
        // Hash the password for comparison
        $hashed_password = md5($password); // You should use a more secure hashing algorithm like bcrypt

        // Query to check if the user exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Check if the user exists
            if (mysqli_num_rows($result) == 1) {
                // User authenticated successfully
                // Store user data in the session
                $user = mysqli_fetch_assoc($result);
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];

                // Redirect the user to the homepage or dashboard
                header("Location: ../view/profile.php");
                exit();
            } else {
                // Incorrect email or password, display SweetAlert2 alert
                $_SESSION["login_failed"] = true;
                header("Location: ../login/login.php");
            }
        } else {
            // Error in the query
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Form fields are empty
        echo "Email and password are required.";
    }
}

// Define the check_login() function
function check_login() {
    if (isset($_SESSION['user_id'])) {
        // Redirect the user to the homepage if they are already logged in
        header("Location: ../view/homepage-postlogin.php");
        exit();
    }
}
?>
