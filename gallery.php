<?php
/**
 * Template Name: Gallery Page
 */
get_header();
?>

<!-- ── GALLERY GRID ──────────────────────────────────────────────── -->
<section class="section section--white">
  <div class="sec-header">
    <div>
      <div class="tag" style="margin-bottom:8px;">Real results</div>
      <h1 class="sec-title">Before <em>&amp; After</em> Gallery</h1>
    </div>
  </div>

  <div class="filter-bar" id="filterBar">
    <button class="filter-btn active" data-filter="all" type="button">All</button>
    <?php
    $services = get_terms( [ 'taxonomy' => 'bb_service', 'hide_empty' => true ] );
    if ( ! is_wp_error( $services ) && ! empty( $services ) ) :
      foreach ( $services as $term ) : ?>
        <button class="filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>" type="button">
          <?php echo esc_html( $term->name ); ?>
        </button>
      <?php endforeach;
    else :
      $fallback = [ 'strokeblend' => 'StrokeBlend™', 'softblend' => 'SoftBlend™', 'henna' => 'Henna Brows', 'waxing' => 'Brow Waxing', 'corrections' => 'Corrections' ];
      foreach ( $fallback as $slug => $label ) : ?>
        <button class="filter-btn" data-filter="<?php echo esc_attr( $slug ); ?>" type="button">
          <?php echo esc_html( $label ); ?>
        </button>
      <?php endforeach;
    endif; ?>
  </div>

  <div class="masonry-grid" id="gallery" aria-live="polite">
    <?php
    $gallery_query = new WP_Query( [ 'post_type' => 'bb_gallery', 'posts_per_page' => 12, 'post_status' => 'publish' ] );
    if ( $gallery_query->have_posts() ) :
      while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
        $terms      = wp_get_post_terms( get_the_ID(), 'bb_service', [ 'fields' => 'slugs' ] );
        $term_names = wp_get_post_terms( get_the_ID(), 'bb_service', [ 'fields' => 'names' ] );
        $img_url    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        $label      = ! empty( $term_names ) ? $term_names[0] : get_the_title();
    ?>
      <div class="masonry-item" data-cat="<?php echo esc_attr( implode( ' ', $terms ) ); ?>">
        <?php if ( $img_url ) : ?>
          <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
        <?php else : ?>
          <div class="ph ph-mid c1"></div>
        <?php endif; ?>
        <div class="item-overlay"><div class="item-tag"><?php echo esc_html( $label ); ?></div></div>
      </div>
    <?php endwhile; wp_reset_postdata();
    else : ?>
      <p class="gallery-empty">No gallery items yet.</p>
    <?php endif; ?>
  </div>

  <div id="galleryLoadMore" style="display:none;text-align:center;margin-top:40px;">
    <button class="btn-ghost" id="loadMoreBtn" type="button">Load More Photos</button>
  </div>
</section>


<!-- ── BEFORE / AFTER SLIDERS ────────────────────────────────────── -->
<section class="ba-section">
  <div class="tag" style="color:#C9A882;margin-bottom:8px;">Interactive comparison</div>
  <h2 class="ba-title">Drag to <em>compare</em></h2>
  <p class="ba-sub">Slide to reveal the transformation — before on the right, after on the left.</p>

  <div class="ba-grid" id="baGrid">
    <?php
    $slider_query = new WP_Query( [
      'post_type'      => 'bb_gallery',
      'posts_per_page' => 4,
      'post_status'    => 'publish',
      'meta_query'     => [
        'relation' => 'AND',
        [ 'key' => 'before_image', 'compare' => 'EXISTS' ],
        [ 'key' => 'after_image',  'compare' => 'EXISTS' ],
      ],
    ] );

    $has_sliders = false;
    $slider_index = 1;

    if ( $slider_query->have_posts() ) :
      while ( $slider_query->have_posts() ) : $slider_query->the_post();
        $before = get_field( 'before_image' );
        $after  = get_field( 'after_image' );
        if ( empty( $before ) || empty( $after ) ) continue;
        $has_sliders = true;
        $terms    = wp_get_post_terms( get_the_ID(), 'bb_service', [ 'fields' => 'names' ] );
        $svc_name = ! empty( $terms ) ? $terms[0] : get_the_title();
    ?>
      <div>
        <div class="ba-slider-wrap" id="slider<?php echo $slider_index; ?>">
          <div class="ba-canvas">
            <img class="ba-before"
              src="<?php echo esc_url( $before['sizes']['large'] ?? $before['url'] ); ?>"
              alt="Before: <?php echo esc_attr( get_the_title() ); ?>">
            <img class="ba-after"
              src="<?php echo esc_url( $after['sizes']['large'] ?? $after['url'] ); ?>"
              alt="After: <?php echo esc_attr( get_the_title() ); ?>">
          </div>
          <div class="ba-handle"><div class="ba-handle-circle">⇔</div></div>
        </div>
        <div class="ba-labels">
          <div><div class="ba-label">After</div><div class="ba-svc-name"><?php echo esc_html( $svc_name ); ?></div></div>
          <div style="text-align:right"><div class="ba-label">Before</div></div>
        </div>
      </div>
    <?php
        $slider_index++;
      endwhile;
      wp_reset_postdata();
    endif;

    if ( ! $has_sliders && current_user_can( 'edit_posts' ) ) : ?>
      <p style="color:rgba(255,255,255,.5);font-size:13px;padding:20px 0;">
        No sliders yet — add <strong>before_image</strong> and <strong>after_image</strong> ACF fields to gallery items.
      </p>
    <?php endif; ?>
  </div>
