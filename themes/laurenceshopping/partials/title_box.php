<?php

global $woocommerce;

$post_id = get_the_ID();

$is_shop = false;
$is_product = false;
$is_product_category = false;

if( function_exists( 'is_shop' ) && is_shop() ){
	$is_shop = true;
}

if( function_exists( 'is_product_category' ) && is_product_category() ){
	$is_product_category = true;
}

if( function_exists( 'is_product' ) && is_product() ){
	$is_product = true;
}

if( is_home() || is_category() || is_search() ){
    $post_id = get_option( 'page_for_posts' );
}

if( $is_shop ) {
	$post_id = get_option( 'woocommerce_shop_page_id' );
}

$title = '';
$tag = 'h1';

if( is_home() ){
    if( ! get_option( 'page_for_posts' ) ){
        $title = __( 'News & Events', 'bestbuild' );
    }else{
        $title = get_the_title( $post_id );
    }
}elseif( $is_product ){
	$title = get_the_title( $post_id );
}elseif( $is_product_category ){
	$title = single_cat_title( '', false );
}elseif( is_category() ){
    $title = single_cat_title( '', false );
}elseif( is_tag() ) {
	$title = single_tag_title( '', false );
}elseif( is_search() ) {
	$title = __( 'Search', 'bestbuild' );
}elseif ( is_day() ) {
	$title = get_the_time('d');
} elseif ( is_month() ) {
	$title = get_the_time('F');
} elseif ( is_year() ) {
	$title = get_the_time('Y');
}elseif( is_single() && is_singular('post') ){
	if( ! get_option( 'page_for_posts' ) ){
		$title = __( 'News & Events', 'bestbuild' );
	}else{
		$title = get_the_title( get_option( 'page_for_posts' ) );
	}
	$tag = 'div';
}else{
    $title = get_the_title( $post_id );
}

