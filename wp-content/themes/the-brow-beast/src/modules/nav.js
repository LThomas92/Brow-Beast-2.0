/**
 * Nav Module
 * Handles: split nav scroll behaviour, mobile drawer open/close
 */

export function initNav() {
	const nav    = document.querySelector( '.site-nav' );
	const drawer = document.querySelector( '.mobile-drawer' );
	const toggle = document.querySelector( '.nav-hamburger' );
	const close  = document.querySelector( '.drawer-close' );

	// ── Scroll: add .scrolled class for compact nav behaviour
	if ( nav ) {
		const onScroll = () => nav.classList.toggle( 'scrolled', window.scrollY > 40 );
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	// ── Mobile drawer
	toggle?.addEventListener( 'click', () => {
		drawer?.classList.add( 'open' );
		document.body.classList.add( 'drawer-open' );
	} );

	close?.addEventListener( 'click', closeDrawer );

	// Close on backdrop tap
	drawer?.addEventListener( 'click', ( e ) => {
		if ( e.target === drawer ) closeDrawer();
	} );

	// Close on Escape
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' ) closeDrawer();
	} );

	function closeDrawer() {
		drawer?.classList.remove( 'open' );
		document.body.classList.remove( 'drawer-open' );
	}
}
