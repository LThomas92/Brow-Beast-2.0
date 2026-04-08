<?php
/**
 * Template Name: Services Page
 *
 * HOW TO USE:
 * 1. Save this file as page-services.php in your theme root
 * 2. Create a new Page in WP Admin → Pages → Add New
 * 3. Set the title to "Services", slug to "services"
 * 4. Under Page Attributes → Template, select "Services Page"
 * 5. Add ACF fields to this page (see field list below)
 *
 * ACF FIELDS FOR THIS PAGE (create in Custom Fields → Add New):
 * Field Group name: "Services Page"
 * Location: Page Template == Services Page
 *
 *   services_intro_tag      Text        e.g. "Expert Eyebrow Services"
 *   services_intro_headline Text        e.g. "Every brow, a masterpiece."
 *   services_intro_sub      Textarea    Supporting line
 *   services_hero_image     Image       Hero right column image
 *
 * The service cards pull from the bb_service taxonomy + individual
 * service pages — no extra ACF needed for the cards themselves.
 */

get_header();

$intro_tag  = get_field( 'services_intro_tag' )      ?: 'Expert Eyebrow Services';
$intro_h1   = get_field( 'services_intro_headline' ) ?: 'Every brow, <em>a masterpiece.</em>';
$intro_sub  = get_field( 'services_intro_sub' )      ?: 'From your first brow shaping to a full semi-permanent transformation — every service delivered with artistry and care.';
$hero_img   = get_field( 'services_hero_image' );

// ── Service data — update prices/details here or move to ACF repeater
$services = [
  [
    'slug'     => 'strokeblend-combo-brows',
    'name'     => 'StrokeBlend™ Combo Brows',
    'desc'     => 'Gabrielle\'s signature technique combining microblading strokes with powder shading — the most natural, dimensional semi-permanent brow available.',
    'tag'      => 'Semi-Permanent · 2–2.5 hrs · Touch-up included',
    'price'    => '$350',
    'badge'    => 'Signature',
    'gradient' => 'linear-gradient(135deg,#D4B896,#896C54)',
  ],
  [
    'slug'     => 'softblend-ombre-brows',
    'name'     => 'SoftBlend™ Ombré Brows',
    'desc'     => 'A soft-focus powder technique that creates a beautiful gradient — fuller at the tail, softer at the head for an effortless, polished finish.',
    'tag'      => 'Semi-Permanent · 2 hrs',
    'price'    => '$300',
    'badge'    => '',
    'gradient' => 'linear-gradient(135deg,#E8D5C4,#B06F44)',
  ],
  [
    'slug'     => 'henna-brows',
    'name'     => 'Henna Brows',
    'desc'     => 'Natural henna tinting — Gabrielle\'s specialty. Adds colour, depth, and definition with up to 2 weeks of worry-free wear. No downtime.',
    'tag'      => 'Natural · 60 min · No downtime',
    'price'    => '$75',
    'badge'    => '',
    'gradient' => 'linear-gradient(135deg,#D4B896,#7A5C40)',
  ],
  [
    'slug'     => 'brow-waxing',
    'name'     => 'Brow Waxing & Shaping',
    'desc'     => 'Precise waxing and shaping to define your natural brow architecture. Perfect for maintenance or a first-time clean-up.',
    'tag'      => 'Classic · 30 min',
    'price'    => '$35',
    'badge'    => '',
    'gradient' => 'linear-gradient(135deg,#F2EAE0,#C9A882)',
  ],
  [
    'slug'     => 'corrections',
    'name'     => 'Corrections',
    'desc'     => 'Corrective work for previous brow procedures. Expert correction of shape, symmetry, and colour — restoring natural beauty.',
    'tag'      => 'Corrective · Consultation required',
    'price'    => 'TBD',
    'badge'    => '',
    'gradient' => 'linear-gradient(135deg,#ddc9b5,#7A5C40)',
  ],
];
?>

<!-- ── HERO ──────────────────────────────────────────────────────── -->
<section class="svc-hero">
  <div class="svc-hero-text">
    <div class="tag"><?php echo esc_html( $intro_tag ); ?></div>
    <h1 class="svc-hero-headline"><?php echo wp_kses_post( $intro_h1 ); ?></h1>
    <p class="svc-hero-sub"><?php echo esc_html( $intro_sub ); ?></p>
  </div>
  <div class="svc-hero-img<?php echo $hero_img ? ' has-image' : ''; ?>">
    <?php if ( $hero_img ) : ?>
      <img
        class="svc-hero-img-el"
        src="<?php echo esc_url( $hero_img['sizes']['large'] ); ?>"
        alt="<?php echo esc_attr( $hero_img['alt'] ); ?>"
        loading="eager"
      >
    <?php endif; ?>
  </div>
</section>

<!-- ── SERVICE LIST ──────────────────────────────────────────────── -->
<section class="section section--white">
  <div class="svc-list">

    <?php foreach ( $services as $svc ) :
      // Try to find a matching WP page for the "Learn More" link
      $page     = get_page_by_path( $svc['slug'] );
      $page_url = $page ? get_permalink( $page->ID ) : '#';

      // Try to get a real image from the individual service page if it exists
      $thumb_url = '';
      if ( $page && has_post_thumbnail( $page->ID ) ) {
        $thumb_url = get_the_post_thumbnail_url( $page->ID, 'large' );
      }
    ?>
    <div class="svc-row">

      <div class="svc-row-img<?php echo $thumb_url ? ' has-image' : ''; ?>"
           <?php if ( ! $thumb_url ) : ?>style="background:<?php echo esc_attr( $svc['gradient'] ); ?>;"<?php endif; ?>>
        <?php if ( $thumb_url ) : ?>
          <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $svc['name'] ); ?>" loading="lazy">
        <?php endif; ?>
      </div>

      <div class="svc-row-info">
        <div class="svc-row-name">
          <?php echo esc_html( $svc['name'] ); ?>
          <?php if ( $svc['badge'] ) : ?>
            <span class="svc-row-badge"><?php echo esc_html( $svc['badge'] ); ?></span>
          <?php endif; ?>
        </div>
        <div class="svc-row-desc"><?php echo esc_html( $svc['desc'] ); ?></div>
        <div class="svc-row-tag"><?php echo esc_html( $svc['tag'] ); ?></div>
        <?php if ( $page_url !== '#' ) : ?>
          <a href="<?php echo esc_url( $page_url ); ?>" class="svc-row-learn">Learn more →</a>
        <?php endif; ?>
      </div>

      <div class="svc-row-right">
        <div class="svc-price-wrap">
          <div class="svc-row-price"><?php echo esc_html( $svc['price'] ); ?></div>
          <div class="svc-price-sub">Starting from</div>
        </div>
        <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
           class="btn-book-svc"
           target="_blank"
           rel="noopener noreferrer">
          <?php echo ( $svc['price'] === 'TBD' ) ? 'Book Consult' : 'Book Now'; ?>
        </a>
      </div>

    </div>
    <?php endforeach; ?>

  </div>

  <!-- Acuity embed fallback CTA -->
  <div class="svc-booking-cta">
    <h2 class="svc-booking-title">Ready to book?</h2>
    <p class="svc-booking-sub">Select a service above or browse all available times directly.</p>
    <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
       class="btn-primary"
       target="_blank"
       rel="noopener noreferrer">
      View All Availability
    </a>
  </div>

</section>

<?php get_footer(); ?>