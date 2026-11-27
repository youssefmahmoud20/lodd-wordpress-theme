<?php

defined( 'ABSPATH' ) || exit;

function lodd_post_type_definitions() {
	return array(
		'lodd_solution'   => array(
			'plural'   => __( 'Solutions', 'lodd' ),
			'singular' => __( 'Solution', 'lodd' ),
			'icon'     => 'dashicons-airplane',
		),
		'lodd_technology' => array(
			'plural'   => __( 'Technologies', 'lodd' ),
			'singular' => __( 'Technology', 'lodd' ),
			'icon'     => 'dashicons-admin-generic',
		),
		'lodd_sector'     => array(
			'plural'   => __( 'Sectors', 'lodd' ),
			'singular' => __( 'Sector', 'lodd' ),
			'icon'     => 'dashicons-building',
		),
	);
}

function lodd_register_post_types() {
	$position = 21;

	foreach ( lodd_post_type_definitions() as $post_type => $def ) {
		register_post_type(
			$post_type,
			array(
				'labels'              => array(
					'name'          => $def['plural'],
					'singular_name' => $def['singular'],
					'menu_name'     => $def['plural'],
					'add_new_item'  => sprintf( __( 'Add New %s', 'lodd' ), $def['singular'] ),
					'edit_item'     => sprintf( __( 'Edit %s', 'lodd' ), $def['singular'] ),
					'all_items'     => $def['plural'],
				),
				'public'              => false,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_rest'        => false,
				'menu_position'       => $position++,
				'menu_icon'           => $def['icon'],
				'supports'            => array( 'title', 'page-attributes' ),
				'has_archive'         => false,
				'rewrite'             => false,
			)
		);
	}
}
add_action( 'init', 'lodd_register_post_types' );

function lodd_admin_columns( $columns ) {
	$columns['menu_order'] = __( 'Order', 'lodd' );
	return $columns;
}

function lodd_admin_column_value( $column, $post_id ) {
	if ( 'menu_order' === $column ) {
		echo (int) get_post_field( 'menu_order', $post_id );
	}
}

function lodd_admin_default_order( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( array_key_exists( $query->get( 'post_type' ), lodd_post_type_definitions() ) && ! $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'lodd_admin_default_order' );

function lodd_register_admin_columns() {
	foreach ( array_keys( lodd_post_type_definitions() ) as $post_type ) {
		add_filter( "manage_{$post_type}_posts_columns", 'lodd_admin_columns' );
		add_action( "manage_{$post_type}_posts_custom_column", 'lodd_admin_column_value', 10, 2 );
	}
}
add_action( 'admin_init', 'lodd_register_admin_columns' );
