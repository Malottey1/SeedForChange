<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Seed for Change</title>
</head>
<body>
    <div class="hero"></div>
    <header class="header">
        <div class="logo">
            <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto;">
        </div>
        <div class="cta">
        <button onclick="scrollToGetStarted()">Get Started</button>
        </div>
    </header>

    <div class="text-container">
        <h1>Welcome to Seed for Change</h1>
        <p>Empowering Volunteers and Organizations for Positive Impact</p>
    </div>

    <div class="header-image"></div>
    
    <main>
    <div class="two-column-section">
        <div class="left-column">
            <h2 style="font-size: 60px; color: white; margin: 20px; margin-top: 35px; text-align:center;";>About Seed for Change</h2>
            
        </div>
        <div class="right-column">
            <p style="font-size: 30px; margin: 20px; text-align: left;";>Seed for Change is a platform dedicated to connecting passionate volunteers with organizations working towards positive change in their communities. Whether you're an individual looking to make a difference or an organization seeking dedicated volunteers, Seed for Change is here to help.</p>
        </div>
</div>
    
    <section class= "featured-project">
        <div class="horizontal-strip">
        <div class="strip-content">
            <h2 style="color: #32620e; font-size: 60px; margin-top: 20px;">What We Offer</h2>
        </div>
        </div>
        <div class="features">
            <div class="feature-column">
            <img src="../assests/images/5.svg" alt="Seed for Change logo" style="width:150px; height: auto;">
                <p style="color: #32620e;">Search and apply for volunteer opportunities</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/8.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p>Create and manage volunteer listings</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/6.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p style="color: #32620e;">Track volunteer registrations</p>
            </div>
            <div class="feature-column">
            <img src="../assests/images/7.svg" alt="Seed for Change logo" style="width: 150px; height: auto;">
                <p>Update and manage volunteer activity</p>
            </div>
</div>

        
    </section>
    
    <div class="custom-two-column-section" id="get-started-section">
    <div class="custom-text-column custom-horizontal-strip">
        <h2>Get Started</h2>
        <p>Ready to make a difference? Join Seed for Change today!</p>
        <a href="../login/register.php" class="rounded-button">Register</a>
        <span>or</span>
        <a href="../login/login.php" class="rounded-button">Login</a>
    </div>
    <div class="custom-image-column"></div>
</div>



</main>


    
    <footer>
        <p style="text-align: right">&copy; 2024 Seed for Change. All rights reserved.</p>
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

        function scrollToGetStarted() {
        var getStartedSection = document.getElementById("get-started-section");
        getStartedSection.scrollIntoView({ behavior: 'smooth' });
    }
    </script>
</body>
</html>
