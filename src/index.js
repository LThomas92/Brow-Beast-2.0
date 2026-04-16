/**
 * The Brow Beast — JS Entry Point
 * Save as src/index.js
 */

import { initNav }         from './modules/nav.js';
// import { initGallery, initBASliders } from './modules/gallery.js';
// import { initServiceQuiz } from './modules/service-quiz.js';
// import { initFAQ }         from './modules/faq.js';
import { initContact }     from './modules/contact.js';

document.addEventListener( 'DOMContentLoaded', () => {
  initNav();
  // initGallery();
  // initServiceQuiz();
  // initFAQ();
  initContact();
} );

// // BA sliders need images to have dimensions before clip-path works.
// // window load fires after all images are loaded — much more reliable
// // than DOMContentLoaded for anything that depends on image layout.
// window.addEventListener( 'load', () => {
//   initBASliders();
// } );