<?php
/**
 * Template Name: FAQ Page
 *
 * ACF FIELD GROUP — "FAQ Page"
 * Location: Page Template == FAQ Page
 *
 * Fields:
 *   faq_intro_tag       Text
 *   faq_intro_headline  Text
 *   faq_intro_sub       Textarea
 *   faq_categories      Repeater
 *     ↳ category_name   Text
 *     ↳ category_icon   Text
 *     ↳ faq_items       Repeater (nested)
 *         ↳ question    Text
 *         ↳ answer      Textarea
 */

get_header();

$tag      = get_field( 'faq_intro_tag' )      ?: 'Got Questions?';
$headline = get_field( 'faq_intro_headline' ) ?: 'Everything you need to know.';
$sub      = get_field( 'faq_intro_sub' )      ?: 'Find answers to the most common questions about Gabrielle\'s services, the booking process, aftercare, and more.';

$fallback_categories = [
  [
    'category_name' => 'Semi-Permanent Brows',
    'category_icon' => '✦',
    'faq_items'     => [
      [ 'question' => 'How long does semi-permanent makeup last?', 'answer' => 'Results typically last 12–18 months depending on your skin type, lifestyle, and aftercare. Oilier skin types may fade faster. A touch-up at 6–8 weeks after your initial session helps lock in the colour and shape.' ],
      [ 'question' => 'Does it hurt?', 'answer' => 'A topical numbing cream is applied before and during the procedure, so most clients experience minimal discomfort — usually described as light scratching or pressure. The majority of clients find it very manageable.' ],
      [ 'question' => 'What is the difference between StrokeBlend™ and SoftBlend™?', 'answer' => 'StrokeBlend™ Combo Brows combines microblading hair strokes with powder shading for a natural, dimensional result — Gabrielle\'s signature technique. SoftBlend™ Ombré Brows uses only powder shading for a softer gradient effect.' ],
      [ 'question' => 'Who is NOT a good candidate?', 'answer' => 'Semi-permanent brows are not recommended for pregnant or breastfeeding women, clients on Accutane or blood thinners, those with eczema or psoriasis in the brow area, or anyone who has had a chemical peel or laser treatment in the area within 4 weeks.' ],
      [ 'question' => 'Can I get semi-permanent brows if I have no brow hair?', 'answer' => 'Absolutely — it\'s one of the most transformative services for clients with sparse or absent brow hair. Gabrielle customises the shape to your facial structure for a completely natural looking result.' ],
    ],
  ],
  [
    'category_name' => 'Henna Brows',
    'category_icon' => '◈',
    'faq_items'     => [
      [ 'question' => 'What are henna brows?', 'answer' => 'Henna brows use a plant-based dye to tint both the brow hairs and the skin beneath, creating depth, definition, and a filled-in effect. Unlike traditional tinting, henna stains the skin for up to 2 weeks and the hairs for 4–6 weeks.' ],
      [ 'question' => 'How long does henna last?', 'answer' => 'The skin stain typically lasts 1–2 weeks depending on your skin type. The colour on the brow hairs themselves lasts 4–6 weeks.' ],
      [ 'question' => 'Is henna safe for sensitive skin?', 'answer' => 'Henna is a natural, plant-based product and is generally well tolerated. A patch test is recommended at least 24 hours before your appointment if you have known sensitivities.' ],
      [ 'question' => 'Can I get henna brows over existing semi-permanent makeup?', 'answer' => 'Yes — henna brows can be applied over existing microblading or powder brows to refresh colour between touch-up appointments. Gabrielle will assess your existing work at the appointment.' ],
    ],
  ],
  [
    'category_name' => 'Brow Waxing & Shaping',
    'category_icon' => '◇',
    'faq_items'     => [
      [ 'question' => 'How often should I get my brows waxed?', 'answer' => 'Every 3–4 weeks is ideal for most clients. This keeps the shape clean and prevents regrowth from disrupting the line.' ],
      [ 'question' => 'Do you offer threading?', 'answer' => 'Currently Gabrielle offers waxing and tweezing for brow shaping. If you have a sensitivity to wax please mention it when booking.' ],
      [ 'question' => 'Can I book waxing before a semi-permanent appointment?', 'answer' => 'Please avoid waxing for at least 2 weeks before a semi-permanent brow appointment. Waxing can temporarily sensitise the skin which may affect pigment retention.' ],
    ],
  ],
  [
    'category_name' => 'Aftercare',
    'category_icon' => '◉',
    'faq_items'     => [
      [ 'question' => 'What should I avoid after semi-permanent brows?', 'answer' => 'For the first 7–10 days: avoid getting the area wet, no sweating, no makeup on the brows, no sun exposure or tanning, no picking or peeling. Full aftercare instructions are provided at your appointment.' ],
      [ 'question' => 'Is it normal for colour to look dark at first?', 'answer' => 'Yes — the colour will appear significantly darker for the first 3–5 days and will fade 30–50% as the skin heals. The final result is visible at 4–6 weeks. This is completely normal.' ],
      [ 'question' => 'What products should I avoid on healed brows?', 'answer' => 'Avoid retinol, AHAs, BHAs, and exfoliants directly on the brow area as these cause the pigment to fade faster. Use SPF daily — UV exposure is the biggest cause of premature fading.' ],
      [ 'question' => 'My brows are peeling — is this normal?', 'answer' => 'Yes, light flaking between days 4–8 is a normal part of healing. Do not pick or peel the skin — pulling off flakes removes pigment and can cause patchiness. Let the skin shed naturally.' ],
    ],
  ],
  [
    'category_name' => 'Booking & Pricing',
    'category_icon' => '◎',
    'faq_items'     => [
      [ 'question' => 'How do I book an appointment?', 'answer' => 'Book directly through the booking page — select your service, choose a date and time, and complete the scheduling form. You\'ll receive a confirmation email immediately.' ],
      [ 'question' => 'Is a deposit required?', 'answer' => 'Yes, a deposit is required to secure your appointment. It is deducted from your total on the day. Deposits are non-refundable if you cancel with less than 48 hours notice.' ],
      [ 'question' => 'What is your cancellation policy?', 'answer' => 'Please cancel or reschedule at least 48 hours before your appointment to avoid losing your deposit. If something comes up, reach out as early as possible and Gabrielle will do her best to accommodate you.' ],
      [ 'question' => 'Do you offer consultations?', 'answer' => 'A brief consultation is included at the start of every semi-permanent appointment. For corrections or complex cases, a separate consultation can be arranged — contact Gabrielle directly.' ],
      [ 'question' => 'Are prices listed on the website final?', 'answer' => 'Prices shown are starting prices. The final cost may vary based on complexity or add-ons discussed at your consultation. Gabrielle will always confirm pricing before beginning any work.' ],
    ],
  ],
];

