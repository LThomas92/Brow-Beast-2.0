/**
 * Gallery Module — Brow Beast
 * Save as src/modules/gallery.js
 */

export function initGallery() {
  const grid         = document.getElementById( 'gallery' );
  const loadMoreWrap = document.getElementById( 'galleryLoadMore' );
  const loadMoreBtn  = document.getElementById( 'loadMoreBtn' );

  // Guard — only run on gallery page
  if ( ! grid ) return;

  const siteUrl = ( window.BrowBeast?.siteUrl ?? '' ).replace( /\/$/, '' );

  let currentFilter = 'all';
  let currentPage   = 1;
  let totalPages    = 1;
  let isLoading     = false;

  // ── Filter buttons ────────────────────────────────────────────
  // Query AFTER guard so we know we're on the gallery page.
  // Use event delegation on the filter bar so it works even if
  // buttons are injected dynamically.
  const filterBar = document.querySelector( '.filter-bar' );

  if ( filterBar ) {
    filterBar.addEventListener( 'click', e => {
      const btn = e.target.closest( '.filter-btn' );
      if ( ! btn ) return;

      const filter = btn.dataset.filter;
      if ( filter === currentFilter ) return;

      // Update active state
      filterBar.querySelectorAll( '.filter-btn' ).forEach( b => b.classList.remove( 'active' ) );
      btn.classList.add( 'active' );

      currentFilter = filter;
      currentPage   = 1;
      fetchGallery( filter, 1, false );
    } );
  }

  // ── Load more ─────────────────────────────────────────────────
  loadMoreBtn?.addEventListener( 'click', () => {
    if ( isLoading || currentPage >= totalPages ) return;
    fetchGallery( currentFilter, currentPage + 1, true );
  } );

  // ── Initial fetch — replaces PHP fallback with live API data ──
  fetchGallery( 'all', 1, false );

  // ── Core fetch ────────────────────────────────────────────────
  async function fetchGallery( filter, page, append ) {
    if ( isLoading ) return;
    isLoading = true;
    grid.classList.add( 'is-loading' );

    const params = new URLSearchParams( { per_page: 12, page } );
    if ( filter !== 'all' ) params.set( 'service', filter );

    try {
      const res = await fetch( `${ siteUrl }/wp-json/browbeast/v1/gallery?${ params }` );
      if ( ! res.ok ) throw new Error( `HTTP ${ res.status }` );
      const data = await res.json();

      totalPages  = data.totalPages ?? 1;
      currentPage = page;

      const html = data.items?.length
        ? data.items.map( buildCard ).join( '' )
        : '<p class="gallery-empty">No results for this filter.</p>';

      if ( append ) {
        const frag = document.createElement( 'div' );
        frag.innerHTML = html;
        while ( frag.firstChild ) grid.appendChild( frag.firstChild );
      } else {
        grid.innerHTML = html;
      }

      if ( loadMoreWrap ) {
        loadMoreWrap.style.display = currentPage < totalPages ? 'block' : 'none';
      }

    } catch ( err ) {
      console.warn( '[BrowBeast Gallery] Fetch failed:', err.message );
      // PHP-rendered fallback stays — just exit loading state
    } finally {
      grid.classList.remove( 'is-loading' );
      isLoading = false;
    }
  }

  function buildCard( item ) {
    const cats  = Array.isArray( item.services ) ? item.services.join( ' ' ) : '';
    const label = item.services?.[0]
      ? item.services[0].charAt(0).toUpperCase() + item.services[0].slice(1)
      : esc( item.title );

    const imgHtml = item.image
      ? `<img src="${ esc( item.image ) }" alt="${ esc( item.title ) }" loading="lazy">`
      : `<div class="ph ph-mid c1"></div>`;

    return `
      <div class="masonry-item" data-cat="${ esc( cats ) }">
        ${ imgHtml }
        <div class="item-overlay">
          <div class="item-tag">${ esc( label ) }</div>
        </div>
      </div>`;
  }

  function esc( s ) {
    return String( s ?? '' )
      .replace( /&/g,'&amp;' ).replace( /</g,'&lt;' )
      .replace( />/g,'&gt;'  ).replace( /"/g,'&quot;' );
  }
}


// ── Before/After Sliders ──────────────────────────────────────────
export function initBASliders() {
  document.querySelectorAll( '.ba-slider-wrap' ).forEach( wrap => {
    const afterImg = wrap.querySelector( '.ba-after' );
    const handle   = wrap.querySelector( '.ba-handle' );
    if ( ! afterImg || ! handle ) return;

    let dragging = false;

    // Start at 50%
    afterImg.style.clipPath = 'inset(0 50% 0 0)';
    handle.style.left       = '50%';

    function setPos( clientX ) {
      const rect = wrap.getBoundingClientRect();
      const pct  = Math.max( 0.01, Math.min( 0.99, ( clientX - rect.left ) / rect.width ) );
      afterImg.style.clipPath = `inset(0 ${ ( 1 - pct ) * 100 }% 0 0)`;
      handle.style.left       = `${ pct * 100 }%`;
    }

    wrap.addEventListener( 'mousedown',  e => { dragging = true; setPos( e.clientX ); e.preventDefault(); } );
    document.addEventListener( 'mousemove',  e => { if ( dragging ) setPos( e.clientX ); } );
    document.addEventListener( 'mouseup',    () => { dragging = false; } );

    wrap.addEventListener( 'touchstart', e => { dragging = true; setPos( e.touches[0].clientX ); }, { passive: true } );
    document.addEventListener( 'touchmove',  e => { if ( dragging ) setPos( e.touches[0].clientX ); }, { passive: true } );
    document.addEventListener( 'touchend',   () => { dragging = false; } );
  } );
}