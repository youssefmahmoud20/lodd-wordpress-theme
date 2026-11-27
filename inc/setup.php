<?php

defined( 'ABSPATH' ) || exit;

function lodd_setup() {
	load_theme_textdomain( 'lodd', LODD_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 68,
			'width'       => 131,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'lodd' ),
			'footer'  => __( 'Footer Menu', 'lodd' ),
		)
	);

	add_image_size( 'lodd-card', 850, 560, true );
	add_image_size( 'lodd-panel', 1176, 1012, true );
	add_image_size( 'lodd-wide', 2880, 1550, true );
}
add_action( 'after_setup_theme', 'lodd_setup' );

function lodd_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'has-overlay-header';
	}
	return $classes;
}
add_filter( 'body_class', 'lodd_body_classes' );

function lodd_nav_link_attributes( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && in_array( $args->theme_location, array( 'primary', 'footer' ), true ) ) {
		$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' nav-link' );
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'lodd_nav_link_attributes', 10, 3 );

function lodd_mime_types( $mimes ) {
	$mimes['mp4']  = 'video/mp4';
	$mimes['webm'] = 'video/webm';
	return $mimes;
}
add_filter( 'upload_mimes', 'lodd_mime_types' );
