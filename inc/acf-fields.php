<?php

defined( 'ABSPATH' ) || exit;

function lodd_acf_field( $type, $name, $label, $args = array() ) {
	return array_merge(
		array(
			'key'   => 'field_lodd_' . $name,
			'name'  => $name,
			'label' => $label,
			'type'  => $type,
		),
		$args
	);
}

function lodd_acf_sub( $parent, $type, $name, $label, $args = array() ) {
	$field        = lodd_acf_field( $type, $name, $label, $args );
	$field['key'] = 'field_lodd_' . $parent . '_' . $name;
	return $field;
}

function lodd_acf_tab( $name, $label ) {
	return array(
		'key'       => 'field_lodd_tab_' . $name,
		'label'     => $label,
		'type'      => 'tab',
		'placement' => 'left',
	);
}

function lodd_acf_group( $name, $label, $sub_fields ) {
	return lodd_acf_field(
		'group',
		$name,
		$label,
		array(
			'layout'     => 'block',
			'sub_fields' => $sub_fields,
		)
	);
}

function lodd_acf_image( $parent, $name, $label, $args = array() ) {
	return lodd_acf_sub(
		$parent,
		'image',
		$name,
		$label,
		array_merge(
			array(
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
			),
			$args
		)
	);
}

function lodd_acf_editor( $parent, $name, $label ) {
	return lodd_acf_sub(
		$parent,
		'wysiwyg',
		$name,
		$label,
		array(
			'tabs'         => 'visual',
			'toolbar'      => 'basic',
			'media_upload' => 0,
		)
	);
}

function lodd_acf_textarea( $parent, $name, $label, $rows = 3 ) {
	return lodd_acf_sub(
		$parent,
		'textarea',
		$name,
		$label,
		array(
			'rows'      => $rows,
			'new_lines' => '',
		)
	);
}

