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
 * GRAVITY FORMS SETUP:
 * 1. Install & activate Gravity Forms plugin
 * 2. Forms → New Form → build your contact form
 * 3. Note the form ID (shown in Forms list, e.g. "ID: 1")
 * 4. Either:
 *    a) Set ACF field "contact_gf_form_id" to that number, OR
 *    b) Hard-code CONTACT_FORM_ID below as a fallback
 *
 * ACF FIELDS — "Contact Page" field group
 * Location: Page Template == Contact Page
 *
 *   contact_tag          Text
 *   contact_headline     Text
 *   contact_sub          Text
 *   contact_phone        Text
 *   contact_email        Email
 *   contact_address      Text
 *   contact_hours        Repeater → day_range (Text) + hours (Text)
 *   contact_map_embed    Textarea  Google Maps <iframe> code
 *   contact_gf_form_id   Number    Gravity Forms form ID
 */

get_header();

// ── Fallback form ID if ACF field isn't set ──────────────────────
define( 'CONTACT_FORM_ID', 1 );

$tag       = get_field( 'contact_tag' )       ?: 'Get in Touch';
$headline  = get_field( 'contact_headline' )  ?: "We'd love to hear from you.";
$sub       = get_field( 'contact_sub' )       ?: 'Have a question about a service? Ready to book? Reach out and Gabrielle will get back to you personally.';
$phone     = get_field( 'contact_phone' )     ?: '516-840-7314';
$email     = get_field( 'contact_email' )     ?: '';
$address   = get_field( 'contact_address' )   ?: '2 Hicks Lane, Great Neck, NY 11024';
$hours     = get_field( 'contact_hours' )     ?: [
  [ 'day_range' => 'Monday – Friday', 'hours' => '9:00 AM – 5:00 PM' ],
  [ 'day_range' => 'Saturday',         'hours' => '11:00 AM – 4:00 PM' ],
  [ 'day_range' => 'Sunday',  'hours' => 'Closed' ],
];
$map_embed = get_field( 'contact_map_embed' ) ?: '';
$gf_id     = (int) ( get_field( 'contact_gf_form_id' ) ?: CONTACT_FORM_ID );
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

      <?php if ( class_exists( 'GFForms' ) ) : ?>
        <?php
        /**
         * gravity_form( $id, $display_title, $display_description, $display_inactive, $field_values, $ajax, $tabindex )
         *
         * - $display_title / $display_description: false hides the GF form title/desc
         *   since we already have our own header above.
         * - $ajax: true submits without a full page reload (recommended).
         */
        gravity_form( $gf_id, false, false, false, null, true );
        ?>

      <?php else : ?>
        <!-- Gravity Forms not active — display an admin notice instead of a broken form -->
        <?php if ( current_user_can( 'manage_options' ) ) : ?>
          <div class="contact-form-notice" style="padding:1rem;background:#fff3cd;border:1px solid #ffc107;border-radius:6px;color:#856404;">
            <strong>Admin notice:</strong> Gravity Forms is not installed or activated.
            <a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=gravity+forms&tab=search&type=term' ) ); ?>">
              Install a plugin
            </a> or activate Gravity Forms to display the contact form.
          </div>
        <?php else : ?>
          <p>Our contact form is temporarily unavailable. Please reach us by phone or email using the details on this page.</p>
        <?php endif; ?>
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