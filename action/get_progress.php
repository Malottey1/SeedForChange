<?php
// Include the file to connect to the database
include '../settings/connection.php';

// Function to get the number of registered opportunities
function getNumRegisteredOpportunities($conn, $user_id) {
    $sql = "SELECT COUNT(*) AS num_opportunities FROM users_opportunities 
            JOIN opportunities ON users_opportunities.opportunity_id = opportunities.id 
            WHERE users_opportunities.user_id = ? AND opportunities.status = 0";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $num_registered_opportunities = $row['num_opportunities'];

    // Close the statement
    mysqli_stmt_close($stmt);

    return $num_registered_opportunities;
}

// Function to get the total number of opportunities
function getTotalOpportunities($conn, $user_id) {
    $sql_total = "SELECT COUNT(*) AS total_opportunities FROM users_opportunities 
                  WHERE user_id = ?";
    $stmt_total = mysqli_prepare($conn, $sql_total);
    mysqli_stmt_bind_param($stmt_total, "i", $user_id);
    mysqli_stmt_execute($stmt_total);
    $result_total = mysqli_stmt_get_result($stmt_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_opportunities = $row_total['total_opportunities'];

    // Close the statement
    mysqli_stmt_close($stmt_total);

    return $total_opportunities;
}

// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Fetch opportunities registered by the user
    $num_registered_opportunities = getNumRegisteredOpportunities($conn, $user_id);

    // Fetch total number of opportunities registered by the user
    $total_opportunities = getTotalOpportunities($conn, $user_id);

    // Close the database connection
    mysqli_close($conn);
    
    // Calculate progress percentage
    $progress_percentage = ($total_opportunities > 0) ? round(($num_registered_opportunities / $total_opportunities) * 100) : 0;
    
    // Display the progress circle
    echo generateProgressCircle($progress_percentage);
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Function to generate the progress circle HTML
function generateProgressCircle($progress_percentage) {
    $html = '<div class="circular-progress" 
                 data-inner-circle-color="white" 
                 data-percentage="' . $progress_percentage . '" 
                 data-progress-color="#32620e" 
                 data-bg-color="black">
                <div class="inner-circle"></div>
                <p class="percentage">' . $progress_percentage . '%</p>
            </div>';

    return $html;
}
?>
