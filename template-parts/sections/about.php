<?php
defined( 'ABSPATH' ) || exit;

$lodd_about = lodd_section( 'about' );

if ( empty( $lodd_about['title'] ) ) {
	return;
}
?>
<section class="about" aria-labelledby="about-title">
	<div class="about__media" data-parallax>
		<?php
		echo lodd_image(
			$lodd_about['background'] ?? 0,
			'full',
			array(
				'class' => 'about__image',
				'alt'   => '',
				'sizes' => '100vw',
			)
		);
		?>
	</div>
	<div class="container about__inner">
		<div class="about__card" data-reveal>
			<?php if ( ! empty( $lodd_about['eyebrow'] ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( $lodd_about['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h2 class="about__title" id="about-title"><?php echo esc_html( $lodd_about['title'] ); ?></h2>
			<?php if ( ! empty( $lodd_about['text'] ) ) : ?>
				<p class="about__text"><?php echo esc_html( $lodd_about['text'] ); ?></p>
			<?php endif; ?>
			<?php lodd_button( $lodd_about['button'] ?? array(), 'light' ); ?>
		</div>
	</div>
</section>
