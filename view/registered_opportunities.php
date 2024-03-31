<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Fetch opportunities registered by the user
    $sql = "SELECT * FROM users_opportunities 
            JOIN opportunities ON users_opportunities.opportunity_id = opportunities.id 
            WHERE users_opportunities.user_id = ? AND opportunities.status = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if opportunities are found
    if (mysqli_num_rows($result) > 0) {
        // Display opportunities
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Opportunities Registered</title>
        </head>
        <body>
            <h1>Opportunities Registered</h1>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li>
                        <strong><?php echo $row['title']; ?></strong><br>
                        <em><?php echo $row['description']; ?></em><br>
                        Date: <?php echo $row['date']; ?><br>
                        <!-- Add more details as needed -->
                    </li>
                <?php } ?>
            </ul>
        </body>
        </html>
        <?php
    } else {
        // No opportunities found for the user
        echo "You have not registered for any opportunities.";
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Close the database connection
mysqli_close($conn);
?>
