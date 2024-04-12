<?php
// Include your database connection file
include "../settings/connection.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get the user ID from the URL
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare the SQL statement
    $user_query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $user_query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        // Display user profile data
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' type='text/css' href='../css/profile.css'>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap'>
            <script src='sweetalert2.min.js'></script>
            <link rel='stylesheet' href='sweetalert2.min.css'>
            <title>User Profile</title>
        </head>
        <body>
        <header class='header'>
            <div class='logo'>
            <a href='../view/homepage-postlogin.php'>
                <img src='../assests/images/4.svg' alt='Seed for Change logo' style='width: 50px; height: auto; margin-left: 20px; margin-top: 10px;'>
            </a>
            </div>
            <div class='cta'>
                <a href='../view/volunteer_listings.php' style='margin-right: 10px;'>Volunteer</a>
                <a href='../view/post_opportunity.php' style='margin-right: 10px;'>Post Opportunity</a>
                <a href='../action/logout.php' style='margin-right: 20px;'>Logout</a>
            </div>
        </header>
        
        <div style='margin-bottom: 150px';>
        <div class='horizontal-strip'>
          <div class='profile-photo'>
            " . (!empty($user_data['profile_photo']) ? "<img src='" . $user_data['profile_photo'] . "' alt='Profile Photo'>" : "") . "
          </div>
          <div class='profile-details' style='color: white;'>
          <strong>
                <p>" . $user_data['first_name'] . ' ' . $user_data['last_name'] . "</p>
                <p>" . $user_data['country'] . "</p>
            </strong>
          </div>
        </div>
        
        
        <div class='bio-strip'>
          <div class='bio-details' style='color: black;'>
                <h2 style='font-style:normal; font-weight:40;'>Profile</h2>
                <p style='font-style:normal; font-weight:40;'>" . $user_data['biography'] . "</p>
          </div>
        
        
        </div>
        
        <div class='tabs'>
            <div class='tab active' onclick='openTab(event, \"skills\")'>Skills</div>
            <div class='tab' onclick='openTab(event, \"cause_areas\")'>Cause Areas</div>
            <div class='tab' onclick='openTab(event, \"personal_experience\")'>Personal Experience</div>
        </div>
        <div id='skills' class='tab-content active'>
            <ul>" . fetchUserSkills($conn, $user_id) . "</ul>
        </div>
        <div id='cause_areas' class='tab-content'>
            <ul>" . fetchUserCauseAreas($conn, $user_id) . "</ul>
        </div>
        <div id='personal_experience' class='tab-content'>" . fetchUserPersonalExperience($conn, $user_id) . "</div>
        </div>
        
        <footer>
          <div> 
            <div>
              <a href='#'>Privacy</a>
              <a href='#'>Contact Us</a>
              <a href='../view/homepage.php'>About Us</a>
            </div>
            <img src='../assests/images/2.svg' alt='Profile Picture' style='width: 200px; text-align:center; margin-right: 1200px;'>
          </div>
        </footer>
        
        <script>
        function openTab(evt, tabName) {
            var tabContent = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = 'none';
            }
        
            var tabs = document.getElementsByClassName('tab');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }
        
            document.getElementById(tabName).style.display = 'block';
            evt.currentTarget.classList.add('active');
        }
        </script>
        
        </body>
        </html>";
        

    } else {
        echo "<p>User not found.</p>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "<p>User ID not provided.</p>";
}

// Function to fetch user skills
function fetchUserSkills($conn, $user_id) {
    $output = "";
    $sql_skills = "SELECT skills.name FROM user_skills 
                    INNER JOIN skills ON user_skills.skill_id = skills.skill_id 
                    WHERE user_skills.user_id = $user_id";
    $result_skills = mysqli_query($conn, $sql_skills);
    if (mysqli_num_rows($result_skills) > 0) {
        while ($row_skills = mysqli_fetch_assoc($result_skills)) {
            $output .= "<li>" . $row_skills['name'] . "</li>";
        }
    } else {
        $output .= "<li>No skills available</li>";
    }
    return $output;
}

// Function to fetch user cause areas
function fetchUserCauseAreas($conn, $user_id) {
    $output = "";
    $sql_cause_areas = "SELECT cause_areas.name FROM user_cause_areas 
                            INNER JOIN cause_areas ON user_cause_areas.cause_area_id = cause_areas.id 
                            WHERE user_cause_areas.user_id = $user_id";
    $result_cause_areas = mysqli_query($conn, $sql_cause_areas);
    if (mysqli_num_rows($result_cause_areas) > 0) {
        while ($row_cause_areas = mysqli_fetch_assoc($result_cause_areas)) {
            $output .= "<li>" . $row_cause_areas['name'] . "</li>";
        }
    } else {
        $output .= "<li>No cause areas available</li>";
    }
    return $output;
}

// Function to fetch user personal experience
function fetchUserPersonalExperience($conn, $user_id) {
    $output = "";
    $sql = "SELECT * FROM professional_experiences WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<p><strong>Position:</strong> " . $row['position'] . "</p>";
            $output .= "<p><strong>Organization/Company:</strong> " . $row['organization'] . "</p>";
            $output .= "<p><strong>From:</strong> " . date('M Y', strtotime($row['from_date'])) . "</p>";
            $output .= "<p><strong>To:</strong> " . date('M Y', strtotime($row['to_date'])) . "</p>";
            $output .= "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        }
    } else {
        $output .= "<p>No professional experiences found.</p>";
    }
    return $output;
}

?>
