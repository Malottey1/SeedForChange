<?php
// Include the file to connect to the database
include '../settings/connection.php';
include '../actions/get_progress.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session

    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session

    // Fetch user data including profile photo path
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    
    // Fetch opportunities registered by the user
    $sql = "SELECT * FROM users_opportunities 
            JOIN opportunities ON users_opportunities.opportunity_id = opportunities.id 
            WHERE users_opportunities.user_id = ? AND opportunities.status = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Count the number of opportunities
    $num_opportunities = mysqli_num_rows($result);


    // Fetch opportunities registered by the user
    $sql = "SELECT COUNT(*) AS num_opportunities FROM users_opportunities 
            JOIN opportunities ON users_opportunities.opportunity_id = opportunities.id 
            WHERE users_opportunities.user_id = ? AND opportunities.status = 0";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $num_registered_opportunities = $row['num_opportunities'];

    // Fetch total number of opportunities registered by the user
    $sql_total = "SELECT COUNT(*) AS total_opportunities FROM users_opportunities 
                  WHERE user_id = ?";
    $stmt_total = mysqli_prepare($conn, $sql_total);
    mysqli_stmt_bind_param($stmt_total, "i", $user_id);
    mysqli_stmt_execute($stmt_total);
    $result_total = mysqli_stmt_get_result($stmt_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_opportunities = $row_total['total_opportunities'];

    // Close the prepared statements
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt_total);

    
    // Calculate progress percentage
    if ($num_registered_opportunities == 0 || $total_opportunities == 0) {
        $progress_percentage = 1;
    } else {
        $progress_percentage = ceil(($num_registered_opportunities / $total_opportunities) * 100);
    }


    $sql = "SELECT * FROM users_opportunities 
    JOIN opportunities ON users_opportunities.opportunity_id = opportunities.id 
    WHERE users_opportunities.user_id = ? AND opportunities.status = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    

    // Check if opportunities are found
    if (mysqli_num_rows($result) > 0) {
        // Display opportunities
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Opportunities Registered</title>
            <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
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
        
        <h1 style="color:#32620e; margin-left: 150px; margin-top: 50px; margin-bottom: 0px;">Dashboard</h1>



            <div class="container">
                <div class="box-wrapper">
                    <div class="wide-box">Active Participations
                        <br>
                        <?php
                        echo "<strong><p style='font-size: 60px; margin-left:20px;'>$num_opportunities</p></strong>";

                        ?>
                    </div>
                    <div class="small-box">
                    <div class="circular-progress" 
                        data-inner-circle-color="white" 
                        data-percentage="<?php echo $progress_percentage; ?>"
                        data-progress-color="#32620e" 
                        data-bg-color="black">
                        <div class="inner-circle"></div>
                        <p class="percentage"><?php echo $progress_percentage; ?>%</p>
                    </div>
                    </div>
                </div>
                
            
                <h1 style="color:#32620e; margin-right: 730px;margin-top: 50px; margin-bottom: -10px;">Registered Opportunities</h1>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="long-box">
                                <strong><?php echo $row['title']; ?></strong><br>
                                <em><?php echo $row['description']; ?></em><br>
                                Date: <?php echo $row['date']; ?><br>
                                <!-- Add more details as needed -->
                        </div>
                    <?php } ?>
                </ul>
            </div>
            </div>
        
            <footer>
            <div>
                <a href="#">Privacy</a>
                <a href="#">Contact Us</a>
                <a href="../view/homepage.php">About Us</a>
            </div>
            <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
            </footer>

        </body>

        <script>
            const circularProgress = document.querySelectorAll(".circular-progress");

            Array.from(circularProgress).forEach((progressBar) => {
            const progressValue = progressBar.querySelector(".percentage");
            const innerCircle = progressBar.querySelector(".inner-circle");
            let startValue = 0,
                endValue = Number(progressBar.getAttribute("data-percentage")),
                speed = 50,
                progressColor = progressBar.getAttribute("data-progress-color");

            const progress = setInterval(() => {
                startValue++;
                progressValue.textContent = `${startValue}%`;
                progressValue.style.color = `${progressColor}`;

                innerCircle.style.backgroundColor = `${progressBar.getAttribute(
                "data-inner-circle-color"
                )}`;

                progressBar.style.background = `conic-gradient(${progressColor} ${
                startValue * 3.6
                }deg,${progressBar.getAttribute("data-bg-color")} 0deg)`;
                if (startValue === endValue) {
                clearInterval(progress);
                }
            }, speed);
            });
        </script>


        </html>
        <?php
    } else {
        echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Opportunities Registered</title>
                <link rel="stylesheet" type="text/css" href="../css/register-opp.css">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
            </head>
            <body>
                <header class="header">
                    <div class="logo">
                        <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
                    </div>
                    <div class="cta">
                        <a href="../view/volunteer_listings.php" style="margin-right: 10px;">Volunteer</a>
                        <a href="../view/post_opportunity.php" style="margin-right: 10px;">Post Opportunity</a>
                        <a href="../view/profile.php" style="margin-right: 10px;">
                            <span>';
                                if (!empty($user_data['profile_photo'])) {
                                    echo '<img src="' . $user_data['profile_photo'] . '" alt="Profile Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 20px;margin-top : 10px;">';
                                }
            echo            '</span>
                        </a>
                    </div>
                </header>';

        
        // No opportunities found for the user
    
            echo '<div style="text-align: center; margin: 50px auto; max-width: 600px; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); margin-bottom: 300px">
                <p style="font-size: 24px; font-weight: bold; ">You have not registered for any opportunity.</p>
                <a href= "../view/volunteer_listings.php">
                <button style="background-color: #32620e; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Register for an opportunity</button>
                </a>
            </div>';


        echo '<footer>
            <div>
                <a href="#">Privacy</a>
                <a href="#">Contact Us</a>
                <a href="../view/homepage.php">About Us</a>
            </div>
            <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
        </footer>';


    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
    header("Location: ../login/login.php");
}

// Close the database connection
mysqli_close($conn);
?>
