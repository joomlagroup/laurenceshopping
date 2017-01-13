<?php
extract( shortcode_atts( array(
	'title' => __( 'Services', 'bestbuild' ),
	'address' => '',
	'phone' => '',
	'fax' => '',
	'email' => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$type = 'Stm_Contacts_Widget';
$args = array(
	'before_widget' => '<aside class="widget widget_contacts wpb_content_element vc_widgets' . $css_class . '">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget_title"><h5>',
	'after_title'   => '</h5></div>'
);
?>

<?php the_widget( $type, $atts, $args ); ?>