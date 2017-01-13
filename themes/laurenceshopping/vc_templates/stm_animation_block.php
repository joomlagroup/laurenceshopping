<?php
extract( shortcode_atts( array(
	'animation' => '',
	'animation_duration' => '',
	'animation_delay' => '',
	'viewport_position' => ''
), $atts ) );
wp_enqueue_style( 'stm_animate.min.css' );
?>
<div class="stm_animation stm_viewport" style="" data-animate="<?php echo esc_attr( $animation ); ?>" data-animation-delay="<?php echo esc_attr( $animation_delay ); ?>" data-animation-duration="<?php echo esc_attr( $animation_duration ); ?>" data-viewport_position="<?php echo esc_attr( $viewport_position ); ?>" >
	<?php echo do_shortcode($content); ?>
</div>