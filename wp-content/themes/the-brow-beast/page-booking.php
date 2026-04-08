<?php
/**
 * Template Name: Booking Page
 */

get_header();

$acuity_owner = '19201786';
$acuity_base  = "https://app.acuityscheduling.com/schedule.php?owner={$acuity_owner}";
$acf_services = get_field( 'booking_services' );
$preselect    = sanitize_text_field( $_GET['service'] ?? '' );

$services = $acf_services ?: [
  [ 'service_name' => 'StrokeBlend™ Combo Brows', 'service_detail' => 'Semi-permanent · 2–2.5 hrs · Touch-up included', 'service_price' => '$350', 'service_image' => null, 'acuity_type_id' => '' ],
  [ 'service_name' => 'SoftBlend™ Ombré Brows',   'service_detail' => 'Semi-permanent · 2 hrs',                          'service_price' => '$300', 'service_image' => null, 'acuity_type_id' => '' ],
  [ 'service_name' => 'Henna Brows',               'service_detail' => 'Natural · 60 min · No downtime',                 'service_price' => '$75',  'service_image' => null, 'acuity_type_id' => '' ],
  [ 'service_name' => 'Brow Waxing & Shaping',     'service_detail' => 'Classic · 30 min',                               'service_price' => '$35',  'service_image' => null, 'acuity_type_id' => '' ],
  [ 'service_name' => 'Corrections',               'service_detail' => 'Corrective · Consultation required',             'service_price' => 'TBD',  'service_image' => null, 'acuity_type_id' => '' ],
];
?>

<!-- ── HERO ───────────────────────────────────────────────────── -->
<div class="bk-hero">
  <div class="bk-hero-text">
    <div class="bk-tag">Acuity Scheduling</div>
    <h1 class="bk-headline">Book your<br><em>appointment</em></h1>
    <p class="bk-sub">With Gabrielle Lowe · Great Neck, NY · 2 Hicks Lane</p>
  </div>

  <!-- Step indicators — clicking steps 1 navigates back -->
  <div class="bk-steps" id="bkSteps">
    <div class="bk-step-wrap" id="stepWrap1">
      <div class="bk-step">
        <div class="bk-step-num active" id="stepNum1">1</div>
        <div class="bk-step-label active" id="stepLbl1">Service</div>
      </div>
    </div>
    <div class="bk-connector" id="conn1"></div>
    <div class="bk-step-wrap" id="stepWrap2">
      <div class="bk-step">
        <div class="bk-step-num inactive" id="stepNum2">2</div>
        <div class="bk-step-label inactive" id="stepLbl2">Date &amp; Time</div>
      </div>
    </div>
    <div class="bk-connector" id="conn2"></div>
    <div class="bk-step-wrap" id="stepWrap3">
      <div class="bk-step">
        <div class="bk-step-num inactive" id="stepNum3">3</div>
        <div class="bk-step-label inactive" id="stepLbl3">Your Details</div>
      </div>
    </div>
    <div class="bk-connector" id="conn3"></div>
    <div class="bk-step-wrap" id="stepWrap4">
      <div class="bk-step">
        <div class="bk-step-num inactive" id="stepNum4">4</div>
        <div class="bk-step-label inactive" id="stepLbl4">Confirm</div>
      </div>
    </div>
  </div>
</div>

