<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Listings</title>
</head>
<body>
    <header>
        <h1>Volunteer Listings</h1>
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
            <h2>Available Volunteer Opportunities</h2>
            <ul>
                <!-- Display volunteer opportunities dynamically here -->
                <li>
                    <h3>Title of Opportunity 1</h3>
                    <p>Description of Opportunity 1</p>
                    <p>Date: June 15, 2024</p>
                    <p>Cause Area: Environment, Education</p>
                    <a href="../view/opportunity_details.php?id=1">View Details</a>
                </li>
                <li>
                    <h3>Title of Opportunity 2</h3>
                    <p>Description of Opportunity 2</p>
                    <p>Date: July 1, 2024</p>
                    <p>Cause Area: Health & Nutrition, Community & Economic Development</p>
                    <a href="../view/opportunity_details.php?id=2">View Details</a>
                </li>
                <!-- Add more volunteer opportunities dynamically -->
            </ul>
        </section>
        
        <!-- Search or Filter Options -->
        <section>
            <h2>Search or Filter Options</h2>
            <!-- Add search or filter options here -->
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>
