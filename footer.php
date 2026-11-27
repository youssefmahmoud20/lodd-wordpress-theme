<?php
defined( 'ABSPATH' ) || exit;

$lodd_footer  = lodd_section( 'footer' );
$lodd_logo    = lodd_image( $lodd_footer['logo'] ?? 0, 'medium', array( 'class' => 'site-footer__logo-img' ) );
$lodd_socials = array(
	'youtube'  => __( 'YouTube', 'lodd' ),
	'twitter'  => __( 'X (Twitter)', 'lodd' ),
	'linkedin' => __( 'LinkedIn', 'lodd' ),
);
?>
<footer class="site-footer" id="contact">
	<div class="container">
		<div class="site-footer__top">
			<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php if ( $lodd_logo ) : ?>
					<?php echo $lodd_logo; ?>
				<?php else : ?>
					<img class="site-footer__logo-img" src="<?php echo esc_url( lodd_asset( 'icons/logo-color.svg' ) ); ?>" width="103" height="54" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php endif; ?>
			</a>

			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'lodd' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-nav__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<ul class="social-links">
				<?php foreach ( $lodd_socials as $lodd_network => $lodd_label ) : ?>
					<?php if ( ! empty( $lodd_footer[ $lodd_network ] ) ) : ?>
						<li>
							<a class="social-links__link" href="<?php echo esc_url( $lodd_footer[ $lodd_network ] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $lodd_label ); ?>">
								<?php echo lodd_icon( $lodd_network ); ?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php lodd_divider( 'light', 'footer' ); ?>

		<div class="site-footer__bottom">
			<p class="site-footer__copy"><?php echo esc_html( $lodd_footer['copyright'] ?? '' ); ?></p>
			<?php if ( ! empty( $lodd_footer['terms']['title'] ) ) : ?>
				<a class="site-footer__legal" <?php echo lodd_link_attrs( $lodd_footer['terms'] ); ?>><?php echo esc_html( $lodd_footer['terms']['title'] ); ?></a>
			<?php endif; ?>
			<?php if ( ! empty( $lodd_footer['privacy']['title'] ) ) : ?>
				<a class="site-footer__legal site-footer__legal--end" <?php echo lodd_link_attrs( $lodd_footer['privacy'] ); ?>><?php echo esc_html( $lodd_footer['privacy']['title'] ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
