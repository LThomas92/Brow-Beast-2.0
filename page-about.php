<?php get_header(); ?>

<section class="about-hero">
  <?php
  $hero_image       = get_field( 'about_hero_image' );
  $hero_badge       = get_field( 'about_hero_badge' );
  $hero_tag         = get_field( 'about_hero_tag' );
  $hero_headline    = get_field( 'about_hero_headline' );
  $hero_subline     = get_field( 'about_hero_subline' );
  $hero_booking_btn = get_field( 'about_hero_booking' );
  ?>

  <!-- Image column — class is about-hero-img (the wrapper), img tag has its own class -->
  <div class="about-hero-img">
    <?php if ( $hero_image ) : ?>
      <img
        class="about-hero-photo"
        src="<?php echo esc_url( $hero_image['sizes']['large'] ?? $hero_image['url'] ); ?>"
        alt="<?php echo esc_attr( $hero_image['alt'] ); ?>"
        loading="eager"
      >
    <?php endif; ?>

    <?php if ( $hero_badge ) : ?>
      <div class="about-hero-badge" style="z-index:2;">
        <?php echo $hero_badge; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Text column -->
  <div class="about-hero-text">
    <?php if ( $hero_tag ) : ?>
      <div class="tag"><?php echo esc_html( $hero_tag ); ?></div>
    <?php endif; ?>
    <?php if ( $hero_headline ) : ?>
      <h1 class="about-headline"><?php echo wp_kses_post( $hero_headline ); ?></h1>
    <?php endif; ?>
    <?php if ( $hero_subline ) : ?>
      <p class="about-sub"><?php echo esc_html( $hero_subline ); ?></p>
    <?php endif; ?>
    <?php if ( $hero_booking_btn ) : ?>
      <div style="margin-top:8px;">
        <a href="<?php echo esc_url( $hero_booking_btn['url'] ); ?>"
           class="btn-primary"
           target="_blank"
           rel="noopener noreferrer">
          <?php echo esc_html( $hero_booking_btn['title'] ); ?>
        </a>
      </div>
    <?php endif; ?>
  </div>

</section>


<!-- ── STORY ──────────────────────────────────────────────────────── -->
<section class="section story-section">
  <?php $studio_image = get_field( 'about_studio_image' ); ?>

  <div class="story-img">
    <?php if ( $studio_image ) : ?>
      <img
        class="story-img-photo"
        src="<?php echo esc_url( $studio_image['sizes']['large'] ?? $studio_image['url'] ); ?>"
        alt="<?php echo esc_attr( $studio_image['alt'] ?: 'The Brow Beast Studio' ); ?>"
        loading="lazy"
      >
    <?php endif; ?>
    <div class="story-img-tag">In the Studio</div>
  </div>

  <div class="story-text">
    <div class="gold-rule"></div>
    <h2 class="story-heading">The story<br>behind the <em>brand</em></h2>
    <p class="story-p">Gabrielle understands that eyebrows are more than just a facial feature — they are a canvas for self-expression. Her journey into brow artistry began with a deep love for precision and beauty, evolving into a thriving brand known for its signature henna technique.</p>
    <p class="story-p">Specializing exclusively in eyebrows, Gabrielle has dedicated her career to mastering every technique — from classic waxing to her proprietary StrokeBlend™ and SoftBlend™ semi-permanent methods. Every appointment is a one-on-one experience with the artist herself.</p>
    <p class="story-p">Beyond the chair, she has built an online course that has trained aspiring artists in her unique henna technique worldwide — cementing her place as both practitioner and educator in the industry.</p>
  </div>
</section>


<!-- ── PHILOSOPHY ────────────────────────────────────────────────── -->
<section class="philosophy">
  <h2 class="philosophy-title">The Brow Beast <em>Philosophy</em></h2>
  <div class="philosophy-grid">
    <div class="phil-card">
      <div class="phil-icon">◈</div>
      <div class="phil-name">Precision</div>
      <div class="phil-desc">Every stroke is intentional. Every arch, mapped to your unique facial structure and bone structure.</div>
    </div>
    <div class="phil-card">
      <div class="phil-icon">◇</div>
      <div class="phil-name">Artistry</div>
      <div class="phil-desc">Brows are art. Gabrielle treats every face as a canvas deserving expert craft and a trained eye.</div>
    </div>
    <div class="phil-card">
      <div class="phil-icon">◉</div>
      <div class="phil-name">Confidence</div>
      <div class="phil-desc">Great brows transform how you carry yourself — and that transformation is the whole point.</div>
    </div>
  </div>
</section>


<!-- ── SPECIALTIES ───────────────────────────────────────────────── -->
<section class="section">
  <div>
    <div class="tag" style="margin-bottom:8px;">Her craft</div>
    <h2 class="sec-title">Areas of <em>Expertise</em></h2>
  </div>
  <div class="spec-grid">
    <div class="spec-item">
      <div class="spec-num">01</div>
      <div><div class="spec-name">StrokeBlend™ Combo Brows</div><div class="spec-desc">Gabrielle's signature blend of microblading and powder — natural strokes with lasting dimension.</div></div>
    </div>
    <div class="spec-item">
      <div class="spec-num">02</div>
      <div><div class="spec-name">SoftBlend™ Ombré Brows</div><div class="spec-desc">A soft, powdered gradient for defined yet effortless-looking brows with semi-permanent results.</div></div>
    </div>
    <div class="spec-item">
      <div class="spec-num">03</div>
      <div><div class="spec-name">Henna Brow Artistry</div><div class="spec-desc">Natural color with up to 2 weeks of worry-free wear — zero downtime and completely customizable.</div></div>
    </div>
    <div class="spec-item">
      <div class="spec-num">04</div>
      <div><div class="spec-name">Corrections &amp; Reshaping</div><div class="spec-desc">Expert correction of previous brow work — restoring symmetry, shape, and natural beauty.</div></div>
    </div>
  </div>
</section>


<!-- ── TESTIMONIALS ──────────────────────────────────────────────── -->
<section class="section section--cream">
  <h2 class="sec-title">What clients <em>say</em></h2>
  <div class="testi-grid">
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Great service! Gab is always professional and has a beautiful spirit."</p>
      <div class="testi-name">— Benita Moore</div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Her technique, precision and shaping is perfect. I receive so many compliments on my eyebrows."</p>
      <div class="testi-name">— Antoinette</div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"The salon's aesthetics are beautiful and very comfortable. Every time I leave I feel amazing."</p>
      <div class="testi-name">— Gabrielle James</div>
    </div>
  </div>
</section>


<!-- ── CTA ───────────────────────────────────────────────────────── -->
<div class="about-cta">
  <h2 class="cta-h">Ready to meet your<br><em>best brows?</em></h2>
  <p class="cta-p">Book your appointment with Gabrielle today and experience the difference of working with a true brow specialist.</p>
  <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
     class="btn-primary"
     target="_blank"
     rel="noopener noreferrer">
    Book Your Appointment
  </a>
</div>

<?php get_footer(); ?>