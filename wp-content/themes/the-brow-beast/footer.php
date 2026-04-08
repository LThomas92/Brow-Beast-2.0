<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Brow_Beast_2.0
 */

?>

<footer class="site-footer">
  <div>
    <div class="footer-logo">The Brow Beast</div>
    <p class="footer-text">Expert eyebrow artistry in Great Neck, NY. Every brow is crafted with precision, passion, and a deep love for the craft.</p>
    <p class="footer-text" style="margin-top:14px;">2 Hicks Lane, Great Neck, NY 11024<br>516-840-7314</p>
  </div>
  <div>
    <div class="footer-col-title">Navigate</div>
    <div class="footer-links">
      <a href="about.html">About</a>
      <a href="services.html">Services</a>
      <a href="gallery.html">Gallery</a>
      <a href="booking.html">Book Now</a>
      <a href="#">Online Course</a>
    </div>
  </div>
  <div>
    <div class="footer-col-title">Services</div>
    <div class="footer-links">
      <a href="services.html">StrokeBlend™ Combo</a>
      <a href="services.html">SoftBlend™ Ombré</a>
      <a href="services.html">Henna Brows</a>
      <a href="services.html">Brow Waxing</a>
      <a href="services.html">Corrections</a>
    </div>
  </div>
  <div>
    <div class="footer-col-title">Connect</div>
    <div class="footer-links">
      <a href="https://www.instagram.com/thebrowbeast/" target="_blank">Instagram</a>
      <a href="#">Facebook</a>
      <a href="#">Contact Us</a>
      <a href="#">FAQs</a>
    </div>
  </div>
</footer>
<div class="footer-bottom">
  <span>© 2026 The Brow Beast · Great Neck, NY</span>
  <span><a href="">Laws & Codes</a></span>
</div>

<script>
  const input = document.getElementById('navSearch');
  const dropdown = document.getElementById('searchDropdown');
  input.addEventListener('focus', () => dropdown.classList.add('open'));
  document.addEventListener('click', e => {
    if (!e.target.closest('.nav-search-wrap') && !e.target.closest('.search-dropdown')) {
      dropdown.classList.remove('open');
    }
  });
  document.querySelectorAll('.sd-tag').forEach(tag => {
    tag.addEventListener('click', () => { input.value = tag.textContent; dropdown.classList.remove('open'); });
  });
</script>
</body>
</html>
