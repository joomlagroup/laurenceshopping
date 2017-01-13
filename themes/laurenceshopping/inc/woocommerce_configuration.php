<?php

if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);