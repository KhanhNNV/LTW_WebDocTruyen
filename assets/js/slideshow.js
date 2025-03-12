let slideIndex = 0; // Start at the first slide
showSlides(); // Show the first slide

function showSlides() {
    let slides = document.getElementsByClassName("list-img");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; // Hide all slides
    }
    slideIndex++; // Move to the next slide
    if (slideIndex > slides.length) {
        slideIndex = 1; // Reset to the first slide
    }
    slides[slideIndex - 1].style.display = "block"; // Show the current slide
    setTimeout(showSlides, 5000); // Change slide every 3 seconds
}

// Function to change slides manually
function plusSlides(n) {
    slideIndex += n; // Change slide index
    if (slideIndex > document.getElementsByClassName("list-img").length) {
        slideIndex = 1; // Reset to the first slide
    }
    if (slideIndex < 1) {
        slideIndex = document.getElementsByClassName("list-img").length; // Go to the last slide
    }
    showSlidesManually(); // Show the selected slide
}

// Function to select a specific slide when clicked
function currentSlide(n) {
    slideIndex = n; // Set the slide index to the clicked slide
    showSlidesManually(); // Show the selected slide
}

function showSlidesManually() {
    let slides = document.getElementsByClassName("list-img");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; // Hide all slides
    }
    slides[slideIndex - 1].style.display = "block"; // Show the current slide
}