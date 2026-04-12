export function initFAQ() {
  const items = document.querySelectorAll( '.faq-item' );
  if ( ! items.length ) return;

  // Force all closed on init
  document.querySelectorAll( '.faq-a' ).forEach( a => {
    a.style.overflow  = 'hidden';
    a.style.maxHeight = '0';
  } );

  items.forEach( item => {
    const btn = item.querySelector( '.faq-q' );
    if ( ! btn ) return;

    btn.addEventListener( 'click', () => {
      const isOpen  = btn.getAttribute( 'aria-expanded' ) === 'true';
      const answer  = document.getElementById( btn.getAttribute( 'aria-controls' ) );
      const cat     = btn.closest( '.faq-category' );

      // Close all others in same category
      if ( cat ) {
        cat.querySelectorAll( '.faq-q[aria-expanded="true"]' ).forEach( other => {
          if ( other === btn ) return;
          other.setAttribute( 'aria-expanded', 'false' );
          const a = document.getElementById( other.getAttribute( 'aria-controls' ) );
          if ( a ) { a.style.overflow = 'hidden'; a.style.maxHeight = '0'; }
        } );
      }

      if ( isOpen ) {
        btn.setAttribute( 'aria-expanded', 'false' );
        if ( answer ) { answer.style.overflow = 'hidden'; answer.style.maxHeight = '0'; }
      } else {
        btn.setAttribute( 'aria-expanded', 'true' );
        if ( answer ) {
          answer.style.overflow  = 'hidden';
          const inner = answer.querySelector( '.faq-a-inner' );
          answer.style.maxHeight = ( inner ? inner.offsetHeight + 40 : answer.scrollHeight ) + 'px';
        }
      }
    } );
  } );
}