<?php
/**
 * Template Name: Brow Quiz
 */
get_header();

$booking_url = get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' );
$services_url = get_permalink( get_page_by_path( 'services' ) ) ?: home_url( '/services/' );

// Service page URLs for result book buttons
$service_urls = [
  'henna'       => get_permalink( get_page_by_path( 'henna-brows' ) )              ?: $booking_url,
  'strokeblend' => get_permalink( get_page_by_path( 'strokeblend-combo-brows' ) )  ?: $booking_url,
  'softblend'   => get_permalink( get_page_by_path( 'softblend-ombre-brows' ) )    ?: $booking_url,
  'waxing'      => get_permalink( get_page_by_path( 'brow-waxing' ) )              ?: $booking_url,
];
?>

<div class="quiz-page">

  <div class="quiz-header">
    <div class="tag">3-question quiz</div>
    <h1 class="quiz-headline">Find your <em>perfect brow</em></h1>
    <p class="quiz-sub">Answer three quick questions and we'll match you with the service that suits your skin, lifestyle, and goals.</p>
  </div>

  <div class="quiz-progress" id="quizProgress">
    <div class="progress-dot active" id="dot0"></div>
    <div class="progress-dot" id="dot1"></div>
    <div class="progress-dot" id="dot2"></div>
  </div>

  <!-- STEP 1 -->
  <div class="quiz-card quiz-step active" id="step0">
    <div class="quiz-q-num">Question 1 of 3</div>
    <h2 class="quiz-question">What's your <em>skin type?</em></h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="oily">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">Oily or combination</div><div class="option-sublabel">My skin tends to shine by midday</div></div>
      </div>
      <div class="quiz-option" data-val="dry">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Dry or normal</div><div class="option-sublabel">My skin rarely gets oily</div></div>
      </div>
      <div class="quiz-option" data-val="sensitive">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Sensitive</div><div class="option-sublabel">My skin reacts easily to products</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" id="back0" type="button" style="visibility:hidden;">← Back</button>
      <button class="quiz-next" id="next0" type="button">Continue →</button>
    </div>
  </div>

  <!-- STEP 2 -->
  <div class="quiz-card quiz-step" id="step1">
    <div class="quiz-q-num">Question 2 of 3</div>
    <h2 class="quiz-question">How much <em>maintenance</em> do you want?</h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="none">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Wake up and go</div><div class="option-sublabel">I want zero effort brows every day</div></div>
      </div>
      <div class="quiz-option" data-val="little">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">A little touch-up is fine</div><div class="option-sublabel">I can spend 2–5 minutes on brows</div></div>
      </div>
      <div class="quiz-option" data-val="flexible">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Open to anything</div><div class="option-sublabel">I just want beautiful brows</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" id="back1" type="button">← Back</button>
      <button class="quiz-next" id="next1" type="button">Continue →</button>
    </div>
  </div>

  <!-- STEP 3 -->
  <div class="quiz-card quiz-step" id="step2">
    <div class="quiz-q-num">Question 3 of 3</div>
    <h2 class="quiz-question">What look are you <em>going for?</em></h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="natural">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Soft and natural</div><div class="option-sublabel">Enhanced, but looks like my own brows</div></div>
      </div>
      <div class="quiz-option" data-val="defined">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">Bold and defined</div><div class="option-sublabel">I want noticeable, striking brows</div></div>
      </div>
      <div class="quiz-option" data-val="both">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Somewhere in between</div><div class="option-sublabel">Defined but still natural-looking</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" id="back2" type="button">← Back</button>
      <button class="quiz-next" id="next2" type="button">See My Result →</button>
    </div>
  </div>

  <!-- RESULT -->
  <div class="quiz-result" id="quizResult" style="display:none;">
    <div class="result-card">
      <div class="result-img" id="resultImg"></div>
      <div class="result-body">
        <div class="result-match">Your perfect match</div>
        <h2 class="result-name" id="resultName"></h2>
        <p class="result-desc" id="resultDesc"></p>
        <div class="result-details" id="resultDetails"></div>
        <div class="result-btns">
          <a href="#" class="btn-primary" id="resultBookBtn">Book This Service</a>
          <button class="quiz-retake" id="retakeBtn" type="button">Retake Quiz</button>
        </div>
      </div>
    </div>
  </div>

