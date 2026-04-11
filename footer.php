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

      // Fallback links shown until a menu is assigned in WP Admin
      if ( ! has_nav_menu( 'footer' ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>">About</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'services' ) ) ); ?>">Services</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'gallery' ) ) ); ?>">Gallery</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>">Book Now</a>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'faq' ) ) ); ?>">FAQs</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- ── Services column — hardcoded, links to individual pages ── -->
  <div class="footer-col">
    <div class="footer-col-title">Services</div>
    <div class="footer-links">
      <?php
      // Pull live from service pages so adding a new page auto-appears
      $service_pages = get_pages( [
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'page-single-service.php',
        'sort_column'=> 'menu_order',
      ] );

      if ( ! empty( $service_pages ) ) :
        foreach ( $service_pages as $svc ) : ?>
          <a href="<?php echo esc_url( get_permalink( $svc->ID ) ); ?>">
            <?php echo esc_html( $svc->post_title ); ?>
          </a>
        <?php endforeach;
      else :
        // Hardcoded fallback until pages are created
        $services = [
          'strokeblend-combo-brows' => 'StrokeBlend™ Combo',
          'softblend-ombre-brows'   => 'SoftBlend™ Ombré',
          'henna-brows'             => 'Henna Brows',
          'brow-waxing'             => 'Brow Waxing',
          'corrections'             => 'Corrections',
        ];
        foreach ( $services as $slug => $label ) :
          $page = get_page_by_path( $slug );
          $url  = $page ? get_permalink( $page->ID ) : home_url( '/services/' );
        ?>
          <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
        <?php endforeach;
      endif; ?>
    </div>
  </div>

  <!-- ── Connect column ───────────────────────────────────────── -->
  <div class="footer-col">
    <div class="footer-col-title">Connect</div>
    <div class="footer-links">
      <a href="https://www.instagram.com/thebrowbeast/" target="_blank" rel="noopener noreferrer">Instagram</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' ) ); ?>">Contact Us</a>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'faq' ) ) ?: home_url( '/faq/' ) ); ?>">FAQs</a>
      <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>" target="_blank" rel="noopener noreferrer">Book an Appointment</a>
    </div>
  </div>

</footer>

<!-- ── Footer bottom bar ──────────────────────────────────────── -->
<div class="footer-bottom">
  <span>© <?php echo date( 'Y' ); ?> The Brow Beast · Great Neck, NY</span>
  <span>
    <a target="_blank" href="<?php echo esc_url('https://lawscodes.com'); ?>">Designed by Laws & Codes</a>
     <span class="footer-bottom-sep">·</span>
    <a href="<?php echo esc_url( get_privacy_policy_url() ?: home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
    <span class="footer-bottom-sep">·</span>
    <a href="<?php echo esc_url(get_permalink( get_page_by_path( '/terms-conditions/' ))); ?>">Terms &amp; Conditions</a>
     <span class="footer-bottom-sep">·</span>
     <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'accessibility' ) )); ?>">Accessibility Statement</a>
  </span>
</div>

<?php wp_footer(); ?>
</body>
</html>