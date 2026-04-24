<?php
/**
 * The Brow Beast — Footer Template
 */
?>

<footer class="site-footer">

  <!-- ── Brand column ─────────────────────────────────────────── -->
  <div class="footer-brand">
    <?php if ( has_custom_logo() ) :
      echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, [
        'class'   => 'footer-logo-img',
        'loading' => 'lazy',
      ] );
    else : ?>
      <div class="footer-logo">The Brow <span>Beast</span></div>
    <?php endif; ?>

    <p class="footer-text">Expert eyebrow artistry in Great Neck, NY. Every brow is crafted with precision, passion, and a deep love for the craft.</p>

    <p class="footer-text footer-address">
      2 Hicks Lane, Great Neck, NY 11024<br>
      <a href="tel:5168407314">516-840-7314</a>
    </p>

    <!-- Social icons -->
    <div class="footer-social">
      <a href="https://www.instagram.com/thebrowbeast/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="20" rx="5"/>
          <circle cx="12" cy="12" r="4"/>
          <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
        </svg>
      </a>
      <!-- TikTok -->
      <a href="https://www.tiktok.com/@thebrowbeast" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/>
        </svg>
      </a>
      <a href="#" aria-label="Facebook">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
        </svg>
      </a>
    </div>
  </div>

  <!-- ── Navigate column — WordPress menu ─────────────────────── -->
  <div class="footer-col">
    <div class="footer-col-title">Navigate</div>
    <div class="footer-links">
      <?php
      wp_nav_menu( [
        'theme_location' => 'footer',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'fallback_cb'    => false,
        'walker'         => new Browbeast_Footer_Walker(),
      ] );

      if ( ! has_nav_menu( 'footer' ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>">About</a>
        <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>" target="_blank" rel="noopener noreferrer">Book an Appointment</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- ── Connect column ───────────────────────────────────────── -->
  <div class="footer-col">
    <div class="footer-col-title">Connect</div>
    <div class="footer-links">
      <a href="https://www.instagram.com/thebrowbeast/" target="_blank" rel="noopener noreferrer">Instagram</a>
      <a href="https://www.tiktok.com/@thebrowbeast" target="_blank" rel="noopener noreferrer">TikTok</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' ) ); ?>">Contact Us</a>
    </div>
  </div>

</footer>

<!-- ── Footer bottom bar ──────────────────────────────────────── -->
<div class="footer-bottom">
  <span>© <?php echo date( 'Y' ); ?> The Brow Beast · Great Neck, NY</span>
  <div class="footer-bottom-links">
    <a href="<?php echo esc_url( 'https://lawscodes.com' ); ?>" target="_blank" rel="noopener noreferrer">Designed by Laws &amp; Codes</a>
    <span class="footer-bottom-sep">·</span>
    <a href="<?php echo esc_url( get_privacy_policy_url() ?: home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
    <span class="footer-bottom-sep">·</span>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'terms-conditions' ) ) ?: home_url( '/terms-conditions/' ) ); ?>">Terms &amp; Conditions</a>
    <span class="footer-bottom-sep">·</span>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'accessibility' ) ) ?: home_url( '/accessibility/' ) ); ?>">Accessibility Statement</a>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>