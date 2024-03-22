<?php
// Include the database connection file
include "../settings/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $requirements = $_POST["requirements"];
    $date = $_POST["date"];
    $cause_areas = $_POST["cause_area[]"]; // Change to cause_area[] if multiple cause areas are selected

    // Validate form data (you may need more robust validation)
    if (!empty($title) && !empty($description) && !empty($requirements) && !empty($date)) {
        // Insert opportunity data into opportunities table
        $sql = "INSERT INTO opportunities (title, description, requirements, date) VALUES ('$title', '$description', '$requirements', '$date')";
        if (mysqli_query($conn, $sql)) {
            // Get the opportunity ID
            $opportunity_id = mysqli_insert_id($conn);
            
            // Insert cause areas for the opportunity into collective_cause_areas table
            $sql_insert_collective_cause_areas = "INSERT INTO collective_cause_areas (cause_area_1, cause_area_2, cause_area_3, cause_area_4, cause_area_5, cause_area_6, cause_area_7, cause_area_8, cause_area_9, cause_area_10) VALUES ";
            $sql_insert_collective_cause_areas .= "('";
            $sql_insert_collective_cause_areas .= implode("', '", $cause_areas);
            $sql_insert_collective_cause_areas .= "')";
            
            if (mysqli_query($conn, $sql_insert_collective_cause_areas)) {
                // Get the collective cause areas ID
                $collective_cause_areas_id = mysqli_insert_id($conn);
                
                // Insert collective cause areas ID into opportunity_cause_areas table
                $sql_insert_opportunity_cause_area = "INSERT INTO opportunity_cause_areas (opportunity_id, collective_cause_areas_id) VALUES ('$opportunity_id', '$collective_cause_areas_id')";
                mysqli_query($conn, $sql_insert_opportunity_cause_area);

                // Opportunity posted successfully
                echo "Opportunity posted successfully!";
                // Redirect user to homepage or another appropriate page
                header("Location: ../view/homepage.php");
                exit();
            } else {
                // Error in SQL execution
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Error in SQL execution
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Required fields are empty
        echo "Title, description, requirements, and date are required.";
    }
}

// Close database connection
mysqli_close($conn);
?>
