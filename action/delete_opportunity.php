<?php
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['opportunity_id'])) {
            $opportunity_id = $_POST['opportunity_id'];

            // Delete related records in the opportunity_cause_areas table first
            $delete_cause_areas_sql = "DELETE FROM opportunity_cause_areas WHERE opportunity_id = ?";
            $stmt_cause_areas = mysqli_prepare($conn, $delete_cause_areas_sql);
            mysqli_stmt_bind_param($stmt_cause_areas, "i", $opportunity_id);
            mysqli_stmt_execute($stmt_cause_areas);
            mysqli_stmt_close($stmt_cause_areas);

            // Now delete the opportunity
            $delete_opportunity_sql = "DELETE FROM opportunities WHERE id = ? AND user_id = ?";
            $stmt_opportunity = mysqli_prepare($conn, $delete_opportunity_sql);
            mysqli_stmt_bind_param($stmt_opportunity, "ii", $opportunity_id, $user_id);
            mysqli_stmt_execute($stmt_opportunity);
            mysqli_stmt_close($stmt_opportunity);

            header("Location: ../view/manage-opportunities.php");
            exit();
        } else {
            echo "Opportunity ID not set.";
        }
    } else {
        echo "Form not submitted.";
    }
} else {
    echo "User is not logged in or session variable is not set.";
}


?>
