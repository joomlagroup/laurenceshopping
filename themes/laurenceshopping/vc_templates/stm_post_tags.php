<?php
extract( shortcode_atts( array(
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="stm_post_tags<?php echo esc_attr( $css_class ); ?>">
	<?php if( $tags = wp_get_post_tags( get_the_ID() ) ){ ?>
		<?php foreach( $tags as $tag ){ ?>
			<a href="<?php echo get_tag_link( $tag ); ?>"><?php echo balanceTags( $tag->name, true ); ?></a>
		<?php } ?>
	<?php } ?>
</div>