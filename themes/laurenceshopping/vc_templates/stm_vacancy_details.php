<?php
extract( shortcode_atts( array(
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="stm_vacancy_details<?php echo esc_attr( $css_class ); ?>">
	<dl>
		<dt><?php _e( 'Departament:', 'bestbuild' ); ?></dt>
		<dd><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_department', true ), true ); ?></dd>
	</dl>
	<dl>
		<dt><?php _e( 'Project Location(s):', 'bestbuild' ); ?></dt>
		<dd><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_location', true ), true ); ?></dd>
	</dl>
	<dl>
		<dt><?php _e( 'Job Type:', 'bestbuild' ); ?></dt>
		<dd><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_job_type', true ), true ); ?></dd>
	</dl>
	<dl>
		<dt><?php _e( 'Education:', 'bestbuild' ); ?></dt>
		<dd><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_education', true ), true ); ?></dd>
	</dl>
	<dl>
		<dt><?php _e( 'Compensation:', 'bestbuild' ); ?></dt>
		<dd><?php echo balanceTags( get_post_meta( get_the_ID(), 'vacancy_compensation', true ), true ); ?></dd>
	</dl>
</div>