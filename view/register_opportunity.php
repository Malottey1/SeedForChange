<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opportunity Details</title>
</head>
<body>
    <header>
        <h1>Opportunity Details</h1>
        <nav>
            <ul>
                <li><a href="../view/homepage.php">Homepage</a></li>
                <li><a href="../view/profile.php">Profile</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Title of the Opportunity</h2>
            <p>Description:</p>
            <p>This is the detailed description of the opportunity. It provides information about the goals, activities, and impact of the opportunity.</p>
            <p>Requirements:</p>
            <p>These are the requirements for participating in the opportunity. It may include skills, experience, or qualifications.</p>
            <p>Date: June 15, 2024</p>
            <p>Cause Area(s): Environment, Education</p>
            
            <!-- Registration Options -->
            <h3>Registration Options</h3>
            <p>If you're interested in participating in this opportunity, please register below:</p>
            <form action="../action/register_opportunity_process.php" method="POST">
                <input type="hidden" name="opportunity_id" value="1"> <!-- Hidden field to store the opportunity ID -->
                <input type="submit" value="Register">
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>