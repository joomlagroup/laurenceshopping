<?php
extract( shortcode_atts( array(
	'title' => '',
	'image' => '',
	'link'  => '',
	'icon'  => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link = vc_build_link( $link );

?>

<div class="info_box<?php echo esc_attr( $css_class ); ?>">
<?php if( $image && $thumbnail = wp_get_attachment_image( $image, 'thumb-355x216' ) ){ ?>
	<div class="info_box_image"><?php echo balanceTags( $thumbnail, true ); ?></div>
<?php } ?>
<?php if ( $title ) { ?>
	<h4><?php echo balanceTags( $title, true ); ?></h4>
<?php } ?>
<?php echo wpb_js_remove_wpautop( $content, true ); ?>
<?php
	if ( $link['url'] ) {
		if ( ! $link['title'] ) {
			$link['title'] = __( 'Read More', 'bestbuild' );
		}
		if ( ! $link['target'] ) {
			$link['target'] = '_self';
		}
		if( $icon ){
			$link['title'] = '<i class="' . $icon . ' stm_icon"></i><span>' . $link['title'] . '</span>';
		}
		echo ' <a class="read_more" target="' . $link['target'] . '" href="' . $link['url'] . '">' . $link['title'] . '</a>';
	}
?>
</div>