<!-- ── BODY ────────────────────────────────────────────────────── -->
<div class="bk-body">
  <div class="bk-main">

    <div class="quiz-link-bar">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#896C54" stroke-width="1.2" stroke-linecap="round"><circle cx="10" cy="10" r="8"/><path d="M10 6v1.5M10 9.5c0-1 1.5-1.5 1.5-3a2.5 2.5 0 00-5 0"/><circle cx="10" cy="14" r=".8" fill="#896C54"/></svg>
      <div class="quiz-link-text">Not sure which service is right for you?</div>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'brow-quiz' ) ) ?: home_url('/brow-quiz/') ); ?>" class="quiz-link-cta">Take the quiz</a>
    </div>

    <!-- ── PANEL 1: Service selector ─────────────────────────── -->
    <div id="panelService">
      <div class="bk-section-title">Choose a service</div>
      <div id="svcOptions">
        <?php foreach ( $services as $i => $svc ) :
          $img        = $svc['service_image'];
          $type_id    = $svc['acuity_type_id'] ?? '';
          $slug       = sanitize_title( $svc['service_name'] );
          $selected   = ( $preselect && str_contains( $slug, $preselect ) ) || ( ! $preselect && $i === 0 );
          $acuity_url = $type_id
            ? $acuity_base . '&appointmentTypeIDs[]=' . rawurlencode( $type_id )
            : $acuity_base;
        ?>
        <div class="svc-opt<?php echo $selected ? ' selected' : ''; ?>"
             data-svc="<?php echo esc_attr( $svc['service_name'] ); ?>"
             data-price="<?php echo esc_attr( $svc['service_price'] ); ?>"
             data-detail="<?php echo esc_attr( $svc['service_detail'] ); ?>"
             data-acuity-url="<?php echo esc_attr( $acuity_url ); ?>">
          <div class="svc-radio"><div class="svc-radio-dot"></div></div>
          <?php if ( $img ) : ?>
            <div class="svc-opt-img has-image"><img src="<?php echo esc_url( $img['sizes']['medium'] ); ?>" alt="<?php echo esc_attr( $svc['service_name'] ); ?>" loading="lazy"></div>
          <?php else : ?>
            <div class="svc-opt-img oi<?php echo ( $i % 5 ) + 1; ?>"></div>
          <?php endif; ?>
          <div class="svc-opt-info">
            <div class="svc-opt-name"><?php echo esc_html( $svc['service_name'] ); ?></div>
            <div class="svc-opt-detail"><?php echo esc_html( $svc['service_detail'] ); ?></div>
          </div>
          <div class="svc-opt-price"><?php echo esc_html( $svc['service_price'] ); ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button class="btn-continue" id="proceedBtn" type="button">Continue to Date &amp; Time →</button>
    </div>

    <!-- ── PANEL 2–4: Acuity embed ───────────────────────────── -->
    <div id="panelAcuity" style="display:none;">

      <!-- Branded step header shown above the iframe -->
      <div class="bk-acuity-header" id="acuityHeader">
        <button class="bk-back-btn" id="backBtn" type="button">← Back</button>
        <div class="bk-acuity-header-content">
          <div class="bk-acuity-step-label" id="acuityStepLabel">Step 2 of 4 — Date &amp; Time</div>
          <div class="bk-acuity-step-desc" id="acuityStepDesc">Select an available date and time for your appointment.</div>
        </div>
      </div>

      <!-- Selected service reminder bar -->
      <div class="bk-service-reminder" id="serviceReminder">
        <div class="bk-reminder-img oi1" id="reminderImg"></div>
        <div class="bk-reminder-info">
          <div class="bk-reminder-name" id="reminderName"></div>
          <div class="bk-reminder-detail" id="reminderDetail"></div>
        </div>
        <button class="bk-reminder-change" id="changeServiceBtn" type="button">Change service</button>
      </div>

      <!-- Loading state -->
      <div class="acuity-embed-wrap">
        <div class="acuity-loading" id="acuityLoading">
          <div class="acuity-loading-inner">
            <div class="acuity-spinner"></div>
            <span>Loading availability…</span>
          </div>
        </div>
        <iframe
          id="acuityIframe"
          src=""
          width="100%"
          height="600"
          frameborder="0"
          title="Book an appointment with The Brow Beast"
          style="display:none;border:none;width:100%;">
        </iframe>
      </div>

    </div>

  </div>

  <!-- ── SIDEBAR ────────────────────────────────────────────── -->
  <div class="bk-sidebar">
    <div class="summary-title">Booking summary</div>
    <div class="selected-svc">
      <div class="sel-img oi1" id="summaryImg"></div>
      <div>
        <div class="sel-name" id="summaryName"><?php echo esc_html( $services[0]['service_name'] ); ?></div>
        <div class="sel-detail" id="summaryDetail"><?php echo esc_html( $services[0]['service_detail'] ); ?></div>
      </div>
    </div>
    <div class="summary-row"><span class="sum-key">Artist</span><span class="sum-val">Gabrielle Lowe</span></div>
    <div class="summary-row"><span class="sum-key">Location</span><span class="sum-val">2 Hicks Lane, Great Neck</span></div>
    <div class="summary-row" id="summaryDateRow" style="display:none;">
      <span class="sum-key">Date &amp; Time</span>
      <span class="sum-val" id="summaryDateTime">—</span>
    </div>
    <div class="summary-total"><span>Starting from</span><span id="summaryPrice"><?php echo esc_html( $services[0]['service_price'] ); ?></span></div>
    <p class="summary-note">A deposit may be required. Cancellations must be made 48 hours in advance to avoid a fee.</p>
    <div class="acuity-badge">
      <div class="acuity-icon"><span>A</span></div>
      <div class="acuity-txt">Powered by Acuity Scheduling</div>
    </div>
    <a href="<?php echo esc_url( $acuity_base ); ?>" class="acuity-direct-link" target="_blank" rel="noopener noreferrer">Open in Acuity directly →</a>
  </div>
