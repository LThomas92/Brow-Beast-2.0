/**
 * Booking Page — Acuity integration
 * Save as src/modules/booking.js
 */

export function initBooking() {

  // ── Guard: only run on booking page ────────────────────────────
  const svcOptions = document.getElementById( 'svcOptions' );
  if ( ! svcOptions ) return;

  const proceedBtn  = document.getElementById( 'proceedToAcuity' );
  const backBtn     = document.getElementById( 'backToService' );
  const stepService = document.getElementById( 'stepService' );
  const stepAcuity  = document.getElementById( 'stepAcuity' );
  const iframe      = document.getElementById( 'acuityIframe' );
  const loading     = document.getElementById( 'acuityLoading' );
  const panelTitle  = document.getElementById( 'acuityPanelTitle' );

  // ── Debug: log which elements were found ───────────────────────
  // Remove this block once confirmed working
  console.group( '[Brow Beast] Booking init' );
  console.log( 'svcOptions:',  svcOptions  ? '✓' : '✗ NOT FOUND' );
  console.log( 'proceedBtn:',  proceedBtn  ? '✓' : '✗ NOT FOUND' );
  console.log( 'stepService:', stepService ? '✓' : '✗ NOT FOUND' );
  console.log( 'stepAcuity:',  stepAcuity  ? '✓' : '✗ NOT FOUND' );
  console.log( 'iframe:',      iframe      ? '✓' : '✗ NOT FOUND' );
  console.groupEnd();

  // ── Service option click/keyboard handlers ─────────────────────
  const opts = svcOptions.querySelectorAll( '.svc-opt' );

  if ( opts.length === 0 ) {
    console.warn( '[Brow Beast] No .svc-opt elements found inside #svcOptions' );
    return;
  }

  opts.forEach( opt => {
    opt.addEventListener( 'click',   () => selectService( opt ) );
    opt.addEventListener( 'keydown', e => {
      if ( e.key === 'Enter' || e.key === ' ' ) {
        e.preventDefault();
        selectService( opt );
      }
    } );
  } );

  function selectService( opt ) {
    opts.forEach( o => {
      o.classList.remove( 'selected' );
      o.setAttribute( 'aria-checked', 'false' );
    } );
    opt.classList.add( 'selected' );
    opt.setAttribute( 'aria-checked', 'true' );
    updateSummary( opt );
    console.log( '[Brow Beast] Selected service:', opt.dataset.svc );
  }

  function updateSummary( opt ) {
    const el = id => document.getElementById( id );
    if ( el( 'summaryName' ) )   el( 'summaryName' ).textContent   = opt.dataset.svc    || '';
    if ( el( 'summaryDetail' ) ) el( 'summaryDetail' ).textContent = opt.dataset.detail || '';
    if ( el( 'summaryPrice' ) )  el( 'summaryPrice' ).textContent  = opt.dataset.price  || '';
  }

  // ── Proceed button ─────────────────────────────────────────────
  if ( ! proceedBtn ) {
    console.warn( '[Brow Beast] #proceedToAcuity button not found' );
  } else {
    proceedBtn.addEventListener( 'click', () => {
      const selected = svcOptions.querySelector( '.svc-opt.selected' );
      if ( ! selected ) {
        console.warn( '[Brow Beast] No service selected when proceed clicked' );
        return;
      }
      console.log( '[Brow Beast] Proceeding to Acuity with URL:', selected.dataset.acuityUrl );
      showAcuityEmbed( selected.dataset.acuityUrl, selected.dataset.svc );
    } );
  }

  // ── Load Acuity iframe ─────────────────────────────────────────
  function showAcuityEmbed( url, svcName ) {
    if ( ! stepService || ! stepAcuity ) {
      console.warn( '[Brow Beast] Step panels not found — check #stepService and #stepAcuity IDs in PHP' );
      return;
    }

    stepService.hidden = true;
    stepAcuity.hidden  = false;
    setStepActive( 2 );

    if ( panelTitle ) {
      panelTitle.textContent = `Choose a date & time — ${ svcName }`;
    }

    if ( ! iframe ) {
      console.warn( '[Brow Beast] #acuityIframe not found' );
      return;
    }

    // Only reload if URL actually changed
    if ( iframe.src === url ) {
      if ( loading ) loading.style.display = 'none';
      iframe.style.display = 'block';
      return;
    }

    if ( loading ) loading.style.display = 'flex';
    iframe.style.display = 'none';
    iframe.src = url;

    iframe.addEventListener( 'load', () => {
      if ( loading ) loading.style.display = 'none';
      iframe.style.display = 'block';
      console.log( '[Brow Beast] Acuity iframe loaded' );
    }, { once: true } );
  }

  // ── Back button ────────────────────────────────────────────────
  backBtn?.addEventListener( 'click', () => {
    stepAcuity.hidden  = true;
    stepService.hidden = false;
    setStepActive( 1 );
  } );

  // ── Step indicator ─────────────────────────────────────────────
  function setStepActive( activeStep ) {
    document.querySelectorAll( '.bk-step-num' ).forEach( ( el, i ) => {
      el.classList.toggle( 'active',   i + 1 === activeStep );
      el.classList.toggle( 'inactive', i + 1 !== activeStep );
    } );
    document.querySelectorAll( '.bk-step-label' ).forEach( ( el, i ) => {
      el.classList.toggle( 'active',   i + 1 === activeStep );
      el.classList.toggle( 'inactive', i + 1 !== activeStep );
    } );
  }

  // ── Acuity postMessage: auto-resize iframe ─────────────────────
  window.addEventListener( 'message', e => {
    if ( typeof e.data !== 'object' || ! e.origin.includes( 'acuityscheduling.com' ) ) return;
    if ( e.data.height && iframe ) {
      iframe.style.height = e.data.height + 'px';
    }
    if ( e.data.status === 'confirmed' ) {
      setStepActive( 4 );
      const row = document.getElementById( 'summaryDateRow' );
      if ( row ) row.style.display = 'flex';
    }
  } );

  // ── URL param pre-selection ────────────────────────────────────
  const preselect = new URLSearchParams( window.location.search ).get( 'service' );
  if ( preselect ) {
    opts.forEach( opt => {
      const slug = opt.dataset.svc.toLowerCase().replace( /[^a-z0-9]+/g, '-' );
      if ( slug.includes( preselect.toLowerCase() ) ) {
        selectService( opt );
        console.log( '[Brow Beast] URL param pre-selected:', opt.dataset.svc );
      }
    } );
  }

}