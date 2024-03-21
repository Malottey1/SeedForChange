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
                <li><a href="homepage.php">Homepage</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <?php
            // Include your database connection file
            require_once "db_connection.php";

            // Check if the 'id' parameter is set in the URL
            if (isset($_GET['id'])) {
                // Get the opportunity ID from the URL
                $opportunity_id = $_GET['id'];

                // Query to fetch opportunity details from the database based on the ID
                $sql = "SELECT * FROM Opportunities WHERE opportunity_id = $opportunity_id";
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful and if a row was returned
                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the opportunity details
                    $opportunity = mysqli_fetch_assoc($result);
            ?>
                    <h2><?php echo $opportunity['title']; ?></h2>
                    <p>Description: <?php echo $opportunity['description']; ?></p>
                    <p>Date: <?php echo $opportunity['date']; ?></p>
                    <p>Cause Area: <?php echo $opportunity['cause_area']; ?></p>
                    <!-- Add more opportunity details here as needed -->
            <?php
                } else {
                    // No opportunity found with the provided ID
                    echo "<p>No opportunity found with the provided ID.</p>";
                }
            } else {
                // 'id' parameter is not set in the URL
                echo "<p>Invalid request. Please provide an opportunity ID.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>
