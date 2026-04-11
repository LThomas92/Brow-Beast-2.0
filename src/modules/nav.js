/**
 * Nav Module — Brow Beast
 * Save as src/modules/nav.js
 */

export function initNav() {
  const hamburger  = document.querySelector( '.nav-hamburger' );
  const drawer     = document.getElementById( 'mobileDrawer' );
  const backdrop   = drawer?.querySelector( '.drawer-backdrop' );
  const closeBtn   = drawer?.querySelector( '.drawer-close' );
  const siteNav    = document.querySelector( '.site-nav' );

  if ( ! hamburger || ! drawer ) return;

  let isOpen = false;

  // ── Open ─────────────────────────────────────────────────────
  function openDrawer() {
    isOpen = true;

    // 1. Make drawer visible and block scroll immediately
    drawer.style.display     = 'block';
    document.body.style.overflow = 'hidden';

    // 2. Force reflow so the browser registers the element
    //    before transitions begin
    drawer.getBoundingClientRect();

    // 3. Add .open — CSS transitions fire from here
    drawer.classList.add( 'open' );
    hamburger.classList.add( 'is-open' );
    hamburger.setAttribute( 'aria-expanded', 'true' );
    drawer.setAttribute( 'aria-hidden', 'false' );

    // 4. After panel slides in, focus the first link
    setTimeout( () => {
      const first = drawer.querySelector( '.drawer-link' );
      if ( first ) first.focus();
    }, 450 );
  }

  // ── Close ─────────────────────────────────────────────────────
  function closeDrawer() {
    isOpen = false;
    drawer.classList.remove( 'open' );
    hamburger.classList.remove( 'is-open' );
    hamburger.setAttribute( 'aria-expanded', 'false' );
    drawer.setAttribute( 'aria-hidden', 'true' );
    document.body.style.overflow = '';

    // Hide drawer after slide-out animation completes
    setTimeout( () => {
      if ( ! isOpen ) drawer.style.display = 'none';
    }, 420 );

    hamburger.focus();
  }

  hamburger.addEventListener( 'click', () => isOpen ? closeDrawer() : openDrawer() );
  closeBtn?.addEventListener( 'click', closeDrawer );
  backdrop?.addEventListener( 'click', closeDrawer );

  // Close when a nav link is clicked
  drawer.querySelectorAll( '.drawer-link, .drawer-cta' ).forEach( el => {
    el.addEventListener( 'click', closeDrawer );
  } );

  // Escape key
  document.addEventListener( 'keydown', e => {
    if ( e.key === 'Escape' && isOpen ) closeDrawer();
  } );

  // ── Nav scroll shadow ─────────────────────────────────────────
  if ( siteNav ) {
    const onScroll = () => siteNav.classList.toggle( 'scrolled', window.scrollY > 10 );
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
  }
}