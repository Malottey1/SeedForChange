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
    <title>Profile</title>
</head>
<body>
    <header>
        <h1>Profile</h1>
        <nav>
            <ul>
                <li><a href="../view/homepage.php">Homepage</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Account Information</h2>
            <!-- Display user's account information -->
            <p>Email: <?php echo $row['email']; ?></p>
            <p>First Name: <?php echo $row['first_name']; ?></p>
            <p>Last Name: <?php echo $row['last_name']; ?></p>
            <p>Biography: <?php echo $row['biography']; ?></p>
            <p>Country: <?php echo $row['country']; ?></p>
            <p>Phone Number: <?php echo $row['phone_number']; ?></p>
            <p>Languages Spoken: <?php echo $row['languages_spoken']; ?></p>

            <h1>Edit Profile</h1>
            <form action="../action/update_profile.php" method="POST" enctype="multipart/form-data">
                <!-- Personal Profile -->
                <h2>Personal Profile:</h2>
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
                <label for="profile_photo">Profile Photo:</label>
                <input type="file" id="profile_photo" name="profile_photo"><br><br>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo isset($row['country']) ? $row['country'] : ''; ?>"><br><br>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($row['phone_number']) ? $row['phone_number'] : ''; ?>"><br><br>
                <label for="languages_spoken">Languages Spoken:</label>
                <input type="text" id="languages_spoken" name="languages_spoken" value="<?php echo isset($row['languages_spoken']) ? $row['languages_spoken'] : ''; ?>"><br><br>
                
                <!-- Professional Experience -->
                <h2>Professional Experience:</h2>

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

                <!-- Project Preferences -->
        <h2>Project Preferences:</h2>

        <!-- Skills Checkbox -->
        <h3>Skills Checkbox:</h3>
        <label><input type="checkbox" name="skills[]" value="1"> Accounting</label><br>
        <label><input type="checkbox" name="skills[]" value="2"> Artificial intelligence</label><br>
        <label><input type="checkbox" name="skills[]" value="3"> Branding</label><br>
        <label><input type="checkbox" name="skills[]" value="4"> Business development</label><br>
        <label><input type="checkbox" name="skills[]" value="5"> Coaching</label><br>
        <label><input type="checkbox" name="skills[]" value="6"> Communications</label><br>
        <label><input type="checkbox" name="skills[]" value="7"> Data analysis</label><br>
        <label><input type="checkbox" name="skills[]" value="8"> Database administration</label><br>
        <label><input type="checkbox" name="skills[]" value="9"> Digital advertising</label><br>
        <label><input type="checkbox" name="skills[]" value="10"> Digital marketing</label><br>
        <label><input type="checkbox" name="skills[]" value="11"> Engineering</label><br>
        <label><input type="checkbox" name="skills[]" value="12"> Entrepreneurship</label><br>
        <label><input type="checkbox" name="skills[]" value="13"> Event planning</label><br>
        <label><input type="checkbox" name="skills[]" value="14"> Executive leadership</label><br>
        <label><input type="checkbox" name="skills[]" value="15"> Finance</label><br>
        <label><input type="checkbox" name="skills[]" value="16"> Fundraising</label><br>
        <label><input type="checkbox" name="skills[]" value="17"> Graphic design</label><br>
        <label><input type="checkbox" name="skills[]" value="18"> Human resources</label><br>
        <label><input type="checkbox" name="skills[]" value="19"> Information technology</label><br>
        <label><input type="checkbox" name="skills[]" value="20"> Management</label><br>
        <label><input type="checkbox" name="skills[]" value="21"> Marketing</label><br>
        <label><input type="checkbox" name="skills[]" value="22"> Organizational design</label><br>
        <label><input type="checkbox" name="skills[]" value="23"> Photography & video</label><br>
        <label><input type="checkbox" name="skills[]" value="24"> Project management</label><br>
        <label><input type="checkbox" name="skills[]" value="25"> Public relations</label><br>
        <label><input type="checkbox" name="skills[]" value="26"> Research</label><br>
        <label><input type="checkbox" name="skills[]" value="27"> Sales</label><br>
        <label><input type="checkbox" name="skills[]" value="28"> Search engine marketing</label><br>
        <label><input type="checkbox" name="skills[]" value="29"> Social media</label><br>
        <label><input type="checkbox" name="skills[]" value="30"> Sound editing</label><br>
        <label><input type="checkbox" name="skills[]" value="31"> Strategy consulting</label><br>
        <label><input type="checkbox" name="skills[]" value="32"> Talent recruitment</label><br>
        <label><input type="checkbox" name="skills[]" value="33"> Training</label><br>
        <label><input type="checkbox" name="skills[]" value="34"> Web design</label><br>
        <label><input type="checkbox" name="skills[]" value="35"> Web development</label><br>

        <!-- Cause Areas -->
        <h3>Cause Areas:</h3>
        <label><input type="checkbox" name="cause_area[]" value="1"> Animals</label><br>
        <label><input type="checkbox" name="cause_area[]" value="2"> Arts & culture</label><br>
        <label><input type="checkbox" name="cause_area[]" value="3"> Civil rights</label><br>
        <label><input type="checkbox" name="cause_area[]" value="4"> Community & economic development</label><br>
        <label><input type="checkbox" name="cause_area[]" value="5"> Disaster relief</label><br>
        <label><input type="checkbox" name="cause_area[]" value="6"> Disease & medical research</label><br>
        <label><input type="checkbox" name="cause_area[]" value="7"> Diversity & inclusion</label><br>
        <label><input type="checkbox" name="cause_area[]" value="8"> Education</label><br>
        <label><input type="checkbox" name="cause_area[]" value="9"> Employment services</label><br>
        <label><input type="checkbox" name="cause_area[]" value="10"> Environment</label><br>
        <label><input type="checkbox" name="cause_area[]" value="11"> Gender equity & justice</label><br>
        <label><input type="checkbox" name="cause_area[]" value="12"> Health & nutrition</label><br>
        <label><input type="checkbox" name="cause_area[]" value="13"> Housing & homelessness</label><br>
        <label><input type="checkbox" name="cause_area[]" value="14"> Human services</label><br>
        <label><input type="checkbox" name="cause_area[]" value="15"> International affairs</label><br>
        <label><input type="checkbox" name="cause_area[]" value="16"> Justice & legal services</label><br>
        <label><input type="checkbox" name="cause_area[]" value="17"> LGBTQ+</label><br>
        <label><input type="checkbox" name="cause_area[]" value="18"> Maternal health</label><br>
        <label><input type="checkbox" name="cause_area[]" value="19"> Military & veterans affairs</label><br>
        <label><input type="checkbox" name="cause_area[]" value="20"> Philanthropy & capacity building</label><br>
        <label><input type="checkbox" name="cause_area[]" value="21"> Religion & spirituality</label><br>
        <label><input type="checkbox" name="cause_area[]" value="22"> Science & technology</label><br>
        <label><input type="checkbox" name="cause_area[]" value="23"> Violence prevention</label><br>
        <label><input type="checkbox" name="cause_area[]" value="24"> Youth development</label><br>

                <input type="submit" value="Save Changes">
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
</body>
</html>