if ( get_post_meta( $post_id, 'title', true ) != 'hide' ) {

    $title_style                         = array();
    $title_style_h1                      = array();
    $title_style_subtitle                = array();
    $title_box_bg_color                  = get_post_meta( $post_id, 'title_box_bg_color', true );
    $title_box_font_color                = get_post_meta( $post_id, 'title_box_font_color', true );
    $title_box_line_color                = get_post_meta( $post_id, 'title_box_line_color', true );
    $title_box_custom_bg_image           = get_post_meta( $post_id, 'title_box_custom_bg_image', true );
    $title_box_bg_position               = get_post_meta( $post_id, 'title_box_bg_position', true );
    $title_box_bg_repeat                 = get_post_meta( $post_id, 'title_box_bg_repeat', true );
    $title_box_overlay                   = get_post_meta( $post_id, 'title_box_overlay', true );
    $title_box_small                     = get_post_meta( $post_id, 'title_box_small', true );
    $sub_title                           = get_post_meta( $post_id, 'sub_title', true );
    $breadcrumbs                         = get_post_meta( $post_id, 'breadcrumbs', true );
    $breadcrumbs_font_color              = get_post_meta( $post_id, 'breadcrumbs_font_color', true );
    $title_box_button_url                = get_post_meta( $post_id, 'title_box_button_url', true );
    $title_box_button_text               = get_post_meta( $post_id, 'title_box_button_text', true );
    $title_box_button_border_color       = get_post_meta( $post_id, 'title_box_button_border_color', true );
    $title_box_button_font_color         = get_post_meta( $post_id, 'title_box_button_font_color', true );
    $title_box_subtitle_font_color       = get_post_meta( $post_id, 'title_box_subtitle_font_color', true );
    $title_box_button_font_color_hover   = get_post_meta( $post_id, 'title_box_button_font_color_hover', true );
	$title_box_button_font_arrow_color   = get_post_meta( $post_id, 'title_box_button_font_arrow_color', true );
	$prev_next_buttons                   = get_post_meta( $post_id, 'prev_next_buttons', true );
	$prev_next_buttons_border_color      = get_post_meta( $post_id, 'prev_next_buttons_border_color', true );
	$prev_next_buttons_arrow_color_hover = get_post_meta( $post_id, 'prev_next_buttons_arrow_color_hover', true );

    if ( $title_box_bg_color ) {
        $title_style['bg_color'] = 'background-color: ' . $title_box_bg_color . ';';
    }

    if ( $title_box_font_color ) {
        $title_style_h1['font_color'] = 'color: ' . $title_box_font_color . ';';
    }

    if ( $title_box_subtitle_font_color ) {
	    $title_style_subtitle['font_color'] = 'color: ' . $title_box_subtitle_font_color . ';';
    }

    if ( $title_box_custom_bg_image = wp_get_attachment_image_src( $title_box_custom_bg_image, 'full' ) ) {

        $title_style['bg_image']   = 'background-image: url(' . $title_box_custom_bg_image[0] . ');';

        if ( $title_box_bg_position ) {
            $title_style['bg_position'] = 'background-position: ' . $title_box_bg_position . ';';
        }

        if ( $title_box_bg_repeat ) {
            $title_style['bg_repeat'] = 'background-repeat: ' . $title_box_bg_repeat . ';';
        }

    }
    ?>
    <div class="entry-header clearfix<?php if($title_box_small || $is_shop || $is_product){ echo ' small'; } ?>" <?php if( get_header_style() != 'header_style_transparent' ){ echo balanceTags( 'style="' . implode( ' ', $title_style ) . '"' ); }; ?>>
        <?php if( $title_box_overlay && get_header_style() != 'header_style_transparent' ){ echo '<div class="overlay"></div>'; } ?>
        <div class="entry-title-left">
            <div class="entry-title">
				<<?php echo $tag ?> class="h2" style="<?php echo implode( ' ', $title_style_h1 ); ?>"><?php echo balanceTags( $title, true ); ?></<?php echo $tag ?>>
                <?php if( $sub_title && ! is_search() ){ ?>
                    <div class="sub_title" style="<?php echo implode( ' ', $title_style_subtitle ); ?>"><?php echo balanceTags( $sub_title, true ); ?></div>
                <?php } ?>
                <?php
                    if( $breadcrumbs != 'hide' ){
                        if( $is_shop || $is_product ){
	                        woocommerce_breadcrumb( array(
		                        'delimiter'   => '<span class="separator">\</span>',
		                        'wrap_before' => '<div class="breadcrumbs">',
		                        'wrap_after'  => '</div>',
		                        'before'      => '',
		                        'after'       => '',
		                        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
	                        ) );
                        }else{
	                        if( is_single() && is_singular('post') ){
		                        stm_breadcrumbs( false );
	                        }else{
		                        stm_breadcrumbs();
	                        }
                        }
                    }
                ?>
            </div>
        </div>
        <div class="entry-title-right">
	        <?php if( $is_shop ) { ?>
		        <div class="entry-title-right">
			        <a class="button cart_link" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><?php _e( 'MY CART', 'bestbuild' ); ?></span> <i class="fa fa-shopping-cart"></i></a>
		        </div>
	        <?php } ?>
	        <?php if( $title_box_button_url ){ ?>
                <a href="<?php echo esc_url( $title_box_button_url ); ?>" class="button"><span><?php echo balanceTags( $title_box_button_text, true ); ?></span> <i class="fa fa-chevron-right"></i></a>
		    <?php } ?>
			<?php if( $prev_next_buttons ){ ?>
		        <div class="prev_next_post">
			        <?php
			            $taxonomy = 'category';
			            if( get_post_type() == 'directory' ){
				            $taxonomy = 'project_category';
			            }
				        previous_post_link('%link', '<i class="fa fa-chevron-left"></i>', true, '', $taxonomy );
				        next_post_link('%link', '<i class="fa fa-chevron-right"></i>', true, '', $taxonomy );
			        ?>
		        </div>
	        <?php } ?>
        </div>
        <?php if( $title_box_line_color || $breadcrumbs_font_color || $title_box_button_border_color || $title_box_button_font_color || $title_box_button_font_color_hover || $title_box_button_font_arrow_color || $prev_next_buttons_border_color || $prev_next_buttons_arrow_color_hover || $title_box_custom_bg_image ){ ?>
            <style type="text/css">
	            <?php if( $title_box_line_color ){ ?>
					.entry-header .entry-title .h2:before{
			            background: <?php echo esc_attr( $title_box_line_color ); ?>;
		            }
	            <?php } ?>
	            <?php if( $breadcrumbs_font_color ){ ?>
	                .breadcrumbs a, .breadcrumbs{
			            color: <?php echo esc_attr( $breadcrumbs_font_color ); ?>;
		            }
	            <?php } ?>
                <?php if( $title_box_button_border_color ){ ?>
	                .entry-header .entry-title-right .button{
		                border: 3px solid <?php echo esc_attr( $title_box_button_border_color ); ?>;
	                }
		            .entry-header .entry-title-right .button:hover,
		            .entry-header .entry-title-right .button:active,
		            .entry-header .entry-title-right .button:focus{
			            background: <?php echo esc_attr( $title_box_button_border_color ); ?>;
		            }
	            <?php } ?>
                <?php if( $title_box_button_font_color ){ ?>
	                .entry-header .entry-title-right .button{
		                color: <?php echo esc_attr( $title_box_button_font_color ); ?>;
	                }
	            <?php } ?>
	            <?php if( $title_box_button_font_color_hover ){ ?>
		            .entry-header .entry-title-right .button:hover,
		            .entry-header .entry-title-right .button:active,
		            .entry-header .entry-title-right .button:focus,
		            .entry-header .entry-title-right .button:hover .fa,
		            .entry-header .entry-title-right .button:active .fa,
		            .entry-header .entry-title-right .button:focus .fa
		            {
		                color: <?php echo esc_attr( $title_box_button_font_color_hover ); ?>;
	                }
	            <?php } ?>
	            <?php if( $title_box_button_font_arrow_color ){ ?>
                    .entry-header .entry-title-right .button .fa{
		                color: <?php echo esc_attr( $title_box_button_font_arrow_color ); ?>;
	                }
	            <?php } ?>
                <?php if( $prev_next_buttons_border_color ){ ?>
	                .prev_next_post a{
		                border-color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?> !important;
		                color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?>;
	                }
	                .prev_next_post a:hover{
		                background-color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?>;
	                }
	            <?php } ?>
                <?php if( $prev_next_buttons_arrow_color_hover ){ ?>
		            .prev_next_post a:hover{
			            color: <?php echo esc_attr( $prev_next_buttons_arrow_color_hover ); ?>;
		            }
	            <?php } ?>
				<?php if( get_header_style() == 'header_style_transparent' ){ ?>
					body.header_style_transparent #header{
						<?php echo implode( "\n", $title_style ); ?>
					}
					<?php if( $title_box_overlay ){ ?>
						body.header_style_transparent #header:before{
							content: '';
							position: absolute;
							left: 0;
							top: 0;
							width: 100%;
							height: 100%;
							background: rgba(51, 51, 51, 0.35);
						}
					<?php } ?>
				<?php } ?>
	        </style>
	    <?php } ?>
    </div>
<?php } ?>
<?php
$page_bg_image    = get_post_meta( $post_id, 'page_bg_image', true );
$page_bg_position = get_post_meta( $post_id, 'page_bg_position', true );
$page_bg_repeat   = get_post_meta( $post_id, 'page_bg_repeat', true );
$page_bg_style    = array();

if ( $page_bg_image = wp_get_attachment_image_src( $page_bg_image, 'full' ) ) {
	$page_bg_style['bg_image'] = 'background-image: url(' . $page_bg_image[0] . ') !important;';

	if ( $page_bg_position ) {
		$page_bg_style['bg_position'] = 'background-position: ' . $page_bg_position . ' !important;';
	}

	if ( $page_bg_repeat ) {
		$page_bg_style['bg_repeat'] = 'background-repeat: ' . $page_bg_repeat . ' !important;';
	}
}

?>
<?php if( $page_bg_style ){ ?>
	<style type="text/css">
		#main{
		<?php echo implode( "\n", $page_bg_style ); ?>
		}
	</style>
<?php } ?>