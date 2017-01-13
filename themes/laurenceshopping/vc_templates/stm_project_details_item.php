<?php
extract( shortcode_atts( array(
	'label' => '',
	'value' => '',
), $atts ) );
?>
<tr>
	<td><?php echo balanceTags( $label, true ); ?></td>
	<th><?php echo balanceTags( $value, true ); ?></th>
</tr>