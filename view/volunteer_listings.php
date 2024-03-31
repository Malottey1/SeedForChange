<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Listings</title>
</head>
<body>
    <header>
        <h1>Volunteer Listings</h1>
        <nav>
            <ul>
                <li><a href="../view/homepage.php">Homepage</a></li>
                <li><a href="../view/profile.php">Profile</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Available Volunteer Opportunities</h2>
            <ul>
                <?php
                // Include the file to connect to the database
                include '../settings/connection.php';

                // Query to fetch opportunities with status 1
                $sql = "SELECT * FROM opportunities WHERE status = 1";
                $result = mysqli_query($conn, $sql);

                // Check if there are any opportunities
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row and fetch opportunity details
                    while ($row = mysqli_fetch_assoc($result)) {
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

                        // Display opportunity details
                        echo '<li>' .
                                '<h3>' . $row['title'] . '</h3>' .
                                '<p>Date: ' . $row['date'] . '</p>' .
                                '<p>Cause Area: ' . implode(", ", $cause_areas) . '</p>' .
                                '<a href="../view/register_opportunity.php?id=' . $opportunity_id . '">View Details</a>' .
                             '</li>';
                    }
                } else {
                    // Display message if no opportunities available
                    echo '<li>No opportunities available</li>';
                }

                // Close database connection
                mysqli_close($conn);
                ?>
            </ul>
        </section>
        
        <!-- Search or Filter Options -->
        <section>
            <h2>Search or Filter Options</h2>
            <!-- Add search or filter options here -->
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>
