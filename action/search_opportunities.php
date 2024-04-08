<?php
// Include the file to connect to the database
include '../settings/connection.php';

// Check if the search keyword is provided
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Prepare the SQL statement to search for opportunities
    $sql = "SELECT * FROM opportunities WHERE title LIKE ? OR description LIKE ? OR requirements LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters
    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, "sss", $searchParam, $searchParam, $searchParam);

    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect to a page that displays the search results
    header("Location: ../view/search_results.php?search=$search");
    exit();
} else {
    // No search keyword provided
    echo "Please enter a search keyword.";
}
?>
