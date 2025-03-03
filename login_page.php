<?php 
    session_start(); // Start the session
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selangor Sports Club - Login</title>
    <link rel="icon" type="image/png" href="images/website_logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f3ff;
        }

        header {
            background-color: rgb(0, 173, 230);
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 16px;
            padding-top: 220px;
            height: 79px;
        }
        .login-form {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            color: #666;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;   /* Makes the input take full width */
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding does not affect width */
        }
        .form-group .password-input {
            position: relative;
            width: 100%; /* Ensures it stays within the container */
        }
        .form-group .password-input input {
            padding-right: 40px; /* Adjust padding to make room for the toggle icon */
        }
        .form-group .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            z-index: 1;  /* Ensures it stays on top of the input */
        }
        .signup-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .sign-up a {
            color: #33ccff; 
            text-decoration: none; 
        }
        .forgot-password a {
            color: #33ccff;
            text-decoration: none;
        }
        .login-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #33ccff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .login-button:hover{
            background-color: #e5e501;
        }

        .menu-bar {
            background-color:#333333;
            height: 180px;
            overflow: hidden;
            position: fixed; /* Makes the menu bar stay on top */
            left: 0;
            top: 0; /* Positions it at the top of the page */
            width: 100%; /* Ensures it stretches across the entire width of the page */
            z-index: 1000; /* Keeps it above other content */
        }

        .menu-bar ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
        }

        .menu-bar ul .logo {
            margin-right: auto; /* Pushes other menu items to the right */
        }

        .menu-bar ul li {
            position: relative;
        }

        .menu-bar ul li a {
            display: block;
            padding: 20px 50px;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 20px;
        }

        .menu-bar ul li a img {
            height: 40px; /* Adjust this value to change the logo size */
            vertical-align: middle;
        }

        .menu-bar ul li a:hover {
            background-color: #575757;
        }

        /* Dropdown menu */
        .menu-bar ul .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color:#001f3f;
            min-width: 220px;
            z-index: 3000;
        }

        .menu-bar ul li:hover .dropdown {
            display: block;
        }

        .menu-bar ul .dropdown li {
            float: none;
        }

        .menu-bar ul .dropdown li a {
            padding: 5px 16px;
            color: white;
        }

        .menu-bar ul .dropdown li a:hover {
            background-color: #575757;
        }

        .menu-bar ul li a img {
            height: 80px; /* Adjust this value to change the logo size */
            display: block;
            margin: 0 auto;
        }

        .menu-bar ul li .logo-text {
            text-align: center;
            color: white;
            font-size: 24px; /* Adjust font size as needed */
            margin-top: 5px;
        }

        .menu-bar ul li.logo a:hover {
            background-color: #575757;
        }

        .contact-info {
            padding: 50px; /* Reduced padding for a more compact design */
            background-color: #f0f4f8; /* Light background for a softer appearance */
            color: #333333; /* Dark gray text for better readability */
            margin-top: 50px; /* Slightly reduced margin for a cleaner look */
            display: flex; /* Use flexbox */
            flex-direction: column; /* Align items in a column */
            align-items: center; /* Center items horizontally */
            text-align: center; /* Center text */
        }

        .contact-images {
            display: flex; /* Use flexbox for a horizontal layout */
            justify-content: center; /* Center the items horizontally */
            gap: 30px; /* Add spacing between items */
            flex-wrap: wrap; /* Ensure items wrap on smaller screens */
            margin-top: 20px; /* Optional: Add some space at the top */
        }

        .contact-item {
            text-align: center; /* Center the content inside each item */
            flex-basis: 200px; /* Set a base width for each item */
            flex-grow: 1; /* Allow items to grow evenly */
            padding: 10px; /* Optional: Add padding around each item */
        }

        .contact-info h2 {
            font-weight: bold;
            font-size: 48px; /* Adjusted size */
            color: #0056b3; /* A pleasant blue color for the heading */
        }

        .contact-info h3 {
            font-weight: bold;
            font-size: 20px; /* Adjusted size */
            color: #000000; /* Match with the heading color */
        }

        .contact-item p {
            font-size: 20px; /* Adjusted for consistency */
            margin-top: 10px; /* Optional: add space between the image and the text */
            color: #555555; /* Medium gray for paragraph text */
            font-weight: normal; /* Normal weight for better reading */
        }

        .contact-image {
            height: 80px; /* Slightly smaller image for better alignment */
            width: auto;
            margin-bottom: 10px; /* Space between image and text */
        }

        /* Optional: Add hover effects */
        .contact-item:hover {
            transform: scale(1.05); /* Scale effect on hover */
            transition: transform 0.2s ease; /* Smooth transition */
            background-color: #a19e9e;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #333; /* Dark background for the footer */
            color: white; /* Text color */
            position: relative; /* Adjust if needed */
        }

        .footer p {
            margin: 0; /* Remove default margin */
            font-size: 20px
        }


        .error-message {
            color: red; /* Text color for the error message */
            background-color: #f8d7da; /* Light red background */
            border: 1px solid #f5c6cb; /* Red border */
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold; /* Make the text bold for emphasis */
        }
    </style>
