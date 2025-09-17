<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="home-style.css" />
        <title>GuideNet</title>
        <link rel="icon" type="image/png" href="logo.png">
    </head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="img/logo.png" width="50px" height="50px"> GuideNet
            </a>
        </div>
    </div>
    
    <div class="hero">
        <div class="overlay"></div>  
        <div class="content">
            <h1>Connecting Banasthalites</h1>
            <div class="buttons">
                <button class="btn" onclick="location.href='signup.php'">Sign Up</button>
                <button class="btn" onclick="location.href='login.php'">Login</button>
            </div>
        </div>
        <button id="prev" class="arrow left">&#10094;</button>
        <button id="next" class="arrow right">&#10095;</button>
    </div>

    <div class="image-grid-container">
        <div class="image-grid">
            <div class="image-column">
                <img src="img/quote1-3.webp" class="slide active" alt="Image 1-1">
                <img src="img/quote1-1.webp" class="slide" alt="Image 1-2">
                <img src="img/quote1-4.webp" class="slide" alt="Image 1-3">
                <img src="img/quote1-2.jpg" class="slide" alt="Image 1-4">
            </div>
            
            <div class="image-column">
                <img src="img/quote2-2.jpg" class="slide active" alt="Image 2-1">
                <img src="img/quote2-4.jpeg" class="slide" alt="Image 2-2">
                <img src="img/quote2-3.jpg" class="slide" alt="Image 2-3">
                <img src="img/quote2-1.png" class="slide" alt="Image 2-4">
            </div>
            
            <div class="image-column">
                <img src="img/quote3-2.webp" class="slide active" alt="Image 3-1">
                <img src="img/quote3-4.jpg" class="slide" alt="Image 3-2">
                <img src="img/quote3-1.png" class="slide" alt="Image 3-3">
                <img src="img/quote3-3.jpeg" class="slide" alt="Image 3-4">
            </div>
            
            <div class="image-column">
                <img src="img/quote4-1.avif" class="slide active" alt="Image 4-1">
                <img src="img/quote4-2.jpeg" class="slide" alt="Image 4-2">
                <img src="img/quote4-3.png" class="slide" alt="Image 4-3">
                <img src="img/quote4-4.jpeg" class="slide" alt="Image 4-4">
            </div>
        </div>
    </div>
    
    <div class="about">
        <h2>Welcome to GuideNet</h2>
        <p>
            A platform that connects seniors and juniors, enabling them to share achievements, experiences, and guidance. 
            Explore profiles, discover insights, and bridge the gap for growth and success.
        </p>
    </div>
    <div class="section">
        <div class="image-container" id="slider1">
            <img src="apaji1.jpeg" class="slidE" style="opacity: 1;">
            <img src="apaji2.png" class="slidE">
            <img src="apaji3.jpeg" class="slidE">
            <img src="apaji4.jpeg" class="slidE">
        </div>
        <div class="quote_layout">“Apaji Fest- where traditions meet talent, and every heartbeat echoes Banasthali pride.”<br><br>
        Banasthali Apaji Fest is a vibraant celebration held in honor of Apaji, the founder of Banasthali Vidyapith. 
        This festival beautifully blends culture, talent, and tradition, showcasing the creativity, unity, and spirit of Banasthali’s students.</div>
        </div>
    </div>

    <div class="section">
        <div class="image-container" id="slider2">
            <img src="ramya.jpg" class="slidE" style="opacity: 1;">
            <img src="avani.jpeg" class="slidE">
            <img src="anjali.jpg" class="slidE">
            <img src="shemushi.jpg" class="slidE">
        </div>
        <div class="quote_layout">"Once a Banasthalite, forever a force—shaped by tradition, driven by purpose."<br><br>
        Banasthali alumni are empowered, graceful, and grounded women who carry the legacy of Banasthali Vidyapith across the world. 
        They are a living reflection of the institution’s values—strong, self-reliant, and ever inspiring.
    </div>
    </div>

    <div class="section">
        <div class="image-container" id="slider3">
            <img src="festi1.jpeg" class="slidE" style="opacity: 1;">
            <img src="festi2.jpeg" class="slidE">
            <img src="festi3.jpeg" class="slidE">
            <img src="festi4.jpeg" class="slidE">
        </div>
        <div class="quote_layout">“From stage lights to starry nights, Banasthali festivals are memories in the making.”<br><br>
        Banasthali festivals are a vibrant blend of culture, tradition, and youthful energy. 
        Each celebration brings students together in unity, showcasing talent, creativity, and the rich heritage that makes Banasthali truly unique.</div>
    </div>

    <div class="quote">
        <div class="quotes">
            <p>
                "GuideNet: Where experience meets ambition, and connections spark growth. <br> Together, we bridge the gap for a brighter tomorrow."
            </p>
        </div>
    </div>

    <div class="contact">
        <h2>Contact Us</h2>
        <p>
            Send us a message and we shall resolve your issues.
        </p>
        Phone No: +91 ----- <br>
        Email ID: contact---@gmail.com
    </div>

    <div class="social-footer">
        <h3>Social</h3>
        <div class="social-icons">
            <span>&#127918;</span>
            <span>&#127759;</span>
            <span>&#128247;</span>
            <span>&#128100;</span>
            <span>&#128220;</span>
        </div>
        <p class="copyright">COPYRIGHT © 2024 GUIDENET - ALL RIGHTS RESERVED.</p>
    </div>


    <script src="script_home.js"></script>
</body>
</html>