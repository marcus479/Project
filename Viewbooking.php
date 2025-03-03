<?php
// Include the database connection file to connect to the database
include 'CConnect_db.php';  // This file contains the logic to connect to the database

// Query to retrieve the most recent booking from the 'bookinguser' table
$sql = "SELECT * FROM bookinguser ORDER BY id DESC LIMIT 1";  // Fetch the most recent booking by ordering the table in descending order by ID and limiting to 1
$result = $conn->query($sql);  // Execute the query and store the result

$booking = array();  // Initialize an empty array to hold the booking details

// Check if any results were returned from the query
if ($result->num_rows > 0) {
    // If there's a booking, fetch the first (and only) result as an associative array
    $booking = $result->fetch_assoc();
    // Return booking details as a JSON object
    echo json_encode($booking);
} else {
    // If no bookings were found, return an error message in JSON format
    echo json_encode(["error" => "No bookings found."]);
}

// Close the database connection to free up resources
$conn->close();
?>



