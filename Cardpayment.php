<?php
session_start();
include 'CConnect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['booking_details'])) {
    // Capture card payment data
    $card_number = $conn->real_escape_string($_POST['card-number']);
    $card_holder_name = $conn->real_escape_string($_POST['card-holder-name']);
    $card_name = $conn->real_escape_string($_POST['card-name']);
    $expiry_date = $conn->real_escape_string($_POST['expiry-date']);
    $cvc = $conn->real_escape_string($_POST['cvc']);

    // Retrieve booking details from session
    $booking = $_SESSION['booking_details'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert booking details
        $sql_booking = "INSERT INTO bookinguser (Venue, Fees, Name, Phone, Date, Email, `Start time`, `End time`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_booking = $conn->prepare($sql_booking);
        $stmt_booking->bind_param("ssssssss", 
            $booking['venue'], 
            $booking['fees'], 
            $booking['name'], 
            $booking['phone'], 
            $booking['date'], 
            $booking['email'], 
            $booking['start_time'], 
            $booking['end_time']
        );
        $stmt_booking->execute();
        $stmt_booking->close();

        // Insert card payment details
        $sql_card = "INSERT INTO card_payment (card_number, card_holder_name, card_name, expiry_date, cvc) 
                     VALUES (?, ?, ?, ?, ?)";
        $stmt_card = $conn->prepare($sql_card);
        $stmt_card->bind_param("sssss", $card_number, $card_holder_name, $card_name, $expiry_date, $cvc);
        $stmt_card->execute();
        $stmt_card->close();

        // Commit transaction
        $conn->commit();

        // Clear session and redirect
        unset($_SESSION['booking_details']);
        header("Location: Paymentsuccessful.html");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
} else {
    echo "Invalid request or missing booking details.";
}
?>