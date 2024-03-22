<?php
 // Include your database connection file
 include '../settings/connection.php';

// Check if the form is submitted
if (isset($_POST['register'])) {

    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $biography = $_POST["biography"];
    $country = $_POST["country"];
    $phone_number = $_POST["phone_number"];
    $languages_spoken = $_POST["languages_spoken"];

    // Validate the form data (you may need more robust validation)
    if (!empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            // Hash the password for security
            $hashed_password = md5($password); // You should use a more secure hashing algorithm like bcrypt

            // Prepare and execute the SQL statement to insert user data
            $sql = "INSERT INTO Users (email, password, first_name, last_name, biography, country, phone_number, languages_spoken)
                    VALUES ('$email', '$hashed_password', '$first_name', '$last_name', '$biography', '$country', '$phone_number', '$languages_spoken')";
            if (mysqli_query($conn, $sql)) {
                // Registration successful
                echo "Registration successful!";
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
