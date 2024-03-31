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
        <div id="professional_experience">
            <div class="experience_entry">
                <label for="position1">Position:</label>
                <input type="text" id="position1" name="position[]"><br><br>
                <label for="organization1">Organization/Company:</label>
                <input type="text" id="organization1" name="organization[]"><br><br>
                <label for="from_date1">From:</label>
                <input type="date" id="from_date1" name="from_date[]"><br><br>
                <label for="to_date1">To:</label>
                <input type="date" id="to_date1" name="to_date[]"><br><br>
                <label for="description1">Description:</label>
                <textarea id="description1" name="description[]"></textarea><br><br>
            </div>
        </div>
        <button type="button" onclick="addExperience()">Add Another Experience</button>
        
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

        
        <button name="register" type="submit" id="loginButton">Register</button>
    </form>
    
    <p>Already have an account? <a href="../login/login.php">Login here</a></p>

    <script>
    var experienceCount = 1; // Initialize the count of experiences

    function addExperience() {
        experienceCount++; // Increment the count
        var newExperience = document.createElement('div'); // Create a new div for the experience
        newExperience.classList.add('experience_entry'); // Add a class for styling
        newExperience.innerHTML = `
            <label for="position${experienceCount}">Position:</label>
            <input type="text" id="position${experienceCount}" name="position[]"><br><br>
            <label for="organization${experienceCount}">Organization/Company:</label>
            <input type="text" id="organization${experienceCount}" name="organization[]"><br><br>
            <label for="from_date${experienceCount}">From:</label>
            <input type="date" id="from_date${experienceCount}" name="from_date[]"><br><br>
            <label for="to_date${experienceCount}">To:</label>
            <input type="date" id="to_date${experienceCount}" name="to_date[]"><br><br>
            <label for="description${experienceCount}">Description:</label>
            <textarea id="description${experienceCount}" name="description[]"></textarea><br><br>
        `;
        document.getElementById('professional_experience').appendChild(newExperience); // Append the new experience to the container
    }
</script>
</body>

</html>
