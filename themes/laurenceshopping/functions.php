<?php

$inc_path     = get_template_directory() . '/inc';
if ( ! isset( $content_width ) ) $content_width = 1120;

add_action( 'after_setup_theme', 'stm_theme_setup' );

if ( ! function_exists( 'stm_theme_setup' ) ) {

	function stm_theme_setup() {

		load_theme_textdomain( 'bestbuild', get_template_directory() . '/languages' );

		add_image_size( 'projects_gallery', 360, 240, true );
		add_image_size( 'projects_gallery_2', 383, 242, true );
		add_image_size( 'thumb-355x216', 355, 216, true );
		add_image_size( 'thumb-86x86', 86, 86, true );
		add_image_size( 'thumb-180x96', 180, 96, true );
		add_image_size( 'thumb-335x170', 335, 170, true );
		add_image_size( 'thumb-795x440', 795, 440, true );
		add_image_size( 'thumb-176x104', 176, 104, true );
		add_image_size( 'thumb-540x320', 540, 320, true );
		add_image_size( 'thumb-795x340', 795, 340, true );
		add_image_size( 'thumb-640x445', 640, 445, true );
		add_image_size( 'thumb-247x185', 247, 185, true );
		add_image_size( 'thumb-280x280', 280, 280, true );
		add_image_size( 'thumb-124x108', 124, 108, true );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		add_theme_support( 'woocommerce' );

		register_nav_menus(
			array(
				'primary_menu'   => __( 'Top Menu', 'bestbuild' )
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Default Sidebar', 'bestbuild' ),
				'id'            => 'default',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s default_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Header Widget 1', 'bestbuild' ),
				'id'            => 'header-widget-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Header Widget 2', 'bestbuild' ),
				'id'            => 'header-widget-2',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Header Widget 3', 'bestbuild' ),
				'id'            => 'header-widget-3',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);		
		register_sidebar(
			array(
				'name'          => __( 'Footer', 'bestbuild' ),
				'id'            => 'footer',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Shop Sidebar', 'bestbuild' ),
				'id'            => 'shop',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s shop_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

	}

}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function stm_slug_render_title() {
		return '<title>' . wp_title( '|', false, 'right' ) . '</title>';
	}
	add_action( 'wp_head', 'stm_slug_render_title' );
}

if( ! get_option( 'layerslider-authorized-site', null ) ) {
	update_option( 'layerslider-authorized-site', true );
}

add_action('layerslider_ready', 'my_layerslider_overrides');

function my_layerslider_overrides() {
	$GLOBALS['lsAutoUpdateBox'] = false;
}

function stm_excerpt_more( $more ) {
	return '';
}

add_filter( 'excerpt_more', 'stm_excerpt_more' );

add_action( 'wp_head', 'stm_ajaxurl' );

function stm_ajaxurl() {
	?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
	</script>
<?php
}

function stm_wp_head() {
	if ( $favicon = stm_option( 'favicon', false, 'url' ) ) {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $favicon ) . '" />' . "\n";
	} else {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.ico" />' . "\n";
	}
	if( stm_option( 'color_skin' ) == 'skin_custom_color' ){
		echo '
			<style type="text/css">
				body.skin_custom_color .project_grid_switcher:hover{
					color: ' . stm_option( 'primary_color' ) . ' !important;
				}
				body.skin_custom_color .slick_prev:hover,
				body.skin_custom_color .slick_next:hover,
				body.skin_custom_color .tp-leftarrow.default:hover,
				body.skin_custom_color .tp-rightarrow.default:hover,
				body.skin_custom_color .ls-construct .ls-nav-prev:hover,
				body.skin_custom_color .ls-construct .ls-nav-next:hover{
					border-color: ' . stm_option( 'primary_color' ) . ' !important;
				}
			</style>
		';
	}
}

add_action( 'wp_head', 'stm_wp_head' );

function stm_body_class( $classes ) {

	$classes[] = stm_option( 'color_skin' );
	$classes[] = stm_option( 'mobile_header_style' );
	$classes[] = get_header_style();
	if( stm_option( 'sticky_header' ) ){
		$classes[] = 'sticky_header';
	}
	if( stm_option( 'site_boxed' ) ){
		$classes[] = 'boxed_layout';
	}
	if( stm_option( 'boxed_background_image_type' ) && stm_option( 'site_boxed' ) ){
		$classes[] = stm_option( 'boxed_background_image_type' );
	}
	if( isset( $_GET['header_demo'] ) && $_GET['header_demo'] == 'white' ){
		$classes[] = 'mobile_header_style_white';
	}
	if( get_post_meta( get_the_ID(), 'header_transparent', true ) ){
		$classes[] = 'header_transparent';
	}
	return $classes;
}

add_filter( 'body_class', 'stm_body_class' );

function stm_custom_css() {
	$site_css = stm_option( 'site_css' );
	$output = "\n<style id=\"stm_custom_css\" type=\"text/css\">\n" . preg_replace( '/\s+/', ' ', $site_css ) . "\n</style>\n";
	if ( !empty( $site_css ) ) {
		echo $output;
	}
}

add_action( 'wp_head', 'stm_custom_css' );

require_once ( $inc_path . '/redux-framework/admin-init.php' );
require_once( $inc_path . '/extras.php' );
require_once( $inc_path . '/tgm/tgm-plugin-registration.php' );
require_once( $inc_path . '/visual_composer.php' );
require_once( $inc_path . '/enqueue-scripts-styles.php' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( $inc_path . '/woocommerce_configuration.php' );
}
require_once( $inc_path . '/widgets/contacts.php' );
require_once( $inc_path . '/widgets/instagram.php' );
require_once( $inc_path . '/widgets/services.php' );
require_once( $inc_path . '/widgets/pages.php' );



