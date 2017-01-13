<?php stm_get_header(); ?>
	<div class="page_404">
		<strong>404</strong>
		<h2><?php _e( 'The page you are looking for does not exist.', 'bestbuild' ); ?></h2>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php _e( 'GO BACK TO HOMEPAGE', 'bestbuild' ); ?></a>
	</div>
<?php get_footer(); ?>