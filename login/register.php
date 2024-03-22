<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register for an Account</h1>
    <form action="../action/registration_process.php" method="POST" enctype="multipart/form-data">
        <!-- Account Information -->
        <h2>Account Information:</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        
        <!-- Personal Profile -->
        <h2>Personal Profile:</h2>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name"><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"><br><br>
        <label for="biography">Biography:</label>
        <textarea id="biography" name="biography"></textarea><br><br>
        <label for="profile_photo">Profile Photo:</label>
        <input type="file" id="profile_photo" name="profile_photo"><br><br>
        <label for="country">Country:</label>
        <input type="text" id="country" name="country"><br><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br><br>
        <label for="languages_spoken">Languages Spoken:</label>
        <input type="text" id="languages_spoken" name="languages_spoken"><br><br>
        
        <!-- Professional Experience -->
        <h2>Professional Experience:</h2>
        <label for="position">Position:</label>
        <input type="text" id="position" name="position"><br><br>
        <label for="organization">Organization/Company:</label>
        <input type="text" id="organization" name="organization"><br><br>
        <label for="from_date">From:</label>
        <input type="date" id="from_date" name="from_date"><br><br>
        <label for="to_date">To:</label>
        <input type="date" id="to_date" name="to_date"><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>
        
        <!-- Project Preferences -->
        <h2>Project Preferences:</h2>

        <!-- Skills Checkbox -->
        <h3>Skills Checkbox:</h3>
        <label><input type="checkbox" name="skills" value="Accounting"> Accounting</label><br>
        <label><input type="checkbox" name="skills" value="Artificial intelligence"> Artificial intelligence</label><br>
        <label><input type="checkbox" name="skills" value="Branding"> Branding</label><br>
        <label><input type="checkbox" name="skills" value="Business development"> Business development</label><br>
        <label><input type="checkbox" name="skills" value="Coaching"> Coaching</label><br>
        <label><input type="checkbox" name="skills" value="Communications"> Communications</label><br>
        <label><input type="checkbox" name="skills" value="Data analysis"> Data analysis</label><br>
        <label><input type="checkbox" name="skills" value="Database administration"> Database administration</label><br>
        <label><input type="checkbox" name="skills" value="Digital advertising"> Digital advertising</label><br>
        <label><input type="checkbox" name="skills" value="Digital marketing"> Digital marketing</label><br>
        <label><input type="checkbox" name="skills" value="Engineering"> Engineering</label><br>
        <label><input type="checkbox" name="skills" value="Entrepreneurship"> Entrepreneurship</label><br>
        <label><input type="checkbox" name="skills" value="Event planning"> Event planning</label><br>
        <label><input type="checkbox" name="skills" value="Executive leadership"> Executive leadership</label><br>
        <label><input type="checkbox" name="skills" value="Finance"> Finance</label><br>
        <label><input type="checkbox" name="skills" value="Fundraising"> Fundraising</label><br>
        <label><input type="checkbox" name="skills" value="Graphic design"> Graphic design</label><br>
        <label><input type="checkbox" name="skills" value="Human resources"> Human resources</label><br>
        <label><input type="checkbox" name="skills" value="Information technology"> Information technology</label><br>
        <label><input type="checkbox" name="skills" value="Management"> Management</label><br>
        <label><input type="checkbox" name="skills" value="Marketing"> Marketing</label><br>
        <label><input type="checkbox" name="skills" value="Organizational design"> Organizational design</label><br>
        <label><input type="checkbox" name="skills" value="Photography & video"> Photography & video</label><br>
        <label><input type="checkbox" name="skills" value="Project management"> Project management</label><br>
        <label><input type="checkbox" name="skills" value="Public relations"> Public relations</label><br>
        <label><input type="checkbox" name="skills" value="Research"> Research</label><br>
        <label><input type="checkbox" name="skills" value="Sales"> Sales</label><br>
        <label><input type="checkbox" name="skills" value="Search engine marketing"> Search engine marketing</label><br>
        <label><input type="checkbox" name="skills" value="Social media"> Social media</label><br>
        <label><input type="checkbox" name="skills" value="Sound editing"> Sound editing</label><br>
        <label><input type="checkbox" name="skills" value="Strategy consulting"> Strategy consulting</label><br>
        <label><input type="checkbox" name="skills" value="Talent recruitment"> Talent recruitment</label><br>
        <label><input type="checkbox" name="skills" value="Training"> Training</label><br>
        <label><input type="checkbox" name="skills" value="Web design"> Web design</label><br>
        <label><input type="checkbox" name="skills" value="Web development"> Web development</label><br>

        <!-- Cause Areas -->
        <h3>Cause Areas:</h3>
        <label><input type="checkbox" name="cause_area" value="Animals"> Animals</label><br>
        <label><input type="checkbox" name="cause_area" value="Arts & culture"> Arts & culture</label><br>
        <label><input type="checkbox" name="cause_area" value="Civil rights"> Civil rights</label><br>
        <label><input type="checkbox" name="cause_area" value="Community & economic development"> Community & economic development</label><br>
        <label><input type="checkbox" name="cause_area" value="Disaster relief"> Disaster relief</label><br>
        <label><input type="checkbox" name="cause_area" value="Disease & medical research"> Disease & medical research</label><br>
        <label><input type="checkbox" name="cause_area" value="Diversity & inclusion"> Diversity & inclusion</label><br>
        <label><input type="checkbox" name="cause_area" value="Education"> Education</label><br>
        <label><input type="checkbox" name="cause_area" value="Employment services"> Employment services</label><br>
        <label><input type="checkbox" name="cause_area" value="Environment"> Environment</label><br>
        <label><input type="checkbox" name="cause_area" value="Gender equity & justice"> Gender equity & justice</label><br>
        <label><input type="checkbox" name="cause_area" value="Health & nutrition"> Health & nutrition</label><br>
        <label><input type="checkbox" name="cause_area" value="Housing & homelessness"> Housing & homelessness</label><br>
        <label><input type="checkbox" name="cause_area" value="Human services"> Human services</label><br>
        <label><input type="checkbox" name="cause_area" value="International affairs"> International affairs</label><br>
        <label><input type="checkbox" name="cause_area" value="Justice & legal services"> Justice & legal services</label><br>
        <label><input type="checkbox" name="cause_area" value="LGBTQ+"> LGBTQ+</label><br>
        <label><input type="checkbox" name="cause_area" value="Maternal health"> Maternal health</label><br>
        <label><input type="checkbox" name="cause_area" value="Military & veterans affairs"> Military & veterans affairs</label><br>
        <label><input type="checkbox" name="cause_area" value="Philanthropy & capacity building"> Philanthropy & capacity building</label><br>
        <label><input type="checkbox" name="cause_area" value="Religion & spirituality"> Religion & spirituality</label><br>
        <label><input type="checkbox" name="cause_area" value="Science & technology"> Science & technology</label><br>
        <label><input type="checkbox" name="cause_area" value="Violence prevention"> Violence prevention</label><br>
        <label><input type="checkbox" name="cause_area" value="Youth development"> Youth development</label><br>

        
        <button name="register" type="submit" id="loginButton">Register</button>
    </form>
    
    <p>Already have an account? <a href="../login/login.php">Login here</a></p>
</body>
</html>
