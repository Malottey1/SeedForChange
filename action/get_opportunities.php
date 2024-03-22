<?php
include "../settings/connection.php";

// Retrieve opportunity ID from the URL or any other source
$opportunity_id = isset($_GET['opportunity_id']) ? $_GET['opportunity_id'] : null;

// Example of how to sanitize the input (optional, but recommended)
$opportunity_id = filter_var($opportunity_id, FILTER_VALIDATE_INT);

if ($opportunity_id === false || $opportunity_id === null) {
    header("Location: ../view/homepage.php");
    exit();
}

// Fetch opportunity details
$sql = "SELECT title, description, requirements, date FROM opportunities WHERE opportunity_id = $opportunity_id";
$result = mysqli_query($conn, $sql);
$opportunity = mysqli_fetch_assoc($result);

// Fetch cause areas associated with the opportunity
$sql = "SELECT ca.name FROM cause_areas ca
        INNER JOIN opportunity_cause_areas oca ON ca.cause_area_id = oca.cause_area_id
        WHERE oca.opportunity_id = $opportunity_id";
$result = mysqli_query($conn, $sql);
$cause_areas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cause_areas[] = $row['name'];
}

// Close the database connection
mysqli_close($conn);
?>
