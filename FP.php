<?php 
session_start();

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'selangorsportclub');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$errors = [];

// Check if the user has submitted the password update form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password']) && isset($_POST['email'])) {
    $input_email = mysqli_real_escape_string($con, $_POST['email']);
    
    // Validate new password input
    if (!empty(trim($input_email))) {
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        
        // Check if the new password is not empty
        if (!empty(trim($new_password))) {
            // Update the password in the database for the given email
            $update_query = "UPDATE member SET password = '$new_password' WHERE email = '$input_email'";
            
            if (mysqli_query($con, $update_query)) {
                // Password updated successfully
                header("Location: successfulPage.html");
                exit;
            } else {
                // Failure: Show an error message
                echo "<div style='color:red;'>Error updating password: " . mysqli_error($con) . "</div>";
            }
        } else {
            // New password is not set or is empty
            $errors['new_password'] = "New password is required.";
        }
    } else {
        $errors['email'] = "Email is required.";
    }
}

// Optional: Display errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div style='color:red;'>$error</div>";
    }
}

// Close the database connection
mysqli_close($con);
?>