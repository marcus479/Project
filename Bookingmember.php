<?php
// Include the database connection file to connect to the database
include 'CConnect_db.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data using real_escape_string to prevent SQL injection
    $venue = $conn->real_escape_string($_POST['venue']);
    $fees = $conn->real_escape_string($_POST['fees']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $email = $conn->real_escape_string($_POST['email']);
    $start_time = $conn->real_escape_string($_POST['start-time']);
    $end_time = $conn->real_escape_string($_POST['end-time']);

    // Prepare the SQL statement to insert booking information into the bookinguser table
    $sql = "INSERT INTO booking_member (Venue, Fees, Name, Phone, Date, Email, `Start time`, `End time`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL statement for execution
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the captured parameters to the SQL statement
        $stmt->bind_param("ssssssss", $venue, $fees, $name, $phone, $date, $email, $start_time, $end_time);

        // Execute the statement and check if the booking was submitted successfully
        if ($stmt->execute()) {
            echo "Booking submitted successfully."; // Success message
        } else {
            echo "Error submitting booking: " . $stmt->error; // Error message if execution fails
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement: " . $conn->error; // Error message if preparation fails
    }

    // Close the database connection after completing the operation
    $conn->close();
} else {
    echo "Invalid request. Expecting POST."; // Message if the request method is not POST
}
?>