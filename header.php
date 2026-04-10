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

	<header id="masthead" class="site-nav">
		<div class="nav-accent"></div>
		<div class="nav-inner">

			<nav class="nav-left" aria-label="<?php esc_attr_e( 'Primary left navigation', 'browbeast' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'nav-left',
					'menu_id'        => 'nav-left-menu',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Browbeast_Nav_Walker(),
				) );
				?>
			</nav>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   class="nav-logo"
			   rel="home"
			   aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — Home">
				<?php if ( has_custom_logo() ) :
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					echo wp_get_attachment_image( $custom_logo_id, 'full', false, [
						'class'   => 'nav-logo-img',
						'alt'     => esc_attr( get_bloginfo( 'name' ) ),
						'loading' => 'eager',
					] );
				else : ?>
					The Brow <span>Beast</span>
				<?php endif; ?>
			</a>

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


				<a href="<?php echo esc_url( get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' ) ); ?>"
				   class="nav-book"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php esc_html_e( 'Book Now', 'browbeast' ); ?>
				</a>

				<button class="nav-hamburger"
				        aria-label="<?php esc_attr_e( 'Open menu', 'browbeast' ); ?>"
				        aria-expanded="false"
				        aria-controls="mobileDrawer">
					<span></span><span></span><span></span>
				</button>
			</div>

		
		</div><!-- .nav-inner -->
	</header><!-- #masthead -->

	<!-- Mobile drawer -->
	<div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
		<div class="drawer-backdrop"></div>
		<div class="drawer-panel" role="dialog" aria-modal="true"
		     aria-label="<?php esc_attr_e( 'Mobile navigation', 'browbeast' ); ?>">
			<div class="drawer-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="drawer-logo">
					<?php if ( has_custom_logo() ) :
						echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, [
							'class'   => 'drawer-logo-img',
							'loading' => 'eager',
						] );
					else : ?>
						The Brow <span>Beast</span>
					<?php endif; ?>
				</a>
				<button class="drawer-close" aria-label="<?php esc_attr_e( 'Close menu', 'browbeast' ); ?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
						<line x1="4" y1="4" x2="16" y2="16"/>
						<line x1="16" y1="4" x2="4" y2="16"/>
					</svg>
				</button>
			</div>
			<div class="drawer-body">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => 'mobile-nav-menu',
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