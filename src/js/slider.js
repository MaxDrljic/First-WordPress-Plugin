// Global(not really global, only for this file) variables
const sliderView = document.querySelector('.max-slider--view > ul'),
  sliderViewSlides = document.querySelectorAll('.max-slider--view__slides'),
  arrowLeft = document.querySelector('.max-slider--arrows__left'),
  arrowRight = document.querySelector('.max-slider--arrows__right'),
  sliderLength = sliderViewSlides.length;


// Sliding function
const slideMe = (sliderViewItems, isActiveItem) => {
  // Update the classes
  isActiveItem.classList.remove('is-active');
  sliderViewItems.classList.add('is-active');


  // Css transform the active slide position
  sliderView.setAttribute('style', 'transform:translateX(-' + sliderViewItems.offsetLeft + 'px)');
}



// Before sliding function
// No parentheses for parameters because there is only one parameter
const beforeSliding = i => {
  let isActiveItem = document.querySelector('.max-slider--view__slides.is-active'),
    currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i,
    nextItem = currentItem + i,
    sliderViewItems = document.querySelector(`.max-slider--view__slides:nth-child(${nextItem})`);

  // if nextItem is bigger than the number of slides
  if (nextItem > sliderLength) {
    sliderViewItems = document.querySelector('.max-slider--view__slides:nth-child(1)');
  }

  // if nextItem is 0
  if (nextItem == 0) {
    sliderViewItems = document.querySelector(`.max-slider--view__slides:nth-child(${sliderLength})`);
  }

  // Trigger the sliding method
  slideMe(sliderViewItems, isActiveItem);
}


// Triggers arrows
arrowRight.addEventListener('click', () => beforeSliding(1));
arrowLeft.addEventListener('click', () => beforeSliding(0));
