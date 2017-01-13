<?php
extract( shortcode_atts( array(
	'title' => '',
	'icon'  => '',
	'icon_size'  => '65',
	'icon_height'  => '65',
	'icon_width'  => '50',
	'style'  => 'icon_top',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<?php if( $style == 'icon_left' ){ ?>
	<div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
		<?php if( $icon ){ ?>
			<div class="icon" style="width: <?php echo esc_attr( $icon_width ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="<?php echo esc_attr( $icon ); ?>"></i></div>
		<?php } ?>
		<div class="icon_text">
			<?php if ( $title ) { ?>
				<h5><?php echo balanceTags( $title, true ); ?></h5>
			<?php } ?>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
	</div>
<?php }else{ ?>
	<div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
		<?php if( $icon ){ ?>
			<div class="icon" style="height: <?php echo esc_attr( $icon_height ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="<?php echo esc_attr( $icon ); ?>"></i></div>
		<?php } ?>
		<div class="icon_text">
			<?php if ( $title ) { ?>
				<h4><?php echo balanceTags( $title, true ); ?></h4>
			<?php } ?>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
	</div>
<?php } ?>