$categories = get_field( 'faq_categories' ) ?: $fallback_categories;
?>

<section class="faq-hero">
  <div class="faq-hero-text">
    <div class="tag"><?php echo esc_html( $tag ); ?></div>
    <h1 class="faq-headline"><?php echo esc_html( $headline ); ?></h1>
    <p class="faq-sub"><?php echo esc_html( $sub ); ?></p>
  </div>
  <nav class="faq-jump-nav" aria-label="Jump to FAQ category">
    <?php foreach ( $categories as $i => $cat ) : ?>
      <a href="#faq-cat-<?php echo $i; ?>" class="faq-jump-link">
        <?php if ( ! empty( $cat['category_icon'] ) ) : ?>
          <span class="faq-jump-icon"><?php echo esc_html( $cat['category_icon'] ); ?></span>
        <?php endif; ?>
        <?php echo esc_html( $cat['category_name'] ); ?>
      </a>
    <?php endforeach; ?>
  </nav>
</section>

<section class="section section--white">
  <div class="faq-page-wrap">
    <?php foreach ( $categories as $i => $cat ) :
      $items = $cat['faq_items'] ?? [];
      if ( empty( $items ) ) continue;
    ?>
      <div class="faq-category" id="faq-cat-<?php echo $i; ?>">
        <div class="faq-cat-header">
          <?php if ( ! empty( $cat['category_icon'] ) ) : ?>
            <div class="faq-cat-icon"><?php echo esc_html( $cat['category_icon'] ); ?></div>
          <?php endif; ?>
          <h2 class="faq-cat-title"><?php echo esc_html( $cat['category_name'] ); ?></h2>
        </div>
        <div class="faq-list">
          <?php foreach ( $items as $j => $item ) :
            $q_id = 'faq-' . $i . '-' . $j;
            $a_id = 'faq-a-' . $i . '-' . $j;
          ?>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false" aria-controls="<?php echo $a_id; ?>" id="<?php echo $q_id; ?>" type="button">
                <span><?php echo esc_html( $item['question'] ); ?></span>
                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                  <polyline points="4 7 9 12 14 7"/>
                </svg>
              </button>
              <!-- No hidden attribute — max-height controls open/closed state -->
              <div class="faq-a" id="<?php echo $a_id; ?>" role="region" aria-labelledby="<?php echo $q_id; ?>">
                <div class="faq-a-inner">
                  <?php echo wp_kses_post( nl2br( esc_html( $item['answer'] ) ) ); ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="faq-contact-cta">
  <div class="faq-cta-inner">
    <div class="faq-cta-text">
      <h2>Still have a question?</h2>
      <p>Gabrielle is happy to answer anything before you book. Send a message and she'll get back to you personally within 24 hours.</p>
    </div>
    <div class="faq-cta-actions">
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' ) ); ?>" class="btn-primary">Send a Message</a>
      <a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>" class="btn-ghost" target="_blank" rel="noopener noreferrer">Book an Appointment</a>
    </div>
  </div>
