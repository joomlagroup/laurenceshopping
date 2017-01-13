<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = $link = '';
extract( $this->getAttributes( $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
extract( shortcode_atts( array(
	'link'  => ''
), $atts ) );
$link = vc_build_link( $link );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
$output .= '<div class="' . esc_attr( $css_class ) . '" >';
$style = '';
if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}
$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
if ( $link['url'] ) {
	if ( ! $link['target'] ) {
		$link['target'] = '_self';
	}
	$output .= '<a target="' . $link['target'] . '" href="' . $link['url'] . '">';
	$output .= $text;
	$output .= '</a>';
}else{
	$output .= $text;
}
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';

echo balanceTags( $output, true );