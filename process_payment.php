<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment details
    $cardNumber = $_POST['card_number'];
    $cardName = $_POST['card_name'];
    $expiryDate = $_POST['expiry_date'];
    $cvc = $_POST['cvc'];

    // Retrieve user data from session
    $userData = $_SESSION['user_data'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'selangorsportclub');
    
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert user data into member table
        $stmt = $conn->prepare("INSERT INTO member (Name, Email, IC, Phone, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $userData['name'], $userData['email'], $userData['ic'], $userData['phone'], $userData['password']);
        $stmt->execute();
        $memberId = $stmt->insert_id;
        $stmt->close();

        // Insert payment data into payment table
        $stmt = $conn->prepare("INSERT INTO payment (MemberID, CardNumber, CardName, ExpiryDate, CVC) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $memberId, $cardNumber, $cardName, $expiryDate, $cvc);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();

        // Clear session data
        unset($_SESSION['user_data']);

        // Redirect to success page
        echo "<script>
                alert('Registration and payment successful!');
                window.location.href='login_page.php';
              </script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "<script>
                alert('An error occurred. Please try again.');
                window.location.href='sign_in.html';
              </script>";
    }

    $conn->close();
} else {
    // Redirect to sign up page if accessed directly
    header("Location: sign_in.html");
    exit();
}
?>