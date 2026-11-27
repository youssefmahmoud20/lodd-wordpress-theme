<?php
defined( 'ABSPATH' ) || exit;

$lodd_news = lodd_section( 'news_cta' );

if ( empty( $lodd_news['text'] ) ) {
	return;
}
?>
<section class="news-cta" id="news" aria-label="<?php echo esc_attr( $lodd_news['text'] ); ?>">
	<div class="container news-cta__inner" data-reveal>
		<p class="news-cta__text"><?php echo esc_html( $lodd_news['text'] ); ?></p>
		<?php lodd_button( $lodd_news['button'] ?? array(), 'primary' ); ?>
	</div>
</section>