</head>
<body>
    <nav class="menu-bar">
        <ul>
            <li class="logo">
                <a href="http://localhost/rwdd/HTML_Assignment/SelangorSportClub.html">
                    <img src="images/htmlLogo2.png" alt="Logo">
                    <div class="logo-text">Selangor Sport Club</div>
                </a>
            </li>
            <li><a href="http://localhost/rwdd/HTML_Assignment/SelangorSportClub.html">Home</a></li>
            <li><a>About</a>
                <ul class="dropdown">
                    <li><a href="http://localhost/rwdd/HTML_Assignment/history.html">History</a></li>
                    <li><a href="http://localhost/rwdd/HTML_Assignment/generalCommitte.html">General Committee</a></li>
                </ul>
            </li>
            <li><a href="http://localhost/rwdd/HTML_Assignment/membership.html">Membership</a></li>
            <li><a href="http://localhost/rwdd/HTML_Assignment/Gallery.html">Gallery</a></li>
            <li><a href="http://localhost/rwdd/HTML_Assignment/login_page.html">Member Login</a></li>
            <li><a href="http://localhost/rwdd/HTML_Assignment/ContactUs.html">Contact Us</a></li>
        </ul>
    </nav>

    <header>
        <h1 style="color: white;">LOGIN</h1>
    </header>
    <main>
        <?php 
        $test = "php block";
        
        // Check if the session variable is set
        if (isset($_SESSION['Error'])) {
            session_unset();
        }
        ?>
        <!-- Form now posts data to login.php using POST method -->
        <form class="login-form" action="login.php" method="POST"> <!-- Updated to connect with login.php -->
            <h2>Member Login</h2>
            <div class="form-group">
                <label for="user-id">* Username</label>
                <!-- Name attribute added to send 'user-id' in form data -->
                <input type="text" id="username" name="username" required> <!-- Added name="user-id" for form submission -->
            </div>
            <div class="form-group">
                <label for="password">* Password</label>
                <div class="password-input">
                    <!-- Name attribute added to send 'password' in form data -->
                    <input type="password" id="password" name="password" required> <!-- Added name="password" for form submission -->
                    <span class="password-toggle" onclick="togglePassword()">
                        <img id="toggleIcon" src="images/hide_eye.png" alt="Toggle Password Visibility" style="width: 20px; height: 20px;">
                    </span>                    
                </div>
            </div>
            <?php if (isset($_SESSION['Error'])): ?>
                <div class="error-message">
                    <?php
                    // Display the error message safely
                    echo htmlspecialchars($_SESSION['Error']);
                    
                    // Optional: Unset the session variable after displaying it
                    unset($_SESSION['Error']);
                    ?>
                </div>
            <?php endif; ?>
            <div class="signup-forgot">
                <div class="sign-up">
                    <a href="sign_in.html">Sign Up</a>
                </div>
                <div class="forgot-password">
                    <a href="forget_password.html">Forgot Password</a>
                </div>
            </div>
            <!-- The submit button will now send form data to login.php -->
            <button type="submit" class="login-button">LOGIN</button> <!-- The form will be submitted to login.php -->
        </form>
    </main>

    <div class="contact-info">
        <h2>CONTACT INFO</h2>
        <br><br><br>
        <div class="contact-images">
            <div class="contact-item">
                <img src="images/phone.png" alt="Swimming Pool" class="contact-image">
                <h3>PHONE</h3>
                <h3>06-1234 8888/08-1234 8888</h3>
            </div>
            <div class="contact-item">
                <img src="images/clock.png" alt="Conference Room" class="contact-image">
                <h3>OPERATION HOUR</h3>
                <p>Sunday, Monday, Tuesday:</p>
                <p>7.30am - 12.00am</p>
                <p>Wednesday, Thursday, Friday:</p> 
                <p>7.30am - 1.00am</p>  
                <p>Saturday & Eve of public holiday:</p>
                <p>7.30am - 2.00am</p>    
            </div>
            <div class="contact-item">
                <img src="images/location.png" alt="Library" class="contact-image">
                <h3>ADDRESS</h3>
                <h3>JALAN SERDANG, 43300 SERI</h3>
                <h3>KEMBANGAN, SELANGOR</h3>
            </div>
            <div class="contact-item">
                <img src="images/email.png" alt="Library" class="contact-image">
                <h3>EMAIL</h3>
                <p>admin@slgsportsclub.com.my</p>
            </div>
        </div>
    </div>
    

    <footer class="footer">
        <p>&copy; 2024 Selangor Sport Club. All rights reserved.</p>
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.src = 'images/show_eye.png';  // Update with your icon's path for showing the password
            } else {
                passwordInput.type = 'password';
                toggleIcon.src = 'images/hide_eye.png';  // Update with your icon's path for hiding the password
            }
        }
    </script>
</body>
</html>