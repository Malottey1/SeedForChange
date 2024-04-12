<?php
  include "../settings/connection.php";
  include "../action/post_opportunity_process.php";
  //check_login();

  ini_set('display_errors', 1);
  error_reporting(E_ALL);


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
    <link rel="stylesheet" type="text/css" href="../css/post-opp.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <title>Post Volunteer Opportunities</title>
</head>
<body>
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
        <h2 style="color:#32620e; margin-left: 200px; margin-top: 50px; margin-bottom: 0px;">Create New Volunteer Opportunity</h2>
        <div class="container">
        <form action="../action/post_opportunity_process.php" method="POST">
        <div class="form-container">
            <div class="form-column">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>

                <div class="form-adjust">
                                    <!-- Cause Areas -->
                                    <h3 style="color: #32620e">Cause Areas</h3>
                                    <div class="checkbox-column">
                                                    <label style="display: flex; align-items: center;">
                                                    <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                        <input type="checkbox" id="cbx-43-1" name="cause_area[]" value="Animals">
                                                        <span class="check">
                                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                                <polyline points="1 9 7 14 15 4"></polyline>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    Animals
                                                </label>
                                                

                                                <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-2" name="cause_area[]" value="Arts & culture">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Arts & culture
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-3" name="cause_area[]" value="Civil rights">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Civil rights
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-5" name="cause_area[]" value="Disaster relief">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Disaster relief
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;"> 
                                                    <input type="checkbox" id="cbx-43-6" name="cause_area[]" value="Disease & medical research">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Disease & medical research
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-7" name="cause_area[]" value="Diversity & inclusion">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Diversity & inclusion
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-8" name="cause_area[]" value="Education">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Education
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-9" name="cause_area[]" value="Employment services">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Employment services
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-10" name="cause_area[]" value="Environment">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Environment
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-11" name="cause_area[]" value="Gender equity & justice">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Gender equity & justice
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-12" name="cause_area[]" value="Health & nutrition">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Health & nutrition
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-13" name="cause_area[]" value="Housing & homelessness">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Housing & homelessness
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-14" name="cause_area[]" value="Human services">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Human services
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-15" name="cause_area[]" value="International affairs">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                International affairs
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-16" name="cause_area[]" value="Justice & legal services">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Justice & legal services
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-17" name="cause_area[]" value="LGBTQ+">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                LGBTQ+
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-18" name="cause_area[]" value="Maternal health">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Maternal health
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-4" name="cause_area[]" value="Community & economic development">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Community & economic development
                                            </label>

                                    </div>
                </div>
            
            </div>
            <div class="form-column">
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required style="width: 350px; height: 150px;"></textarea><br><br>
                
                <label for="requirements">Requirements:</label><br>
                <textarea id="requirements" name="requirements" rows="4" required style="width: 350px; height: 150px;"></textarea><br><br>
                
                <label for="date">Date:</label><br>
                <input type="date" id="date" name="date" required  onchange="validateDate()"><br><br>
                
                <button name="post" type="submit" id="post-btn">Post Opportunity</button>
            </form>
                
            </div>
        </div>
    </div>
    
    <main>
        <section>
           
            <form action="../action/post_opportunity_process.php" method="POST">
                
                
                
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>
<script>
    function validateDate() {
        var selectedDate = new Date(document.getElementById("date").value);
        var currentDate = new Date(); // Get the current date

        // Compare the selected date with the current date
        if (selectedDate < currentDate) {
            alert("Selected date cannot be in the past.");
            document.getElementById("date").value = ""; // Clear the input field
        }
    }
</script>
<?php
   // Check if the post was successful
if (isset($_SESSION['post_success']) && $_SESSION['post_success']) {
    // Display SweetAlert for successful post
    echo '<script>';
    echo 'Swal.fire({';
    echo '  icon: "success",';
    echo '  title: "Post Successful",';
    echo '  text: "Your opportunity has been successfully posted!",';
    echo '  timer: 2000,';
    echo '  showConfirmButton: false';
    echo '});';
    echo '</script>';

    // Unset the session variable to prevent the SweetAlert from showing on page refresh
    unset($_SESSION['post_success']);
}
 

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
