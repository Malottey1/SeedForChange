<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/volunteer_listings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Search Results</title>
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

<img src="../assests/images/hor-pic.jpeg" alt="Seed for Change logo" style="width: 100%; height: auto; margin-bottom: 0px;">

<div class="horizontal-strip" style="margin-top: -5px;">
    <h2 style="color: white;"> Discover an opportunity tailored to your skillset!</h2>
</div>

<center><a href="../view/volunteer_listings.php">
    <button type="submit" class="search-button">Back To Listings Page</button>
</a>
</center>

<main>
    <section id="opportunitiesList">
        <!-- Opportunities will be displayed here -->
        <?php
        // Include the file to connect to the database
        include '../settings/connection.php';

        // Check if the search keyword is provided
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            // Prepare the SQL statement to search for opportunities
            $sql = "SELECT * FROM opportunities WHERE title LIKE ? OR description LIKE ? OR requirements LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);
            
            // Bind parameters
            $searchParam = "%$search%";
            mysqli_stmt_bind_param($stmt, "sss", $searchParam, $searchParam, $searchParam);

            // Execute the query
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Display search results
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output opportunity details
                    echo "<div>";
                    echo "<h2>" . $row['title'] . "</h2>";
                    echo "<p>Description: " . $row['description'] . "</p>";
                    echo '<a href="../view/register_opportunity.php?id=' . $row['id'] . '">View Details</a>';
                    echo "</div>";
                }
            } else {
                echo "<p>No results found.</p>";
            }

            // Close statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            // No search keyword provided
            echo "<p>Please enter a search keyword.</p>";
        }
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
