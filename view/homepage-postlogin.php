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
    <link rel="stylesheet" type="text/css" href="../css/homepage-postlogin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Seed for Change</title>
</head>
<body>
    <div class="hero"></div>
    
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

    <div class="text-container">
        <h1>Welcome to Seed for Change</h1>
        <p>Empowering Volunteers and Organizations for Positive Impact</p>
    </div>

    <div class="header-image"></div>
    
    <main>
    <div class="two-column-section">
        <div class="left-column">
            <h2 style="font-size: 60px; color: white; margin: 20px; margin-top: 35px; text-align:center;";>About Seed for Change</h2>
            
        </div>
        <div class="right-column">
            <p style="font-size: 30px; margin: 20px; text-align: left;";>Seed for Change is a platform dedicated to connecting passionate volunteers with organizations working towards positive change in their communities. Whether you're an individual looking to make a difference or an organization seeking dedicated volunteers, Seed for Change is here to help.</p>
        </div>
</div>
    
    <section class= "featured-project">
        <div class="horizontal-strip">
        <div class="strip-content">
            <h2 style="color: #32620e; font-size: 60px; margin-top: 20px;">What We Offer</h2>
        </div>
        </div>
        <div class="features">
            <div class="feature-column">
            <img src="../assests/images/5.svg" alt="Seed for Change logo" style="width:150px; height: auto;">
                <p style="color: #32620e;">Search and apply for volunteer opportunities</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/8.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p>Create and manage volunteer listings</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/6.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p style="color: #32620e;">Track volunteer registrations</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/7.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p>Update and manage volunteer activity</p>
            </div>
</div>

        
    </section>
    
    

    <div class="custom-two-column-section" id="get-started-section">
    <div class="custom-text-column custom-horizontal-strip">
        <h2>Review Your Progress</h2>
        <p>View your dashboard for registered volunteer opportunities.</p>
        <a href="../view/registered_opportunities.php" class="rounded-button">Visit Your Dashboard</a>
    </div>
    <div class="custom-image-column"></div>
</div>
    


</main>


    
    <footer>
        <p style="text-align: right">&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('.header');
            const scrollPosition = () => window.pageYOffset || document.documentElement.scrollTop;

            const handleScroll = () => {
                if (scrollPosition() > 0) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            };

            window.addEventListener('scroll', handleScroll);
            handleScroll();
        });

        function scrollToGetStarted() {
        var getStartedSection = document.getElementById("get-started-section");
        getStartedSection.scrollIntoView({ behavior: 'smooth' });
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
}

// Close the database connection
mysqli_close($conn);
?>



