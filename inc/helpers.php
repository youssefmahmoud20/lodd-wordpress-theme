<?php

defined( 'ABSPATH' ) || exit;

function lodd_front_page_id() {
	static $id = null;

	if ( null === $id ) {
		$id = (int) get_option( 'page_on_front' );
		if ( $id && function_exists( 'pll_get_post' ) ) {
			$translated = pll_get_post( $id );
			$id         = $translated ? (int) $translated : $id;
		}
	}

	return $id;
}

function lodd_field( $name, $post_id = null ) {
	if ( ! function_exists( 'get_field' ) ) {
		return null;
	}
	return get_field( $name, $post_id ?? lodd_front_page_id() );
}

function lodd_section( $name ) {
	$value = lodd_field( $name );
	return is_array( $value ) ? $value : array();
}

function lodd_asset( $path ) {
	return LODD_URI . '/assets/' . ltrim( $path, '/' );
}

function lodd_icon( $name, $class = '' ) {
	$file = LODD_DIR . '/assets/icons/' . sanitize_file_name( $name ) . '.svg';
	if ( ! file_exists( $file ) ) {
		return '';
	}

	$svg = file_get_contents( $file );
	if ( $class ) {
		$svg = preg_replace( '/^<svg /', '<svg class="' . esc_attr( $class ) . '" ', $svg, 1 );
	}

	return $svg;
}

function lodd_icon_choices() {
	return array(
		'package'       => __( 'Package', 'lodd' ),
		'quick-reorder' => __( 'Quick reorder', 'lodd' ),
		'antenna'       => __( 'Antenna', 'lodd' ),
		'directions'    => __( 'Directions', 'lodd' ),
		'beenhere'      => __( 'Shield check', 'lodd' ),
		'conveyor-belt' => __( 'Conveyor belt', 'lodd' ),
	);
}

function lodd_image( $image, $size = 'large', $attr = array() ) {
	$id = is_array( $image ) ? ( $image['ID'] ?? 0 ) : (int) $image;
	if ( ! $id ) {
		return '';
	}
	return wp_get_attachment_image( $id, $size, false, $attr );
}

function lodd_image_url( $image, $size = 'full' ) {
	$id = is_array( $image ) ? ( $image['ID'] ?? 0 ) : (int) $image;
	return $id ? (string) wp_get_attachment_image_url( $id, $size ) : '';
}

function lodd_text( $text ) {
	return wp_kses_post( wpautop( (string) $text ) );
}

function lodd_link_attrs( $link ) {
	$url    = $link['url'] ?? '#';
	$target = $link['target'] ?? '';
	$attrs  = 'href="' . esc_url( $url ) . '"';

	if ( '_blank' === $target ) {
		$attrs .= ' target="_blank" rel="noopener noreferrer"';
	}

	return $attrs;
}

function lodd_button( $link, $variant = 'primary', $class = '' ) {
	if ( empty( $link['title'] ) ) {
		return;
	}

	get_template_part(
		'template-parts/components/button',
		null,
		array(
			'link'    => $link,
			'variant' => $variant,
			'class'   => $class,
		)
	);
}

function lodd_divider( $variant = 'light', $drone = null ) {
	get_template_part(
		'template-parts/components/divider',
		null,
		array(
			'variant' => $variant,
			'drone'   => $drone ?? $variant,
		)
	);
}

function lodd_items( $post_type ) {
	return get_posts(
		array(
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'posts_per_page'   => -1,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'suppress_filters' => false,
		)
	);
}