</section>


<!-- ── QUIZ CTA ───────────────────────────────────────────────────── -->
<section class="quiz-cta">
  <div class="quiz-text">
    <h2>Not sure which<br>brow is <em>yours?</em></h2>
    <p>Answer 3 quick questions and we'll match you with the perfect service for your skin type, lifestyle, and desired look.</p>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'service-quiz' ) ) ?: home_url( '/service-quiz/' ) ); ?>" class="btn-primary">Take the Brow Quiz</a>
  </div>
  <div class="quiz-steps">
    <?php foreach ( [
      [ '1', 'Your skin type',    'Oily, dry, combination — it changes which technique works best.' ],
      [ '2', 'Your lifestyle',    'How much time do you want to spend on brows each morning?' ],
      [ '3', 'Your desired look', 'Natural and soft, bold and defined, or somewhere in between.' ],
    ] as [ $num, $name, $text ] ) : ?>
      <div class="quiz-step">
        <div class="quiz-step-num"><?php echo $num; ?></div>
        <div><div class="quiz-step-name"><?php echo esc_html( $name ); ?></div><div class="quiz-step-text"><?php echo esc_html( $text ); ?></div></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>


<?php
// Pass site URL to inline script — avoids BrowBeast.siteUrl timing issues
$site_url = rtrim( get_site_url(), '/' );
?>
<script>
(function() {
  'use strict';

  var SITE = '<?php echo esc_js( $site_url ); ?>';

  // ── GALLERY FILTER + FETCH ──────────────────────────────────────
  var grid        = document.getElementById('gallery');
  var filterBar   = document.getElementById('filterBar');
  var loadMoreWrap = document.getElementById('galleryLoadMore');
  var loadMoreBtn  = document.getElementById('loadMoreBtn');

  var currentFilter = 'all';
  var currentPage   = 1;
  var totalPages    = 1;
  var isLoading     = false;

  if ( grid && filterBar ) {

    // Filter click — event delegation
    filterBar.addEventListener('click', function(e) {
      var btn = e.target.closest('.filter-btn');
      if ( !btn ) return;
      var filter = btn.getAttribute('data-filter');
      if ( filter === currentFilter ) return;

      filterBar.querySelectorAll('.filter-btn').forEach(function(b) { b.classList.remove('active'); });
      btn.classList.add('active');
      currentFilter = filter;
      currentPage   = 1;
      fetchGallery(filter, 1, false);
    });

    // Load more
    if ( loadMoreBtn ) {
      loadMoreBtn.addEventListener('click', function() {
        if ( isLoading || currentPage >= totalPages ) return;
        fetchGallery(currentFilter, currentPage + 1, true);
      });
    }

    // Initial fetch
    fetchGallery('all', 1, false);
  }

  function fetchGallery(filter, page, append) {
    if ( isLoading ) return;
    isLoading = true;
    grid.style.opacity = '0.5';

    var url = SITE + '/wp-json/browbeast/v1/gallery?per_page=12&page=' + page;
    if ( filter !== 'all' ) url += '&service=' + encodeURIComponent(filter);

    fetch(url)
      .then(function(res) {
        if ( !res.ok ) throw new Error('HTTP ' + res.status);
        return res.json();
      })
      .then(function(data) {
        totalPages  = data.totalPages || 1;
        currentPage = page;

        var html = '';
        if ( data.items && data.items.length ) {
          data.items.forEach(function(item) {
            var cats  = Array.isArray(item.services) ? item.services.join(' ') : '';
            var label = item.services && item.services[0]
              ? item.services[0].charAt(0).toUpperCase() + item.services[0].slice(1)
              : esc(item.title);
            var img = item.image
              ? '<img src="' + esc(item.image) + '" alt="' + esc(item.title) + '" loading="lazy">'
              : '<div class="ph ph-mid c1"></div>';
            html += '<div class="masonry-item" data-cat="' + esc(cats) + '">'
              + img
              + '<div class="item-overlay"><div class="item-tag">' + esc(label) + '</div></div>'
              + '</div>';
          });
        } else {
          html = '<p class="gallery-empty">No results for this filter.</p>';
        }

        if ( append ) {
          var frag = document.createElement('div');
          frag.innerHTML = html;
          while (frag.firstChild) grid.appendChild(frag.firstChild);
        } else {
          grid.innerHTML = html;
        }

        if ( loadMoreWrap ) {
          loadMoreWrap.style.display = currentPage < totalPages ? 'block' : 'none';
        }
      })
      .catch(function(err) {
        console.warn('[BrowBeast Gallery] fetch failed:', err.message);
      })
      .finally(function() {
        grid.style.opacity = '1';
        isLoading = false;
      });
  }

  function esc(s) {
    return String(s || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }


  // ── BEFORE / AFTER SLIDERS ──────────────────────────────────────
  // Use window.load so all images are fully loaded and have dimensions
  window.addEventListener('load', function() {
    initSliders();
  });

  // Also try immediately in case window.load already fired
  if ( document.readyState === 'complete' ) {
    initSliders();
  }

  function initSliders() {
    var wraps = document.querySelectorAll('.ba-slider-wrap');
    if ( !wraps.length ) return;

    wraps.forEach(function(wrap) {
      var afterImg = wrap.querySelector('.ba-after');
      var handle   = wrap.querySelector('.ba-handle');
      if ( !afterImg || !handle ) return;

      // Verify the canvas has height — if not, force it
      // aspect-ratio should handle this via CSS but inline fallback
      // catches any browser that doesn't support aspect-ratio
      var canvas = wrap.querySelector('.ba-canvas');
      if ( canvas && canvas.offsetHeight === 0 ) {
        canvas.style.height = Math.round(canvas.offsetWidth * (1541/768)) + 'px';
      }

      // Set initial 50/50 position
      afterImg.style.clipPath = 'inset(0 50% 0 0)';
      handle.style.left       = '50%';

      var dragging = false;

      function setPos(clientX) {
        var rect = wrap.getBoundingClientRect();
        if ( rect.width === 0 ) return;
        var pct = Math.max(0.02, Math.min(0.98, (clientX - rect.left) / rect.width));
        afterImg.style.clipPath = 'inset(0 ' + ((1 - pct) * 100).toFixed(2) + '% 0 0)';
        handle.style.left       = (pct * 100).toFixed(2) + '%';
      }

      wrap.addEventListener('mousedown', function(e) {
        dragging = true;
        setPos(e.clientX);
        e.preventDefault();
      });
      document.addEventListener('mousemove', function(e) {
        if (dragging) setPos(e.clientX);
      });
      document.addEventListener('mouseup', function() {
        dragging = false;
      });
      wrap.addEventListener('touchstart', function(e) {
        dragging = true;
        setPos(e.touches[0].clientX);
      }, { passive: true });
      document.addEventListener('touchmove', function(e) {
        if (dragging) setPos(e.touches[0].clientX);
      }, { passive: true });
      document.addEventListener('touchend', function() {
        dragging = false;
      });

      console.log('[BrowBeast] Slider initialised:', wrap.id);
    });
  }

})();
</script>

<?php get_footer(); ?>