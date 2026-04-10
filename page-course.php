<?php
/**
 * Template Name: Course Page
 *
 * Promotional landing page for the Henna Brow Online Course
 * hosted on Thinkific. All CTAs link out to the enrollment page.
 *
 * ACF FIELDS (optional — "Course Page" field group):
 *   course_price        Text    e.g. "$299"
 *   course_headline     Text    Override main headline
 *   course_sub          Textarea Override sub text
 *   course_hero_image   Image   Instructor/hero photo
 */

get_header();

$enroll_url  = 'https://browbeasthennacourse.thinkific.com/enroll/2181083';
$course_url  = 'https://browbeasthennacourse.thinkific.com/courses/BrowCourse';
$price       = get_field( 'course_price' )    ?: '$299';
$headline    = get_field( 'course_headline' ) ?: 'Master Henna Brows from anywhere in the world.';
$sub         = get_field( 'course_sub' )      ?: 'Gabrielle\'s comprehensive online course teaches you the exact henna brow technique behind her six-figure brow brand — 16 lessons, full video demonstrations, and everything you need to offer henna brows with confidence.';
$hero_img    = get_field( 'course_hero_image' );
?>

<!-- ── HERO ──────────────────────────────────────────────────────── -->
<section class="course-hero">
  <div class="course-hero-text">
    <div class="tag">Online Course · Thinkific</div>
    <h1 class="course-headline"><?php echo esc_html( $headline ); ?></h1>
    <p class="course-sub"><?php echo esc_html( $sub ); ?></p>

    <div class="course-hero-meta">
      <div class="course-meta-item">
        <div class="course-meta-val">16</div>
        <div class="course-meta-label">Lessons</div>
      </div>
      <div class="course-meta-div"></div>
      <div class="course-meta-item">
        <div class="course-meta-val">Video</div>
        <div class="course-meta-label">Content</div>
      </div>
      <div class="course-meta-div"></div>
      <div class="course-meta-item">
        <div class="course-meta-val">Lifetime</div>
        <div class="course-meta-label">Access</div>
      </div>
      <div class="course-meta-div"></div>
      <div class="course-meta-item">
        <div class="course-meta-val"><?php echo esc_html( $price ); ?></div>
        <div class="course-meta-label">One-time</div>
      </div>
    </div>

    <div class="course-hero-btns">
      <a href="<?php echo esc_url( $enroll_url ); ?>"
         class="btn-primary btn-large"
         target="_blank" rel="noopener noreferrer">
        Enroll Now — <?php echo esc_html( $price ); ?>
      </a>
      <a href="<?php echo esc_url( $course_url ); ?>"
         class="btn-ghost"
         target="_blank" rel="noopener noreferrer">
        Preview Course
      </a>
    </div>
  </div>

  <div class="course-hero-img<?php echo $hero_img ? ' has-image' : ''; ?>">
    <?php if ( $hero_img ) : ?>
      <img src="<?php echo esc_url( $hero_img['sizes']['large'] ); ?>"
           alt="<?php echo esc_attr( $hero_img['alt'] ); ?>"
           loading="eager">
    <?php else : ?>
      <img src="https://import.cdn.thinkific.com/714193%2Fcustom_site_themes%2Fid%2FsZSohx61R5qDJnq33ecS_IMG_9791.JPG"
           alt="Gabrielle Lowe — The Brow Beast"
           loading="eager">
    <?php endif; ?>
  </div>
</section>


