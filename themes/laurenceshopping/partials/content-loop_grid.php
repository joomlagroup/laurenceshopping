<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ){ ?>
		<div class="post_thumbnail"><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'thumb-335x170' ); ?></a></div>
	<?php } ?>
	<h2 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="post_info">
		<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'View More', 'bestbuild' ); ?></a>
		<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></div>
	</div>
</li>