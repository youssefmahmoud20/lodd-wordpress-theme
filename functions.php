<?php

defined( 'ABSPATH' ) || exit;

define( 'LODD_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'LODD_DIR', get_template_directory() );
define( 'LODD_URI', get_template_directory_uri() );

require_once LODD_DIR . '/inc/setup.php';
require_once LODD_DIR . '/inc/enqueue.php';
require_once LODD_DIR . '/inc/helpers.php';
require_once LODD_DIR . '/inc/post-types.php';
require_once LODD_DIR . '/inc/acf-fields.php';
require_once LODD_DIR . '/inc/i18n.php';
