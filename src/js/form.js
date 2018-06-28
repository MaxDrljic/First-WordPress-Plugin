// DOMContentLoaded is a default DOM event which targets the whole DOM
document.addEventListener('DOMContentLoaded', function(e) {
  let testimonialForm = document.getElementById('max-testimonial-form');

  testimonialForm.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log('Prevent form to submit');
    // reset the form messages
    // validate the email address
    // collect all the data
    // ajax http post request
  })
})