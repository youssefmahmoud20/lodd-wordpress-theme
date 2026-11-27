<?php
defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php the_title( '<h1 class="page-content__title">', '</h1>' ); ?>
	<div class="entry__content">
		<?php the_content(); ?>
	</div>
</article>
