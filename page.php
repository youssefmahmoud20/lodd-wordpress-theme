<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main site-main--page" tabindex="-1">
	<div class="container page-content">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'single' );
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
