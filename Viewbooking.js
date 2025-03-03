// Function to fetch and load booking details into a form container
function loadBookingDetails() {
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();


// Function to fetch and load booking details into a form container
function loadBookingDetails() {
    // Create a new XMLHttpRequest object to handle the request
    const xhr = new XMLHttpRequest();

    // Configure the request using the GET method, targeting 'Viewbooking.php'
    // The third argument 'true' indicates the request is asynchronous
    xhr.open("GET", "Viewbooking.php", true);

    // Define the onload callback function, which is called when the response is received
    xhr.onload = function() {
        // Check if the response status is 200, indicating the request was successful
        if (xhr.status === 200) {
            // Parse the server response from JSON format into a JavaScript object
            const booking = JSON.parse(xhr.responseText);

            // Check if the booking object contains an error field
            // If so, display a message indicating no booking details were found
            if (booking.error) {
                document.getElementById('booking-details').innerHTML = "<p>No booking details found.</p>";
            } else {
                // If no error, dynamically generate a form with the booking details
                // The form fields are populated with values from the booking object and marked readonly
                document.getElementById('booking-details').innerHTML = `
                    <form class="booking-form">
                        <div class="form-group">
                            <label for="venue">Venue</label>
                            <input type="text" id="venue" name="venue" value="${booking.Venue}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fees">Fees</label>
                            <input type="text" id="fees" name="fees" value="${booking.Fees}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="${booking.Name}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" value="${booking.Phone}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" value="${booking.Date}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="${booking.Email}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="start-time">Start Time</label>
                            <input type="time" id="start-time" name="start-time" value="${booking['Start time']}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="end-time">End Time</label>
                            <input type="time" id="end-time" name="end-time" value="${booking['End time']}" readonly>
                        </div>
                    </form>
                `;
            }
        } else {
            // If the request failed (status is not 200), display an error message
            document.getElementById('booking-details').innerHTML = "<p>Error fetching booking details.</p>";
        }
    };

    // Send the configured request to the server
    xhr.send();
}

// Call the loadBookingDetails function as soon as the page loads
// The setInterval function ensures the booking details are refreshed every 5 seconds
window.onload = function() {
    loadBookingDetails();  // Load booking details immediately when the page loads
    setInterval(loadBookingDetails, 5000);  // Refresh the booking details every 5 seconds
};




}
