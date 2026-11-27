<?php
defined( 'ABSPATH' ) || exit;

$lodd_title = $args['title'] ?? '';
$lodd_text  = $args['text'] ?? '';
$lodd_id    = $args['id'] ?? '';
$lodd_rich  = ! empty( $args['rich'] );

if ( ! $lodd_title && ! $lodd_text ) {
	return;
}
?>
<div class="section-head">
	<?php if ( $lodd_title ) : ?>
		<h2 class="section-head__title" <?php echo $lodd_id ? 'id="' . esc_attr( $lodd_id ) . '"' : ''; ?> data-reveal><?php echo esc_html( $lodd_title ); ?></h2>
	<?php endif; ?>
	<?php if ( $lodd_text ) : ?>
		<div class="section-head__text" data-reveal>
			<?php echo $lodd_rich ? lodd_text( $lodd_text ) : '<p>' . esc_html( $lodd_text ) . '</p>'; ?>
		</div>
	<?php endif; ?>
</div>
