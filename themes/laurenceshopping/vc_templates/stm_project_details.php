<?php
extract( shortcode_atts( array(
	'title' => '',
	'style' => 'style_1',
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="project_info<?php echo esc_attr( $css_class . ' ' . $style ); ?>">
	<?php if( $title ){ ?>
		<h4><?php echo balanceTags( $title, true ); ?></h4>
	<?php } ?>
	<?php if( !empty( $content ) ){ ?>
		<div class="project_info_wr">
			<table>
				<?php echo wpb_js_remove_wpautop($content); ?>
			</table>
		</div>
	<?php } ?>
</div>