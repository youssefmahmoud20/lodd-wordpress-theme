<?php
defined( 'ABSPATH' ) || exit;

$lodd_safety = lodd_section( 'safety' );

if ( empty( $lodd_safety['title'] ) ) {
	return;
}
?>
<section class="safety" aria-labelledby="safety-title">
	<div class="safety__pattern" aria-hidden="true">
		<?php echo lodd_image( $lodd_safety['pattern'] ?? 0, 'full', array( 'class' => 'safety__pattern-image', 'alt' => '' ) ); ?>
	</div>
	<div class="container safety__grid">
		<h2 class="safety__title" id="safety-title" data-reveal><?php echo esc_html( $lodd_safety['title'] ); ?></h2>
		<div class="safety__text rich-text" data-reveal>
			<?php echo lodd_text( $lodd_safety['text'] ?? '' ); ?>
		</div>
	</div>
</section>
