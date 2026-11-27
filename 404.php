<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main site-main--page" tabindex="-1">
	<div class="container page-content page-content--center">
		<h1 class="page-content__title"><?php esc_html_e( 'Page not found', 'lodd' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'lodd' ); ?></p>
		<?php
		lodd_button(
			array(
				'url'   => home_url( '/' ),
				'title' => __( 'Back to homepage', 'lodd' ),
			)
		);
		?>
	</div>
</main>
<?php
get_footer();
