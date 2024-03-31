<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <title>Seed for Change</title>
</head>
<body>
    <div class="hero"></div>
    <header class="header">
        <div class="logo">
            <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto;">
        </div>
        <div class="cta">
            <button>Get Started</button>
        </div>
    </header>

    <div class="text-container">
        <h1>Welcome to Seed for Change</h1>
        <p>Empowering Volunteers and Organizations for Positive Impact</p>
    </div>

    <div class="header-image"></div>
    
    <main>
    <section>
        <div class="section-content">
            <h2>About Seed for Change</h2>
            <p>Seed for Change is a platform dedicated to connecting passionate volunteers with organizations working towards positive change in their communities. Whether you're an individual looking to make a difference or an organization seeking dedicated volunteers, Seed for Change is here to help.</p>
        </div>
    </section>
    
    <section>
        <div class="section-content">
            <h2>Features</h2>
            <ul>
                <li>Search and apply for volunteer opportunities</li>
                <li>Create and manage volunteer listings</li>
                <li>Track volunteer registrations</li>
                <li>Update and manage volunteer activity</li>
            </ul>
        </div>
    </section>
    
    <section>
        <div class="section-content">
            <h2>Get Started</h2>
            <p>Ready to make a difference? Join Seed for Change today!</p>
            <a href="../login/register.php">Register</a>
            <span>or</span>
            <a href="../login/login.php">Login</a>
        </div>
    </section>
</main>


    
    <footer>
        <p>&copy; 2024 Seed for Change. All rights reserved.</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('.header');
            const scrollPosition = () => window.pageYOffset || document.documentElement.scrollTop;

            const handleScroll = () => {
                if (scrollPosition() > 0) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            };

            window.addEventListener('scroll', handleScroll);
            handleScroll();
        });
    </script>
</body>
</html>