<!-- ── WHO IT'S FOR ──────────────────────────────────────────────── -->
<section class="section section--cream">
  <div class="course-split">
    <div>
      <div class="tag" style="margin-bottom:8px;">Is this course for me?</div>
      <h2 class="sec-title">Built for <em>every level</em></h2>
      <p style="font-size:14px;color:#7A6358;line-height:1.8;margin-top:16px;">Whether you're picking up a henna brush for the first time or you're an experienced brow artist looking to add a profitable new service — this course meets you where you are.</p>
    </div>
    <div class="course-for-grid">
      <?php
      $for_whom = [
        [ '✦', 'Beginners',          'No experience needed. Gabrielle walks you through every step from the very beginning.' ],
        [ '◈', 'Brow Artists',       'Already doing brows? Add henna to your menu and increase your average ticket.' ],
        [ '◇', 'Estheticians',       'Expand your service offerings with a natural, in-demand treatment.' ],
        [ '◉', 'Beauty Enthusiasts', 'Learn the technique for yourself and your clients at your own pace.' ],
      ];
      foreach ( $for_whom as $item ) : ?>
        <div class="course-for-card">
          <div class="course-for-icon"><?php echo $item[0]; ?></div>
          <div class="course-for-name"><?php echo esc_html( $item[1] ); ?></div>
          <div class="course-for-text"><?php echo esc_html( $item[2] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ── WHAT YOU'LL LEARN ─────────────────────────────────────────── -->
<section class="section section--white">
  <div class="tag" style="margin-bottom:8px;">Course overview</div>
  <h2 class="sec-title">What you'll <em>learn</em></h2>

  <div class="course-curriculum">
    <?php
    $modules = [
      [ '01', 'Introduction to Henna Brows',          'The history and origin of henna, how it works on the skin, and why it\'s become one of the fastest growing brow treatments.' ],
      [ '02', 'Henna & Skin Sensitivities',            'How to identify contraindications, address allergies, and keep clients safe. Everything you need to know before touching a brush to skin.' ],
      [ '03', 'Client Consultation',                   'The exact consultation and consent form process Gabrielle uses in her own studio. Build trust and set expectations from the first interaction.' ],
      [ '04', 'Proper PPE & Sanitisation',             'Professional sanitation standards for a safe, compliant service environment. Non-negotiable for any beauty professional.' ],
      [ '05', 'Product List & Recommended Brands',     'Gabrielle\'s curated product list — the exact henna brands and tools she uses for optimal results. No guesswork.' ],
      [ '06', 'Skin Type & Undertone',                 'Understanding skin colour, undertones, and brow types so you can choose the right henna shade every time and achieve consistent results.' ],
      [ '07', 'Preparation & Setup',                   'How to prepare the skin for henna application and set up your workspace for efficiency and professionalism.' ],
      [ '08', 'Video Demonstration',                   'Full step-by-step video of a real henna brow application — brow mapping, paste mixing, application, and removal. Watch the technique in action.' ],
      [ '09', 'Business Strategies',                   'How to price your henna service, position it in your menu, and maximise profitability from day one.' ],
      [ '10', 'Social Media & Content Creation',       'Platform strategy, how to film and edit henna brow content using CapCut, and Gabrielle\'s approach to building a brand that attracts clients.' ],
    ];
    foreach ( $modules as $i => $mod ) : ?>
      <div class="curriculum-row">
        <div class="curriculum-num"><?php echo $mod[0]; ?></div>
        <div class="curriculum-info">
          <div class="curriculum-title"><?php echo esc_html( $mod[1] ); ?></div>
          <div class="curriculum-desc"><?php echo esc_html( $mod[2] ); ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div style="text-align:center;margin-top:48px;">
    <a href="<?php echo esc_url( $enroll_url ); ?>"
       class="btn-primary btn-large"
       target="_blank" rel="noopener noreferrer">
      Enroll Now — <?php echo esc_html( $price ); ?>
    </a>
  </div>
</section>


<!-- ── INSTRUCTOR ────────────────────────────────────────────────── -->
<section class="section section--cream">
  <div class="course-instructor">
    <div class="course-instructor-img">
      <?php if ( $hero_img ) : ?>
        <img src="<?php echo esc_url( $hero_img['sizes']['medium'] ); ?>"
             alt="Gabrielle Lowe"
             loading="lazy">
      <?php else : ?>
        <img src="https://import.cdn.thinkific.com/714193%2Fcustom_site_themes%2Fid%2FsZSohx61R5qDJnq33ecS_IMG_9791.JPG"
             alt="Gabrielle Lowe — The Brow Beast"
             loading="lazy">
      <?php endif; ?>
    </div>
    <div class="course-instructor-text">
      <div class="tag" style="margin-bottom:8px;">Your instructor</div>
      <h2 class="sec-title">Gabrielle <em>Lowe</em></h2>
      <p>Gabrielle has built a thriving six-figure brow brand from Great Neck, NY — and henna brows are at the heart of it. Her unique henna technique delivers natural, long-lasting results with zero downtime, and has become one of the most requested services at The Brow Beast studio.</p>
      <p style="margin-top:16px;">This course is everything Gabrielle wishes she had when she started — the techniques, the business strategies, and the social media approach that actually work. It's not just a tutorial. It's a blueprint.</p>
      <div class="course-instructor-stats">
        <div class="instructor-stat">
          <div class="instructor-stat-val">6-Figure</div>
          <div class="instructor-stat-label">Brow Brand</div>
        </div>
        <div class="instructor-stat">
          <div class="instructor-stat-val">Great Neck</div>
          <div class="instructor-stat-label">NY Studio</div>
        </div>
        <div class="instructor-stat">
          <div class="instructor-stat-val">2 Weeks</div>
          <div class="instructor-stat-label">Results, No Downtime</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ── PRICING CTA ───────────────────────────────────────────────── -->
<section class="course-cta-section">
  <div class="course-cta-inner">
    <div class="course-cta-tag">Ready to start?</div>
    <h2 class="course-cta-headline">One investment.<br><em>Unlimited earning potential.</em></h2>
    <p class="course-cta-sub">Pay once, access forever. No subscriptions, no hidden fees — just the knowledge to build a henna brow service your clients will love.</p>

    <div class="course-price-card">
      <div class="course-price-label">Full Course Access</div>
      <div class="course-price-amount"><?php echo esc_html( $price ); ?></div>
      <div class="course-price-sub">One-time payment · Lifetime access</div>

      <ul class="course-price-includes">
        <li>16 in-depth lessons</li>
        <li>Full video demonstration</li>
        <li>Consultation & consent form templates</li>
        <li>Gabrielle's recommended product list</li>
        <li>Business pricing strategy</li>
        <li>Social media & CapCut content guide</li>
        <li>Lifetime access — learn at your own pace</li>
      </ul>

      <a href="<?php echo esc_url( $enroll_url ); ?>"
         class="btn-primary btn-large course-enroll-btn"
         target="_blank" rel="noopener noreferrer">
        Enroll Now
      </a>

      <p class="course-cta-note">Hosted securely on Thinkific. You'll be taken to the course platform to complete enrolment.</p>
    </div>
  </div>
</section>

<?php get_footer(); ?>