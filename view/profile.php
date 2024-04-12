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
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>User Profile</title>
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
        <a href="../action/logout.php" style="margin-right: 20px;">Logout</a>
    </div>
</header>

<div style="margin-bottom: 150px";>
<div class="horizontal-strip">
  <div class="profile-photo">
    <?php if (!empty($user_data['profile_photo'])): ?>
                <img src="<?php echo $user_data['profile_photo']; ?>" alt="Profile Photo">
            <?php endif; ?>
  </div>
  <div class="profile-details" style="color: white;">
  <strong>
        <p><?php echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?></p>
        <p><?php echo $user_data['country']; ?></p>
    </strong>
  <a href="../view/edit-profile.php" class="edit-profile-button">
  <img src="../assests/images/pen-2.svg" style="width: 20px;">
</a>
  </div>
</div>


<div class="bio-strip">
  <div class="bio-details" style="color: black;">
        <h2 style="font-style:normal; font-weight:40;">Profile</h2>
        <p style="font-style:normal; font-weight:40;"><?php echo $user_data['biography']; ?></p>
  </div>


</div>

<div class="tabs">
        <div class="tab active" onclick="openTab(event, 'skills')">Skills</div>
        <div class="tab" onclick="openTab(event, 'cause_areas')">Cause Areas</div>
        <div class="tab" onclick="openTab(event, 'personal_experience')">Personal Experience</div>
    </div>
    <div id="skills" class="tab-content active">
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
    </div>
    <div id="cause_areas" class="tab-content">
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
    </div>
    <div id="personal_experience" class="tab-content">
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
    </div>

        </div>

            
        </section>
    </main>
    <div class="space">



    <div class="welcome">
        <img class="image" src="../assests/images/iu.svg" alt="Image Description" style="width:150px;">
        <div class="text">
            <h2>Hi <?php echo $user_data['first_name'] ?>, welcome to your Seed For Change profile.</h2><br>
            <p>Explore opportunities and sign up today!</p>
        </div>
    </div>


    <footer>


  <div> 
  <div>
    <a href="#">Privacy</a>
    <a href="#">Contact Us</a>
    <a href="../view/homepage.php">About Us</a>
  </div>

  <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
</footer>







    <script>
        function openTab(evt, tabName) {
        var tabContent = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
        }
        
        var tabs = document.getElementsByClassName("tab");
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }
        
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");
        }
</script>
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
    header("Location: ../login/login.php");
}

// Close the database connection
mysqli_close($conn);
?>
