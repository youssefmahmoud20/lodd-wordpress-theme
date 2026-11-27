<?php
defined( 'ABSPATH' ) || exit;

$lodd_solutions = lodd_section( 'solutions' );
$lodd_items     = lodd_items( 'lodd_solution' );

if ( empty( $lodd_solutions['title'] ) && ! $lodd_items ) {
	return;
}
?>
<section class="solutions section--dark" id="solutions" aria-labelledby="solutions-title">
	<div class="solutions__decor" aria-hidden="true">
		<?php echo lodd_image( $lodd_solutions['background'] ?? 0, 'full', array( 'class' => 'solutions__decor-image', 'alt' => '' ) ); ?>
		<img class="solutions__decor-mark" src="<?php echo esc_url( lodd_asset( 'icons/solutions-logo-mark.svg' ) ); ?>" width="88" height="46" alt="">
	</div>
	<div class="container">
		<?php
		get_template_part(
			'template-parts/components/section-head',
			null,
			array(
				'title' => $lodd_solutions['title'] ?? '',
				'text'  => $lodd_solutions['text'] ?? '',
				'id'    => 'solutions-title',
			)
		);
		?>

		<?php if ( $lodd_items ) : ?>
			<div class="solutions__grid">
				<?php foreach ( $lodd_items as $lodd_index => $lodd_item ) : ?>
					<?php
					$lodd_icon   = get_field( 'icon', $lodd_item->ID );
					$lodd_text   = get_field( 'description', $lodd_item->ID );
					$lodd_button = get_field( 'button', $lodd_item->ID );
					?>
					<article class="solution-card" data-reveal style="--reveal-delay: <?php echo (int) $lodd_index * 120; ?>ms">
						<?php if ( $lodd_icon ) : ?>
							<span class="icon-box icon-box--outline"><?php echo lodd_icon( $lodd_icon ); ?></span>
						<?php endif; ?>
						<h3 class="solution-card__title"><?php echo esc_html( get_the_title( $lodd_item ) ); ?></h3>
						<?php if ( $lodd_text ) : ?>
							<p class="solution-card__text"><?php echo esc_html( $lodd_text ); ?></p>
						<?php endif; ?>
						<?php lodd_button( is_array( $lodd_button ) ? $lodd_button : array(), 'light', 'solution-card__button' ); ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php lodd_divider( 'dark' ); ?>
	</div>
</section>
