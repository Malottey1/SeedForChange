<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Volunteer Opportunities</title>
</head>
<body>
    <header>
        <h1>Post Volunteer Opportunities</h1>
        <nav>
            <ul>
                <li><a href="../view/homepage.php">Homepage</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Create New Volunteer Opportunity</h2>
            <form action="../action/post_opportunity_process.php" method="POST">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>

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
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
                
                <label for="requirements">Requirements:</label><br>
                <textarea id="requirements" name="requirements" rows="4" required></textarea><br><br>
                
                <label for="date">Date:</label><br>
                <input type="date" id="date" name="date" required><br><br>
                
                <button name="post" type="submit" id="post-btn">Post Opportunity</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
</body>
</html>