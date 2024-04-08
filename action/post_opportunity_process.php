<?php
// Start the session
session_start();



// Include database connection
include "../settings/connection.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Check if the form is submitted
    if (isset($_POST['post'])) {
        // Get the form data
        $title = $_POST["title"];
        $description = $_POST["description"];
        $requirements = $_POST["requirements"];
        $date = $_POST["date"];
        
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
                    foreach($_POST['cause_area'] as $cause_area_name) {
                        // Retrieve the cause area ID based on its name
                        $sql = "SELECT id FROM cause_areas WHERE name = '$cause_area_name'";
                        $result = mysqli_query($conn, $sql);
                        
                        if($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $cause_area_id = $row['id'];
                            
                            // Insert into the opportunity_cause_areas table
                            $sql = "INSERT INTO opportunity_cause_areas (opportunity_id, cause_area_id)
                                    VALUES ('$opportunity_id', '$cause_area_id')";
                            mysqli_query($conn, $sql);
                        } else {
                            echo "Error retrieving cause area ID for: $cause_area_name";
                        }
                    }
                }


                // Opportunity posted successfully
                echo "Opportunity posted successfully!";
                // Redirect the user to the homepage or another appropriate page
                header("Location: ../view/homepage-postlogin.php");
                exit();
            } else {
                // Error in SQL execution
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Required fields are empty
            echo "Title, description, requirements, and date are required.";
        }
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Close the database connection
mysqli_close($conn);
?>
