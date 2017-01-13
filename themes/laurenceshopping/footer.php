</div> <!--.container-->
</div> <!--#main-->
</div> <!--.content_wrapper-->
<?php if( ! is_404() ){ ?>
	<footer id="footer">
	    <?php get_sidebar( 'footer' ); ?>
	    <div class="footer_wrapper">
	        <div class="container">
	            <?php if ( $copyright = stm_option( 'copyright' ) ) { ?>
	                <div class="copyright">
	                    <?php echo balanceTags( $copyright ); ?>
	                </div>
	            <?php } ?>
	        </div>
	    </div>
	</footer>
<?php } ?>
<?php
	global $wp_customize;
	if( is_stm() && ! $wp_customize ){
		get_template_part( 'partials/frontend_customizer' );
	}
?>
</div> <!--#wrapper-->
<?php wp_footer(); ?>
</body>
</html>