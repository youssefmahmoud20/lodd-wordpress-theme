<?php
defined( 'ABSPATH' ) || exit;

$lodd_header = lodd_section( 'header' );
$lodd_logo   = lodd_image(
	$lodd_header['logo'] ?? 0,
	'medium',
	array(
		'class'   => 'site-logo__img',
		'loading' => 'eager',
	)
);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'lodd' ); ?></a>

<header class="site-header" data-header>
	<div class="site-header__inner">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( $lodd_logo ) : ?>
				<?php echo $lodd_logo; ?>
			<?php else : ?>
				<img class="site-logo__img" src="<?php echo esc_url( lodd_asset( 'images/logo-white.png' ) ); ?>" width="131" height="68" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php endif; ?>
		</a>

		<button class="site-header__toggle" type="button" aria-expanded="false" aria-controls="site-panel" data-nav-toggle>
			<span class="screen-reader-text" data-nav-label><?php esc_html_e( 'Open menu', 'lodd' ); ?></span>
			<span class="site-header__toggle-bar" aria-hidden="true"></span>
			<span class="site-header__toggle-bar" aria-hidden="true"></span>
			<span class="site-header__toggle-bar" aria-hidden="true"></span>
		</button>

		<div class="site-header__panel" id="site-panel" data-nav-panel>
			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'lodd' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-nav__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<div class="site-header__actions">
				<?php lodd_language_switcher(); ?>
				<?php if ( ! empty( $lodd_header['cta']['title'] ) ) : ?>
					<a class="btn btn--outline" <?php echo lodd_link_attrs( $lodd_header['cta'] ); ?>><?php echo esc_html( $lodd_header['cta']['title'] ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
