// DOMContentLoaded is a default DOM event which targets the whole DOM
document.addEventListener('DOMContentLoaded', function(e) {
  let testimonialForm = document.getElementById('max-testimonial-form');

  testimonialForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // reset the form messages
    resetMessages()

    // collect all the data
    let data = {
      name: testimonialForm.querySelector('[name="name"]').value,
      email: testimonialForm.querySelector('[name="email"]').value,
      message: testimonialForm.querySelector('[name="message"]').value
    }

    // validate everything
    if (! data.name) {
      testimonialForm.querySelector('[data-error="invalidName"]').classList.add('show');
      return ;
    }

    if (! validateEmail(data.email)) {
      testimonialForm.querySelector('[data-error="invalidEmail"]').classList.add('show');
      return ;
    }

    if (! data.message) {
      testimonialForm.querySelector('[data-error="invalidMessage"]').classList.add('show');
      return ;
    }

    // ajax http post request
    let url = testimonialForm.dataset.url;
    console.log(url);
  });
});

function resetMessages() {
  document.querySelectorAll('.field-msg').forEach(field => field.classList.remove('show'));
}

function validateEmail(email) {
  let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}