function lodd_homepage_fields() {
	return array(
		lodd_acf_tab( 'header', __( 'Header', 'lodd' ) ),
		lodd_acf_group(
			'header',
			__( 'Header', 'lodd' ),
			array(
				lodd_acf_image( 'header', 'logo', __( 'Logo (light)', 'lodd' ) ),
				lodd_acf_sub( 'header', 'link', 'cta', __( 'Call to action', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'hero', __( 'Hero', 'lodd' ) ),
		lodd_acf_group(
			'hero',
			__( 'Hero', 'lodd' ),
			array(
				lodd_acf_sub( 'hero', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_sub(
					'hero',
					'file',
					'video',
					__( 'Background video (MP4)', 'lodd' ),
					array(
						'return_format' => 'array',
						'mime_types'    => 'mp4,webm',
					)
				),
				lodd_acf_image( 'hero', 'poster', __( 'Poster image', 'lodd' ), array( 'instructions' => __( 'Shown while the video loads and for visitors who prefer reduced motion.', 'lodd' ) ) ),
			)
		),

		lodd_acf_tab( 'intro', __( 'Introduction', 'lodd' ) ),
		lodd_acf_group(
			'intro',
			__( 'Introduction', 'lodd' ),
			array(
				lodd_acf_textarea( 'intro', 'heading', __( 'Heading', 'lodd' ), 2 ),
				lodd_acf_textarea( 'intro', 'lead', __( 'Lead paragraph', 'lodd' ) ),
				lodd_acf_editor( 'intro', 'body', __( 'Body', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'about', __( 'About', 'lodd' ) ),
		lodd_acf_group(
			'about',
			__( 'About', 'lodd' ),
			array(
				lodd_acf_image( 'about', 'background', __( 'Background image', 'lodd' ) ),
				lodd_acf_sub( 'about', 'text', 'eyebrow', __( 'Eyebrow', 'lodd' ) ),
				lodd_acf_sub( 'about', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_textarea( 'about', 'text', __( 'Text', 'lodd' ), 4 ),
				lodd_acf_sub( 'about', 'link', 'button', __( 'Button', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'solutions', __( 'Solutions', 'lodd' ) ),
		lodd_acf_group(
			'solutions',
			__( 'Solutions', 'lodd' ),
			array(
				lodd_acf_sub( 'solutions', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_textarea( 'solutions', 'text', __( 'Intro text', 'lodd' ) ),
				lodd_acf_image( 'solutions', 'background', __( 'Background illustration', 'lodd' ) ),
				lodd_acf_sub(
					'solutions',
					'message',
					'items_note',
					__( 'Solution cards', 'lodd' ),
					array( 'message' => __( 'Cards are managed under Solutions in the admin menu. Use the Order attribute to sort them.', 'lodd' ) )
				),
			)
		),

		lodd_acf_tab( 'safety', __( 'Safety & Privacy', 'lodd' ) ),
		lodd_acf_group(
			'safety',
			__( 'Safety & Privacy', 'lodd' ),
			array(
				lodd_acf_sub( 'safety', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_editor( 'safety', 'text', __( 'Text', 'lodd' ) ),
				lodd_acf_image( 'safety', 'pattern', __( 'Decorative pattern', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'technologies', __( 'Technologies', 'lodd' ) ),
		lodd_acf_group(
			'technologies',
			__( 'Technologies', 'lodd' ),
			array(
				lodd_acf_sub( 'technologies', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_editor( 'technologies', 'text', __( 'Intro text', 'lodd' ) ),
				lodd_acf_sub(
					'technologies',
					'message',
					'items_note',
					__( 'Technology panels', 'lodd' ),
					array( 'message' => __( 'Panels are managed under Technologies in the admin menu. The first panel opens by default.', 'lodd' ) )
				),
			)
		),

		lodd_acf_tab( 'sectors', __( 'Sectors', 'lodd' ) ),
		lodd_acf_group(
			'sectors',
			__( 'Sectors', 'lodd' ),
			array(
				lodd_acf_sub( 'sectors', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_textarea( 'sectors', 'text', __( 'Intro text', 'lodd' ) ),
				lodd_acf_sub( 'sectors', 'link', 'button', __( 'Button', 'lodd' ) ),
				lodd_acf_sub(
					'sectors',
					'message',
					'items_note',
					__( 'Sector cards', 'lodd' ),
					array( 'message' => __( 'Slides are managed under Sectors in the admin menu.', 'lodd' ) )
				),
			)
		),

		lodd_acf_tab( 'news_cta', __( 'News banner', 'lodd' ) ),
		lodd_acf_group(
			'news_cta',
			__( 'News banner', 'lodd' ),
			array(
				lodd_acf_sub( 'news_cta', 'text', 'text', __( 'Text', 'lodd' ) ),
				lodd_acf_sub( 'news_cta', 'link', 'button', __( 'Button', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'careers', __( 'Careers', 'lodd' ) ),
		lodd_acf_group(
			'careers',
			__( 'Careers', 'lodd' ),
			array(
				lodd_acf_image( 'careers', 'image', __( 'Background image', 'lodd' ) ),
				lodd_acf_sub( 'careers', 'text', 'title', __( 'Title', 'lodd' ) ),
				lodd_acf_editor( 'careers', 'text', __( 'Text', 'lodd' ) ),
				lodd_acf_sub( 'careers', 'link', 'button', __( 'Button', 'lodd' ) ),
			)
		),

		lodd_acf_tab( 'footer', __( 'Footer', 'lodd' ) ),
		lodd_acf_group(
			'footer',
			__( 'Footer', 'lodd' ),
			array(
				lodd_acf_image( 'footer', 'logo', __( 'Logo (colour)', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'text', 'copyright', __( 'Copyright', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'link', 'terms', __( 'Terms link', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'link', 'privacy', __( 'Privacy link', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'url', 'youtube', __( 'YouTube URL', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'url', 'twitter', __( 'X (Twitter) URL', 'lodd' ) ),
				lodd_acf_sub( 'footer', 'url', 'linkedin', __( 'LinkedIn URL', 'lodd' ) ),
			)
		),
	);
}

function lodd_register_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'            => 'group_lodd_homepage',
			'title'          => __( 'Homepage content', 'lodd' ),
			'fields'         => lodd_homepage_fields(),
			'location'       => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position'       => 'acf_after_title',
			'style'          => 'seamless',
			'hide_on_screen' => array( 'the_content', 'excerpt', 'discussion', 'comments', 'author', 'format', 'featured_image', 'send-trackbacks' ),
		)
	);

	$icon_choices = lodd_icon_choices();

	acf_add_local_field_group(
		array(
			'key'      => 'group_lodd_solution',
			'title'    => __( 'Solution details', 'lodd' ),
			'fields'   => array(
				lodd_acf_sub( 'solution', 'select', 'icon', __( 'Icon', 'lodd' ), array( 'choices' => $icon_choices ) ),
				lodd_acf_textarea( 'solution', 'description', __( 'Description', 'lodd' ), 4 ),
				lodd_acf_sub( 'solution', 'link', 'button', __( 'Button', 'lodd' ) ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'lodd_solution' ) ) ),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_lodd_technology',
			'title'    => __( 'Technology details', 'lodd' ),
			'fields'   => array(
				lodd_acf_sub( 'technology', 'select', 'icon', __( 'Icon', 'lodd' ), array( 'choices' => $icon_choices ) ),
				lodd_acf_textarea( 'technology', 'description', __( 'Description', 'lodd' ), 4 ),
				lodd_acf_image( 'technology', 'image', __( 'Image', 'lodd' ) ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'lodd_technology' ) ) ),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_lodd_sector',
			'title'    => __( 'Sector details', 'lodd' ),
			'fields'   => array(
				lodd_acf_image( 'sector', 'image', __( 'Image', 'lodd' ) ),
				lodd_acf_textarea( 'sector', 'description', __( 'Description', 'lodd' ), 4 ),
				lodd_acf_sub( 'sector', 'link', 'link', __( 'Link', 'lodd' ) ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'lodd_sector' ) ) ),
		)
	);
}
add_action( 'acf/include_fields', 'lodd_register_field_groups' );

function lodd_is_front_page_translation( $post_id ) {
	$front = (int) get_option( 'page_on_front' );
	if ( ! $front || ! $post_id ) {
		return false;
	}
	if ( (int) $post_id === $front ) {
		return true;
	}
	return function_exists( 'pll_get_post_translations' ) && in_array( (int) $post_id, array_map( 'intval', pll_get_post_translations( $front ) ), true );
}

function lodd_match_front_page_translations( $match, $rule, $screen ) {
	if ( 'front_page' !== $rule['value'] || empty( $screen['post_id'] ) ) {
		return $match;
	}
	$is_front = lodd_is_front_page_translation( $screen['post_id'] );
	return '==' === $rule['operator'] ? $is_front : ! $is_front;
}
add_filter( 'acf/location/rule_match/page_type', 'lodd_match_front_page_translations', 20, 3 );

function lodd_disable_block_editor_on_front( $use, $post ) {
	return lodd_is_front_page_translation( $post->ID ) ? false : $use;
}
add_filter( 'use_block_editor_for_post', 'lodd_disable_block_editor_on_front', 10, 2 );

function lodd_hide_front_page_editor() {
	$screen = get_current_screen();
	if ( $screen && 'page' === $screen->post_type && isset( $_GET['post'] ) && lodd_is_front_page_translation( absint( $_GET['post'] ) ) ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'current_screen', 'lodd_hide_front_page_editor' );
