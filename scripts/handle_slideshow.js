// Initialize the slide index
var slideIndex = 1;
var slides = document.getElementsByClassName("mySlides");
var initialLoad = true;
var animating = false; // Flag to check if a transition is currently happening

// Function to change the slide
function plusSlides(n) {
  if (animating) return; // Exit the function if a transition is in progress
  animating = true; // Set the flag when the transition starts

  var currentSlide = slideIndex;
  slideIndex += n;
  if (slideIndex > slides.length) {
    slideIndex = 1; // Loop back to the first slide if it goes beyond the last one
  } else if (slideIndex < 1) {
    slideIndex = slides.length; // Loop to the last slide if it goes before the first one
  }
  applyTransition(currentSlide, slideIndex, n > 0 ? 'left' : 'right');
}

// Function to show a specific slide
function showSlides(n) {
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // Handle wrapping of slide index
  if (n > slides.length) { slideIndex = 1; }
  if (n < 1) { slideIndex = slides.length; }

  // Display the current slide
  slides[slideIndex - 1].style.display = "flex";
  if (initialLoad) {
    slides[slideIndex - 1].style.transition = "none";
    initialLoad = false; // Set to false after initial setup
  } else {
    slides[slideIndex - 1].style.transition = "transform 0.5s ease-in-out";
  }
}

// Function to apply transition effects
function applyTransition(current, next, direction) {
  slides[next - 1].style.display = "flex";
  slides[next - 1].style.transform = `translateX(${direction === 'left' ? '100%' : '-100%'})`;
  slides[current - 1].style.transition = "transform 0.5s ease-in-out";
  slides[next - 1].style.transition = "transform 0.5s ease-in-out";
  slides[current - 1].style.transform = `translateX(${direction === 'left' ? '-100%' : '100%'})`;
  slides[next - 1].style.transform = "translateX(0)";

  // Set timeout to reset the animation flag and hide the previous slide
  setTimeout(() => {
    slides[current - 1].style.display = "none";
    animating = false; // Reset the flag when the transition ends
  }, 500); // This timeout duration should match the transition duration
}

// Display the first slide initially
document.addEventListener("DOMContentLoaded", function() {
  showSlides(slideIndex);
});
