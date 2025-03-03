<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" type="image/png" href="images/website_logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: rgb(0, 173, 230);
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 16px;
        }
        .container {
            width: 70%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            width: 48%;
            margin-bottom: 15px;
        }
        label {
            color: #555;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #00bfff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="color: white;">PAYMENT</h1>
    </header>
    <div class="container">
        <h1>Enter Payment Details</h1>
        <form id="paymentForm" onsubmit="return validateForm()" action="process_payment.php" method="post">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
                <label for="card_holder">Card Holder Name:</label>
                <input type="text" id="card_holder" name="card_holder" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="card_name">Name on Card:</label>
                <input type="text" id="card_name" name="card_name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvc">CVC:</label>
                <input type="text" id="cvc" name="cvc" placeholder="123" required>
            </div>
            <button type="submit">Pay Now</button>
        </form>
    </div>
    <script>
        document.getElementById("card_number").addEventListener('input', function (e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            if (value.length > 16) {
                value = value.slice(0, 16);
            }
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            e.target.value = formattedValue.trim();
        });

        document.getElementById("expiry_date").addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });

        document.getElementById("cvc").addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 3) {
                value = value.slice(0, 3);
            }
            e.target.value = value;
        });

        function validateForm() {
            const cardNumber = document.getElementById("card_number").value;
            const cardName = document.getElementById("card_name").value;
            const cardHolder = document.getElementById("card_holder").value;
            const expiryDate = document.getElementById("expiry_date").value;
            const cvc = document.getElementById("cvc").value;

            // Basic validation (you may want to add more comprehensive checks)
            if (!/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/.test(cardNumber)) {
                alert("Please enter a valid 16-digit card number.");
                return false;
            }

            if (!/^[a-zA-Z\s]+$/.test(cardName)) {
                alert("Please enter a valid name on the card.");
                return false;
            }

            if (!/^[a-zA-Z\s]+$/.test(cardHolder)) {
                alert("Please enter a valid card holder name.");
                return false;
            }

            const [month, year] = expiryDate.split('/');
            if (!/^\d{2}\/\d{2}$/.test(expiryDate) || parseInt(month) < 1 || parseInt(month) > 12) {
                alert("Please enter a valid expiry date in MM/YY format. Month should be between 01 and 12.");
                return false;
            }

            if (!/^\d{3}$/.test(cvc)) {
                alert("Please enter a valid 3-digit CVC.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>