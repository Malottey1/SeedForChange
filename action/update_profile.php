<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if not logged in
    header("Location: ../login/login.php");
    exit();
}

// Include database connection
require_once "../settings/connection.php";

// Get user ID from session
$user_id = $_SESSION["user_id"];

// Retrieve form data
$email = $_POST["email"];
$password = $_POST["password"]; // Note: Password should be hashed before storing in the database for security
$confirm_password = $_POST["confirm_password"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$biography = $_POST["biography"];
$country = $_POST["country"];
$phone_number = $_POST["phone_number"];
$languages_spoken = $_POST["languages_spoken"];
$position = $_POST["position"];
$organization = $_POST["organization"];
$from_date = $_POST["from_date"];
$to_date = $_POST["to_date"];
$description = $_POST["description"];
$skills = implode(", ", $_POST["skills[]"]); // Convert array to comma-separated string
$cause_areas = implode(", ", $_POST["cause_areas[]"]); // Convert array to comma-separated string

// Update user information in the database
$sql = "UPDATE users SET 
            email = '$email', 
            password = '$password', 
            first_name = '$first_name', 
            last_name = '$last_name', 
            biography = '$biography', 
            country = '$country', 
            phone_number = '$phone_number', 
            languages_spoken = '$languages_spoken', 
            position = '$position', 
            organization = '$organization', 
            from_date = '$from_date', 
            to_date = '$to_date', 
            description = '$description', 
            skills = '$skills', 
            cause_areas = '$cause_areas' 
        WHERE id = $user_id";

if (mysqli_query($conn, $sql)) {
    // Profile updated successfully
    $_SESSION["success_message"] = "Profile updated successfully.";
} else {
    // Error updating profile
    $_SESSION["error_message"] = "Error updating profile: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

// Redirect back to profile page
header("Location: ../view/profile.php");
exit();
?>
