<?php
defined( 'ABSPATH' ) || exit;

$lodd_careers = lodd_section( 'careers' );

if ( empty( $lodd_careers['title'] ) ) {
	return;
}
?>
<section class="careers" id="careers" aria-labelledby="careers-title">
	<div class="container">
		<?php lodd_divider( 'light' ); ?>

		<div class="careers__card">
			<div class="careers__media" data-parallax>
				<?php echo lodd_image( $lodd_careers['image'] ?? 0, 'lodd-wide', array( 'class' => 'careers__image', 'alt' => '', 'loading' => 'lazy', 'sizes' => '(min-width: 1520px) 1440px, 100vw' ) ); ?>
			</div>
			<div class="careers__panel" data-reveal>
				<h2 class="careers__title" id="careers-title"><?php echo esc_html( $lodd_careers['title'] ); ?></h2>
				<div class="careers__text rich-text">
					<?php echo lodd_text( $lodd_careers['text'] ?? '' ); ?>
				</div>
				<?php lodd_button( $lodd_careers['button'] ?? array(), 'primary' ); ?>
			</div>
		</div>

		<?php lodd_divider( 'light' ); ?>
	</div>
</section>
