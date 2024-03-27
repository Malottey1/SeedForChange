<?php

session_start();
// Include database connection
include "../settings/connection.php";
include "../settings/core.php";

// Check if the form is submitted
if (isset($_POST['post'])) {
    // Get the form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $requirements = $_POST["requirements"];
    $date = $_POST["date"];
    // Replace the hardcoded user ID with dynamic value
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Validate the form data (you may need more robust validation)
    if (!empty($title) && !empty($description) && !empty($requirements) && !empty($date)) {
        // Prepare and execute the SQL statement to insert opportunity data
        $sql = "INSERT INTO opportunities (title, description, requirements, date, user_id)
                VALUES ('$title', '$description', '$requirements', '$date', '$user_id')";
        if (mysqli_query($conn, $sql)) {
            // Get the opportunity ID
            $opportunity_id = mysqli_insert_id($conn);

            // Insert cause areas for the opportunity into the opportunity_cause_areas table
            if(isset($_POST['cause_area'])) {
                foreach($_POST['cause_area'] as $cause_area_id) {
                    $sql = "INSERT INTO opportunity_cause_areas (opportunity_id, cause_area_id)
                            VALUES ('$opportunity_id', '$cause_area_id')";
                    mysqli_query($conn, $sql);
                }
            }

            // Opportunity posted successfully
            echo "Opportunity posted successfully!";
            // Redirect the user to the homepage or another appropriate page
            header("Location: ../view/homepage.php");
            exit();
        } else {
            // Error in SQL execution
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Required fields are empty
        echo "Title, description, requirements, and date are required.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
