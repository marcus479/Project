// Handles the NFC click (Placeholder functionality)
function handleNFCClick() {
    alert("NFC Activated!"); // Displays an alert when the NFC icon is clicked
}

// Handles the Camera click (Placeholder functionality)
function handleCameraClick() {
    alert("Camera Activated!"); // Displays an alert when the camera icon is clicked
}

// Format card number to add a space after every 4 digits
function formatCardNumber(input) {
    const value = input.value.replace(/\D/g, ''); // Remove all non-digit characters
    input.value = value.replace(/(.{4})/g, '$1 ').trim(); // Add a space after every 4 digits
}

// Validate card number length and formatting
function validateCardNumber(input) {
    const value = input.value.replace(/\D/g, ''); // Remove non-digit characters
    if (value.length > 16) {
        input.value = value.slice(0, 16).replace(/(.{4})/g, '$1 ').trim(); // Truncate to 16 digits and format
    }
}

// Restrict input to alphabets and spaces
function restrictToAlphabets(input) {
    input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); // Remove any characters that are not alphabets or spaces
}

// Format expiry date in MM/YY format and validate MM to allow only 01-12
function formatExpiryDate(input) {
    let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
    if (value.length <= 2) {
        // Allow only values from 01 to 12 for month
        if (parseInt(value, 10) > 12) {
            value = '12'; // Set to '12' if input exceeds valid month range
        }
        input.value = value; // Allow up to 2 digits (MM)
    } else {
        input.value = value.slice(0, 2) + '/' + value.slice(2, 4); // Format as MM/YY
    }
}

// Restrict CVC to 3 digits
function restrictCVC(input) {
    input.value = input.value.replace(/\D/g, '').slice(0, 3); // Restrict input to 3 digits
}

// Validate the form before submission
function validateForm(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Capture form values
    const cardNumber = document.getElementById('card-number').value.replace(/\s/g, ''); // Remove spaces from card number
    const cardHolderName = document.getElementById('card-holder-name').value;
    const cardName = document.getElementById('card-name').value;
    const expiryDate = document.getElementById('expiry-date').value;
    const cvc = document.getElementById('cvc').value;

    // Validate fields
    const cardNumberValid = cardNumber.length === 16 && /^\d+$/.test(cardNumber); // Ensure the card number is 16 digits long
    const cardHolderValid = /^[a-zA-Z\s]+$/.test(cardHolderName); // Ensure the card holder name contains only alphabets
    const cardNameValid = /^[a-zA-Z\s]+$/.test(cardName); // Ensure the card name contains only alphabets
    const expiryDateValid = /^\d{2}\/\d{2}$/.test(expiryDate); // Ensure the expiry date is in the MM/YY format
    const cvcValid = /^\d{3}$/.test(cvc); // Ensure the CVC is 3 digits long

    // If all validations pass, submit the form
    if (cardNumberValid && cardHolderValid && cardNameValid && expiryDateValid && cvcValid) {
        document.querySelector('.payment-form').submit(); // Submit the form
    } else {
        alert("Please ensure all fields are filled correctly."); // Show an error message if any validation fails
    }
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const bookingId = urlParams.get('booking_id');
        document.getElementById('booking_id').value = bookingId;
    }
}


