<?php

defined( 'ABSPATH' ) || exit;

function lodd_asset_version( $relative_path ) {
	$file = LODD_DIR . '/' . ltrim( $relative_path, '/' );
	return file_exists( $file ) ? LODD_VERSION . '.' . filemtime( $file ) : LODD_VERSION;
}

function lodd_enqueue_assets() {
	wp_enqueue_style(
		'lodd-fonts',
		'https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300;400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'lodd-main',
		LODD_URI . '/assets/css/main.css',
		array( 'lodd-fonts' ),
		lodd_asset_version( 'assets/css/main.css' )
	);

	wp_enqueue_script(
		'lodd-main',
		LODD_URI . '/assets/js/main.js',
		array(),
		lodd_asset_version( 'assets/js/main.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	wp_localize_script(
		'lodd-main',
		'loddConfig',
		array(
			'isRtl' => is_rtl(),
			'i18n'  => array(
				'play'  => __( 'Play background video', 'lodd' ),
				'pause' => __( 'Pause background video', 'lodd' ),
				'open'  => __( 'Open menu', 'lodd' ),
				'close' => __( 'Close menu', 'lodd' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lodd_enqueue_assets' );

function lodd_js_detection() {
	wp_print_inline_script_tag( "document.documentElement.classList.add('js');" );
}
add_action( 'wp_head', 'lodd_js_detection', 0 );

function lodd_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
		$urls[] = 'https://fonts.googleapis.com';
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'lodd_resource_hints', 10, 2 );
