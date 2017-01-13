<?php
extract( shortcode_atts( array(
	'title' => '',
	'logo' => 'thumbnail',
	'img_size' => '',
	'description' => '',
	'link' => '',
), $atts ) );

$logo = wpb_getImageBySize( array( 'attach_id' => $logo, 'thumb_size' => $img_size ) );
$link = vc_build_link( $link );
if ( $link['url'] ) {
	if ( ! $link['target'] ) {
		$link['target'] = '_self';
	}
}
?>
<li>
	<?php if( $logo['thumbnail'] ){ ?>
		<div class="logo">
			<?php
				if ( $link['url'] ) {
					echo  '<a target="' . $link['target'] . '" href="' . $link['url'] . '">';
				}
				echo balanceTags( $logo['thumbnail'], true );
				if ( $link['url'] ) {
					echo '</a>';
				}
			?>
		</div>
	<?php } ?>
	<div class="text">
		<?php if( $title ){ ?>
			<h5>
				<?php
					if ( $link['url'] ) {
						echo  '<a target="' . $link['target'] . '" href="' . $link['url'] . '">';
					}
					echo balanceTags( $title, true );
					if ( $link['url'] ) {
						echo '</a>';
					}
				?>
			</h5>
		<?php } ?>
		<?php echo wpb_js_remove_wpautop($description, true); ?>
	</div>
</li>