</div>

<script>
(function () {

  // ── Element refs ──────────────────────────────────────────────
  var opts          = document.querySelectorAll('#svcOptions .svc-opt');
  var proceedBtn    = document.getElementById('proceedBtn');
  var backBtn       = document.getElementById('backBtn');
  var changeBtn     = document.getElementById('changeServiceBtn');
  var panelService  = document.getElementById('panelService');
  var panelAcuity   = document.getElementById('panelAcuity');
  var iframe        = document.getElementById('acuityIframe');
  var loading       = document.getElementById('acuityLoading');
  var stepLabel     = document.getElementById('acuityStepLabel');
  var stepDesc      = document.getElementById('acuityStepDesc');

  if (!opts.length || !proceedBtn) return;

  // ── Step config ───────────────────────────────────────────────
  var steps = {
    1: { label: 'Step 1 of 4 — Service',       desc: 'Choose the service you\'d like to book.' },
    2: { label: 'Step 2 of 4 — Date & Time',   desc: 'Select an available date and time for your appointment.' },
    3: { label: 'Step 3 of 4 — Your Details',  desc: 'Enter your contact information to confirm your booking.' },
    4: { label: 'Step 4 of 4 — Confirmation',  desc: 'Your appointment is confirmed! Check your email for details.' },
  };

  var currentStep = 1;

  // ── Set active step ───────────────────────────────────────────
  function setStep(n) {
    currentStep = n;
    for (var i = 1; i <= 4; i++) {
      var num  = document.getElementById('stepNum' + i);
      var lbl  = document.getElementById('stepLbl' + i);
      var conn = document.getElementById('conn' + i); // connectors 1–3
      if (!num || !lbl) continue;

      if (i < n) {
        // Completed step
        num.className = 'bk-step-num done';
        num.innerHTML = '✓';
        lbl.className = 'bk-step-label done';
      } else if (i === n) {
        // Active step
        num.className = 'bk-step-num active';
        num.textContent = i;
        lbl.className = 'bk-step-label active';
      } else {
        // Future step
        num.className = 'bk-step-num inactive';
        num.textContent = i;
        lbl.className = 'bk-step-label inactive';
      }

      // Highlight connector between completed steps
      if (conn) {
        conn.className = i < n ? 'bk-connector done' : 'bk-connector';
      }
    }

    // Update branded header above iframe
    if (stepLabel && steps[n]) stepLabel.textContent = steps[n].label;
    if (stepDesc  && steps[n]) stepDesc.textContent  = steps[n].desc;
  }

  // ── Service selection ─────────────────────────────────────────
  opts.forEach(function (opt) {
    opt.addEventListener('click', function () {
      opts.forEach(function (o) { o.classList.remove('selected'); });
      opt.classList.add('selected');

      var name   = opt.getAttribute('data-svc')    || '';
      var detail = opt.getAttribute('data-detail') || '';
      var price  = opt.getAttribute('data-price')  || '';

      // Update summary sidebar
      var el = document.getElementById.bind(document);
      if (el('summaryName'))   el('summaryName').textContent   = name;
      if (el('summaryDetail')) el('summaryDetail').textContent = detail;
      if (el('summaryPrice'))  el('summaryPrice').textContent  = price;

      // Update service reminder bar
      if (el('reminderName'))   el('reminderName').textContent   = name;
      if (el('reminderDetail')) el('reminderDetail').textContent = detail;
    });
  });

  // ── Show Acuity panel ─────────────────────────────────────────
  function showAcuity(url, svcName) {
    panelService.style.display = 'none';
    panelAcuity.style.display  = 'block';
    setStep(2);

    // Scroll to top of booking section
    panelAcuity.scrollIntoView({ behavior: 'smooth', block: 'start' });

    // Load iframe if URL changed
    if (iframe.src === url) {
      loading.style.display = 'none';
      iframe.style.display  = 'block';
      return;
    }

    loading.style.display = 'flex';
    iframe.style.display  = 'none';
    iframe.src = url;

    iframe.onload = function () {
      loading.style.display = 'none';
      iframe.style.display  = 'block';
    };
  }

  // ── Proceed button ────────────────────────────────────────────
  proceedBtn.addEventListener('click', function () {
    var selected = document.querySelector('#svcOptions .svc-opt.selected');
    if (!selected) return;
    showAcuity(
      selected.getAttribute('data-acuity-url') || '',
      selected.getAttribute('data-svc') || ''
    );
  });

  // ── Back / Change service ─────────────────────────────────────
  function goBack() {
    panelAcuity.style.display  = 'none';
    panelService.style.display = 'block';
    setStep(1);
    // Reset iframe so it reloads fresh next time
    iframe.src = '';
    iframe.style.display = 'none';
    loading.style.display = 'flex';
    panelService.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  if (backBtn)   backBtn.addEventListener('click', goBack);
  if (changeBtn) changeBtn.addEventListener('click', goBack);

  // ── Acuity postMessage: step detection + resize ───────────────
  // Acuity sends messages when the user moves between its internal
  // views — we map those to our step indicator.
  window.addEventListener('message', function (e) {
    if (!e.origin || e.origin.indexOf('acuityscheduling.com') === -1) return;

    var data = e.data;
    if (!data || typeof data !== 'object') return;

    // ── Auto-resize iframe
    if (data.height && iframe) {
      iframe.style.height = (parseInt(data.height) + 40) + 'px';
    }

    // ── Step detection via Acuity's message types
    // Acuity postMessages include a 'type' field for navigation events
    if (data.type) {
      switch (data.type) {
        case 'acuity.scheduleView':
        case 'appointmentTypeSelected':
          setStep(2); break;

        case 'acuity.calendarView':
        case 'timeSelected':
          setStep(2); break;

        case 'acuity.formView':
        case 'clientForm':
          setStep(3); break;

        case 'acuity.confirmationView':
        case 'appointmentScheduled':
        case 'confirmed':
          setStep(4);
          showConfirmationState();
          break;
      }
    }

    // Legacy Acuity confirmation signal
    if (data.status === 'confirmed' || data.appointmentId) {
      setStep(4);
      showConfirmationState();
    }
  });

  function showConfirmationState() {
    var dateRow = document.getElementById('summaryDateRow');
    if (dateRow) dateRow.style.display = 'flex';
    // Hide the back button — booking is done
    if (backBtn) backBtn.style.display = 'none';
    if (document.getElementById('changeServiceBtn')) {
      document.getElementById('changeServiceBtn').style.display = 'none';
    }
  }

  // ── URL param pre-selection ───────────────────────────────────
  var preselect = new URLSearchParams(window.location.search).get('service');
  if (preselect) {
    opts.forEach(function (opt) {
      var slug = (opt.getAttribute('data-svc') || '').toLowerCase().replace(/[^a-z0-9]+/g, '-');
      if (slug.indexOf(preselect.toLowerCase()) !== -1) opt.click();
    });
  }

})();
</script>

<?php get_footer(); ?>