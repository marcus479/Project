<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data
    $venue = $_POST['venue'];
    $fees = $_POST['fees'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $email = $_POST['email'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];

    // Generate a unique booking ID
    $booking_id = uniqid('BOOKING_');

    // Store booking details in session
    $_SESSION['booking_details'] = [
        'booking_id' => $booking_id,
        'venue' => $venue,
        'fees' => $fees,
        'name' => $name,
        'phone' => $phone,
        'date' => $date,
        'email' => $email,
        'start_time' => $start_time,
        'end_time' => $end_time
    ];

    // Redirect to payment method selection page
    header("Location: Paymentmethod.html");
    exit();
} else {
    echo "Invalid request. Expecting POST.";
}
?>