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

	wp_add_inline_script(
		'browbeast-main',
		'window.BrowBeast = ' . wp_json_encode( [
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'browbeast_nonce' ),
			'siteUrl'   => get_site_url(),
			'acuityUrl' => get_theme_mod(
				'browbeast_acuity_url',
				'https://app.acuityscheduling.com/schedule.php?owner=19201786'
			),
		] ) . ';',
		'before'
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'browbeast_scripts' );


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
//  Outputs bare <a class="nav-link"> instead of <ul><li><a>
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
//  NAV WALKER — Mobile Drawer
//  Outputs <a class="drawer-link"> for the dark sidebar panel
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
//  CUSTOMIZER — Booking URL
//  Appearance → Customize → Booking Settings
// ─────────────────────────────────────────────────────────────
add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section( 'browbeast_booking', [
		'title'    => esc_html__( 'Booking Settings', 'browbeast' ),
		'priority' => 30,
	] );

	$wp_customize->add_setting( 'browbeast_acuity_url', [
		'default'           => 'https://app.acuityscheduling.com/schedule.php?owner=19201786',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );

	$wp_customize->add_control( 'browbeast_acuity_url', [
		'label'       => esc_html__( 'Acuity Booking URL', 'browbeast' ),
		'description' => esc_html__( 'The full URL from your Acuity scheduling page.', 'browbeast' ),
		'section'     => 'browbeast_booking',
		'type'        => 'url',
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
		'has_archive'  => true,
		'show_in_rest' => true,
		'supports'     => [ 'title', 'thumbnail', 'excerpt' ],
		'rewrite'      => [ 'slug' => 'gallery' ],
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
add_action( 'rest_api_init', 'browbeast_register_rest_routes' );

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



/**
 * Contact Form AJAX Handler
 * Add this to functions.php (or keep in a separate file and require it)
 *
 * Handles the native HTML fallback form submission from page-contact.php.
 * If you're using Contact Form 7 instead, you don't need this.
 */

// ── Register AJAX actions (logged in + logged out users) ──────────
add_action( 'wp_ajax_browbeast_contact',        'browbeast_handle_contact_form' );
add_action( 'wp_ajax_nopriv_browbeast_contact', 'browbeast_handle_contact_form' );

function browbeast_handle_contact_form(): void {

  // Verify nonce
  if ( ! isset( $_POST['browbeast_nonce'] ) ||
       ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['browbeast_nonce'] ) ), 'browbeast_contact' ) ) {
    wp_send_json_error( [ 'message' => 'Security check failed. Please refresh and try again.' ], 403 );
  }

  // Sanitize + validate fields
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

  // ── Build email ────────────────────────────────────────────────
  $to      = get_option( 'admin_email' ); // change to Gabrielle's actual email
  $subject = sprintf( 'New contact from %s — The Brow Beast', $name );

  $body  = "Name: {$name}\n";
  $body .= "Email: {$email}\n";
  if ( $phone )   $body .= "Phone: {$phone}\n";
  if ( $service ) $body .= "Service interest: {$service}\n";
  $body .= "\nMessage:\n{$message}\n";
  $body .= "\n---\nSent from " . home_url();

  $headers = [
    'Content-Type: text/plain; charset=UTF-8',
    "Reply-To: {$name} <{$email}>",
  ];

  $sent = wp_mail( $to, $subject, $body, $headers );

  if ( $sent ) {
    wp_send_json_success( [ 'message' => 'Message sent! Gabrielle will be in touch within 24 hours.' ] );
  } else {
    wp_send_json_error( [ 'message' => 'Sorry, there was a problem sending your message. Please try calling or emailing directly.' ], 500 );
  }
}


// ─────────────────────────────────────────────────────────────
//  INCLUDES
// ─────────────────────────────────────────────────────────────
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}