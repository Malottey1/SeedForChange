<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/register-opp.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Opportunity Details</title>
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
    </div>
    <div class="cta">
        <a href="../view/volunteer_listings.php" style="margin-right: 10px;">Volunteer</a>
        <a href="../view/post_opportunity.php" style="margin-right: 10px;">Post Opportunity</a>
        <a href="../view/manage-opportunities.php" class="registered-opportunities-profile-button">Manage Opportunities</a>
        <a href="../view/registered_opportunities.php" class="registered-opportunities-profile-button">Track Your Progress</a>
        <a href="../view/profile.php" style="margin-right: 10px;">
        <span><?php if (!empty($user_data['profile_photo'])): ?>
                <img src="<?php echo $user_data['profile_photo']; ?>" alt="Profile Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 20px;margin-top : 10px;">
            <?php endif; ?></span>
        </a>
    </div>
</header>

<div class="header-strip">
            <h2>Register To Volunteer</h2>
</div>
    
<div class="container">
    <section>
        <?php
        // Include the file to connect to the database
        include '../settings/connection.php';

        // Check if opportunity ID is set and valid
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $opportunity_id = $_GET['id'];

            // Query to fetch opportunity details
            $opportunity_query = "SELECT * FROM opportunities WHERE id = $opportunity_id";
            $opportunity_result = mysqli_query($conn, $opportunity_query);

            if (mysqli_num_rows($opportunity_result) > 0) {
                $opportunity_row = mysqli_fetch_assoc($opportunity_result);
                echo '<h2>' . $opportunity_row['title'] . '</h2>';
                echo '<p>Description:</p>';
                echo '<p>' . $opportunity_row['description'] . '</p>';
                echo '<p>Requirements:</p>';
                echo '<p>' . $opportunity_row['requirements'] . '</p>';
                echo '<p>Date: ' . $opportunity_row['date'] . '</p>';

                // Fetch cause areas associated with the opportunity
                $cause_areas_query = "SELECT cause_areas.name FROM cause_areas
                                    INNER JOIN opportunity_cause_areas ON cause_areas.id = opportunity_cause_areas.cause_area_id
                                    WHERE opportunity_cause_areas.opportunity_id = $opportunity_id";
                $cause_areas_result = mysqli_query($conn, $cause_areas_query);

                $cause_areas = [];
                while ($cause_area_row = mysqli_fetch_assoc($cause_areas_result)) {
                    $cause_areas[] = $cause_area_row['name'];
                }

                echo '<p>Cause Area(s): ' . implode(", ", $cause_areas) . '</p>';

                // Registration form
                echo '<h3 style="margin-bottom: 5px";>Registration Options</h3>';
                echo '<p>If you\'re interested in participating in this opportunity, please register below:</p>';
                echo '<form id="registrationForm" action="../action/register_opportunity_process.php" method="POST">';
                echo '<input type="hidden" name="opportunity_id" value="' . $opportunity_id . '">';
                echo '<button name="register-opp" type="submit">Register</button>';
                echo '</form>';
            } else {
                echo '<p>Opportunity not found.</p>';
            }
        } else {
            echo '<p>Invalid opportunity ID.</p>';
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </section>
</div>
    
    <footer>
   
  <div>
    <a href="#">Privacy</a>
    <a href="#">Contact Us</a>
    <a href="../view/homepage.php">About Us</a>
  </div>

  <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
</footer>
</body>
</html>
