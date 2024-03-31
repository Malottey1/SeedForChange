<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Fetch opportunities posted by the user
    $sql = "SELECT * FROM opportunities WHERE user_id = ?";
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
            <title>Manage Opportunities</title>
        </head>
        <body>
            <h1>Manage Opportunities</h1>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                        <td>
                            <form action="../action/change_opportunity_status.php" method="POST">
                                <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="status" value="1">Activate</button>
                                <button type="submit" name="status" value="0">Deactivate</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        // No opportunities found for the user
        echo "You have not posted any opportunities.";
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Close the database connection
mysqli_close($conn);
?>
