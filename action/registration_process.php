<?php
// Include your database connection file
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if (isset($_POST['register'])) {

    // Get the form data
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $biography = mysqli_real_escape_string($conn, $_POST["biography"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $phone_number = mysqli_real_escape_string($conn, $_POST["phone_number"]);
    $languages_spoken = mysqli_real_escape_string($conn, $_POST["languages_spoken"]);

    // Validate the form data (you may need more robust validation)
    if (!empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            // Hash the password for security
            $hashed_password = md5($password); // You should use a more secure hashing algorithm like bcrypt

            // Prepare and execute the SQL statement to insert user data
            $sql = "INSERT INTO users (email, password, first_name, last_name, biography, country, phone_number, languages_spoken)
                    VALUES ('$email', '$hashed_password', '$first_name', '$last_name', '$biography', '$country', '$phone_number', '$languages_spoken')";
            if (mysqli_query($conn, $sql)) {
                // Registration successful
                // Get the ID of the inserted user
                $user_id = mysqli_insert_id($conn);

                // Insert professional experiences
                $positions = $_POST['position'];
                $organizations = $_POST['organization'];
                $from_dates = $_POST['from_date'];
                $to_dates = $_POST['to_date'];
                $descriptions = $_POST['description'];

                // Loop through each professional experience and insert into the database
                for ($i = 0; $i < count($positions); $i++) {
                    $position = mysqli_real_escape_string($conn, $positions[$i]);
                    $organization = mysqli_real_escape_string($conn, $organizations[$i]);
                    $from_date = mysqli_real_escape_string($conn, $from_dates[$i]);
                    $to_date = mysqli_real_escape_string($conn, $to_dates[$i]);
                    $description = mysqli_real_escape_string($conn, $descriptions[$i]);

                    // Insert professional experience into the database
                    $sql = "INSERT INTO professional_experiences (user_id, position, organization, from_date, to_date, description)
                            VALUES ('$user_id', '$position', '$organization', '$from_date', '$to_date', '$description')";
                    mysqli_query($conn, $sql);

                }

                // Get selected cause areas
                $selected_cause_areas = isset($_POST['cause_area']) ? $_POST['cause_area'] : [];

                $selected_skills = isset($_POST['skills']) ? $_POST['skills'] : [];

                // Insert selected cause areas for the user into the user_cause_areas table
                foreach ($selected_cause_areas as $cause_area_id) {
                    $cause_area_id = mysqli_real_escape_string($conn, $cause_area_id);
                    $sql = "INSERT INTO user_cause_areas (user_id, cause_area_id) VALUES ('$user_id', '$cause_area_id')";
                    mysqli_query($conn, $sql);
                }

                // Insert selected skills for the user into the user_skills table
                foreach ($selected_skills as $skill_id) {
                    $skill_id = mysqli_real_escape_string($conn, $skill_id);
                    $sql = "INSERT INTO user_skills (user_id, skill_id) VALUES ('$user_id', '$skill_id')";
                    mysqli_query($conn, $sql);
                }
                // Redirect the user to the login page
                header("Location: ../login/login.php");
                exit();
            } else {
                // Error in SQL execution
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Passwords do not match
            echo "Passwords do not match. Please try again.";
        }
    } else {
        // Required fields are empty
        echo "Email, password, and confirm password are required.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
