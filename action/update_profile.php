<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update personal information
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $biography = $_POST['biography'];
        $country = $_POST['country'];
        $phone_number = $_POST['phone_number'];
        $languages_spoken = $_POST['languages_spoken'];
        $hashed_password = md5($password);
        
        // Update professional experiences
        $positions = $_POST['position'];
        $organizations = $_POST['organization'];
        $from_dates = $_POST['from_date'];
        $to_dates = $_POST['to_date'];
        $descriptions = $_POST['description'];
        
        // Update cause areas
        $cause_areas = isset($_POST['cause_area']) ? implode(',', $_POST['cause_area']) : '';

        // Update skills
        $skills = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';
        
        // Update user information in the database
        $update_user_sql = "UPDATE users SET email=?, password=?, first_name=?, last_name=?, biography=?, country=?, phone_number=?, languages_spoken=? WHERE user_id=?";
        $stmt = mysqli_prepare($conn, $update_user_sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $email, $hashed_password, $first_name, $last_name, $biography, $country, $phone_number, $languages_spoken, $user_id);
        mysqli_stmt_execute($stmt);
        
        // Update professional experiences
        $delete_professional_experiences_sql = "DELETE FROM professional_experiences WHERE user_id=?";
        $stmt_delete = mysqli_prepare($conn, $delete_professional_experiences_sql);
        mysqli_stmt_bind_param($stmt_delete, "i", $user_id);
        mysqli_stmt_execute($stmt_delete);
        
        foreach ($positions as $key => $position) {
            $insert_professional_experience_sql = "INSERT INTO professional_experiences (user_id, position, organization, from_date, to_date, description) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $insert_professional_experience_sql);
            mysqli_stmt_bind_param($stmt_insert, "isssss", $user_id, $position, $organizations[$key], $from_dates[$key], $to_dates[$key], $descriptions[$key]);
            mysqli_stmt_execute($stmt_insert);
        }
        
        // Update user cause areas
        if (!empty($cause_areas)) {
            // Remove existing user cause areas
            $delete_user_cause_areas_sql = "DELETE FROM user_cause_areas WHERE user_id=?";
            $stmt_delete_cause_areas = mysqli_prepare($conn, $delete_user_cause_areas_sql);
            mysqli_stmt_bind_param($stmt_delete_cause_areas, "i", $user_id);
            mysqli_stmt_execute($stmt_delete_cause_areas);
            
            // Insert new user cause areas
            $insert_user_cause_areas_sql = "INSERT INTO user_cause_areas (user_id, cause_area_id) VALUES (?, ?)";
            $stmt_insert_cause_areas = mysqli_prepare($conn, $insert_user_cause_areas_sql);
            $cause_areas_array = explode(',', $cause_areas);
            foreach ($cause_areas_array as $cause_area_id) {
                mysqli_stmt_bind_param($stmt_insert_cause_areas, "ii", $user_id, $cause_area_id);
                mysqli_stmt_execute($stmt_insert_cause_areas);
            }
        }

        if (!empty($skills)) {
            // Remove existing user skills
            $delete_user_skills_sql = "DELETE FROM user_skills WHERE user_id=?";
            $stmt_delete_skills = mysqli_prepare($conn, $delete_user_skills_sql);
            mysqli_stmt_bind_param($stmt_delete_skills, "i", $user_id);
            mysqli_stmt_execute($stmt_delete_skills);
            
            // Insert new user skills
            $insert_user_skills_sql = "INSERT INTO user_skills (user_id, skill_id) VALUES (?, ?)";
            $stmt_insert_skills = mysqli_prepare($conn, $insert_user_skills_sql);
            $skills_array = explode(',', $skills);
            foreach ($skills_array as $skill_id) {
                mysqli_stmt_bind_param($stmt_insert_skills, "ii", $user_id, $skill_id);
                mysqli_stmt_execute($stmt_insert_skills);
            }
        }
        
        
        // Redirect to profile page
        header("Location: ../view/profile.php");
        exit();
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Close the database connection
mysqli_close($conn);
?>
