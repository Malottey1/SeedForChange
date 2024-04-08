<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include the database connection file
include '../settings/connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was selected
    if ($_FILES["profile_photo"]["error"] == 0) {
        // Set the upload directory
        $uploadDir = "../uploads/";
        
        // Generate a unique filename
        $filename = uniqid() . '_' . basename($_FILES["profile_photo"]["name"]);
        
        // Set the file path
        $filePath = $uploadDir . $filename;
        
        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $filePath)) {
            // File uploaded successfully, now insert the file path into the database
            
            // Prepare SQL statement
            $sql = "UPDATE users SET profile_photo = ? WHERE user_id = ?";
            
            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $filePath, $_POST['user_id']);
            
            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../view/profile.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file selected.";
    }
}
?>
