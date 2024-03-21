<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "db_connection.php";

    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the form data (you may need more robust validation)
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
                // Start a session and store user data
                session_start();
                $user = mysqli_fetch_assoc($result);
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];
                // Redirect the user to the homepage or dashboard
                header("Location: homepage.php");
                exit();
            } else {
                // User does not exist or invalid credentials
                echo "Invalid email or password. Please try again.";
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
?>
