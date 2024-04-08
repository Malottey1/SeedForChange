<?php 
  include "../settings/connection.php";
  //check_login();

  ini_set('display_errors', 1);
error_reporting(E_ALL);

  session_start();

  if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session

    
    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, retrieve user data
        $user_data = mysqli_fetch_assoc($result);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/volunteer_listings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Volunteer Listings</title>
</head>
<body>
<header class="header">
    <div class="logo">
    <a href="../view/homepage-postlogin.php">
        <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
    </a>
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

<img src="../assests/images/hor-pic.jpeg" alt="Seed for Change logo" style="width: 100%; height: auto; margin-bottom: 0px;">

<div class="horizontal-strip" style="margin-top: -5px;">
    <h2 style="color: white;"> Discover an opportunity tailored to your skillset!</h2>
</div>

<form action="../action/search_opportunities.php" method="GET" class="search-form">
    <input type="text" id="search" name="search" class="search-input" placeholder="Enter search keyword">
    <button type="submit" class="search-button">Search</button>
</form>

<main>
    <section id="opportunitiesList">
        <!-- Opportunities will be displayed here -->
        <?php
        // Include the file to connect to the database
        include '../settings/connection.php';

        // Query to fetch opportunities with status 1
        $sql = "SELECT * FROM opportunities WHERE status = 1";
        $result = mysqli_query($conn, $sql);

        // Check if there are any opportunities
        if (mysqli_num_rows($result) > 0) {
            // Initialize counter for distributing opportunities among columns
            $counter = 0;

            // Loop through each row and fetch opportunity details
            while ($row = mysqli_fetch_assoc($result)) {
                // Increment the counter
                $counter++;

                // If the counter is divisible by 3, start a new container
                if ($counter % 3 === 1) {
                    echo '<div class="container">';
                }

                // Fetch cause areas associated with the opportunity
                $opportunity_id = $row['id'];
                $cause_areas_sql = "SELECT cause_areas.name FROM cause_areas
                                        INNER JOIN opportunity_cause_areas ON cause_areas.id = opportunity_cause_areas.cause_area_id
                                        WHERE opportunity_cause_areas.opportunity_id = $opportunity_id";
                $cause_areas_result = mysqli_query($conn, $cause_areas_sql);

                // Initialize an array to store cause areas
                $cause_areas = array();
                while ($cause_area_row = mysqli_fetch_assoc($cause_areas_result)) {
                    $cause_areas[] = $cause_area_row['name'];
                }

                // Output the opportunity box
                echo '<div class="column">';
                echo '<div class="box">';
                echo '<h2>' . $row['title'] . '</h2>';
                echo '<p>Date: ' . $row['date'] . '</p>';
                echo '<p>Cause Area: ' . implode(", ", $cause_areas) . '</p>';
                echo '<a href="../view/register_opportunity.php?id=' . $opportunity_id . '">View Details</a>';
                echo '</div>';
                echo '</div>';

                // If the counter is divisible by 3, close the container
                if ($counter % 3 === 0) {
                    echo '</div>'; // Close the container after every three opportunities
                }
            }

            // If the counter is not divisible by 3 (i.e., there are remaining opportunities), close the last container
            if ($counter % 3 !== 0) {
                echo '</div>';
            }
        } else {
            // Display message if no opportunities available
            echo '<p>No opportunities available</p>';
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </section>

  
</main>

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

<?php
    } else {
        // User not found in the database
        echo "User not found.";
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

?>
