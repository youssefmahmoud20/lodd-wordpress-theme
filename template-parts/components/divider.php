<?php
defined( 'ABSPATH' ) || exit;

$lodd_variant = 'dark' === ( $args['variant'] ?? 'light' ) ? 'dark' : 'light';
$lodd_drones  = array(
	'light'  => 'divider-drone-light.gif',
	'dark'   => 'divider-drone-dark.gif',
	'footer' => 'divider-drone-footer.gif',
);
$lodd_drone   = $lodd_drones[ $args['drone'] ?? $lodd_variant ] ?? $lodd_drones['light'];
?>
<div class="divider divider--<?php echo esc_attr( $lodd_variant ); ?>" data-divider aria-hidden="true">
	<span class="divider__line"></span>
	<span class="divider__progress"></span>
	<span class="divider__node divider__node--start"></span>
	<span class="divider__node divider__node--middle"></span>
	<span class="divider__node divider__node--end"></span>
	<img class="divider__drone" src="<?php echo esc_url( lodd_asset( 'images/' . $lodd_drone ) ); ?>" width="48" height="48" alt="" loading="lazy" decoding="async">
</div>
