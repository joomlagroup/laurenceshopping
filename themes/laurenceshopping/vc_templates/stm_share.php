<?php
extract( shortcode_atts( array(
	'title' => '',
	'code' => '',
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if( ! $code ){
	return;
}
?>
<div class="stm_share<?php echo esc_attr( $css_class ); ?>">
	<?php if( $title ){ ?>
		<label><?php echo balanceTags( $title, true ); ?></label>
	<?php } ?>
	<?php echo rawurldecode( base64_decode( strip_tags( $code ) ) ); ?>
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</div>