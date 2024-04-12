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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <title>Manage Opportunities</title>
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
                    <td ><a style="color: #32620e; text-decoration:none;" href="../view/registered-volunteers.php?opportunity_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
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
                            <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>"> 
                            <button style="background-color: transparent; border: none;" type="submit" onclick="confirmDelete(event)">
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
        <script>
            function confirmDelete(event) {
                event.preventDefault(); // Prevent form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if the user confirms
                        document.getElementById('deleteForm').submit();
                    }
                });
            }
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
                <header class="header">
                    <div class="logo">
                        <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
                    </div>
                    <div class="cta">
                        <a href="../view/volunteer_listings.php" style="margin-right: 10px;">Volunteer</a>
                        <a href="../view/post_opportunity.php" style="margin-right: 10px;">Post Opportunity</a>
                    </div>
                </header>';
        
        // No opportunities found for the user
    
            echo '<div style="text-align: center; margin: 50px auto; max-width: 600px; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); margin-bottom: 300px">
                <p style="font-size: 24px; font-weight: bold; ">You have not posted any opportunity.</p>
                <a href= "../view/post_opportunity.php">
                <button style="background-color: #32620e; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;"> Post an opportunity</button>
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
