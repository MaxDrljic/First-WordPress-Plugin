// Global(not really global, only for this file) variables
const sliderView = document.querySelector('.max-slider--view > ul'),
  sliderViewSlides = document.querySelectorAll('.max-slider--view__slides'),
  arrowLeft = document.querySelector('.max-slider--arrows__left'),
  arrowRight = document.querySelector('.max-slider--arrows__right'),
  sliderLength = sliderViewSlides.length;


// Sliding function




// Before sliding function
const beforeSliding = (i) => {
  console.log(i);
}


// Triggers arrows
arrowRight.addEventListener('click', () => beforeSliding(1));
arrowLeft.addEventListener('click', () => beforeSliding(0));
