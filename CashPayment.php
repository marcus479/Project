<?php
session_start();
include 'CConnect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['booking_details'])) {
    $booking = $_SESSION['booking_details'];

    $sql = "INSERT INTO bookinguser (Venue, Fees, Name, Phone, Date, Email, `Start time`, `End time`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssss", 
            $booking['venue'], 
            $booking['fees'], 
            $booking['name'], 
            $booking['phone'], 
            $booking['date'], 
            $booking['email'], 
            $booking['start_time'], 
            $booking['end_time']
        );

        if ($stmt->execute()) {
            unset($_SESSION['booking_details']); // Clear the session data
            echo "success";
        } else {
            echo "Error submitting booking: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request or missing booking details.";
}
?>