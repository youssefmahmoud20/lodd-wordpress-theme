<?php
defined( 'ABSPATH' ) || exit;

$lodd_tech  = lodd_section( 'technologies' );
$lodd_items = lodd_items( 'lodd_technology' );

if ( empty( $lodd_tech['title'] ) && ! $lodd_items ) {
	return;
}
?>
<section class="technologies" id="technologies" aria-labelledby="technologies-title">
	<div class="container">
		<?php lodd_divider( 'light' ); ?>

		<?php
		get_template_part(
			'template-parts/components/section-head',
			null,
			array(
				'title' => $lodd_tech['title'] ?? '',
				'text'  => $lodd_tech['text'] ?? '',
				'id'    => 'technologies-title',
				'rich'  => true,
			)
		);
		?>

		<?php if ( $lodd_items ) : ?>
			<div class="tech-accordion" data-accordion data-reveal>
				<?php foreach ( $lodd_items as $lodd_index => $lodd_item ) : ?>
					<?php
					$lodd_active = 0 === $lodd_index;
					$lodd_uid    = 'tech-' . $lodd_item->ID;
					$lodd_title  = get_the_title( $lodd_item );
					$lodd_icon   = get_field( 'icon', $lodd_item->ID );
					$lodd_text   = get_field( 'description', $lodd_item->ID );
					$lodd_image  = get_field( 'image', $lodd_item->ID );
					?>
					<div class="tech-item<?php echo $lodd_active ? ' is-active' : ''; ?>" data-accordion-item>
						<button class="tech-item__tab" type="button" id="<?php echo esc_attr( $lodd_uid ); ?>-tab" aria-expanded="<?php echo $lodd_active ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $lodd_uid ); ?>-panel" data-accordion-trigger>
							<span class="tech-item__toggle" aria-hidden="true">
								<?php echo lodd_icon( 'plus-circle', 'tech-item__toggle-open' ); ?>
								<?php echo lodd_icon( 'minus-circle', 'tech-item__toggle-close' ); ?>
							</span>
							<span class="tech-item__label"><?php echo esc_html( $lodd_title ); ?></span>
							<?php if ( $lodd_icon ) : ?>
								<span class="icon-box tech-item__icon" aria-hidden="true"><?php echo lodd_icon( $lodd_icon ); ?></span>
							<?php endif; ?>
						</button>
						<div class="tech-item__panel" id="<?php echo esc_attr( $lodd_uid ); ?>-panel" role="region" aria-labelledby="<?php echo esc_attr( $lodd_uid ); ?>-tab">
							<div class="tech-item__content">
								<?php if ( $lodd_image ) : ?>
									<div class="tech-item__media">
										<?php echo lodd_image( $lodd_image, 'lodd-panel', array( 'class' => 'tech-item__image', 'loading' => 'lazy', 'alt' => $lodd_title ) ); ?>
									</div>
								<?php endif; ?>
								<div class="tech-item__body">
									<h3 class="tech-item__title"><?php echo esc_html( $lodd_title ); ?></h3>
									<?php if ( $lodd_text ) : ?>
										<p class="tech-item__text"><?php echo esc_html( $lodd_text ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php lodd_divider( 'light' ); ?>
	</div>
</section>
