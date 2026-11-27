<?php
defined( 'ABSPATH' ) || exit;

$lodd_sectors = lodd_section( 'sectors' );
$lodd_items   = lodd_items( 'lodd_sector' );

if ( empty( $lodd_sectors['title'] ) && ! $lodd_items ) {
	return;
}
?>
<section class="sectors section--dark" id="sectors" aria-labelledby="sectors-title">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/components/section-head',
			null,
			array(
				'title' => $lodd_sectors['title'] ?? '',
				'text'  => $lodd_sectors['text'] ?? '',
				'id'    => 'sectors-title',
			)
		);
		?>
	</div>

	<?php if ( $lodd_items ) : ?>
		<div class="sectors__slider" data-slider>
				<ul class="sectors__track" data-slider-track tabindex="0" aria-label="<?php echo esc_attr( $lodd_sectors['title'] ?? __( 'Sectors', 'lodd' ) ); ?>">
					<?php foreach ( $lodd_items as $lodd_index => $lodd_item ) : ?>
						<?php
						$lodd_link  = get_field( 'link', $lodd_item->ID );
						$lodd_text  = get_field( 'description', $lodd_item->ID );
						$lodd_image = get_field( 'image', $lodd_item->ID );
						?>
						<li class="sector-card" data-slider-slide>
							<div class="sector-card__media">
								<?php echo lodd_image( $lodd_image, 'lodd-card', array( 'class' => 'sector-card__image', 'loading' => 'lazy', 'alt' => get_the_title( $lodd_item ) ) ); ?>
							</div>
							<h3 class="sector-card__title"><?php echo esc_html( get_the_title( $lodd_item ) ); ?></h3>
							<?php if ( $lodd_text ) : ?>
								<p class="sector-card__text"><?php echo esc_html( $lodd_text ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $lodd_link['url'] ) ) : ?>
								<a class="sector-card__more" <?php echo lodd_link_attrs( $lodd_link ); ?>>
									<span class="screen-reader-text"><?php echo esc_html( ( $lodd_link['title'] ?? '' ) . ': ' . get_the_title( $lodd_item ) ); ?></span>
									<?php echo lodd_icon( 'plus' ); ?>
								</a>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
		</div>
	<?php endif; ?>

	<div class="container sectors__footer">
		<?php lodd_button( $lodd_sectors['button'] ?? array(), 'primary' ); ?>
		<?php if ( count( $lodd_items ) > 1 ) : ?>
			<div class="slider-nav">
				<button class="slider-nav__btn" type="button" data-slider-prev aria-label="<?php esc_attr_e( 'Previous sector', 'lodd' ); ?>"><?php echo lodd_icon( 'chevron-prev' ); ?></button>
				<button class="slider-nav__btn" type="button" data-slider-next aria-label="<?php esc_attr_e( 'Next sector', 'lodd' ); ?>"><?php echo lodd_icon( 'chevron-next' ); ?></button>
			</div>
		<?php endif; ?>
	</div>
</section>
