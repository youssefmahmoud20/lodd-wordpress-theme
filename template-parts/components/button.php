<?php
defined( 'ABSPATH' ) || exit;

$lodd_link    = $args['link'] ?? array();
$lodd_variant = $args['variant'] ?? 'primary';
$lodd_class   = trim( 'btn btn--' . $lodd_variant . ' ' . ( $args['class'] ?? '' ) );
?>
<a class="<?php echo esc_attr( $lodd_class ); ?>" <?php echo lodd_link_attrs( $lodd_link ); ?>>
	<span class="btn__label"><?php echo esc_html( $lodd_link['title'] ); ?></span>
	<?php echo lodd_icon( 'arrow', 'btn__icon' ); ?>
</a>
