<?php stm_get_header(); ?>

	<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'partials/content' );

		}
	?>

<?php get_footer(); ?>
