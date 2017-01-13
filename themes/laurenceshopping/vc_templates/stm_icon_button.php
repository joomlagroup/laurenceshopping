<?php
extract( shortcode_atts( array(
	'icon'  => '',
	'sub_text'  => '',
	'icon_size'  => '19',
	'icon_height'  => '29',
	'link'  => '',
	'class'  => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link = vc_build_link( $link );

?>

<div class="icon_button<?php echo esc_attr( $css_class . ' ' . $class, true ); ?>">
<?php
	if ( $link['url'] ) {
		if ( ! $link['target'] ) {
			$link['target'] = '_self';
		}
		echo '<a target="' . $link['target'] . '" href="' . $link['url'] . '">';
		echo '<i style="font-size: ' . $icon_size . 'px; line-height: ' . $icon_height . 'px; height: ' . $icon_height . 'px;" class="' . $icon . '"></i>';
		echo '<span>';
		echo balanceTags( $link['title'], true );
		if( $sub_text ){
			echo '<br/><em>' . $sub_text . '</em>';
		}
		echo '</span>';
		echo '</a>';
	}
?>
</div>