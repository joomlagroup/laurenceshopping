<?php stm_get_header(); ?>
	<?php
		$blog_class = 'posts_grid';
		if( stm_option( 'blog_layout', 'grid' ) == 'list' ){
			$blog_class = 'posts_list';
		}
		if( !empty( $_GET['layout'] ) && $_GET['layout'] == 'list' ){
			$blog_class = 'posts_list';
		}

		$blog_sidebar_id = stm_option( 'blog_sidebar' );
		$blog_sidebar_position = stm_option( 'blog_sidebar_position', 'none');
		$content_before = $content_after =  $sidebar_before = $sidebar_after = '';

		if( !empty( $_GET['sidebar_id'] ) ){
			$blog_sidebar_id = intval( $_GET['sidebar_id'] );
		}

		if( $blog_sidebar_id ) {
			$blog_sidebar = get_post( $blog_sidebar_id );
		}

		if( $blog_sidebar_position == 'right' && isset( $blog_sidebar ) ) {
			$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
			$content_before .= '<div class="col_in __padd-right __three-cols">';

			$content_after .= '</div>'; // col_in
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
			// .sidebar-area
			$sidebar_after .= '</div>'; // col
			$sidebar_after .= '</div>'; // row
		}

		if( $blog_sidebar_position == 'left' && isset( $blog_sidebar ) ) {
			$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
			$content_before .= '<div class="col_in __padd-left __three-cols">';

			$content_after .= '</div>'; // col_in
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
			// .sidebar-area
			$sidebar_after .= '</div>'; // col
			$sidebar_after .= '</div>'; // row
		}

	?>
	<div class="content-area">
		<?php get_template_part( 'partials/title_box' ); ?>
		<?php echo $content_before; ?>
			<?php if( have_posts() ){ ?>
				<div class="<?php echo esc_attr( $blog_class ); ?>">
					<ul>
						<?php
							while ( have_posts() ) { the_post();
								if( $blog_class == 'posts_list' ){
									get_template_part( 'partials/content', 'loop_list' );
								}else{
									get_template_part( 'partials/content', 'loop_grid' );
								}
							}
						?>
					</ul>
				</div>
				<?php
				echo paginate_links( array(
					'type'      => 'list',
					'prev_text' => '<i class="fa fa-arrow-left"></i>',
					'next_text' => '<i class="fa fa-arrow-right"></i>',
				) );
				?>
			<?php }else{ ?>
				<p><?php _e( 'No result has been found. Please check for correctness.', 'bestbuild' ); ?></p>
			<?php } ?>
		<?php echo $content_after; ?>
		<?php echo $sidebar_before; ?>
			<div class="sidebar-area">
				<?php
					if( isset( $blog_sidebar ) && $blog_sidebar_position != 'none' ) {
						echo apply_filters( 'the_content' , $blog_sidebar->post_content);
					}
				?>
			</div>
		<?php echo $sidebar_after; ?>
	</div>

<?php get_footer(); ?>