</section>

<script>
(function() {

  // ── FAQ Accordion ─────────────────────────────────────────────
  // Controlled entirely by max-height — no hidden attribute needed.
  // Closed = max-height: 0 / overflow: hidden
  // Open   = max-height: scrollHeight px

  function closeItem(btn) {
    var a = document.getElementById(btn.getAttribute('aria-controls'));
    if (!a) return;
    btn.setAttribute('aria-expanded', 'false');
    a.style.maxHeight = '0';
  }

  function openItem(btn) {
    var a = document.getElementById(btn.getAttribute('aria-controls'));
    if (!a) return;
    btn.setAttribute('aria-expanded', 'true');
    a.style.maxHeight = a.scrollHeight + 'px';
  }

  document.querySelectorAll('.faq-q').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var isOpen = btn.getAttribute('aria-expanded') === 'true';

      // Close every item in this category first
      var cat = btn.closest('.faq-category');
      if (cat) {
        cat.querySelectorAll('.faq-q').forEach(function(other) {
          closeItem(other);
        });
      }

      // If it was closed, open it
      if (!isOpen) {
        openItem(btn);
      }
      // If it was already open, closeItem above already closed it — done
    });
  });

  // ── Smooth scroll jump nav ────────────────────────────────────
  document.querySelectorAll('.faq-jump-link').forEach(function(link) {
    link.addEventListener('click', function(e) {
      var target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      var top = target.getBoundingClientRect().top + window.scrollY - 90;
      window.scrollTo({ top: top, behavior: 'smooth' });
      document.querySelectorAll('.faq-jump-link').forEach(function(l) { l.classList.remove('active'); });
      link.classList.add('active');
    });
  });

  // ── Active jump link on scroll ────────────────────────────────
  var cats  = document.querySelectorAll('.faq-category');
  var jumps = document.querySelectorAll('.faq-jump-link');
  if (cats.length && jumps.length) {
    window.addEventListener('scroll', function() {
      var y = window.scrollY + 120;
      var active = 0;
      cats.forEach(function(c, i) { if (c.offsetTop <= y) active = i; });
      jumps.forEach(function(l) { l.classList.remove('active'); });
      if (jumps[active]) jumps[active].classList.add('active');
    }, { passive: true });
  }

})();
</script>

<?php get_footer(); ?>