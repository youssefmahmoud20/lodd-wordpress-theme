<?php

defined( 'ABSPATH' ) || exit;

function lodd_translatable_post_types( $post_types, $is_settings ) {
	foreach ( array_keys( lodd_post_type_definitions() ) as $post_type ) {
		$post_types[ $post_type ] = $post_type;
	}
	return $post_types;
}
add_filter( 'pll_get_post_types', 'lodd_translatable_post_types', 10, 2 );

function lodd_languages() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return array();
	}

	$languages = pll_the_languages(
		array(
			'raw'                    => 1,
			'hide_if_empty'          => 0,
			'hide_if_no_translation' => 0,
		)
	);

	return is_array( $languages ) ? $languages : array();
}

function lodd_language_switcher( $class = '' ) {
	$languages = array_filter(
		lodd_languages(),
		static function ( $language ) {
			return empty( $language['current_lang'] );
		}
	);

	if ( ! $languages ) {
		return;
	}

	echo '<ul class="' . esc_attr( trim( 'lang-switcher ' . $class ) ) . '" aria-label="' . esc_attr__( 'Language', 'lodd' ) . '">';
	foreach ( $languages as $language ) {
		printf(
			'<li><a class="lang-switcher__link" href="%1$s" hreflang="%2$s" lang="%2$s">%3$s</a></li>',
			esc_url( $language['url'] ),
			esc_attr( $language['locale'] ? str_replace( '_', '-', $language['locale'] ) : $language['slug'] ),
			esc_html( $language['name'] )
		);
	}
	echo '</ul>';
}
