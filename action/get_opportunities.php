<?php
// Include the file to connect to the database
include '../settings/connection.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

// Function to fetch opportunities from the database
function getOpportunities() {
    global $conn;

    // Query to fetch all opportunities
    $sql = "SELECT * FROM opportunities";
    $result = mysqli_query($conn, $sql);

    // Check if there are any opportunities
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and fetch opportunity details
        while ($row = mysqli_fetch_assoc($result)) {
            // Fetch cause areas associated with the opportunity
            $opportunity_id = $row['id'];
            $cause_areas_sql = "SELECT cause_areas.name FROM cause_areas
                                INNER JOIN opportunity_cause_areas ON cause_areas.id = opportunity_cause_areas.cause_area_id
                                WHERE opportunity_cause_areas.opportunity_id = $opportunity_id";
            $cause_areas_result = mysqli_query($conn, $cause_areas_sql);

            // Initialize an array to store cause areas
            $cause_areas = array();
            while ($cause_area_row = mysqli_fetch_assoc($cause_areas_result)) {
                $cause_areas[] = $cause_area_row['name'];
            }

            // Display opportunity details
            echo '<li>' .
                    '<h3>' . $row['title'] . '</h3>' .
                    '<p>' . $row['description'] . '</p>' .
                    '<p>Date: ' . $row['date'] . '</p>' .
                    '<p>Cause Area: ' . implode(", ", $cause_areas) . '</p>' .
                    '<a href="../view/opportunity_details.php?id=' . $opportunity_id . '">View Details</a>' .
                 '</li>';
        }
    } else {
        // Display message if no opportunities available
        echo '<li>No opportunities available</li>';
    }
}

// Close database connection
mysqli_close($conn);
?>
