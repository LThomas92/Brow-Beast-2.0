<?php
/**
 * Template Name: Contact Page
 *
 * HOW TO USE:
 * 1. Save as page-contact.php in theme root
 * 2. WP Admin → Pages → Add New
 *    Title: Contact  |  Slug: contact
 *    Template: Contact Page
 *
 * ACF FIELDS — "Contact Page" field group
 * Location: Page Template == Contact Page
 *
 *   contact_tag          Text    e.g. "Get in Touch"
 *   contact_headline     Text    e.g. "We'd love to hear from you."
 *   contact_sub          Text    Supporting line
 *   contact_phone        Text    Phone number (plain text)
 *   contact_email        Email   Email address
 *   contact_address      Text    Street address
 *   contact_hours        Repeater → day_range (Text) + hours (Text)
 *   contact_map_embed    Textarea  Google Maps embed <iframe> code
 */

get_header();

$tag      = get_field( 'contact_tag' )      ?: 'Get in Touch';
$headline = get_field( 'contact_headline' ) ?: "We'd love to hear from you.";
$sub      = get_field( 'contact_sub' )      ?: 'Have a question about a service? Ready to book? Reach out and Gabrielle will get back to you personally.';
$phone    = get_field( 'contact_phone' )    ?: '516-840-7314';
$email    = get_field( 'contact_email' )    ?: '';
$address  = get_field( 'contact_address' )  ?: '2 Hicks Lane, Great Neck, NY 11024';
$hours    = get_field( 'contact_hours' )    ?: [
  [ 'day_range' => 'Tuesday – Friday',  'hours' => '10:00 AM – 7:00 PM' ],
  [ 'day_range' => 'Saturday',          'hours' => '9:00 AM – 5:00 PM' ],
  [ 'day_range' => 'Sunday – Monday',   'hours' => 'Closed' ],
];
$map_embed = get_field( 'contact_map_embed' ) ?: '';
?>

<!-- ── HERO BANNER ──────────────────────────────────────────────── -->
<section class="contact-hero">
  <div class="contact-hero-text">
    <div class="tag"><?php echo esc_html( $tag ); ?></div>
    <h1 class="contact-headline"><?php echo esc_html( $headline ); ?></h1>
    <p class="contact-sub"><?php echo esc_html( $sub ); ?></p>
  </div>
</section>