</div><!-- .quiz-page -->

<script>
(function() {
  'use strict';

  // ── Service URLs from PHP ─────────────────────────────────────
  var SERVICE_URLS = {
    henna:       '<?php echo esc_js( $service_urls['henna'] ); ?>',
    strokeblend: '<?php echo esc_js( $service_urls['strokeblend'] ); ?>',
    softblend:   '<?php echo esc_js( $service_urls['softblend'] ); ?>',
    waxing:      '<?php echo esc_js( $service_urls['waxing'] ); ?>',
  };

  var BOOKING_URL = '<?php echo esc_js( $booking_url ); ?>';

  // ── State ─────────────────────────────────────────────────────
  var answers     = { skin: null, maintenance: null, look: null };
  var currentStep = 0;
  var KEY_MAP     = ['skin', 'maintenance', 'look'];

  // ── Results data ──────────────────────────────────────────────
  var results = {
    henna: {
      name:      'Henna Brows',
      nameHtml:  '<em>Henna Brows</em>',
      desc:      'Based on your answers, Henna Brows are your ideal starting point. Natural plant-based pigment gives you beautiful colour and definition for up to 2 weeks with zero downtime — perfect for sensitive skin or a commitment-free first step.',
      duration:  '60 min',
      longevity: 'Up to 2 weeks',
      price:     'From $75',
      gradient:  'linear-gradient(140deg,#E8D5C4,#C9A882)',
    },
    strokeblend: {
      name:      'StrokeBlend™ Combo Brows',
      nameHtml:  'StrokeBlend™ <em>Combo Brows</em>',
      desc:      'Your answers point to StrokeBlend™ — Gabrielle\'s signature semi-permanent technique combining hair strokes with powder shading. The result is incredibly natural-looking brows with lasting dimension. Wake up with perfect brows every single day.',
      duration:  '2–2.5 hrs',
      longevity: '12–18 months',
      price:     'From $350',
      gradient:  'linear-gradient(140deg,#D4B896,#896C54)',
    },
    softblend: {
      name:      'SoftBlend™ Ombré Brows',
      nameHtml:  'SoftBlend™ <em>Ombré Brows</em>',
      desc:      'Your lifestyle and look preferences are a perfect match for SoftBlend™ Ombré Brows. A soft powdered gradient that starts lighter at the head and deepens at the tail — bold, defined, and effortlessly beautiful with semi-permanent staying power.',
      duration:  '2 hrs',
      longevity: '12–18 months',
      price:     'From $300',
      gradient:  'linear-gradient(140deg,#C9A882,#5C3D2E)',
    },
    waxing: {
      name:      'Brow Waxing & Shaping',
      nameHtml:  'Brow Waxing <em>&amp; Shaping</em>',
      desc:      'For you, precision waxing and shaping is the perfect match. Gabrielle\'s expert eye for shape and symmetry will define your natural brow architecture — clean, polished, and ready for your makeup routine.',
      duration:  '30 min',
      longevity: '3–4 weeks',
      price:     'From $35',
      gradient:  'linear-gradient(140deg,#F2EAE0,#C9A882)',
    },
  };

  // ── Result logic ──────────────────────────────────────────────
  function getResultKey() {
    var skin        = answers.skin;
    var maintenance = answers.maintenance;
    var look        = answers.look;

    if ( skin === 'sensitive' )                             return 'henna';
    if ( maintenance === 'little' )                        return 'henna';
    if ( maintenance === 'none' && look === 'defined' )    return 'softblend';
    if ( maintenance === 'none' )                          return 'strokeblend';
    if ( look === 'defined' )                              return 'softblend';
    if ( look === 'natural' || look === 'both' )           return 'strokeblend';
    return 'strokeblend'; // default
  }

  // ── Navigation ────────────────────────────────────────────────
  function goTo( step ) {
    document.getElementById( 'step' + currentStep ).classList.remove( 'active' );
    currentStep = step;
    document.getElementById( 'step' + step ).classList.add( 'active' );
    updateProgress( step );
    window.scrollTo( { top: 0, behavior: 'smooth' } );
  }

  function updateProgress( step ) {
    for ( var i = 0; i < 3; i++ ) {
      var dot = document.getElementById( 'dot' + i );
      dot.className = 'progress-dot';
      if ( i < step )       dot.classList.add( 'done' );
      else if ( i === step ) dot.classList.add( 'active' );
    }
  }

  // ── Show result ───────────────────────────────────────────────
  function showResult() {
    var key = getResultKey();
    var r   = results[ key ];

    // Hide quiz panels
    for ( var i = 0; i < 3; i++ ) {
      document.getElementById( 'step' + i ).classList.remove( 'active' );
    }
    document.getElementById( 'quizProgress' ).style.display = 'none';

    // Populate result card
    document.getElementById( 'resultImg' ).style.background  = r.gradient;
    document.getElementById( 'resultName' ).innerHTML        = r.nameHtml;
    document.getElementById( 'resultDesc' ).textContent      = r.desc;
    document.getElementById( 'resultDetails' ).innerHTML     =
      '<div class="result-detail-item"><div class="detail-label">Duration</div><div class="detail-val">' + r.duration + '</div></div>' +
      '<div class="result-detail-item"><div class="detail-label">Results last</div><div class="detail-val">' + r.longevity + '</div></div>' +
      '<div class="result-detail-item"><div class="detail-label">Starting from</div><div class="detail-val">' + r.price + '</div></div>';

    // Book button — links to the individual service page
    var bookBtn = document.getElementById( 'resultBookBtn' );
    bookBtn.href        = SERVICE_URLS[ key ] || BOOKING_URL;
    bookBtn.textContent = 'Book ' + r.name;

    document.getElementById( 'quizResult' ).style.display = 'block';
    window.scrollTo( { top: 0, behavior: 'smooth' } );
  }

  // ── Retake ────────────────────────────────────────────────────
  function retakeQuiz() {
    answers = { skin: null, maintenance: null, look: null };

    document.querySelectorAll( '.quiz-option' ).forEach( function(o) { o.classList.remove( 'selected' ); } );
    document.querySelectorAll( '.quiz-next' ).forEach( function(b) { b.classList.remove( 'enabled' ); } );

    document.getElementById( 'quizResult' ).style.display   = 'none';
    document.getElementById( 'quizProgress' ).style.display = '';
    currentStep = 0;

    // Ensure all steps are hidden then show step 0
    for ( var i = 0; i < 3; i++ ) {
      document.getElementById( 'step' + i ).classList.remove( 'active' );
    }
    document.getElementById( 'step0' ).classList.add( 'active' );
    updateProgress( 0 );
    window.scrollTo( { top: 0, behavior: 'smooth' } );
  }

  // ── Wire up option clicks ─────────────────────────────────────
  document.querySelectorAll( '.quiz-step' ).forEach( function( card, stepIdx ) {
    card.querySelectorAll( '.quiz-option' ).forEach( function( opt ) {
      opt.addEventListener( 'click', function() {
        // Deselect all options in this step
        card.querySelectorAll( '.quiz-option' ).forEach( function(o) { o.classList.remove( 'selected' ); } );
        opt.classList.add( 'selected' );

        // Save answer
        answers[ KEY_MAP[ stepIdx ] ] = opt.getAttribute( 'data-val' );

        // Enable the next/continue button
        var nextBtn = document.getElementById( 'next' + stepIdx );
        if ( nextBtn ) nextBtn.classList.add( 'enabled' );
      } );
    } );
  } );

  // ── Wire up next buttons ──────────────────────────────────────
  document.getElementById( 'next0' ).addEventListener( 'click', function() {
    if ( answers.skin ) goTo( 1 );
  } );

  document.getElementById( 'next1' ).addEventListener( 'click', function() {
    if ( answers.maintenance ) goTo( 2 );
  } );

  document.getElementById( 'next2' ).addEventListener( 'click', function() {
    if ( answers.look ) showResult();
  } );

  // ── Wire up back buttons ──────────────────────────────────────
  document.getElementById( 'back1' ).addEventListener( 'click', function() { goTo( 0 ); } );
  document.getElementById( 'back2' ).addEventListener( 'click', function() { goTo( 1 ); } );

  // ── Wire up retake button ─────────────────────────────────────
  document.getElementById( 'retakeBtn' ).addEventListener( 'click', retakeQuiz );

})();
</script>

<?php get_footer(); ?>