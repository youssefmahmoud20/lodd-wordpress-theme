<?php
defined( 'ABSPATH' ) || exit;

$lodd_hero   = lodd_section( 'hero' );
$lodd_video  = $lodd_hero['video'] ?? array();
$lodd_poster = lodd_image_url( $lodd_hero['poster'] ?? 0, 'full' );
?>
<section class="hero" id="top" aria-label="<?php echo esc_attr( $lodd_hero['title'] ?? get_bloginfo( 'name' ) ); ?>">
	<div class="hero__media">
		<?php if ( ! empty( $lodd_video['url'] ) ) : ?>
			<video class="hero__video" autoplay muted loop playsinline preload="metadata" <?php echo $lodd_poster ? 'poster="' . esc_url( $lodd_poster ) . '"' : ''; ?> data-hero-video>
				<source src="<?php echo esc_url( $lodd_video['url'] ); ?>" type="<?php echo esc_attr( $lodd_video['mime_type'] ?? 'video/mp4' ); ?>">
			</video>
		<?php elseif ( $lodd_poster ) : ?>
			<img class="hero__video" src="<?php echo esc_url( $lodd_poster ); ?>" alt="" fetchpriority="high">
		<?php endif; ?>
	</div>

	<div class="container hero__inner">
		<?php if ( ! empty( $lodd_hero['title'] ) ) : ?>
			<h1 class="hero__title" data-reveal><?php echo esc_html( $lodd_hero['title'] ); ?></h1>
		<?php endif; ?>

		<?php if ( ! empty( $lodd_video['url'] ) ) : ?>
			<button class="hero__toggle" type="button" aria-pressed="true" data-hero-toggle>
				<span class="screen-reader-text" data-hero-toggle-label><?php esc_html_e( 'Pause background video', 'lodd' ); ?></span>
				<svg class="hero__ring" viewBox="0 0 51 51" width="51" height="51" aria-hidden="true" focusable="false">
					<circle class="hero__ring-track" cx="25.5" cy="25.5" r="23.5"></circle>
					<circle class="hero__ring-progress" cx="25.5" cy="25.5" r="23.5" pathLength="100" data-hero-progress></circle>
				</svg>
				<span class="hero__toggle-icon" aria-hidden="true"></span>
			</button>
		<?php endif; ?>
	</div>
</section>
