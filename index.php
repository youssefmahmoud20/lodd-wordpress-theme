<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main site-main--page" tabindex="-1">
	<div class="container page-content">
		<?php if ( have_posts() ) : ?>
			<?php if ( ! is_singular() ) : ?>
				<h1 class="page-content__title"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
			<?php endif; ?>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', is_singular() ? 'single' : 'excerpt' );
			endwhile;
			the_posts_pagination();
			?>
		<?php else : ?>
			<h1 class="page-content__title"><?php esc_html_e( 'Nothing found', 'lodd' ); ?></h1>
			<p><?php esc_html_e( 'The content you are looking for is not available yet.', 'lodd' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
