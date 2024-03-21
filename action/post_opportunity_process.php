<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "db_connection.php";

    // Get the form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $requirements = $_POST["requirements"];
    $date = $_POST["date"];
    // Cause Areas
    $cause_areas = isset($_POST["cause_areas"]) ? $_POST["cause_areas"] : [];

    // Validate the form data (you may need more robust validation)
    if (!empty($title) && !empty($description) && !empty($requirements) && !empty($date)) {
        // Prepare and execute the SQL statement to insert opportunity data
        $sql = "INSERT INTO Opportunities (title, description, requirements, date)
                VALUES ('$title', '$description', '$requirements', '$date')";
        if (mysqli_query($conn, $sql)) {
            // Get the opportunity ID
            $opportunity_id = mysqli_insert_id($conn);

            // Insert cause areas for the opportunity into the Opportunity_Cause_Areas table
            foreach ($cause_areas as $cause_area_id) {
                $sql = "INSERT INTO Opportunity_Cause_Areas (opportunity_id, cause_area_id)
                        VALUES ('$opportunity_id', '$cause_area_id')";
                mysqli_query($conn, $sql);
            }

            // Opportunity posted successfully
            echo "Opportunity posted successfully!";
            // Redirect the user to the homepage or another appropriate page
            header("Location: homepage.php");
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
