<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opportunity Details</title>
</head>
<body>
    <header>
        <h1>Opportunity Details</h1>
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
                    echo '<h3>Registration Options</h3>';
                    echo '<p>If you\'re interested in participating in this opportunity, please register below:</p>';
                    echo '<form action="../action/register_opportunity_process.php" method="POST">';
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
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>
