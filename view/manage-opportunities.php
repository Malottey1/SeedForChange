<?php
// Include the file to connect to the database
include '../settings/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and session variable is set
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session
    
    // Fetch opportunities posted by the user
    $sql = "SELECT * FROM opportunities WHERE user_id = ?";
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
            <link rel="stylesheet" type="text/css" href="../css/manage-opp.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <title>Manage Opportunities</title>
        </head>
        <header class="header">
            <div class="logo">
                <img src="../assests/images/3.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
            </div>
            <div class="cta">
                <a href="../view/volunteer_listings.php" style="margin-right: 10px; text-decoration: none;">Volunteer</a>
                <a href="../view/post_opportunity.php" style="margin-right: 10px;  text-decoration: none;">Post Opportunity</a>
                <a href="../view/manage-opportunities.php" style="margin-right: 10px;  text-decoration: none;" class="registered-opportunities-profile-button">Manage Opportunities</a>
                <a href="../view/registered_opportunities.php" style="margin-right: 10px;  text-decoration: none;" class="registered-opportunities-profile-button">Track Your Progress</a>
                <a href="../view/profile.php" style="margin-right: 10px;">
                <span><?php if (!empty($user_data['profile_photo'])): ?>
                <img src="<?php echo $user_data['profile_photo']; ?>" alt="Profile Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 20px;margin-top : 10px;">
            <?php endif; ?></span>
                </a>
            </div>
        </header>
        
        <body>
            <h1 style="margin-top: 40px";>Manage Opportunities</h1>
            
            <div class="table-boot">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php $counter = 0; ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                        <td>
                            <form action="../action/change_opportunity_status.php" method="POST">
                                <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
                                <button class="button-82-pushable" role="button" type="submit" name="status" value="1">
                                <span class="button-82-shadow"></span>
                                <span class="button-82-edge"></span>
                                <span class="button-84-front text">
                                    Activate
                                </span>
                                </button>
                                <button class="button-82-pushable" role="button" type="submit" name="status" value="0">
                                <span class="button-82-shadow"></span>
                                <span class="button-82-edge"></span>
                                <span class="button-83-front text">
                                    Deactivate
                                </span>
                                </button>
                            </form>
                        </td>
                        <td>
                        <form id="deleteForm" action="../action/delete_opportunity.php" method="post">
                            <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>"> <!-- Replace 1 with the actual opportunity ID -->
                            <button style="background-color: transparent; border: none;" type="submit" onclick="return confirm('Are you sure you want to delete this opportunity?')">
                                <img src= "../assests/images/trash.svg">
                            </button>
                        </form>
                    
                    </td>

                    </tr>
                    <?php $counter++; ?>
                <?php } ?>
            </table>
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
            <?php for ($i = 0; $i < $counter; $i++) { ?>
            const checkbox<?php echo $i; ?> = document.getElementById('toggle-<?php echo $i; ?>');

            // Event listener for checkbox change
            checkbox<?php echo $i; ?>.addEventListener('change', function() {
                const status = checkbox<?php echo $i; ?>.checked ? 1 : 0; // 1 for Active, 0 for Inactive
                
                // Get the corresponding form
                const form = checkbox<?php echo $i; ?>.closest('form');
                
                // Update the hidden input value
                form.querySelector('[name="status"]').value = status;
                
                // Submit the form
                form.submit();
            });
            <?php } ?>
        </script>
        </html>
        <?php
    } else {
        // No opportunities found for the user
        echo "You have not posted any opportunities.";
    }
} else {
    // User is not logged in or session variable is not set
    echo "User is not logged in or session variable is not set.";
}

// Close the database connection
mysqli_close($conn);
?>
