<?php
/**
 * Template Name: Single Service Page
 *
 * HOW TO USE:
 * 1. Save as page-single-service.php in theme root
 * 2. Create a Page per service in WP Admin → Pages → Add New
 *    Suggested slugs: strokeblend-combo-brows, softblend-ombre-brows,
 *                     henna-brows, brow-waxing, corrections
 * 3. Under Page Attributes → Template, select "Single Service Page"
 *
 * ACF FIELDS — "Single Service" field group
 * Location: Page Template == Single Service Page
 *
 *   service_tag         Text      e.g. "Semi-Permanent"
 *   service_price       Text      e.g. "From $350"
 *   service_duration    Text      e.g. "2–2.5 hours"
 *   service_longevity   Text      e.g. "12–18 months"
 *   service_hero_image  Image     Hero column photo
 *   service_intro       Textarea  Short intro paragraph
 *   service_ideal_for   Textarea  Who is this service for?
 *   service_process     Repeater  Steps (step_title + step_desc fields inside)
 *   service_aftercare   Textarea  Aftercare instructions
 *   service_faq         Repeater  FAQs (faq_q + faq_a fields inside)
 *   service_gallery     Gallery   Before/after images for this service
 */

get_header();

$tag        = get_field( 'service_tag' )        ?: '';
$price      = get_field( 'service_price' )      ?: '';
$duration   = get_field( 'service_duration' )   ?: '';
$longevity  = get_field( 'service_longevity' )  ?: '';
$hero_img   = get_field( 'service_hero_image' );
$intro      = get_field( 'service_intro' )      ?: get_the_excerpt();
$ideal_for  = get_field( 'service_ideal_for' )  ?: '';
$process    = get_field( 'service_process' )    ?: [];
$aftercare  = get_field( 'service_aftercare' )  ?: '';
$faqs       = get_field( 'service_faq' )        ?: [];
$gallery    = get_field( 'service_gallery' )    ?: [];
?>

<!-- ── SERVICE HERO ──────────────────────────────────────────────── -->
<section class="single-svc-hero">

  <div class="single-svc-hero-text">
    <?php if ( $tag ) : ?>
      <div class="tag"><?php echo esc_html( $tag ); ?></div>
    <?php endif; ?>
    <h1 class="single-svc-headline"><?php the_title(); ?></h1>
    <?php if ( $intro ) : ?>
      <p class="single-svc-intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>

    <div class="single-svc-meta">
      <?php if ( $price ) : ?>
        <div class="meta-item">
          <div class="meta-label">Starting from</div>
          <div class="meta-val"><?php echo esc_html( $price ); ?></div>
        </div>
      <?php endif; ?>
      <?php if ( $duration ) : ?>
        <div class="meta-item">
          <div class="meta-label">Duration</div>
          <div class="meta-val"><?php echo esc_html( $duration ); ?></div>
        </div>
      <?php endif; ?>
      <?php if ( $longevity ) : ?>
        <div class="meta-item">
          <div class="meta-label">Results last</div>
          <div class="meta-val"><?php echo esc_html( $longevity ); ?></div>
        </div>
      <?php endif; ?>
    </div>

    <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
       class="btn-primary"
       target="_blank"
       rel="noopener noreferrer">
      Book This Service
    </a>
  </div>

  <div class="single-svc-hero-img<?php echo $hero_img ? ' has-image' : ''; ?>">
    <?php if ( $hero_img ) : ?>
      <img
        src="<?php echo esc_url( $hero_img['sizes']['large'] ); ?>"
        alt="<?php echo esc_attr( $hero_img['alt'] ); ?>"
        loading="eager"
      >
    <?php endif; ?>
  </div>

</section>

<!-- ── IDEAL FOR ─────────────────────────────────────────────────── -->
<?php if ( $ideal_for ) : ?>
<section class="section section--cream">
  <div class="single-svc-ideal">
    <div class="tag" style="margin-bottom:8px;">Is this right for me?</div>
    <h2 class="sec-title">Ideal <em>for you if…</em></h2>
    <p class="single-svc-ideal-text"><?php echo esc_html( $ideal_for ); ?></p>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path( '/service-quiz' ) ) ); ?>" class="btn-ghost">
      Take the Brow Quiz
    </a>
  </div>
</section>
<?php endif; ?>

<!-- ── THE PROCESS ───────────────────────────────────────────────── -->
<?php if ( ! empty( $process ) ) : ?>
<section class="section section--white">
  <div class="tag" style="margin-bottom:8px;">What to expect</div>
  <h2 class="sec-title">The <em>Process</em></h2>
  <div class="process-steps">
    <?php foreach ( $process as $i => $step ) : ?>
      <div class="process-step">
        <div class="process-step-num"><?php echo str_pad( $i + 1, 2, '0', STR_PAD_LEFT ); ?></div>
        <div>
          <div class="process-step-name"><?php echo esc_html( $step['step_title'] ); ?></div>
          <div class="process-step-desc"><?php echo esc_html( $step['step_desc'] ); ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ── SERVICE GALLERY ───────────────────────────────────────────── -->
