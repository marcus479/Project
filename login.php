<?php
// Start the session to manage user login sessions
session_start();

// Database connection (replace with your own credentials)
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "selangorsportclub";

// Create connection using MySQLi
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a message for console output
$consoleMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set in $_POST
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Get user input
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepared statement to fetch all users
        $stmt = $conn->prepare("SELECT Name, Password FROM member");
        $stmt->execute();
        $result = $stmt->get_result();

        $loginSuccessful = false;

        // Check each user in the database
        while ($row = $result->fetch_assoc()) {
            if ($username === $row['Name'] && $password === $row['Password']) {
                $loginSuccessful = true;
                break;
            }
        }

        if ($loginSuccessful) {
            // Set session variables
            $_SESSION['Name'] = $username;

            // Instead of redirecting, include the home page HTML content
            include('Member_homePage.html'); // This will run the content of 'home_page.html'
        } else {
            $_SESSION['Error'] = "Wrong Username or Password";
            include('login_page.php');
        }

        // Close the statement
        $stmt->close();
    } else {
        $consoleMessage = "Form submitted but username or password is missing";
    }
} else {
    $consoleMessage = "Form not submitted";
}

// Close the database connection
$conn->close();

// Print the console message using JavaScript
if ($consoleMessage != "") {
    echo "<script>console.log('$consoleMessage');</script>";
}
?>