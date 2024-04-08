<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register-opp'])) {
    // Check if opportunity_id and user_id are set and valid
    if (isset($_POST['opportunity_id']) && isset($_SESSION['user_id']) && is_numeric($_POST['opportunity_id']) && is_numeric($_SESSION['user_id'])) {
        $opportunity_id = $_POST['opportunity_id'];
        $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session, adjust as needed

        // Prepare and execute the SQL statement to insert into users_opportunities table
        $sql = "INSERT INTO users_opportunities (user_id, opportunity_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $opportunity_id);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            header("Location: ../view/volunteer_listings.php");
            exit();
        } else {
            // Error in SQL execution
            echo "Error: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Required fields are not set or invalid
        echo "Invalid data provided.";
    }
} else {
    // Redirect to the homepage or any other page if accessed directly without POST request
    header("Location: ../view/homepage-postlogin.php");
    exit();
}

// Close database connection
mysqli_close($conn);
?>
