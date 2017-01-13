<?php
extract( shortcode_atts( array(
	'year' => '',
	'title' => '',
	'description' => '',
), $atts ) );
?>
<li>
	<div class="company_history_header">
		<div class="year"><?php echo balanceTags( $year, true ); ?></div>
		<h4><?php echo balanceTags( $title, true ); ?></h4>
	</div>
	<?php echo wpb_js_remove_wpautop($description, true); ?>
</li>