<?php
/**
 * 404 Page — The Brow Beast
 */
get_header();
$booking_url  = get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' );
$course_url = get_permalink( get_page_by_path( 'course' ) ) ?: home_url( '/course/' );
$contact_url  = get_permalink( get_page_by_path( 'contact' ) )  ?: home_url( '/contact/' );
?>

<div class="not-found-page">

  <!-- Decorative background text -->
  <div class="not-found-bg-text" aria-hidden="true">404</div>

  <div class="not-found-inner">

    <div class="not-found-tag">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" aria-hidden="true">
        <circle cx="8" cy="8" r="6"/>
        <line x1="8" y1="5" x2="8" y2="8.5"/>
        <circle cx="8" cy="11" r="0.6" fill="currentColor" stroke="none"/>
      </svg>
      Page not found
    </div>

    <h1 class="not-found-headline">
      We lost this page,<br>
      but your <em>perfect brow</em><br>
      is still waiting.
    </h1>

    <p class="not-found-sub">
      The page you're looking for doesn't exist or may have moved.
      Let's get you back on track.
    </p>

    <!-- Quick links -->
    <div class="not-found-links">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="not-found-link">
        <div class="nfl-icon">→</div>
        <div>
          <div class="nfl-name">Home</div>
          <div class="nfl-sub">Back to the beginning</div>
        </div>
      </a>
      <a target="_blank" href="<?php echo esc_url( $booking_url ); ?>" class="not-found-link">
        <div class="nfl-icon">✦</div>
        <div>
          <div class="nfl-name">Services</div>
          <div class="nfl-sub">Browse all brow services</div>
        </div>
      </a>
      <a href="<?php echo esc_url( $course_url ); ?>" class="not-found-link">
        <div class="nfl-icon">◈</div>
        <div>
          <div class="nfl-name">Course</div>
          <div class="nfl-sub">Learn about our course</div>
        </div>
      </a>
      <a href="<?php echo esc_url( $contact_url ); ?>" class="not-found-link">
        <div class="nfl-icon">◇</div>
        <div>
          <div class="nfl-name">Contact</div>
          <div class="nfl-sub">Get in touch with Gabrielle</div>
        </div>
      </a>
    </div>

    <div class="not-found-cta">
      <a href="<?php echo esc_url( $booking_url ); ?>"
         class="btn-primary"
         target="_blank"
         rel="noopener noreferrer">
        Book an Appointment
      </a>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-ghost">
        Go Home
      </a>
    </div>

  </div>

</div>

<?php get_footer(); ?>