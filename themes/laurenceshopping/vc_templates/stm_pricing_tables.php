<?php
extract( shortcode_atts( array(
	'title' => '',
	'price_prefix' => '',
	'price' => '',
	'price_separator' => '',
	'price_postfix' => '',
	'button' => '',
	'label_state' => '',
	'label_text' => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$button = vc_build_link( $button );
$stm_classes = '';

if($label_state == 'enable' && $label_text != '' ) {
	$stm_classes = ' has-label';
}
?>

<div class="stm_pricing-table<?php echo esc_attr( $stm_classes ); ?>">
	<div class="pricing-table_inner">
		<div class="pricing-table_head">
			<?php if ( $title ) { ?>
				<h5><?php echo balanceTags( $title, true ); ?></h5>
			<?php } ?>
				<div class="pricing_price_wrap">
					<?php echo ( ( $price_prefix != '' ) ? '<span class="pricing_price_prefix">' . balanceTags( $price_prefix, true ) . '</span>' : '' ); ?>
					<?php echo ( ( $price != '' ) ? '<span class="pricing_price">' . balanceTags( $price, true ) . '</span>' : '' ); ?>
					<?php echo ( ( $price_separator != '' ) ? '<span class="pricing_price_separator">' . balanceTags( $price_separator, true ) . '</span>' : '' ); ?>
					<?php echo ( ( $price_postfix != '' ) ? '<span class="pricing_price_postfix">' . balanceTags( $price_postfix, true ) . '</span>' : '' ); ?>
				</div>
		</div>
		<div class="pricing-table_content">
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
		<div class="pricing-table_footer">
			<?php if( $button['url'] != '' ) { ?>
			<a href="<?php echo esc_url( $button['url'] ); ?>" class="button" target="<?php echo ( ( $button['target'] == '' ) ? '_self' : $button['target'] ); ?>"><?php echo balanceTags( $button['title'] ); ?></a>
			<?php } ?>
		</div>
		<?php if( $stm_classes != '' ) { ?>
			<span class="pricing-table_label"><?php echo balanceTags( $label_text ); ?></span>
		<?php } ?>
	</div>
</div>