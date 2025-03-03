<?php
// Include database connection
include 'CConnect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $number = htmlspecialchars(trim($_POST['number']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the data
    $errors = [];
    if (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (strlen($number) < 10) {
        $errors[] = "Phone number must be at least 10 digits.";
    }
    if (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters.";
    }

    if (empty($errors)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO contactus (name, email, phone_number, message) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssss", $name, $email, $number, $message);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Message submitted successfully.";
            } else {
                echo "Error submitting message: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to prepare SQL statement: " . $conn->error;
        }
    } else {
        // Handle validation errors
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
