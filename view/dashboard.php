<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
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
    <title>User Profile</title>
</head>
<body>
    <header>
        <h1>User Profile</h1>
        <nav>
            <ul>
                <li><a href="../view/homepage-postlogin.php">Homepage</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
                <a href="../view/manage-opportunities.php" class="registered-opportunities-profile-button">Manage Opportunities</a>
                <a href="../view/registered_opportunities.php" class="registered-opportunities-profile-button">Opportunities You Have Registered To</a>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>User Information</h2>
            <!-- Display user's profile photo, name, location, and biography -->
            <?php if (!empty($user_data['profile_photo'])): ?>
                <img src="<?php echo $user_data['profile_photo']; ?>" alt="Profile Photo">
            <?php endif; ?>
            <p>Name: <?php echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?></p>
            <p>Location: <?php echo $user_data['country']; ?></p>
            <p>Biography: <?php echo $user_data['biography']; ?></p>

            <a href="../view/edit-profile.php" class="edit-profile-button">Edit Profile</a>

            <h2>Skills</h2>
            <!-- Display user's skills -->
            <ul>
                <?php
                // Query to fetch user's skills
                $sql_skills = "SELECT skills.name FROM user_skills 
                            INNER JOIN skills ON user_skills.skill_id = skills.skill_id 
                            WHERE user_skills.user_id = $user_id";
                $result_skills = mysqli_query($conn, $sql_skills);

                if (mysqli_num_rows($result_skills) > 0) {
                    while ($row_skills = mysqli_fetch_assoc($result_skills)) {
                        echo '<li>' . $row_skills['name'] . '</li>';
                    }
                } else {
                    echo '<li>No skills available</li>';
                }
                ?>
            </ul>

            <h2>Cause Areas</h2>
            <!-- Display user's cause areas -->
            <ul>
                <?php
                // Query to fetch user's cause areas
                $sql_cause_areas = "SELECT cause_areas.name FROM user_cause_areas 
                                    INNER JOIN cause_areas ON user_cause_areas.cause_area_id = cause_areas.id 
                                    WHERE user_cause_areas.user_id = $user_id";
                $result_cause_areas = mysqli_query($conn, $sql_cause_areas);

                if (mysqli_num_rows($result_cause_areas) > 0) {
                    while ($row_cause_areas = mysqli_fetch_assoc($result_cause_areas)) {
                        echo '<li>' . $row_cause_areas['name'] . '</li>';
                    }
                } else {
                    echo '<li>No cause areas available</li>';
                }
                ?>
            </ul>


            <h2>Professional Experiences</h2>
            <!-- Fetch and display user's professional experiences -->
            <?php
            $sql = "SELECT * FROM professional_experiences WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<p><strong>Position:</strong> ' . $row['position'] . '</p>';
                    echo '<p><strong>Organization/Company:</strong> ' . $row['organization'] . '</p>';
                    echo '<p><strong>From:</strong> ' . date('M Y', strtotime($row['from_date'])) . '</p>';
                    echo '<p><strong>To:</strong> ' . date('M Y', strtotime($row['to_date'])) . '</p>';
                    echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                }
            } else {
                echo "<p>No professional experiences found.</p>";
            }
            ?>
        </section>
    </main>



    
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

// Close the database connection
mysqli_close($conn);
?>