<?php if ( ! empty( $gallery ) ) : ?>
<section class="section section--cream">
  <div class="tag" style="margin-bottom:8px;">Real results</div>
  <h2 class="sec-title">Before <em>&amp; After</em></h2>
  <div class="single-svc-gallery">
    <?php foreach ( $gallery as $img ) : ?>
      <div class="single-svc-gallery-item">
        <img
          src="<?php echo esc_url( $img['sizes']['large'] ); ?>"
          alt="<?php echo esc_attr( $img['alt'] ); ?>"
          loading="lazy"
        >
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ── AFTERCARE ─────────────────────────────────────────────────── -->
<?php if ( $aftercare ) : ?>
<section class="section section--white">
  <div class="aftercare-wrap">
    <div class="aftercare-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round">
        <path d="M12 2C8 2 4 6 4 10c0 5 8 12 8 12s8-7 8-12c0-4-4-8-8-8z"/>
        <circle cx="12" cy="10" r="2.5"/>
      </svg>
    </div>
    <div>
      <div class="tag" style="margin-bottom:8px;">After your appointment</div>
      <h2 class="sec-title" style="font-size:28px;">Aftercare <em>Guide</em></h2>
      <p class="aftercare-text"><?php echo nl2br( esc_html( $aftercare ) ); ?></p>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── FAQS ──────────────────────────────────────────────────────── -->
<?php if ( ! empty( $faqs ) ) : ?>
<section class="section section--cream">
  <div class="tag" style="margin-bottom:8px;">Common questions</div>
  <h2 class="sec-title">FAQs</h2>
  <div class="faq-list" id="faqList">
    <?php foreach ( $faqs as $i => $faq ) :
      $q_id = 'faq-' . $i;
      $a_id = 'faq-a-' . $i;
    ?>
      <div class="faq-item" id="<?php echo esc_attr( $q_id ); ?>">
        <button
          class="faq-q"
          type="button"
          aria-expanded="false"
          aria-controls="<?php echo esc_attr( $a_id ); ?>"
          id="btn-<?php echo esc_attr( $q_id ); ?>"
        >
          <span><?php echo esc_html( $faq['faq_q'] ); ?></span>
          <svg class="faq-chevron" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
            <polyline points="4 6 8 10 12 6"/>
          </svg>
        </button>
        <!-- No hidden attribute — max-height: 0 in CSS keeps it closed -->
        <div
          class="faq-a"
          id="<?php echo esc_attr( $a_id ); ?>"
          role="region"
          aria-labelledby="btn-<?php echo esc_attr( $q_id ); ?>"
        >
          <div class="faq-a-inner">
            <?php echo wp_kses_post( nl2br( esc_html( $faq['faq_a'] ) ) ); ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ── BOOKING CTA ───────────────────────────────────────────────── -->
<div class="cta-banner">
  <div>
    <h2 class="cta-title">Ready to book<br><em><?php the_title(); ?>?</em></h2>
    <p class="cta-sub">Gabrielle takes each appointment personally. Secure your spot today.</p>
  </div>
  <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
     class="btn-gold"
     target="_blank"
     rel="noopener noreferrer">
    Book This Service
  </a>
</div>

<!-- ── RELATED SERVICES ──────────────────────────────────────────── -->
<section class="section section--white">
  <div class="tag" style="margin-bottom:8px;">Explore more</div>
  <h2 class="sec-title">Other <em>Services</em></h2>
  <div class="related-services">
    <?php
    // Show other service pages — excludes current page
    $related = get_pages( [
      'meta_key'   => '_wp_page_template',
      'meta_value' => 'page-single-service.php',
      'exclude'    => [ get_the_ID() ],
      'number'     => 3,
    ] );
    foreach ( $related as $rel_page ) :
      $rel_thumb = get_the_post_thumbnail_url( $rel_page->ID, 'medium' );
    ?>
      <a href="<?php echo esc_url( get_permalink( $rel_page->ID ) ); ?>" class="related-svc-card">
        <div class="related-svc-img<?php echo $rel_thumb ? ' has-image' : ''; ?>"
             style="<?php echo ! $rel_thumb ? 'background:linear-gradient(135deg,#D4B896,#896C54);' : ''; ?>">
          <?php if ( $rel_thumb ) : ?>
            <img src="<?php echo esc_url( $rel_thumb ); ?>" alt="<?php echo esc_attr( $rel_page->post_title ); ?>" loading="lazy">
          <?php endif; ?>
        </div>
        <div class="related-svc-name"><?php echo esc_html( $rel_page->post_title ); ?></div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<?php get_footer(); ?>

