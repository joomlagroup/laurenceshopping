<?php
extract( shortcode_atts( array(
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
wp_enqueue_script( 'jquery.tablesorter.min.js' );
$id = rand();
$vacancies = new WP_Query( array( 'post_type' => 'vacancy', 'posts_per_page' => -1 ) );
?>

<div class="vacancy_table_wr<?php echo esc_attr( $css_class ); ?>">
	<?php if( $vacancies->have_posts() ){ ?>
		<table class="vacancy_table" id="vacancy_table_<?php echo esc_attr( $id )?>" >
			<thead>
				<tr>
					<th><?php _e( 'Job Posting Title', 'bestbuild' ); ?></th>
					<th><?php _e( 'Location', 'bestbuild' ); ?></th>
					<th><?php _e( 'Department', 'bestbuild' ); ?></th>
					<th><?php _e( 'Date', 'bestbuild' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php while( $vacancies->have_posts() ){ $vacancies->the_post(); ?>
					<tr>
						<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
						<td><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_location', true ), true ); ?></td>
						<td><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_department', true ), true ); ?></td>
						<td><?php echo balanceTags( get_the_date(), true ); ?></td>
					</tr>
				<?php } wp_reset_query(); ?>
			</tbody>
		</table>
	<?php } ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("#vacancy_table_<?php echo esc_attr( $id )?>").tablesorter({
				sortList: [[0,0]]
			});
		});
	</script>
</div>