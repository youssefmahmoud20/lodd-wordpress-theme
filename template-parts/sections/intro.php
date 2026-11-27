<?php
defined( 'ABSPATH' ) || exit;

$lodd_intro = lodd_section( 'intro' );

if ( ! array_filter( $lodd_intro ) ) {
	return;
}
?>
<section class="intro" id="about" aria-labelledby="intro-title">
	<div class="container">
		<div class="intro__grid">
			<div class="intro__main">
				<h2 class="intro__heading" id="intro-title" data-reveal><?php echo nl2br( esc_html( $lodd_intro['heading'] ?? '' ) ); ?></h2>
				<?php if ( ! empty( $lodd_intro['lead'] ) ) : ?>
					<p class="intro__lead" data-reveal><?php echo esc_html( $lodd_intro['lead'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $lodd_intro['body'] ) ) : ?>
				<div class="intro__body rich-text" data-reveal>
					<?php echo lodd_text( $lodd_intro['body'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php lodd_divider( 'light' ); ?>
	</div>
</section>
