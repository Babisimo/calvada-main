var touchStartX = 0;
var touchEndX = 0;

function checkTouchSwipe() {
  if (touchEndX < touchStartX - 100) {
    plusSlides(1); // Swipe left to go to the next slide
  }
  if (touchEndX > touchStartX + 100) {
    plusSlides(-1); // Swipe right to go to the previous slide
  }
}

document.querySelector('.slideshow-container').addEventListener('touchstart', e => {
  touchStartX = e.changedTouches[0].screenX;
});

document.querySelector('.slideshow-container').addEventListener('touchend', e => {
  touchEndX = e.changedTouches[0].screenX;
  checkTouchSwipe();
});
