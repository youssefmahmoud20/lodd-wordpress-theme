<?php
defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--excerpt' ); ?>>
	<?php the_title( '<h2 class="entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
	<div class="entry__content">
		<?php the_excerpt(); ?>
	</div>
</article>