<!-- ── MAIN CONTENT ─────────────────────────────────────────────── -->
<section class="section section--white">
  <div class="contact-grid">

    <!-- LEFT: Contact info + hours + map ─────────────────────── -->
    <div class="contact-info">

      <div class="contact-info-block">
        <div class="contact-info-title">Studio Location</div>
        <p class="contact-info-val">
          <a href="https://maps.google.com/?q=<?php echo esc_attr( $address ); ?>"
             target="_blank" rel="noopener noreferrer">
            <?php echo esc_html( $address ); ?>
          </a>
        </p>
      </div>

      <?php if ( $phone ) : ?>
      <div class="contact-info-block">
        <div class="contact-info-title">Phone</div>
        <p class="contact-info-val">
          <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
            <?php echo esc_html( $phone ); ?>
          </a>
        </p>
      </div>
      <?php endif; ?>

      <?php if ( $email ) : ?>
      <div class="contact-info-block">
        <div class="contact-info-title">Email</div>
        <p class="contact-info-val">
          <a href="mailto:<?php echo esc_attr( $email ); ?>">
            <?php echo esc_html( $email ); ?>
          </a>
        </p>
      </div>
      <?php endif; ?>

      <?php if ( ! empty( $hours ) ) : ?>
      <div class="contact-info-block">
        <div class="contact-info-title">Studio Hours</div>
        <div class="contact-hours">
          <?php foreach ( $hours as $row ) : ?>
            <div class="hours-row">
              <span class="hours-day"><?php echo esc_html( $row['day_range'] ); ?></span>
              <span class="hours-time"><?php echo esc_html( $row['hours'] ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Social links -->
      <div class="contact-info-block">
        <div class="contact-info-title">Follow Along</div>
        <div class="contact-social">
          <a href="https://www.instagram.com/thebrowbeast/" target="_blank" rel="noopener noreferrer" class="contact-social-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5"/>
              <circle cx="12" cy="12" r="4"/>
              <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
            </svg>
            @thebrowbeast
          </a>
        </div>
      </div>

      <!-- Book CTA -->
      <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
         class="btn-primary contact-book-btn"
         target="_blank"
         rel="noopener noreferrer">
        Book an Appointment
      </a>

    </div>

    <!-- RIGHT: Contact form ─────────────────────────────────── -->
    <div class="contact-form-wrap">
      <div class="contact-form-header">
        <h2 class="contact-form-title">Send a <em>message</em></h2>
        <p class="contact-form-sub">Fill out the form and Gabrielle will get back to you within 24 hours.</p>
      </div>

      <?php
      // ── Using Contact Form 7 shortcode if installed
      // Install CF7: Plugins → Add New → "Contact Form 7" → Install
      // Then create a form and paste its shortcode below replacing [contact-form-7 ...]
      if ( function_exists( 'wpcf7' ) ) :
        echo do_shortcode( '[contact-form-7 id="your-form-id" title="Contact Form"]' );
      else :
        // ── Native HTML fallback form (processed via functions.php AJAX handler)
      ?>
      <form class="contact-form" id="contactForm" novalidate>
        <?php wp_nonce_field( 'browbeast_contact', 'browbeast_nonce' ); ?>

        <div class="form-row form-row--two">
          <div class="form-field">
            <label for="contact_name">Name <span aria-hidden="true">*</span></label>
            <input type="text" id="contact_name" name="contact_name" required autocomplete="name" placeholder="Your name">
            <span class="form-error" aria-live="polite"></span>
          </div>
          <div class="form-field">
            <label for="contact_email_field">Email <span aria-hidden="true">*</span></label>
            <input type="email" id="contact_email_field" name="contact_email" required autocomplete="email" placeholder="your@email.com">
            <span class="form-error" aria-live="polite"></span>
          </div>
        </div>

        <div class="form-field">
          <label for="contact_phone_field">Phone</label>
          <input type="tel" id="contact_phone_field" name="contact_phone" autocomplete="tel" placeholder="(555) 000-0000">
        </div>

        <div class="form-field">
          <label for="contact_service">Interested in</label>
          <select id="contact_service" name="contact_service">
            <option value="">Select a service (optional)</option>
            <option>StrokeBlend™ Combo Brows</option>
            <option>SoftBlend™ Ombré Brows</option>
            <option>Henna Brows</option>
            <option>Brow Waxing &amp; Shaping</option>
            <option>Corrections</option>
            <option>Other / General Question</option>
          </select>
        </div>

        <div class="form-field">
          <label for="contact_message">Message <span aria-hidden="true">*</span></label>
          <textarea id="contact_message" name="contact_message" required rows="5" placeholder="Tell us a little about what you're looking for…"></textarea>
          <span class="form-error" aria-live="polite"></span>
        </div>

        <button type="submit" class="btn-primary form-submit" id="formSubmit">
          <span class="btn-label">Send Message</span>
          <span class="btn-loading" hidden>Sending…</span>
        </button>

        <div class="form-success" id="formSuccess" hidden>
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><polyline points="6.5 10.5 9 13 13.5 7.5"/></svg>
          Message sent! Gabrielle will be in touch within 24 hours.
        </div>

      </form>
      <?php endif; ?>

    </div>

  </div>
</section>

<!-- ── MAP ──────────────────────────────────────────────────────── -->
<?php if ( $map_embed ) : ?>
<div class="contact-map">
  <?php
  // Only allow iframe tags from Google Maps
  $allowed = [ 'iframe' => [ 'src' => true, 'width' => true, 'height' => true,
    'style' => true, 'allowfullscreen' => true, 'loading' => true,
    'referrerpolicy' => true, 'title' => true ] ];
  echo wp_kses( $map_embed, $allowed );
  ?>
</div>
<?php else : ?>
<div class="contact-map contact-map--placeholder">
  <a href="https://maps.google.com/?q=<?php echo esc_attr( $address ); ?>"
     target="_blank" rel="noopener noreferrer" class="contact-map-link">
    <div class="contact-map-inner">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round">
        <path d="M12 2C8 2 4 6 4 10c0 5 8 12 8 12s8-7 8-12c0-4-4-8-8-8z"/>
        <circle cx="12" cy="10" r="2.5"/>
      </svg>
      <span>View on Google Maps — <?php echo esc_html( $address ); ?></span>
    </div>
  </a>
</div>
<?php endif; ?>

<?php get_footer(); ?>