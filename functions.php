<?php
/**
 * The Brow Beast — Theme Functions
 *
 * @package TheBrowBeast
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BROWBEAST_VERSION', '1.0.0' );


// ─────────────────────────────────────────────────────────────
//  THEME SETUP
// ─────────────────────────────────────────────────────────────
function browbeast_setup(): void {
	load_theme_textdomain( 'browbeast', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script',
	] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo', [
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	] );

	register_nav_menus( [
		'nav-left'    => esc_html__( 'Desktop Nav — Left (About, Services, Gallery)', 'browbeast' ),
		'nav-right'   => esc_html__( 'Desktop Nav — Right (Course, Contact)', 'browbeast' ),
		'mobile-menu' => esc_html__( 'Mobile Drawer Menu (all links)', 'browbeast' ),
		'footer'      => esc_html__( 'Footer Navigation', 'browbeast' ),
	] );
}
add_action( 'after_setup_theme', 'browbeast_setup' );


// ─────────────────────────────────────────────────────────────
//  CONTENT WIDTH
// ─────────────────────────────────────────────────────────────
function browbeast_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'browbeast_content_width', 1200 );
}
add_action( 'after_setup_theme', 'browbeast_content_width', 0 );


// ─────────────────────────────────────────────────────────────
//  WIDGET AREAS
// ─────────────────────────────────────────────────────────────
function browbeast_widgets_init(): void {
	register_sidebar( [
		'name'          => esc_html__( 'Sidebar', 'browbeast' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}
add_action( 'widgets_init', 'browbeast_widgets_init' );

// ── Prevent ACF and other plugins breaking the Customizer ────────
// Priority 999 runs after all plugins have enqueued their scripts
add_action( 'customize_controls_enqueue_scripts', function() {
	// ACF scripts
	wp_dequeue_script( 'acf-input' );
	wp_dequeue_script( 'acf' );
	wp_dequeue_script( 'acf-pro-input' );
	wp_dequeue_script( 'acf-pro-ui-options-page' );
	wp_dequeue_script( 'acf-pro-blocks' );
	wp_dequeue_script( 'acf-field-group' );
	// ACF styles
	wp_dequeue_style( 'acf-input' );
	wp_dequeue_style( 'acf-global' );
	wp_dequeue_style( 'acf-inline-editing-styles' );
	wp_dequeue_style( 'acf-datepicker' );
	// Deregister too so they can't be re-enqueued by dependencies
	wp_deregister_script( 'acf-input' );
	wp_deregister_script( 'acf' );
}, 999 );

// Also block ACF from loading in the Customizer preview iframe
add_action( 'customize_preview_init', function() {
	wp_dequeue_script( 'acf-input' );
	wp_dequeue_script( 'acf' );
	wp_deregister_script( 'acf-input' );
	wp_deregister_script( 'acf' );
}, 999 );

// Prevent ACF from redirecting or throwing errors in Customizer context
add_filter( 'acf/settings/show_admin', function( $show ) {
	if ( is_customize_preview() ) return false;
	return $show;
} );


// ─────────────────────────────────────────────────────────────
//  ENQUEUE SCRIPTS & STYLES
// ─────────────────────────────────────────────────────────────
function browbeast_scripts(): void {
	$css = '/dist/css/style.css';
	$js  = '/dist/js/main.js';

	$assets_file = get_template_directory() . '/dist/assets.json';
	if ( file_exists( $assets_file ) ) {
		$raw = file_get_contents( $assets_file );
		if ( $raw !== false ) {
			$assets = json_decode( $raw, true );
			$css    = '/dist/' . ( $assets['main']['css'] ?? 'css/style.css' );
			$js     = '/dist/' . ( $assets['main']['js']  ?? 'js/main.js' );
		}
	} else {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-warning"><p>'
				. '<strong>Brow Beast theme:</strong> '
				. '<code>/dist/assets.json</code> not found. '
				. 'Run <code>npm run dev</code> or <code>npm run build</code> inside the theme folder.'
				. '</p></div>';
		} );
	}

	wp_enqueue_style( 'browbeast-style', get_template_directory_uri() . $css, [], null );
	wp_enqueue_script( 'browbeast-main',  get_template_directory_uri() . $js,  [], null, true );

	$browbeast_data = wp_json_encode(
		[
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'browbeast_nonce' ),
			'siteUrl'   => get_site_url(),
			'acuityUrl' => get_theme_mod( 'browbeast_acuity_url' ) ?: 'https://app.acuityscheduling.com/schedule.php?owner=19201786',
		],
		JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);

	wp_add_inline_script(
		'browbeast-main',
		'window.BrowBeast = ' . $browbeast_data . ';',
		'before'
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'browbeast_scripts' );


// ─────────────────────────────────────────────────────────────
//  CUSTOMIZER FIXES
// ─────────────────────────────────────────────────────────────

// Allow Customizer preview to load from localhost/local domains
add_filter( 'customize_loaded_components', function( $components ) {
	return $components;
} );

// Extend HTTP timeout for slow local environments
add_filter( 'http_request_timeout', function( $timeout ) {
	if ( is_customize_preview() || ( defined('DOING_CRON') && DOING_CRON ) ) {
		return 30;
	}
	return $timeout;
} );


// ─────────────────────────────────────────────────────────────
//  GOOGLE ANALYTICS
// ─────────────────────────────────────────────────────────────
add_action( 'wp_head', function(): void {
	$ga_id = 'G-206GLLLKJL';
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', '<?php echo esc_attr( $ga_id ); ?>');
	</script>
	<?php
}, 1 );


// ─────────────────────────────────────────────────────────────
//  SOCIAL META CARDS (Open Graph + Twitter/X)
//  Outputs og: and twitter: tags for rich link previews on
//  Facebook, Instagram, Twitter/X, iMessage, Slack, WhatsApp etc.
// ─────────────────────────────────────────────────────────────
add_action( 'wp_head', function(): void {

	// ── Defaults (used on pages with no specific data) ────────
	$site_name    = 'The Brow Beast';
	$default_desc = 'Expert eyebrow artistry in Great Neck, NY. Microblading, henna brows, waxing & more by Gabrielle Lowe.';
	$default_img  = get_template_directory_uri() . '/assets/social-card.jpg'; // 1200x630 image — see note below
	$site_url     = home_url( '/' );
	$twitter_handle = '@thebrowbeast';

	// ── Page-specific values ──────────────────────────────────
	if ( is_singular() ) {
		$title = get_the_title() . ' — ' . $site_name;
		$url   = get_permalink();

		// Use ACF meta description if set, fall back to excerpt then default
		$desc = get_field( 'meta_description' ) ?: get_the_excerpt() ?: $default_desc;
		$desc = wp_strip_all_tags( $desc );

		// Use featured image if set, fall back to default social card
		$img = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $default_img;

	} elseif ( is_home() || is_front_page() ) {
		$title = $site_name . ' — Expert Eyebrow Artistry, Great Neck NY';
		$url   = $site_url;
		$desc  = $default_desc;
		$img   = $default_img;

	} else {
		$title = wp_title( '—', false, 'right' ) . $site_name;
		$url   = home_url( $_SERVER['REQUEST_URI'] );
		$desc  = $default_desc;
		$img   = $default_img;
	}

	// Truncate description to 160 chars
	$desc = mb_strlen( $desc ) > 160 ? mb_substr( $desc, 0, 157 ) . '...' : $desc;
	?>

	<!-- ── Open Graph (Facebook, Instagram, WhatsApp, Slack, iMessage) -->
	<meta property="og:type"        content="website">
	<meta property="og:site_name"   content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:title"       content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
	<meta property="og:url"         content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image"       content="<?php echo esc_url( $img ); ?>">
	<meta property="og:image:width"  content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:alt"    content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:locale"       content="en_US">

	<!-- ── Twitter / X Card -->
	<meta name="twitter:card"        content="summary_large_image">
	<meta name="twitter:site"        content="<?php echo esc_attr( $twitter_handle ); ?>">
	<meta name="twitter:title"       content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
	<meta name="twitter:image"       content="<?php echo esc_url( $img ); ?>">
	<meta name="twitter:image:alt"   content="<?php echo esc_attr( $site_name ); ?>">

	<!-- ── Standard meta description (SEO) -->
	<meta name="description" content="<?php echo esc_attr( $desc ); ?>">

	<?php
}, 5 );


// ─────────────────────────────────────────────────────────────
//  REMOVE WORDPRESS JUNK FROM <HEAD>
// ─────────────────────────────────────────────────────────────
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
add_filter( 'the_generator', '__return_empty_string' );


// ─────────────────────────────────────────────────────────────
//  NAV WALKER — Desktop
// ─────────────────────────────────────────────────────────────
class Browbeast_Nav_Walker extends Walker_Nav_Menu {

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ): void {
		$item      = $data_object;
		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'nav-link';

		if ( in_array( 'current-menu-item', $classes, true ) ||
		     in_array( 'current-menu-ancestor', $classes, true ) ) {
			$classes[] = 'active';
		}

		$output .= sprintf(
			'<a href="%s" class="%s"%s%s>%s</a>',
			esc_url( $item->url ?: '#' ),
			esc_attr( implode( ' ', array_unique( array_filter( $classes ) ) ) ),
			$item->target ? ' target="' . esc_attr( $item->target ) . '"' : '',
			$item->xfn    ? ' rel="'    . esc_attr( $item->xfn )    . '"' : '',
			esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
		);
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ): void {}
	public function start_lvl( &$output, $depth = 0, $args = null ): void {}
	public function end_lvl( &$output, $depth = 0, $args = null ): void {}
}


// ─────────────────────────────────────────────────────────────
//  NAV WALKER — Footer
// ─────────────────────────────────────────────────────────────
class Browbeast_Footer_Walker extends Walker_Nav_Menu {

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ): void {
		$item      = $data_object;
		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'footer-link';

		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$classes[] = 'active';
		}

		$output .= sprintf(
			'<a href="%s" class="%s"%s%s>%s</a>',
			esc_url( $item->url ?: '#' ),
			esc_attr( implode( ' ', array_unique( array_filter( $classes ) ) ) ),
			$item->target ? ' target="' . esc_attr( $item->target ) . '"' : '',
			$item->xfn    ? ' rel="'    . esc_attr( $item->xfn )    . '"' : '',
			esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
		);
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ): void {}
	public function start_lvl( &$output, $depth = 0, $args = null ): void {}
	public function end_lvl( &$output, $depth = 0, $args = null ): void {}
}


// ─────────────────────────────────────────────────────────────
//  NAV WALKER — Mobile Drawer
// ─────────────────────────────────────────────────────────────
class Browbeast_Drawer_Walker extends Walker_Nav_Menu {

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ): void {
		$item      = $data_object;
		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'drawer-link';

		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$classes[] = 'active';
		}

		$output .= sprintf(
			'<a href="%s" class="%s"%s>%s</a>',
			esc_url( $item->url ?: '#' ),
			esc_attr( implode( ' ', array_unique( array_filter( $classes ) ) ) ),
			$item->target ? ' target="' . esc_attr( $item->target ) . '"' : '',
			esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
		);
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ): void {}
	public function start_lvl( &$output, $depth = 0, $args = null ): void {}
	public function end_lvl( &$output, $depth = 0, $args = null ): void {}
}


// ─────────────────────────────────────────────────────────────
//  CUSTOMIZER — Booking URL + Instagram Token
// ─────────────────────────────────────────────────────────────
add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ): void {

	// ── Booking ───────────────────────────────────────────────
	$wp_customize->add_section( 'browbeast_booking', [
		'title'    => 'Booking Settings',
		'priority' => 30,
	] );

	// Store the default without special chars in the default —
	// the ?owner= query string was causing JSON encoding issues
	$wp_customize->add_setting( 'browbeast_acuity_url', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );

	$wp_customize->add_control( 'browbeast_acuity_url', [
		'label'       => 'Acuity Booking URL',
		'description' => 'Paste the full URL from your Acuity scheduling page.',
		'section'     => 'browbeast_booking',
		'type'        => 'text',
	] );

	// ── Instagram ─────────────────────────────────────────────
	$wp_customize->add_section( 'browbeast_instagram', [
		'title'    => 'Instagram Settings',
		'priority' => 35,
	] );

	$wp_customize->add_setting( 'browbeast_instagram_token', [
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	] );

	$wp_customize->add_control( 'browbeast_instagram_token', [
		'label'       => 'Instagram Access Token',
		'description' => 'Long-lived token from Meta Basic Display API.',
		'section'     => 'browbeast_instagram',
		'type'        => 'text',
	] );

	$wp_customize->add_setting( 'browbeast_instagram_count', [
		'default'           => 6,
		'sanitize_callback' => 'absint',
	] );

	$wp_customize->add_control( 'browbeast_instagram_count', [
		'label'       => 'Number of Instagram posts to display',
		'section'     => 'browbeast_instagram',
		'type'        => 'number',
		'input_attrs' => [ 'min' => 3, 'max' => 12, 'step' => 1 ],
	] );

} );


// ─────────────────────────────────────────────────────────────
//  CUSTOM POST TYPE — GALLERY
// ─────────────────────────────────────────────────────────────
function browbeast_register_gallery_cpt(): void {
	register_post_type( 'bb_gallery', [
		'labels' => [
			'name'          => esc_html__( 'Gallery',         'browbeast' ),
			'singular_name' => esc_html__( 'Gallery Item',    'browbeast' ),
			'add_new_item'  => esc_html__( 'Add New Photo',   'browbeast' ),
			'edit_item'     => esc_html__( 'Edit Photo',      'browbeast' ),
			'not_found'     => esc_html__( 'No photos found', 'browbeast' ),
		],
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'supports'     => [ 'title', 'thumbnail', 'excerpt' ],
		'rewrite'      => [ 'slug' => 'brow-gallery' ],
		'menu_icon'    => 'dashicons-format-gallery',
	] );
}
add_action( 'init', 'browbeast_register_gallery_cpt' );


// ─────────────────────────────────────────────────────────────
//  CUSTOM TAXONOMY — SERVICE CATEGORY
// ─────────────────────────────────────────────────────────────
function browbeast_register_service_tax(): void {
	register_taxonomy( 'bb_service', [ 'bb_gallery' ], [
		'labels' => [
			'name'          => esc_html__( 'Services',    'browbeast' ),
			'singular_name' => esc_html__( 'Service',     'browbeast' ),
			'add_new_item'  => esc_html__( 'Add Service', 'browbeast' ),
		],
		'hierarchical' => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'service' ],
	] );
}
add_action( 'init', 'browbeast_register_service_tax' );


// ─────────────────────────────────────────────────────────────
//  REST API — Gallery endpoint
//  GET /wp-json/browbeast/v1/gallery?service=henna&per_page=12
// ─────────────────────────────────────────────────────────────
add_action( 'rest_api_init', 'browbeast_register_rest_routes' );

function browbeast_register_rest_routes(): void {
	register_rest_route( 'browbeast/v1', '/gallery', [
		'methods'             => WP_REST_Server::READABLE,
		'callback'            => 'browbeast_gallery_rest_handler',
		'permission_callback' => '__return_true',
		'args'                => [
			'service'  => [ 'type' => 'string',  'sanitize_callback' => 'sanitize_title' ],
			'per_page' => [ 'type' => 'integer', 'default' => 12, 'sanitize_callback' => 'absint' ],
			'page'     => [ 'type' => 'integer', 'default' => 1,  'sanitize_callback' => 'absint' ],
		],
	] );
}

function browbeast_gallery_rest_handler( WP_REST_Request $request ): WP_REST_Response {
	$args = [
		'post_type'      => 'bb_gallery',
		'posts_per_page' => $request->get_param( 'per_page' ),
		'paged'          => $request->get_param( 'page' ),
		'post_status'    => 'publish',
	];

	$service = $request->get_param( 'service' );
	if ( $service ) {
		$args['tax_query'] = [ [
			'taxonomy' => 'bb_service',
			'field'    => 'slug',
			'terms'    => $service,
		] ];
	}

	$query = new WP_Query( $args );
	$items = [];

	foreach ( $query->posts as $post ) {
		$thumb_id = get_post_thumbnail_id( $post->ID );
		$items[]  = [
			'id'       => $post->ID,
			'title'    => get_the_title( $post ),
			'excerpt'  => get_the_excerpt( $post ),
			'image'    => $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : null,
			'services' => wp_get_post_terms( $post->ID, 'bb_service', [ 'fields' => 'slugs' ] ),
		];
	}

	return new WP_REST_Response( [
		'items'      => $items,
		'totalPages' => (int) $query->max_num_pages,
		'total'      => (int) $query->found_posts,
	], 200 );
}


// ─────────────────────────────────────────────────────────────
//  CONTACT FORM — AJAX Handler
// ─────────────────────────────────────────────────────────────
add_action( 'wp_ajax_browbeast_contact',        'browbeast_handle_contact_form' );
add_action( 'wp_ajax_nopriv_browbeast_contact', 'browbeast_handle_contact_form' );

function browbeast_handle_contact_form(): void {

	if ( ! isset( $_POST['browbeast_nonce'] ) ||
	     ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['browbeast_nonce'] ) ), 'browbeast_contact' ) ) {
		wp_send_json_error( [ 'message' => 'Security check failed. Please refresh and try again.' ], 403 );
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['contact_name']    ?? '' ) );
	$email   = sanitize_email(      wp_unslash( $_POST['contact_email']   ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['contact_phone']   ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['contact_service'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );

	$errors = [];
	if ( empty( $name ) )                          $errors[] = 'Name is required.';
	if ( empty( $email ) || ! is_email( $email ) ) $errors[] = 'A valid email address is required.';
	if ( empty( $message ) )                       $errors[] = 'Message is required.';

	if ( ! empty( $errors ) ) {
		wp_send_json_error( [ 'message' => implode( ' ', $errors ) ], 422 );
	}

	$to      = get_option( 'admin_email' ); // ← update to Gabrielle's email
	$subject = sprintf( 'New contact from %s — The Brow Beast', $name );
	$body    = "Name: {$name}\nEmail: {$email}\n";
	if ( $phone )   $body .= "Phone: {$phone}\n";
	if ( $service ) $body .= "Service: {$service}\n";
	$body .= "\nMessage:\n{$message}\n\n---\nSent from " . home_url();

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		"Reply-To: {$name} <{$email}>",
	];

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( [ 'message' => 'Message sent! Gabrielle will be in touch within 24 hours.' ] );
	} else {
		wp_send_json_error( [ 'message' => 'Sorry, there was a problem sending your message. Please try calling directly.' ], 500 );
	}
}


// ─────────────────────────────────────────────────────────────
//  INSTAGRAM — Fetch + cache + auto-refresh token
// ─────────────────────────────────────────────────────────────
function browbeast_get_instagram_posts(): array {
	$token = get_theme_mod( 'browbeast_instagram_token', '' );
	$count = (int) get_theme_mod( 'browbeast_instagram_count', 6 );
	if ( empty( $token ) ) return [];

	$cache_key = 'browbeast_instagram_feed_' . md5( $token );
	$cached    = get_transient( $cache_key );
	if ( $cached !== false ) return $cached;

	$url = add_query_arg( [
		'fields'       => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp',
		'limit'        => $count,
		'access_token' => $token,
	], 'https://graph.instagram.com/me/media' );

	$response = wp_remote_get( $url, [ 'timeout' => 10 ] );
	if ( is_wp_error( $response ) ) return [];

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( empty( $body['data'] ) || isset( $body['error'] ) ) return [];

	set_transient( $cache_key, $body['data'], 2 * HOUR_IN_SECONDS );
	return $body['data'];
}

// Auto-refresh cron schedule
add_filter( 'cron_schedules', function ( array $schedules ): array {
	$schedules['every_50_days'] = [
		'interval' => 50 * DAY_IN_SECONDS,
		'display'  => esc_html__( 'Every 50 Days', 'browbeast' ),
	];
	return $schedules;
} );

add_action( 'after_switch_theme', function (): void {
	if ( ! wp_next_scheduled( 'browbeast_refresh_instagram_token' ) ) {
		wp_schedule_event( time(), 'every_50_days', 'browbeast_refresh_instagram_token' );
	}
} );

add_action( 'switch_theme', function (): void {
	wp_clear_scheduled_hook( 'browbeast_refresh_instagram_token' );
} );

add_action( 'browbeast_refresh_instagram_token', function (): void {
	$token = get_theme_mod( 'browbeast_instagram_token', '' );
	if ( empty( $token ) ) return;

	$url      = add_query_arg( [ 'grant_type' => 'ig_refresh_token', 'access_token' => $token ], 'https://graph.instagram.com/refresh_access_token' );
	$response = wp_remote_get( $url, [ 'timeout' => 10 ] );
	if ( is_wp_error( $response ) ) return;

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! empty( $body['access_token'] ) ) {
		set_theme_mod( 'browbeast_instagram_token', sanitize_text_field( $body['access_token'] ) );
		delete_transient( 'browbeast_instagram_feed_' . md5( $token ) );
	}
} );

function browbeast_instagram_feed( int $count = 0, bool $header = true ): void {
	$posts   = browbeast_get_instagram_posts();
	$token   = get_theme_mod( 'browbeast_instagram_token', '' );
	$display = $count ?: (int) get_theme_mod( 'browbeast_instagram_count', 6 );
	$posts   = array_slice( $posts, 0, $display );
	?>
	<?php if ( $header ) : ?>
		<div class="insta-handle">Follow @thebrowbeast</div>
		<h2 class="sec-title" style="display:inline-block;">Our <em>Instagram</em></h2>
	<?php endif; ?>

	<?php if ( empty( $posts ) ) : ?>
		<?php if ( empty( $token ) && current_user_can( 'manage_options' ) ) : ?>
			<p class="insta-notice">Instagram not connected. Go to <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=browbeast_instagram' ) ); ?>">Customize → Instagram Settings</a> to add your access token.</p>
		<?php else : ?>
			<div class="insta-grid insta-grid--placeholder">
				<?php for ( $i = 0; $i < $display; $i++ ) : ?>
					<div class="insta-cell"><div class="insta-placeholder ig<?php echo ( $i % 6 ) + 1; ?>"></div></div>
				<?php endfor; ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="insta-grid">
			<?php foreach ( $posts as $post ) :
				$img_url = ( $post['media_type'] === 'VIDEO' )
					? ( $post['thumbnail_url'] ?? $post['media_url'] )
					: $post['media_url'];
				$caption = isset( $post['caption'] ) ? substr( strip_tags( $post['caption'] ), 0, 100 ) : 'Instagram post';
			?>
				<a href="<?php echo esc_url( $post['permalink'] ); ?>" class="insta-cell" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $caption ); ?>">
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>" loading="lazy">
					<?php if ( $post['media_type'] === 'VIDEO' ) : ?>
						<div class="insta-cell-play" aria-hidden="true">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
								<circle cx="10" cy="10" r="10" fill-opacity=".5"/>
								<polygon points="8,6 15,10 8,14" fill="white"/>
							</svg>
						</div>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
		<div style="margin-top:24px;text-align:center;">
			<a href="https://www.instagram.com/thebrowbeast/" class="btn-ghost" target="_blank" rel="noopener noreferrer">Follow on Instagram</a>
		</div>
	<?php endif;
}





// ─────────────────────────────────────────────────────────────
//  SOCIAL META CARDS (Open Graph + Twitter/X)
// ─────────────────────────────────────────────────────────────
add_action( 'wp_head', function(): void {

	$site_name    = 'The Brow Beast';
	$default_desc = 'Expert eyebrow artistry in Great Neck, NY. Microblading, henna brows, waxing and more by Gabrielle Lowe.';
	$default_img  = get_template_directory_uri() . '/assets/social-card.jpg';
	$site_url     = home_url( '/' );

	if ( is_singular() ) {
		$title = get_the_title() . ' — ' . $site_name;
		$url   = get_permalink();
		$desc  = get_field( 'meta_description' ) ?: wp_strip_all_tags( get_the_excerpt() ) ?: $default_desc;
		$img   = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $default_img;
	} elseif ( is_home() || is_front_page() ) {
		$title = $site_name . ' — Expert Eyebrow Artistry, Great Neck NY';
		$url   = $site_url;
		$desc  = $default_desc;
		$img   = $default_img;
	} else {
		$title = wp_title( '—', false, 'right' ) . $site_name;
		$url   = home_url( $_SERVER['REQUEST_URI'] );
		$desc  = $default_desc;
		$img   = $default_img;
	}

	$desc = mb_strlen( $desc ) > 160 ? mb_substr( $desc, 0, 157 ) . '...' : $desc;
	?>
	<meta property="og:type"         content="website">
	<meta property="og:site_name"    content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:title"        content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description"  content="<?php echo esc_attr( $desc ); ?>">
	<meta property="og:url"          content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image"        content="<?php echo esc_url( $img ); ?>">
	<meta property="og:image:width"  content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:alt"    content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:locale"       content="en_US">
	<meta name="twitter:card"        content="summary_large_image">
	<meta name="twitter:site"        content="@thebrowbeast">
	<meta name="twitter:title"       content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
	<meta name="twitter:image"       content="<?php echo esc_url( $img ); ?>">
	<meta name="description"         content="<?php echo esc_attr( $desc ); ?>">
	<?php
}, 5 );



// ─────────────────────────────────────────────────────────────
//  ACF FIELD GROUPS — Programmatic Registration
//  Registers all ACF fields in code so they don't rely on
//  the database and work across all environments.
// ─────────────────────────────────────────────────────────────
add_action( 'init', 'browbeast_register_acf_fields', 20 );

function browbeast_register_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

	// ── Homepage Services Repeater ────────────────────────────
	acf_add_local_field_group( [
		'key'      => 'group_homepage_services',
		'title'    => 'Homepage — Service Cards',
		'fields'   => [
			[
				'key'        => 'field_homepage_services',
				'label'      => 'Service Cards',
				'name'       => 'homepage_services',
				'type'       => 'repeater',
				'min'        => 1,
				'max'        => 6,
				'layout'     => 'block',
				'button_label' => 'Add Service Card',
				'sub_fields' => [
					[
						'key'   => 'field_svc_name',
						'label' => 'Service Name',
						'name'  => 'svc_name',
						'type'  => 'text',
					],
					[
						'key'   => 'field_svc_desc',
						'label' => 'Description',
						'name'  => 'svc_desc',
						'type'  => 'textarea',
						'rows'  => 2,
					],
					[
						'key'   => 'field_svc_price',
						'label' => 'Price',
						'name'  => 'svc_price',
						'type'  => 'text',
						'placeholder' => 'From $895',
					],
					[
						'key'   => 'field_svc_badge',
						'label' => 'Badge (optional)',
						'name'  => 'svc_badge',
						'type'  => 'text',
						'placeholder' => 'e.g. Signature — leave blank for none',
					],
					[
						'key'           => 'field_svc_image',
						'label'         => 'Service Image',
						'name'          => 'svc_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					],
				],
			],
		],
		'location' => [
			[ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ],
		],
		'menu_order' => 10,
		'style'      => 'default',
	] );
}

// ─────────────────────────────────────────────────────────────
//  INCLUDES
//  Using require_once with file_exists so a missing file
//  never kills the Customizer or any other admin page
// ─────────────────────────────────────────────────────────────
$_browbeast_includes = [
	'/inc/template-tags.php',
	'/inc/template-functions.php',
	'/inc/customizer.php',
];

foreach ( $_browbeast_includes as $_file ) {
	$_path = get_template_directory() . $_file;
	if ( file_exists( $_path ) ) {
		require_once $_path;
	}
}

if ( defined( 'JETPACK__VERSION' ) ) {
	$_jetpack = get_template_directory() . '/inc/jetpack.php';
	if ( file_exists( $_jetpack ) ) {
		require_once $_jetpack;
	}
}