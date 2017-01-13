<?php
extract( shortcode_atts( array(
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="stm_post_info<?php echo esc_attr( $css_class ); ?>">
	<h1 class="h3"><?php the_title(); ?></h1>
	<div class="stm_post_details clearfix">
		<ul class="clearfix">
			<li class="post_date"><span><?php echo get_the_date(); ?></span></li>
			<li class="post_by"><?php _e( 'Posted by:', 'bestbuild' ); ?> <span><?php the_author(); ?></span></li>
			<li class="post_cat"><?php _e( 'Category:', 'bestbuild' ); ?> <span><?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) )?></span></li>
		</ul>
		<div class="comments_num">
			<a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <?php comments_number(); ?> </a>
		</div>
	</div>
	<?php if( has_post_thumbnail() ){ ?>
		<div class="post_thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>
</div>