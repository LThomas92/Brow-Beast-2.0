<?php get_header(); ?>

<section class="hero">
  <?php
  $hero_tag          = get_field( 'homepage_hero_tag' );
  $hero_headline     = get_field( 'homepage_hero_headline' );
  $hero_subline      = get_field( 'homepage_hero_subline' );
  $hero_booking_btn  = get_field( 'homepage_hero_booking' );
  $hero_services_btn = get_field( 'homepage_hero_services' );
  $hero_image        = get_field( 'homepage_hero_image' );
  ?>

  <div class="hero-text">
    <?php if ( $hero_tag ) : ?>
      <div class="tag"><?php echo esc_html( $hero_tag ); ?></div>
    <?php endif; ?>

    <?php if ( $hero_headline ) : ?>
      <h1 class="hero-headline"><?php echo wp_kses_post( $hero_headline ); ?></h1>
    <?php endif; ?>

    <?php if ( $hero_subline ) : ?>
      <p class="hero-sub"><?php echo esc_html( $hero_subline ); ?></p>
    <?php endif; ?>

    <div class="hero-btns">
      <?php if ( $hero_booking_btn ) : ?>
        <a href="<?php echo esc_url( $hero_booking_btn['url'] ); ?>"
           class="btn-primary"
           <?php echo ! empty( $hero_booking_btn['target'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
          <?php echo esc_html( $hero_booking_btn['title'] ); ?>
        </a>
      <?php endif; ?>

      <?php if ( $hero_services_btn ) : ?>
        <a href="<?php echo esc_url( $hero_services_btn['url'] ); ?>"
           class="btn-ghost"
           <?php echo ! empty( $hero_services_btn['target'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
          <?php echo esc_html( $hero_services_btn['title'] ); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="hero-image">
    <?php if ( $hero_image ) : ?>
      <img
        class="hero-image-img"
        src="<?php echo esc_url( $hero_image['url'] ); ?>"
        alt="<?php echo esc_attr( $hero_image['alt'] ); ?>"
        loading="eager">
    <?php endif; ?>
    <div class="hero-image-label">Gabrielle Lowe · The Brow Beast</div>
  </div>
</section>


<!-- ═══ STATS ═══════════════════════════════════════════════════ -->
<div class="stats-bar">
  <?php
  $statsClientNumber   = get_field( 'stats_client_number' );
  $statsClientText     = get_field( 'stats_client_text' );
  $statsServicesNumber = get_field( 'stats_services_number' );
  $statsServicesText   = get_field( 'stats_services_text' );
  $statsYearsNumber    = get_field( 'stats_years_number' );
  $statsYearsText      = get_field( 'stats_years_text' );
  ?>
  <div class="stat">
    <div class="stat-num"><?php echo esc_html( $statsClientNumber ); ?></div>
    <div class="stat-label"><?php echo esc_html( $statsClientText ); ?></div>
  </div>
  <div class="stat">
    <div class="stat-num"><?php echo esc_html( $statsServicesNumber ); ?></div>
    <div class="stat-label"><?php echo esc_html( $statsServicesText ); ?></div>
  </div>
  <div class="stat">
    <div class="stat-num"><?php echo esc_html( $statsYearsNumber ); ?></div>
    <div class="stat-label"><?php echo esc_html( $statsYearsText ); ?></div>
  </div>
</div>


<!-- ═══ SERVICES ════════════════════════════════════════════════ -->
<section class="section">
  <?php
  $servicesBtn = get_field( 'services_button' );
  $svcImage1   = get_field( 'service_image_1' );
  $svcImage2   = get_field( 'service_image_2' );
  $svcImage3   = get_field( 'service_image_3' );
  $svcImage4   = get_field( 'service_image_4' );
  ?>

  <div class="sec-header">
    <div>
      <div class="tag" style="margin-bottom:8px;">What we offer</div>
      <h2 class="sec-title">Featured <em>Services</em></h2>
    </div>
    <?php if ( $servicesBtn ) : ?>
      <a href="<?php echo esc_url( $servicesBtn['url'] ); ?>" class="link-underline">
        <?php echo esc_html( $servicesBtn['title'] ); ?>
      </a>
    <?php endif; ?>
  </div>

  <div class="services-grid">
    <?php
    $services = [
      [
        'image' => $svcImage1,
        'badge' => 'Signature',
        'name'  => 'StrokeBlend™ Combo Brows',
        'desc'  => 'Microblading meets powder for the most natural, full look.',
        'price' => 'From $895',
        'fill'  => 'si-1',
        'slug'  => 'strokeblend-combo-brows',
      ],
      [
        'image' => $svcImage2,
        'badge' => '',
        'name'  => 'SoftBlend™ Ombré Brows',
        'desc'  => 'Soft powdered gradient brows with lasting definition.',
        'price' => 'From $850',
        'fill'  => 'si-2',
        'slug'  => 'softblend-ombre-brows',
      ],
      [
        'image' => $svcImage3,
        'badge' => '',
        'name'  => 'Henna Brows',
        'desc'  => 'Natural tinting with up to 2 weeks of beautiful, worry-free color.',
        'price' => 'From $140',
        'fill'  => 'si-3',
        'slug'  => 'henna-brows',
      ],
      [
        'image' => $svcImage4,
        'badge' => '',
        'name'  => 'Brow Waxing &amp; Shaping',
        'desc'  => 'Precise shaping to define and frame your natural features.',
        'price' => 'From $40',
        'fill'  => 'si-4',
        'slug'  => 'brow-waxing',
      ],
    ];

    $booking_url = get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' );

    foreach ( $services as $svc ) :
      $has_image = ! empty( $svc['image'] );
      $img_url   = $has_image ? $svc['image']['url'] : '';
    ?>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="svc-card svc-card--link" target="_blank" rel="noopener noreferrer">
        <div class="svc-img<?php echo $has_image ? ' has-image' : ''; ?>"
             <?php if ( $has_image ) : ?>
               style="background-image: url('<?php echo esc_url( $img_url ); ?>');"
             <?php endif; ?>>
          <?php if ( ! $has_image ) : ?>
            <div class="svc-img-fill <?php echo esc_attr( $svc['fill'] ); ?>"></div>
          <?php endif; ?>
          <?php if ( $svc['badge'] ) : ?>
            <div class="svc-badge"><?php echo esc_html( $svc['badge'] ); ?></div>
          <?php endif; ?>
        </div>
        <div class="svc-info">
          <div class="svc-name"><?php echo wp_kses_post( $svc['name'] ); ?></div>
          <div class="svc-desc"><?php echo esc_html( $svc['desc'] ); ?></div>
          <div class="svc-price"><?php echo esc_html( $svc['price'] ); ?></div>
          <div class="svc-learn">Book Now →</div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>


<!-- ═══ QUOTE ════════════════════════════════════════════════════ -->
<div class="quote-section">
  <div class="quote-line"></div>
  <blockquote class="quote-text">"Beauty is in the details and I'm here to make yours unforgettable."</blockquote>
  <div class="quote-line"></div>
  <p class="quote-author">— Gabrielle Lowe, The Brow Beast</p>
</div>


<!-- ═══ INSTAGRAM FEED ══════════════════════════════════════════ -->
<section class="section section--cream">

  <div class="insta-handle">Follow @thebrowbeast</div>
  <h2 class="sec-title" style="display:inline-block;margin-bottom:28px;">Our <em>Instagram</em></h2>

  <?php
  // Check for a LightWidget (or any third-party) embed code saved in ACF.
  // ACF field: homepage_instagram_embed (Textarea)
  // Paste the full LightWidget <script> + <div> snippet into that field.
  $instagram_embed = get_field( 'homepage_instagram_embed' );
  ?>

  <?php if ( $instagram_embed ) : ?>
    <div class="insta-embed-wrap">
      <?php
      // Allow script and the LightWidget div — wp_kses strips scripts by default
      // so we use echo directly. The field is admin-only so XSS risk is minimal.
      // Wrap in output buffering to avoid whitespace issues.
      echo $instagram_embed; // phpcs:ignore WordPress.Security.EscapeOutput
      ?>
    </div>

  <?php elseif ( function_exists( 'browbeast_instagram_feed' ) && get_theme_mod( 'browbeast_instagram_token' ) ) : ?>
    <?php browbeast_instagram_feed( 6, false ); // API fallback if token is set ?>

  <?php else : ?>
    <!-- Placeholder shown until embed code is added -->
    <div class="insta-grid">
      <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
        <a href="https://www.instagram.com/thebrowbeast/"
           class="insta-cell"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Visit The Brow Beast on Instagram">
          <div class="ig<?php echo $i; ?>"></div>
        </a>
      <?php endfor; ?>
    </div>
    <?php if ( current_user_can( 'manage_options' ) ) : ?>
      <p style="margin-top:16px;font-size:12px;color:#7A6358;">
        <strong>Admin:</strong> Add a LightWidget embed code to the
        <a href="<?php echo esc_url( admin_url( 'post.php?post=' . get_the_ID() . '&action=edit' ) ); ?>">
          homepage ACF field "homepage_instagram_embed"
        </a> to show the live Instagram feed.
      </p>
    <?php endif; ?>
  <?php endif; ?>

  <div style="margin-top:28px;">
    <a href="https://www.instagram.com/thebrowbeast/"
       class="btn-ghost"
       target="_blank"
       rel="noopener noreferrer">
      Follow on Instagram
    </a>
  </div>

</section>


<!-- ═══ BOOKING CTA ═════════════════════════════════════════════ -->
<div class="cta-banner">
  <div>
    <div class="cta-title">Ready for your<br><em>best brows?</em></div>
    <p class="cta-sub">Book your appointment with Gabrielle today. Every brow is crafted with precision, passion, and a deep love for the craft.</p>
  </div>
  <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
     class="btn-gold"
     target="_blank"
     rel="noopener noreferrer">
    Book Now
  </a>
</div>


<?php get_footer(); ?>