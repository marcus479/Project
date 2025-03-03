document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Clear previous error messages
    document.getElementById('nameError').innerText = '';
    document.getElementById('emailError').innerText = '';
    document.getElementById('numberError').innerText = '';
    document.getElementById('messageError').innerText = '';

    // Get form values
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const number = document.getElementById('number').value;
    const message = document.getElementById('message').value;

    let isValid = true;

    // Validation
    if (name.length < 2) {
        document.getElementById('nameError').innerText = 'Name must be at least 2 characters.';
        isValid = false;
    }
    if (!/\S+@\S+\.\S+/.test(email)) {
        document.getElementById('emailError').innerText = 'Please enter a valid email address.';
        isValid = false;
    }
    if (number.length < 10) {
        document.getElementById('numberError').innerText = 'Phone number must be at least 10 digits.';
        isValid = false;
    }
    if (message.length < 10) {
        document.getElementById('messageError').innerText = 'Message must be at least 10 characters.';
        isValid = false;
    }

    
    // If valid, send data to PHP file
    if (isValid) {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('number', number);
        formData.append('message', message);

        fetch('ContactUs.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display the response from the PHP file
            document.getElementById('contactForm').reset(); // Reset the form
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the form.');
        });
    }
});



//Typing Function
const phrases = [
    "Contact Us and Tell Us Your Feeling !!",
    "We Would Like To Hear From You !!"
];

let i = 0; // Current phrase index
let j = 0; // Current character index
let currentPhrase = [];
let isDeleting = false;
let isEnd = false;

function loop() {
    isEnd = false;
    document.getElementById('typing').innerHTML = currentPhrase.join('');

    if (!isDeleting && j <= phrases[i].length) {
        // Typing the phrase
        currentPhrase.push(phrases[i][j]);
        j++;
    }

    if (isDeleting && j >= 0) {
        // Deleting the phrase
        currentPhrase.pop();
        j--;
    }

    // When the phrase is completely typed out
    if (j === phrases[i].length) {
        isEnd = true;
        isDeleting = true;
    }

    // When the phrase is completely deleted
    if (isDeleting && j === 0) {
        currentPhrase = [];
        isDeleting = false;
        i++;
        if (i === phrases.length) {
            i = 0; // Loop back to the first phrase
        }
    }

    const normalSpeed = 100;
    const fastSpeed = 50;
    const pauseTime = 2000;

    let typingSpeed = isEnd ? pauseTime : (isDeleting ? fastSpeed : normalSpeed);

    setTimeout(loop, typingSpeed);
}

// Start the typing loop
loop();