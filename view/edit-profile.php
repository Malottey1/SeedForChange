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
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // User found, populate form fields with user data
        $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/edit-page.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Profile</title>
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../assests/images/3.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px; margin-top: 10px;">
    </div>
    <div class="cta">
        <a href="../view/volunteer_listings.php" style="margin-right: 10px;color: white;">Volunteer</a>
        <a href="../view/post_opportunity.php" style="margin-right: 10px; color: white;">Post Opportunity</a>
        <a href="../action/logout.php" style="margin-right: 20px; color: white;">Logout</a>
    </div>
</header>

<h1 style="margin-left: 50px; color: #32620e;">Edit Profile</h1>
    
    <main>
        <section>
            <div class="box">
            <h2 style="color: #32620e">Account Information</h2>
            <!-- Display user's account information -->
            <p>Email: <?php echo $row['email']; ?></p>
            <p>First Name: <?php echo $row['first_name']; ?></p>
            <p>Last Name: <?php echo $row['last_name']; ?></p>
            <p>Biography: <?php echo $row['biography']; ?></p>
            <p>Country: <?php echo $row['country']; ?></p>
            <p>Phone Number: <?php echo $row['phone_number']; ?></p>
            <p>Languages Spoken: <?php echo $row['languages_spoken']; ?></p>
            <form action="../action/upload_action.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <label for="profile_photo">Select image to upload:</label>
                    <input type="file" name="profile_photo" id="profile_photo">
                    <input style="background-color:#32620e; color: white; padding: 20px; width: 180px; font-size:15px; border-radius: 50px; " type="submit" value="Upload Image" name="submit">
            </form>
             </div>

            <form action="../action/update_profile.php" method="POST" enctype="multipart/form-data">
                <!-- Personal Profile -->
                <div class="box">
                <h2 style="color: #32620e">Personal Profile:</h2>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>" required><br><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>"><br><br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>"><br><br>
                <label for="biography">Biography:</label>
                <textarea id="biography" name="biography"><?php echo isset($row['biography']) ? $row['biography'] : ''; ?></textarea><br><br>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo isset($row['country']) ? $row['country'] : ''; ?>"><br><br>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($row['phone_number']) ? $row['phone_number'] : ''; ?>"><br><br>
                <label for="languages_spoken">Languages Spoken:</label>
                <input type="text" id="languages_spoken" name="languages_spoken" value="<?php echo isset($row['languages_spoken']) ? $row['languages_spoken'] : ''; ?>"><br><br>
                </div>
                <!-- Professional Experience -->
                <div class="box">
                <h2 style="color: #32620e">Professional Experience:</h2>

                <?php
                // Fetch professional experiences from the database
                $sql = "SELECT * FROM professional_experiences WHERE user_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Check if there are any professional experiences for the user
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position[]" value="<?php echo isset($row['position']) ? $row['position'] : ''; ?>"><br><br>
                        <label for="organization">Organization/Company:</label>
                        <input type="text" id="organization" name="organization[]" value="<?php echo isset($row['organization']) ? $row['organization'] : ''; ?>"><br><br>
                        <label for="from_date">From:</label>
                        <input type="date" id="from_date" name="from_date[]" value="<?php echo isset($row['from_date']) ? $row['from_date'] : ''; ?>"><br><br>
                        <label for="to_date">To:</label>
                        <input type="date" id="to_date" name="to_date[]" value="<?php echo isset($row['to_date']) ? $row['to_date'] : ''; ?>"><br><br>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description[]"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea><br><br>
                        <?php
                    }
                } else {
                    // If there are no professional experiences, display empty input fields to add new ones
                    ?>
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position[]"><br><br>
                    <label for="organization">Organization/Company:</label>
                    <input type="text" id="organization" name="organization[]"><br><br>
                    <label for="from_date">From:</label>
                    <input type="date" id="from_date" name="from_date[]"><br><br>
                    <label for="to_date">To:</label>
                    <input type="date" id="to_date" name="to_date[]"><br><br>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description[]"></textarea><br><br>
                    <?php
                }
                ?>
                </div>
                <!-- Project Preferences -->
                <div class="box">

        <!-- Skills Checkbox -->
        <div class="form-adjust">
                                    <h2 style="color: #32620e; margin-bottom: 0px ">Project Preferences</h2>

                                    <!-- Skills Checkbox -->
                                    <h3 style="color: #32620e">Skills</h3>
                            <div class="checkbox-column">
                                            <div class="checkbox-wrapper-43">
                                            <input type="checkbox" id="cbx-43" name="skills[]" value="1">
                                            <label for="cbx-43" class="check">
                                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                    <polyline points="1 9 7 14 15 4"></polyline>
                                                </svg>
                                            </label>
                                            <label for="cbx-43">Accounting</label><br>
                                            </div>

                                            <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-2" name="skills[]" value="2">
                                        <label for="cbx-43-2" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-2">Artificial intelligence</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-3" name="skills[]" value="3">
                                        <label for="cbx-43-3" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-3">Branding</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-4" name="skills[]" value="4">
                                        <label for="cbx-43-4" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-4">Business development</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-5" name="skills[]" value="5">
                                        <label for="cbx-43-5" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-5">Coaching</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-6" name="skills[]" value="6">
                                        <label for="cbx-43-6" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-6">Communications</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-7" name="skills[]" value="7">
                                        <label for="cbx-43-7" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-7">Data analysis</label><br>
                                    </div>


                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-8" name="skills[]" value="8">
                                        <label for="cbx-43-8" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-8">Database administration</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-9" name="skills[]" value="9">
                                        <label for="cbx-43-9" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-9">Digital advertising</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-10" name="skills[]" value="10">
                                        <label for="cbx-43-10" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-10">Digital marketing</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-11" name="skills[]" value="11">
                                        <label for="cbx-43-11" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-11">Engineering</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-12" name="skills[]" value="12">
                                        <label for="cbx-43-12" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-12">Entrepreneurship</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-13" name="skills[]" value="13">
                                        <label for="cbx-43-13" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-13">Event planning</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-14" name="skills[]" value="14">
                                        <label for="cbx-43-14" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-14">Executive leadership</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-15" name="skills[]" value="15">
                                        <label for="cbx-43-15" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-15">Finance</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-16" name="skills[]" value="16">
                                        <label for="cbx-43-16" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-16">Fundraising</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-17" name="skills[]" value="17">
                                        <label for="cbx-43-17" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-17">Graphic design</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-18" name="skills[]" value="18">
                                        <label for="cbx-43-18" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-18">Human resources</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-19" name="skills[]" value="19">
                                        <label for="cbx-43-19" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-19">Information technology</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-20" name="skills[]" value="20">
                                        <label for="cbx-43-20" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-20">Management</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-21" name="skills[]" value="21">
                                        <label for="cbx-43-21" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-21">Marketing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-22" name="skills[]" value="22">
                                        <label for="cbx-43-22" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-22">Organizational design</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-23" name="skills[]" value="23">
                                        <label for="cbx-43-23" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-23">Photography & video</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-24" name="skills[]" value="24">
                                        <label for="cbx-43-24" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-24">Project management</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-25" name="skills[]" value="25">
                                        <label for="cbx-43-25" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-25">Public relations</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-26" name="skills[]" value="26">
                                        <label for="cbx-43-26" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-26">Research</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-27" name="skills[]" value="27">
                                        <label for="cbx-43-27" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-27">Sales</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-28" name="skills[]" value="28">
                                        <label for="cbx-43-28" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-28">Search engine marketing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-29" name="skills[]" value="29">
                                        <label for="cbx-43-29" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-29">Social media</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-30" name="skills[]" value="30">
                                        <label for="cbx-43-30" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-30">Sound editing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-31" name="skills[]" value="31">
                                        <label for="cbx-43-31" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-31">Strategy consulting</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-32" name="skills[]" value="32">
                                        <label for="cbx-43-32" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-32">Talent recruitment</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-33" name="skills[]" value="33">
                                        <label for="cbx-43-33" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-33">Training</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-34" name="skills[]" value="34">
                                        <label for="cbx-43-34" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-34">Web design</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-35" name="skills[]" value="35">
                                        <label for="cbx-43-35" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-35">Web development</label><br>
                                    </div>
                        </div>

                    </div>

            </div>

        <!-- Cause Areas -->
        <div class="box">
        <div class="form-adjust">
                                    <!-- Cause Areas -->
                                    <h3 style="color: #32620e">Cause Areas</h3>
                                    <div class="checkbox-column">
                                                    <label style="display: flex; align-items: center;">
                                                    <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                        <input type="checkbox" id="cbx-43-1" name="cause_area[]" value="1">
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
                                                    <input type="checkbox" id="cbx-43-2" name="cause_area[]" value="2">
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
                                                    <input type="checkbox" id="cbx-43-3" name="cause_area[]" value="3">
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
                                                    <input type="checkbox" id="cbx-43-5" name="cause_area[]" value="5">
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
                                                    <input type="checkbox" id="cbx-43-6" name="cause_area[]" value="6">
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
                                                    <input type="checkbox" id="cbx-43-7" name="cause_area[]" value="7">
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
                                                    <input type="checkbox" id="cbx-43-8" name="cause_area[]" value="8">
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
                                                    <input type="checkbox" id="cbx-43-9" name="cause_area[]" value="9">
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
                                                    <input type="checkbox" id="cbx-43-10" name="cause_area[]" value="10">
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
                                                    <input type="checkbox" id="cbx-43-11" name="cause_area[]" value="11">
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
                                                    <input type="checkbox" id="cbx-43-12" name="cause_area[]" value="12">
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
                                                    <input type="checkbox" id="cbx-43-13" name="cause_area[]" value="13">
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
                                                    <input type="checkbox" id="cbx-43-14" name="cause_area[]" value="14">
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
                                                    <input type="checkbox" id="cbx-43-15" name="cause_area[]" value="15">
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
                                                    <input type="checkbox" id="cbx-43-16" name="cause_area[]" value="16">
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
                                                    <input type="checkbox" id="cbx-43-17" name="cause_area[]" value="17">
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
                                                    <input type="checkbox" id="cbx-43-18" name="cause_area[]" value="18">
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
                                                    <input type="checkbox" id="cbx-43-4" name="cause_area[]" value="4">
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

                <center><input style="background-color:#32620e; color: white; padding: 20px; width: 180px; font-size:15px; border-radius: 50px; " type="submit" value="Save Changes"><center>
            </form>
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
    </main>
    <footer>
            <div>
                <a href="#">Privacy</a>
                <a href="#">Contact Us</a>
                <a href="../view/homepage.php">About Us</a>
            </div>
            <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
            </footer>
</body>
</html>
