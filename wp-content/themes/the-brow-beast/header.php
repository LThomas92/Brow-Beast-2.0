<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'browbeast' ); ?>
	</a>

	<header id="masthead" class="site-nav"><!-- ← was missing closing quote on id -->
		<div class="nav-accent"></div>
		<div class="nav-inner">

			<!-- ── Left menu (About, Services, Gallery) ──────────────── -->
			<nav class="nav-left" aria-label="<?php esc_attr_e( 'Primary left navigation', 'browbeast' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'nav-left',   // registered in functions.php
					'menu_id'        => 'nav-left-menu',
					'container'      => false,         // no wrapping <div>
					'items_wrap'     => '%3$s',        // no <ul> — just the <li> items
					'fallback_cb'    => false,         // don't show anything if no menu assigned
					'walker'         => new Browbeast_Nav_Walker(), // custom walker below
				) );
				?>
			</nav>

			<!-- ── Centred logo ──────────────────────────────────────── -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
        class="nav-logo"
        rel="home"
        aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — Home">
      
        <?php if ( has_custom_logo() ) : ?>
      
          <?php
          // get_custom_logo() returns a full <a> tag by default.
          // We only want the <img> inside it — so we extract just that.
          $custom_logo_id  = get_theme_mod( 'custom_logo' );
          $logo_image      = wp_get_attachment_image(
            $custom_logo_id,
            'full',
            false,
            [
              'class'   => 'nav-logo-img',
              'alt'     => esc_attr( get_bloginfo( 'name' ) ),
              'loading' => 'eager',  // logo is above fold — never lazy load
            ]
          );
          echo $logo_image;
          ?>
      
        <?php else : ?>
      
          <?php // Text wordmark fallback — shows until a logo is uploaded ?>
          The Brow <span>Beast</span>
      
        <?php endif; ?>
      
      </a>

			<!-- ── Right menu (Course, Contact) + search + CTA ──────── -->
			<div class="nav-right">
				<nav aria-label="<?php esc_attr_e( 'Primary right navigation', 'browbeast' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'nav-right',
						'menu_id'        => 'nav-right-menu',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'walker'         => new Browbeast_Nav_Walker(),
					) );
					?>
				</nav>

				<!-- Search -->
				<div class="nav-search-wrap" role="search">
					<svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="#C9A882" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
						<circle cx="6.5" cy="6.5" r="4"/>
						<line x1="10" y1="10" x2="14" y2="14"/>
					</svg>
					<input
						type="text"
						placeholder="<?php esc_attr_e( 'Search...', 'browbeast' ); ?>"
						id="navSearch"
						autocomplete="off"
						aria-label="<?php esc_attr_e( 'Search site', 'browbeast' ); ?>"
					>
				</div>

				<!-- Book CTA — pulls URL from Customizer (set in functions.php) -->
				<a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
				   class="nav-book"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php esc_html_e( 'Book Now', 'browbeast' ); ?>
				</a>

				<!-- Hamburger (mobile only, shown via CSS) -->
				<button class="nav-hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'browbeast' ); ?>" aria-expanded="false" aria-controls="mobileDrawer">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>

			<!-- ── Search dropdown ───────────────────────────────────── -->
			<div class="search-dropdown" id="searchDropdown" role="listbox" aria-label="Search suggestions" hidden>
				<div class="sd-label"><?php esc_html_e( 'Quick searches', 'browbeast' ); ?></div>
				<div class="sd-tags">
					<button class="sd-tag" type="button">Henna brows</button>
					<button class="sd-tag" type="button">Combo brows</button>
					<button class="sd-tag" type="button">Pricing</button>
					<button class="sd-tag" type="button">Gallery</button>
					<button class="sd-tag" type="button">Book now</button>
					<button class="sd-tag" type="button">Aftercare</button>
				</div>
				<div class="sd-label"><?php esc_html_e( 'Services', 'browbeast' ); ?></div>
				<div class="sd-results" id="sdResults">
					<?php
					// Dynamic search results populated via JS (see search.js)
					// Static fallback shown before any typing:
					$services = array(
						array(
							'title' => 'StrokeBlend™ Combo Brows',
							'meta'  => 'Service · From $350',
							'url'   => get_permalink( get_page_by_path( 'strokeblend-combo-brows', OBJECT, 'page' ) ),
							'color' => 'linear-gradient(135deg,#D4B896,#896C54)',
						),
						array(
							'title' => 'Henna Brows',
							'meta'  => 'Service · From $75',
							'url'   => get_permalink( get_page_by_path( 'henna-brows', OBJECT, 'page' ) ),
							'color' => 'linear-gradient(135deg,#E8D5C4,#B06F44)',
						),
						array(
							'title' => 'Before & After Gallery',
							'meta'  => 'Gallery · View all transformations',
							'url'   => get_permalink( get_page_by_path( 'gallery', OBJECT, 'page' ) ),
							'color' => 'linear-gradient(135deg,#C9A882,#5C3D2E)',
						),
					);
					foreach ( $services as $svc ) :
						$url = $svc['url'] ?: home_url( '/' );
					?>
					<a href="<?php echo esc_url( $url ); ?>" class="sd-row">
						<div class="sd-thumb" style="background:<?php echo esc_attr( $svc['color'] ); ?>;"></div>
						<div>
							<div class="sd-name"><?php echo esc_html( $svc['title'] ); ?></div>
							<div class="sd-cat"><?php echo esc_html( $svc['meta'] ); ?></div>
						</div>
					</a>
					<?php endforeach; ?>
				</div>
			</div><!-- .search-dropdown -->

		</div><!-- .nav-inner -->
	</header><!-- #masthead -->

	<!-- ── Mobile drawer ─────────────────────────────────────────── -->
	<div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
		<div class="drawer-backdrop"></div>
		<div class="drawer-panel" role="dialog" aria-label="<?php esc_attr_e( 'Mobile navigation', 'browbeast' ); ?>">
			<div class="drawer-header">
				<span class="drawer-logo">The Brow <span>Beast</span></span>
				<button class="drawer-close" aria-label="<?php esc_attr_e( 'Close menu', 'browbeast' ); ?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
						<line x1="4" y1="4" x2="16" y2="16"/>
						<line x1="16" y1="4" x2="4" y2="16"/>
					</svg>
				</button>
			</div>
			<div class="drawer-body">
				<div class="drawer-search">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
						<circle cx="6.5" cy="6.5" r="4"/>
						<line x1="10" y1="10" x2="14" y2="14"/>
					</svg>
					<input type="text" placeholder="<?php esc_attr_e( 'Search services, gallery...', 'browbeast' ); ?>">
				</div>
				<?php
				// Full menu in drawer — merges both nav locations
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => 'mobile-menu',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Browbeast_Drawer_Walker(),
				) );
				?>
				<a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
				   class="drawer-cta"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php esc_html_e( 'Book an Appointment', 'browbeast' ); ?>
				</a>
			</div>
		</div>
	</div><!-- .mobile-drawer -->