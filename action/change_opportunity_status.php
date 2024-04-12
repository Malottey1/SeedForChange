<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the opportunity_id and status are set
        if (isset($_POST['opportunity_id']) && isset($_POST['status'])) {
            $opportunity_id = $_POST['opportunity_id'];
            $status = $_POST['status'];
            
            // Update the status of the opportunity in the database
            $update_status_sql = "UPDATE opportunities SET status = ? WHERE id = ? AND user_id = ?";
            $stmt = mysqli_prepare($conn, $update_status_sql);
            mysqli_stmt_bind_param($stmt, "iii", $status, $opportunity_id, $user_id);
            mysqli_stmt_execute($stmt);

            // Redirect back to the manage-opportunities.php page
            header("Location: ../view/manage-opportunities.php");
            exit();
        } else {
            // Opportunity ID or status not set
            echo "Opportunity ID or status not set.";
        }
    } else {
        // Form not submitted
        echo "Form not submitted.";
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
    header("Location: ../login/login.php");
}

// Close the database connection
mysqli_close($conn);
?>
