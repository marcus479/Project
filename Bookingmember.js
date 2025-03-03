// Function to update the fees based on the selected venue
function updateFees() {
    const venue = document.getElementById("venue").value;
    const feesInput = document.getElementById("fees");
    
    const fees = {
        "Swimming": "RM5",
        "Conference Room": "RM5",
        "Library": "RM5",
        "Snooker": "RM8",
        "Tennis": "RM10",
        "Gymnasium": "RM3"
    };

    if (venue in fees) {
        feesInput.value = fees[venue];
    } else {
        feesInput.value = "";
    }
}

// Function to validate First Name (only alphabets and spaces allowed)
function validateFirstName() {
    const firstName = document.getElementById('name').value.trim();
    const nameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)*$/;

    if (!nameRegex.test(firstName)) {
        document.getElementById('error-message').innerText = "Error: Name must contain only letters and can include spaces between words.";
        return false;
    }
    return true;
}

// Function to validate Phone Number (10-11 digits, must start with 01, no symbols or letters)
function validatePhoneNumber() {
    const phone = document.getElementById('phone').value;
    const phoneRegex = /^01\d{8,9}$/;

    if (!phoneRegex.test(phone)) {
        document.getElementById('error-message').innerText = "Error: Phone number must start with 01 and contain 10-11 digits without any symbols or letters.";
        return false;
    }
    return true;
}

// Function to validate Date (current or future)
function validateDate() {
    const selectedDate = new Date(document.getElementById('date').value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (selectedDate < today) {
        document.getElementById('error-message').innerText = "Error: The selected date cannot be in the past.";
        return false;
    }
    return true;
}

// Function to validate Email
function validateEmail() {
    const email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        document.getElementById('error-message').innerText = "Error: Please enter a valid email address (e.g., alex123@gmail.com).";
        return false;
    }
    return true;
}

// Function to validate Time (hour only, no minutes)
function validateTimeRange() {
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;

    const startDate = new Date(`1970-01-01T${startTime}`);
    const endDate = new Date(`1970-01-01T${endTime}`);

    if (startDate.getMinutes() !== 0 || endDate.getMinutes() !== 0) {
        document.getElementById('error-message').innerText = "Error: Time must be set to the hour only, no minutes allowed.";
        return false;
    }

    if (startDate >= endDate) {
        document.getElementById('error-message').innerText = "Error: The end time must be after the start time.";
        return false;
    }

    return true;
}

// Function to validate all form fields before submission
function validateForm(event) {
    event.preventDefault();

    const isFirstNameValid = validateFirstName();
    const isPhoneNumberValid = validatePhoneNumber();
    const isDateValid = validateDate();
    const isEmailValid = validateEmail();
    const isTimeValid = validateTimeRange();

    if (isFirstNameValid && isPhoneNumberValid && isDateValid && isEmailValid && isTimeValid) {
        const formData = new FormData(document.getElementById('booking-form'));

        fetch('Booking.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'Paymentmethod_member.html';
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (data) {
                document.getElementById('error-message').innerText = data;
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            document.getElementById('error-message').innerText = 'Error: ' + error.message;
        });
    }
}

// Function to go back to the previous page
function goBack() {
    window.history.back();
}

// Add event listeners when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('booking-form').addEventListener('submit', validateForm);
    document.getElementById('venue').addEventListener('change', updateFees);
});