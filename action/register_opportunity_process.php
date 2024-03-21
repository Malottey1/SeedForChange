<?php
session_start(); // Start the session (assuming you're using sessions for user authentication)

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "db_connection.php";

    // Get the opportunity ID from the form
    $opportunity_id = $_POST["opportunity_id"];

    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
        // If the user is not logged in, redirect them to the login page
        header("Location: login.php");
        exit();
    }

    // Retrieve the user ID from the session
    $user_id = $_SESSION["user_id"];

    // Insert the user-opportunity registration into the Users_Opportunities table
    $sql = "INSERT INTO Users_Opportunities (user_id, opportunity_id)
            VALUES ('$user_id', '$opportunity_id')";
    
    if (mysqli_query($conn, $sql)) {
        // Registration successful
        echo "Registration successful!";
        // Redirect the user to the homepage or another appropriate page
        header("Location: homepage.php");
        exit();
    } else {
        // Error in SQL execution
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
