<!DOCTYPE html> <!-- Declares the document type as HTML5 -->
<html lang="en"> <!-- Specifies the language of the page as English -->
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures proper scaling on mobile devices -->
    <title>Book Your Sports Slot</title> <!-- Sets the title of the page displayed on the browser tab -->
    <link rel="stylesheet" href="Booking.css"> <!-- Links to the external CSS file for styling -->
    <link rel="icon" type="image/png" href="images/page logo.jpeg"> <!-- Sets the favicon (icon displayed on the browser tab) -->
</head>
<body>
    <header> <!-- Header section for the page title -->
        <div class="header-container"> <!-- Container for centering the header content -->
            <h1>BOOKING</h1> <!-- Main heading for the booking page -->
        </div>
    </header>

    <section class="booking-section"> <!-- Section for booking form content -->
        <div class="booking-details"> <!-- Container for booking details text -->
            <h2>Booking Details</h2> <!-- Subheading for the booking details section -->
            <p>Please fill in the details below to book your desired sports slot.</p> <!-- Instructional text for the form -->
        </div>
        <div class="form-container"> <!-- Container for the booking form -->
            <form id="booking-form" class="booking-form" onsubmit="validateForm(event)" action="Booking.php" method="POST"> <!-- Form for booking with ID, class, validation on submit, and action to send data to Booking.php using POST method -->
                
                <!-- Venue and Fees -->
                <div class="form-row full-width"> <!-- A row in the form spanning full width for venue and fees fields -->
                    <div class="form-group"> <!-- Form group for the venue field -->
                        <label for="venue">Venue</label> <!-- Label for venue dropdown -->
                        <select id="venue" name="venue" onchange="updateFees()" required> <!-- Dropdown menu for selecting venue, updates fees based on selection -->
                            <option value="">Select Venue</option> <!-- Placeholder option -->
                            <option value="Swimming">Swimming</option> <!-- Option for Swimming venue -->
                            <option value="Conference Room">Conference Room</option> <!-- Option for Conference Room -->
                            <option value="Library">Library</option> <!-- Option for Library -->
                            <option value="Snooker">Snooker</option> <!-- Option for Snooker -->
                            <option value="Tennis">Tennis</option> <!-- Option for Tennis -->
                            <option value="Gymnasium">Gymnasium</option> <!-- Option for Gymnasium -->
                        </select>
                    </div>
                    <div class="form-group"> <!-- Form group for the fees field -->
                        <label for="fees">Fees (per hour)</label> <!-- Label for fees input -->
                        <input type="text" id="fees" name="fees" placeholder="RMXXX" readonly required> <!-- Input for fees, readonly as it is calculated automatically -->
                    </div>
                </div>

                <!-- Name and Phone -->
                <div class="form-row full-width"> <!-- A row in the form spanning full width for name and phone fields -->
                    <div class="form-group"> <!-- Form group for the name field -->
                        <label for="name">Name</label> <!-- Label for name input -->
                        <input type="text" id="name" name="name" placeholder="John" required> <!-- Input for name, required field -->
                    </div>
                    <div class="form-group"> <!-- Form group for the phone field -->
                        <label for="phone">Phone</label> <!-- Label for phone input -->
                        <input type="tel" id="phone" name="phone" placeholder="012-345-6789" required> <!-- Input for phone number with a placeholder, required field -->
                    </div>
                </div>

                <!-- Date and Email -->
                <div class="form-row"> <!-- A row in the form for date and email fields -->
                    <div class="form-group"> <!-- Form group for the date field -->
                        <label for="date">Date</label> <!-- Label for date input -->
                        <input type="date" id="date" name="date" required> <!-- Input for date selection, required field -->
                    </div>
                    <div class="form-group"> <!-- Form group for the email field -->
                        <label for="email">Email</label> <!-- Label for email input -->
                        <input type="email" id="email" name="email" placeholder="name@gmail.com" required> <!-- Input for email address with a placeholder, required field -->
                    </div>
                </div>

                <!-- Time Selection -->
                <div class="form-row"> <!-- A row in the form for start and end time fields -->
                    <div class="form-group"> <!-- Form group for the start time field -->
                        <label for="start-time">Start Time</label> <!-- Label for start time input -->
                        <input type="time" id="start-time" name="start-time" required> <!-- Input for selecting start time, required field -->
                    </div>
                    <div class="form-group"> <!-- Form group for the end time field -->
                        <label for="end-time">End Time</label> <!-- Label for end time input -->
                        <input type="time" id="end-time" name="end-time" required> <!-- Input for selecting end time, required field -->
                    </div>
                </div>

                <!-- Error Message -->
                <div id="error-message" class="error"></div> <!-- Placeholder for error message display, will be populated dynamically if validation fails -->

                <!-- Submit Button -->
                <input type="submit" value="SUBMIT BOOKING"> <!-- Submit button for the form with the text "SUBMIT BOOKING" -->
            </form>
        </div>
    </section>

    <script src="Booking.js"></script> <!-- Links to external JavaScript file for form validation and other functionality -->
</body>
</html>
