// Function Auto-Scroll
const scrollGallery = document.getElementById('scrollGallery');
let scrollAmount = 0;
const scrollStep = 2;  // Number of pixels to scroll each time

// Function to auto-scroll the gallery
function autoScrollGallery() {
    scrollAmount += scrollStep;

    // Check if it reaches the end, then reset to the start
    if (scrollAmount >= scrollGallery.scrollWidth - scrollGallery.clientWidth) {
        scrollAmount = 0;  // Reset scroll position to the start
    }

    // Scroll the gallery
    scrollGallery.scrollLeft = scrollAmount;

    // Repeat the function every 40ms for smooth animation
    setTimeout(autoScrollGallery, 40);
}

// Start the automatic scrolling
window.onload = function () {
    autoScrollGallery();  // Start scrolling when the window loads
};


// Get the modal
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

// Get all buttons with the class 'event-more-info'
var buttons = document.querySelectorAll(".event-more-info");

// Add click event listener to each button
buttons.forEach(function (button) {
    button.addEventListener("click", function () {
        modal.style.display = "block";
        modalImg.src = this.getAttribute("data-image");
        captionText.innerHTML = this.getAttribute("data-caption");
    });
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}