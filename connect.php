<?php
    session_start();

    // Retrieve the form inputs
    $Name = $_POST['name'];
    $Email = strtolower($_POST['email']);
    $IC = $_POST['ic'];
    $Phone = $_POST['phone'];  
    $Pwd = $_POST['password'];

    // Store user data in session
    $_SESSION['user_data'] = [
        'name' => $Name,
        'email' => $Email,
        'ic' => $IC,
        'phone' => $Phone,
        'password' => $Pwd
    ];

    $conn = new mysqli('localhost', 'root', '', 'selangorsportclub');
    
    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    } else {
        $checkQuery = $conn->prepare("SELECT * FROM member WHERE Name = ? OR Email = ? OR IC = ? OR Phone = ?");
        $checkQuery->bind_param("ssss", $Name, $Email, $IC, $Phone);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if($result->num_rows > 0){
            $usernameTaken = false;
            $emailTaken = false;
            $icTaken = false;
            $phoneTaken = false;

            while ($row = $result->fetch_assoc()) {
                if ($row['Name'] === $Name) $usernameTaken = true;
                if ($row['Email'] === $Email) $emailTaken = true;
                if ($row['IC'] === $IC) $icTaken = true;
                if ($row['Phone'] === $Phone) $phoneTaken = true;
            }

            if ($usernameTaken) {
                echo "<script>
                        alert('Username has already been selected by another member. Please use a different username.');
                        window.location.href='sign_in.html';
                      </script>";
            } elseif ($emailTaken) {
                echo "<script>
                        alert('Email has already been registered. Please use a different email.');
                        window.location.href='sign_in.html';
                      </script>";
            } elseif ($icTaken) {
                echo "<script>
                        alert('This IC number is already registered.');
                        window.location.href='sign_in.html';
                      </script>";
            } elseif ($phoneTaken) {
                echo "<script>
                        alert('This phone number has been registered before.');
                        window.location.href='sign_in.html';
                      </script>";
            }
        } else {
            // Redirect to payment page
            header("Location: payment.php");
            exit();
        }

        $checkQuery->close();
        
    }
?>