/**
 * The Brow Beast — JS Entry Point
 *
 * 
 */

import { initNav }         from './modules/nav.js';
import { initSearch }      from './modules/search.js';
import { initGallery }     from './modules/gallery.js';
import { initBASliders }   from './modules/before-after.js';
import { initServiceQuiz } from './modules/service-quiz.js';
import { initFAQ }         from './modules/faq.js';
import { initContact }     from './modules/contact.js';

document.addEventListener( 'DOMContentLoaded', () => {
  initNav();
  initSearch();
  initGallery();
  initBASliders();
  initServiceQuiz();
  initFAQ();
  initContact();

  console.log( '[Brow Beast] JS initialised' );
} );