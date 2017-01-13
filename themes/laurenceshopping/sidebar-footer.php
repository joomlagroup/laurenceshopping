<?php if ( is_active_sidebar( 'footer' ) && stm_option( 'footer_widgets', true ) ) { ?>

	<?php 
		$widget_areas = stm_option( 'footer_columns', 4 );
		if( ! $widget_areas ){
			$widget_areas = 4;
		}
	?>

	<div class="footer_widgets_wrapper">
		<div class="container">
			<div class="widgets <?php echo 'cols_' . esc_attr( $widget_areas ); ?> clearfix">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>
	</div>

<?php } ?>