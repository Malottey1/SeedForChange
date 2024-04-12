<!DOCTYPE html>
<html lang="en">
<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Opportunities Registered</title>
            <link rel="stylesheet" type="text/css" href="../css/reg-vol.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
            <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">
</head>
<header class="header">
            <div class="logo">
            <a href="../view/homepage-postlogin.php">
                <img src="../assests/images/3.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
            </a>
            </div>
            <div class="cta">
                <a href="../view/volunteer_listings.php" style="margin-right: 10px;">Volunteer</a>
                <a href="../view/post_opportunity.php" style="margin-right: 10px;">Post Opportunity</a>
                <a href="../view/manage-opportunities.php" style="margin-right: 10px;" class="registered-opportunities-profile-button">Manage Opportunities</a>
                <a href="../view/profile.php" style="margin-right: 10px;">
                <span><?php if (!empty($user_data['profile_photo'])): ?>
                <img src="<?php echo $user_data['profile_photo']; ?>" alt="Profile Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 20px;margin-top : 10px;">
            <?php endif; ?></span>
                </a>
            </div>
        </header>
<body>
    <h1 style="color:#32620e; margin-left: 150px; margin-top: 50px; margin-bottom: 0px;">Registered Volunteers</h1>
        <?php
        // Include your database connection file
        include "../settings/connection.php";

        // Get the opportunity ID from the URL
        if(isset($_GET['opportunity_id'])) {
            $opportunity_id = $_GET['opportunity_id'];

            // Query to fetch opportunity title
            $title_query = "SELECT title FROM opportunities WHERE id = $opportunity_id";
            $title_result = mysqli_query($conn, $title_query);
            $title_row = mysqli_fetch_assoc($title_result);
            $opportunity_title = $title_row['title'];

        // Display opportunity title
        echo "<h2 >Opportunity Title: $opportunity_title</h2>";

        echo '<br> <br>';

            // Query to fetch users registered for the specified opportunity
            $sql = "SELECT u.first_name, u.last_name, u.email, u.profile_photo FROM users u
                    INNER JOIN users_opportunities uo ON u.user_id = uo.user_id
                    WHERE uo.opportunity_id = $opportunity_id";
            $result = mysqli_query($conn, $sql);

            echo "<div class='user-container'>";
            // Check if there are any registered users
            if (mysqli_num_rows($result) > 0) {
                // Fetch and display user data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='user-card'>";
                    echo "<img src='" . $row['profile_photo'] . "' alt='Profile Picture'>";
                    echo "<p>" . $row['first_name'] . " " . $row['last_name'] . "</p>";
                    echo "<p>" . $row['email'] . "</p>";
                    echo "</div>";
                }
               
            } else {
                echo '<div style="text-align: center; margin: 50px auto; max-width: 600px; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); margin-bottom: 200px">
                <p style="font-size: 24px; font-weight: bold; ">No users registered for this opportunity.</p>
            </div>';
            }

            echo "</div>";

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "<p>Opportunity ID not provided.</p>";
        }
        ?>

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
