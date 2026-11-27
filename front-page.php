<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php
	foreach ( array( 'hero', 'intro', 'about', 'solutions', 'safety', 'technologies', 'sectors', 'news-cta', 'careers' ) as $lodd_section ) {
		get_template_part( 'template-parts/sections/' . $lodd_section );
	}
	?>
</main>
<?php
get_footer();
