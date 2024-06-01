import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const conceptButton = document.getElementById('concept-button');

conceptButton.addEventListener('click', () => {
  window.location.href = Routing.generate('app_concept');
});

(function () {
  "use strict";

  var carousels = function () {
    $(".owl-carousel1").owlCarousel({
      loop: true,
      center: true,
      margin: 0,
      responsiveClass: true,
      nav: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        680: {
          items: 2,
          nav: false,
          loop: false
        },
        1000: {
          items: 3,
          nav: true
        }
      }
    });
  };

  (function ($) {
    carousels();
  })(jQuery);
})();


document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('.toggle-details');
  buttons.forEach(button => {
      button.addEventListener('click', function() {
          const targetId = this.getAttribute('data-target');
          const details = document.getElementById(targetId);
          if (details.style.display === 'block') {
              details.style.display = 'none';
          } else {
              details.style.display = 'block';
          }
      });
  });
});


