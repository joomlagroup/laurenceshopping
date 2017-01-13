<?php
extract( shortcode_atts( array(
	'css'         => '',
	'count'       => 1,
	'category'    => 'all'
), $atts ) );

wp_enqueue_script( 'slick.min.js' );
wp_enqueue_style( 'slick.css' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$args = array( 
	'post_type' => 'testimonial',
	'posts_per_page' => $count
);
if( $category != 'all' ){
	$args['testimonial_category'] = $category;
}
$testimonials = new WP_Query( $args );
?>

<?php
	if( $testimonials->have_posts() ){
		$id = time();?>
			<div id="testimonials_carousel-<?php echo esc_attr($id) ?>" class="testimonials_module testimonials_carousel">
			<?php while( $testimonials->have_posts() ) {
				$testimonials->the_post();?>
				<div class="testimonials_module<?php echo esc_attr( $css_class ); ?>">
					<div class="testimonial"><?php the_excerpt(); ?></div>
					<div class="testimonial-info clearfix">
						<div class="testimonial-image"><?php echo get_the_post_thumbnail( get_the_ID(), 'thumb-86x86' ); ?></div>
						<div class="testimonial-text">
							<div class="name"><?php the_title(); ?></div>
							<div class="company"><?php echo get_post_meta( get_the_ID(), 'testimonial_profession', true ); ?>, <?php echo get_post_meta( get_the_ID(), 'testimonial_company', true ); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				"use strict";
				var slick_<?php echo esc_attr( $id ) ?> = $("#testimonials_carousel-<?php echo esc_attr( $id ) ?>");
				slick_<?php echo esc_attr( $id ) ?>.slick({
					dots: true,
					infinite: true,
					arrows: false,
					autoplaySpeed: 5000,
					autoplay: true,
					slidesToShow: 1,
					cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)"
				});
			});
		</script>
		<?php wp_reset_query(); ?>
<?php } ?>