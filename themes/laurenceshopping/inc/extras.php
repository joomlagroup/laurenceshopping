<?php

if( ! function_exists( 'stm_breadcrumbs' ) ){
	function stm_breadcrumbs( $showCurrent = true ) {

		$showOnHome = 0;
		$delimiter = '<span class="separator">/</span>';
		$home = __( 'Home', 'bestbuild' );
		$before = '<span class="current">';
		$after = '</span>';

		global $post;
		$homeLink = home_url();

		if ( is_home() || is_front_page() ) {

			if ( $showOnHome == 1 ) {
				echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
			}

		} else {
			echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					echo get_category_parents( $thisCat->parent, true, ' ' . $delimiter . ' ' );
				}
				echo balanceTags( $before . sprintf( __( 'Archive by category "%s"', 'bestbuild' ), single_cat_title( '', false ) ) . $after, true );
			} elseif ( is_search() ) {
				echo balanceTags( $before . sprintf( __( 'Search results for "%s"', 'bestbuild' ), get_search_query() ) . $after, true );
			} elseif ( is_day() ) {
				echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
				echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
				echo balanceTags( $before . get_the_time( 'd' ) . $after, true );
			} elseif ( is_month() ) {
				echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
				echo balanceTags( $before . get_the_time( 'F' ) . $after, true );

			} elseif ( is_year() ) {
				echo balanceTags( $before . get_the_time( 'Y' ) . $after, true );

			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					if( get_post_type() == 'project' && stm_option( 'projects_page' ) ){
						echo '<a href="' . get_the_permalink( stm_option( 'projects_page' ) ) . '">' . get_the_title( stm_option( 'projects_page' ) ) . '</a>';
						if ( $showCurrent == 1 ) {
							echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}elseif( get_post_type() == 'service' && stm_option( 'services_page' ) ) {
						echo '<a href="' . get_the_permalink( stm_option( 'services_page' ) ) . '">' . get_the_title( stm_option( 'services_page' ) ) . '</a>';
						if ( $showCurrent == 1 ) {
							echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}elseif( get_post_type() == 'vacancy' && stm_option( 'vacancies_page' ) ) {
						echo '<a href="' . get_the_permalink( stm_option( 'vacancies_page' ) ) . '">' . get_the_title( stm_option( 'vacancies_page' ) ) . '</a>';
						if ( $showCurrent == 1 ) {
							echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}else{
						$post_type = get_post_type_object( get_post_type() );
						$slug      = $post_type->rewrite;
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						if ( $showCurrent == 1 ) {
							echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					}
				} else {
					$cat  = get_the_category();
					$cat  = $cat[0];
					$cats = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					if ( $showCurrent == 0 ) {
						$cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
					}
					echo balanceTags( $cats, true );
					if ( $showCurrent == 1 ) {
						echo balanceTags( $before . get_the_title() . $after, true );
					}
				}

			} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo balanceTags( $before . $post_type->labels->singular_name . $after, true );

			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );
				$cat    = $cat[0];
				echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
				echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
				if ( $showCurrent == 1 ) {
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}

			} elseif ( is_page() && ! $post->post_parent ) {
				if ( $showCurrent == 1 ) {
					echo balanceTags( $before . get_the_title() . $after, true );
				}

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page          = get_page( $parent_id );
					$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
					echo balanceTags( $breadcrumbs[ $i ], true );
					if ( $i != count( $breadcrumbs ) - 1 ) {
						echo ' ' . $delimiter . ' ';
					}
				}
				if ( $showCurrent == 1 ) {
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {
				echo balanceTags( $before . sprintf( __( 'Posts tagged "%s"', 'bestbuild' ), single_tag_title( '', false ) ) . $after, true );

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo balanceTags( $before . sprintf( __( 'Articles posted by %s', 'bestbuild' ), $userdata->display_name ) . $after, true );

			} elseif ( is_404() ) {
				echo balanceTags( $before . __( 'Error 404', 'bestbuild' ) . $after, true );
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}
				echo __( 'Page', 'bestbuild' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}

			echo '</div>';

		}
	}
}

add_filter( 'upload_mimes', 'stm_custom_mime' );

function stm_custom_mime( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['ico'] = 'image/icon';

	return $mimes;
}

if( class_exists( 'LS_Sources' ) ){
    LS_Sources::addSkins( get_template_directory().'/inc/ls-skins' );
}

if( ! function_exists( 'stm_comment' ) ){
	function stm_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php } ?>
		<?php if ( $args['avatar_size'] != 0 ) { ?>
			<div class="vcard">
				<?php echo get_avatar( $comment, 174 ); ?>
			</div>
		<?php } ?>
		<div class="comment-info clearfix">
			<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'bestbuild' ), get_comment_date(),  get_comment_time() ); ?>
				</a>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i> Reply', 'bestbuild' ), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __( 'Edit', 'bestbuild' ), '  ', '' ); ?>
			</div>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bestbuild' ); ?></em>
			<?php } ?>
		</div>

		<?php if ( 'div' != $args['style'] ) { ?>
			</div>
		<?php } ?>
	<?php
	}
}

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );

if( ! function_exists( 'bootstrap3_comment_form_fields' ) ){
	function bootstrap3_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$fields    = array(
			'author' => '<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="input-group comment-form-author">
		            			<input placeholder="' . __( 'Name', 'bestbuild' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
	                        </div>
	                    </div>',
			'email'  => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="input-group comment-form-email">
							<input placeholder="' . __( 'E-mail', 'bestbuild' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
						</div>
					</div>',
			'url'    => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="input-group comment-form-url">
							<input placeholder="' . __( 'Website', 'bestbuild' ) . '" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
						</div>
					</div></div>'
		);

		return $fields;
	}
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

if( ! function_exists( 'bootstrap3_comment_form' ) ){
	function bootstrap3_comment_form( $args ) {
		$args['comment_field'] = '<div class="input-group comment-form-comment">
						        <textarea placeholder="' . _x( 'Message', 'noun', 'bestbuild' ) . ' *" class="form-control" name="comment" rows="9" aria-required="true"></textarea>
							  </div>';

		return $args;
	}
}

if( ! function_exists( 'stm_wpml_lang_switcher' ) ){
	function stm_wpml_lang_switcher() {
		if( function_exists( 'icl_get_languages' ) ){
			$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
			$output = '';
			if ( ! empty( $languages ) ) {
				$output .= '<div id="stm_wpml_lang_switcher">';
				$output .= '<div class="active_language">' . ICL_LANGUAGE_NAME_EN . ' <i class="fa fa-angle-down"></i></div>';
				$output .= '<ul>';
				foreach ( $languages as $l ) {
					if ( ! $l['active'] ) {
						$output .= '<li>';
						$output .= '<a href="' . $l['url'] . '">';
						$output .= icl_disp_language( $l['native_name'] );
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= '</ul>';
				$output .= '</div>';
				echo balanceTags( $output, true );
			}
		}
	}
}



if ( ! function_exists( 'get_header_style' ) ) {
	function get_header_style(){
		$header_style = stm_option( 'header_style' );
		if( isset( $_REQUEST[ 'header_demo' ] ) && $_REQUEST[ 'header_demo' ] == 'transparent' || (get_post_meta( get_the_ID(), 'header_transparent', true )) ){
			$header_style = 'header_style_transparent';
		}elseif( isset( $_REQUEST[ 'header_demo' ] ) && $_REQUEST[ 'header_demo' ] == 'dark' ){
			$header_style = 'header_style_dark';
		}elseif( isset( $_REQUEST[ 'header_demo' ] ) && $_REQUEST[ 'header_demo' ] == 'white' ){
			$header_style = 'header_style_white';
		}
		return $header_style;
	}
}

function stm_get_header() {
    $header = '';
	return get_header( $header );
}

function is_top_bar() {
	$top_bar = stm_option( 'top_bar' );
	if( isset( $_REQUEST[ 'top_bar' ] ) && $_REQUEST[ 'top_bar' ] == 'show' ){
		$top_bar = true;
	}
	return $top_bar;
}

function is_stm(){
	$host = $_SERVER['HTTP_HOST'];
	if( $host == "www.construct.stm" || $host == "construct.stm" || $host == "www.bestbuild.stylemixthemes.com" || $host == "bestbuild.stylemixthemes.com" ) {
		return true;
	}else{
		return false;
	}
}

if ( ! function_exists( 'stm_updater' ) ) {
	function stm_updater() {
		global $stm_option;
		if( isset( $stm_option['envato_username'] ) && isset( $stm_option['envato_api'] ) ){
			$envato_username = trim( $stm_option['envato_username'] );
			$envato_api_key  = trim( $stm_option['envato_api'] );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );
	
				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'stm_updater' );
}

if ( !function_exists( 'stm_after_content_import' ) ) {

	function stm_after_content_import( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if(!empty($menus))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && $menu->name == 'Main Menu')
				{
					$locations['primary_menu'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Home' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		$blog_page = get_page_by_title( 'Company News' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'demo' => 'rev_slider_full_screen_slider.zip'
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		include LS_ROOT_PATH.'/classes/class.ls.importutil.php';
		new LS_ImportUtil( $demo_directory_path. '/layer_slider-main.zip' );
		new LS_ImportUtil( $demo_directory_path. '/layer_slider-about_us.zip' );
		new LS_ImportUtil( $demo_directory_path . '/layer_slider-secondary.zip' );

	}

	add_action( 'wbc_importer_after_content_import', 'stm_after_content_import', 10, 2 );
}

function add_metaboxes(){
	STM_PostType::addMetaBox( 'page_options', __( 'Page Options', 'bestbuild' ), array( 'page', 'post', 'service', 'project', 'product', 'vacancy' ), '', '', '', array(
		'fields' => array(
			'separator_page_header' => array(
				'label'   => __( 'Page Header', 'bestbuild' ),
				'type'    => 'separator'
			),
			'header_transparent' => array(
				'label'   => __( 'Transparent Header', 'bestbuild' ),
				'type'    => 'checkbox'
			),
			'separator_page_background' => array(
				'label'   => __( 'Page Background', 'bestbuild' ),
				'type'    => 'separator'
			),
			'page_bg_image' => array(
				'label' => __( 'Background Image', 'bestbuild' ),
				'type'  => 'image',
				'default' => stm_option( 'page_background_bg_image', false, 'id' )
			),
			'page_bg_position' => array(
				'label'   => __( 'Background Position', 'bestbuild' ),
				'type'    => 'text',
				'default' => stm_option( 'page_background_bg_position' )
			),
			'page_bg_repeat' => array(
				'label'   => __( 'Background Repeat', 'bestbuild' ),
				'type'    => 'select',
				'options' => array(
					'repeat' => __( 'Repeat', 'bestbuild' ),
					'no-repeat' => __( 'No Repeat', 'bestbuild' ),
					'repeat-x' => __( 'Repeat-X', 'bestbuild' ),
					'repeat-y' => __( 'Repeat-Y', 'bestbuild' )
				),
				'default' => stm_option( 'page_background_bg_repeat' )
			),
			'separator_title_box' => array(
				'label'   => __( 'Title Box', 'bestbuild' ),
				'type'    => 'separator'
			),
			'title' => array(
				'label'   => __( 'Title', 'bestbuild' ),
				'type'    => 'select',
				'options' => array(
					'show' => __( 'Show', 'bestbuild' ),
					'hide' => __( 'Hide', 'bestbuild' )
				),
				'default' => stm_option( 'page_title_box_title', 'show' )
			),
			'sub_title' => array(
				'label'   => __( 'Sub Title', 'bestbuild' ),
				'type'    => 'text',
				'default' => stm_option( 'page_title_box_sub_title' )
			),
			'title_box_bg_color' => array(
				'label' => __( 'Background Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_bg_color' )
			),
			'title_box_font_color' => array(
				'label' => __( 'Font Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_font_color' )
			),
			'title_box_line_color' => array(
				'label' => __( 'Line Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_line_color' )
			),
			'title_box_subtitle_font_color' => array(
				'label' => __( 'Sub Title Font Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_sub_title_line_color' )
			),
			'title_box_custom_bg_image' => array(
				'label' => __( 'Custom Background Image', 'bestbuild' ),
				'type'  => 'image',
				'default' => stm_option( 'page_title_box_bg_image', false, 'id' )
			),
			'title_box_bg_position' => array(
				'label'   => __( 'Background Position', 'bestbuild' ),
				'type'    => 'text',
				'default' => stm_option( 'page_title_box_bg_position' )
			),
			'title_box_bg_repeat' => array(
				'label'   => __( 'Background Repeat', 'bestbuild' ),
				'type'    => 'select',
				'options' => array(
					'repeat' => __( 'Repeat', 'bestbuild' ),
					'no-repeat' => __( 'No Repeat', 'bestbuild' ),
					'repeat-x' => __( 'Repeat-X', 'bestbuild' ),
					'repeat-y' => __( 'Repeat-Y', 'bestbuild' )
				),
				'default' => stm_option( 'page_title_box_bg_repeat' )
			),
			'title_box_overlay' => array(
				'label'   => __( 'Overlay', 'bestbuild' ),
				'type'    => 'checkbox',
				'default' => stm_option( 'page_title_box_overlay', false, 'yes' )
			),
			'title_box_small' => array(
				'label'   => __( 'Small', 'bestbuild' ),
				'type'    => 'checkbox',
				'default' => stm_option( 'page_title_box_small', false, 'yes' )
			),
			'separator_breadcrumbs' => array(
				'label'   => __( 'Breadcrumbs', 'bestbuild' ),
				'type'    => 'separator'
			),
			'breadcrumbs' => array(
				'label'   => __( 'Breadcrumbs', 'bestbuild' ),
				'type'    => 'select',
				'options' => array(
					'show' => __( 'Show', 'bestbuild' ),
					'hide' => __( 'Hide', 'bestbuild' )
				),
				'default' => stm_option( 'page_breadcrumbs_breadcrumbs' )
			),
			'breadcrumbs_font_color' => array(
				'label' => __( 'Breadcrumbs Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_breadcrumbs_color' )
			),
			'separator_title_box_button' => array(
				'label'   => __( 'Title Box Button', 'bestbuild' ),
				'type'    => 'separator'
			),
			'title_box_button_text' => array(
				'label'   => __( 'Button Text', 'bestbuild' ),
				'type'    => 'text',
				'default' => stm_option( 'title_box_button_text' )
			),
			'title_box_button_url' => array(
				'label'   => __( 'Button URL', 'bestbuild' ),
				'type'    => 'text',
				'default' => stm_option( 'title_box_button_url' )
			),
			'title_box_button_border_color' => array(
				'label' => __( 'Border Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_border_color' )
			),
			'title_box_button_font_color' => array(
				'label' => __( 'Font Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_font_color' )
			),
			'title_box_button_font_color_hover' => array(
				'label' => __( 'Font Color (hover)', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_font_color_hover' )
			),
			'title_box_button_font_arrow_color' => array(
				'label' => __( 'Arrow Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_arrow_color' )
			),
			'prev_next_buttons_title_box' => array(
				'label'   => __( 'Prev/Next Buttons', 'bestbuild' ),
				'type'    => 'separator'
			),
			'prev_next_buttons' => array(
				'label'   => __( 'Enable', 'bestbuild' ),
				'type'    => 'checkbox',
				'default' => stm_option( 'prev_next_buttons', false, 'enable' )
			),
			'prev_next_buttons_border_color' => array(
				'label' => __( 'Border Color', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'prev_next_buttons_border_color' )
			),
			'prev_next_buttons_arrow_color_hover' => array(
				'label' => __( 'Arrow Color (hover)', 'bestbuild' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'prev_next_buttons_border_color_hover' )
			)
		)
	) );

	STM_PostType::addMetaBox( 'testimonial_info', __( 'Testimonial Info', 'bestbuild' ), array( 'testimonial' ), '', '', '', array(
		'fields' => array(
			'testimonial_company'   => array(
				'label' => __( 'Company', 'bestbuild' ),
				'type'  => 'text'
			),
			'testimonial_profession'   => array(
				'label' => __( 'Profession', 'bestbuild' ),
				'type'  => 'text'
			)
		)
	) );

	STM_PostType::addMetaBox( 'vacancy_info', __( '', 'bestbuild' ), array( 'vacancy' ), '', '', '', array(
		'fields' => array(
			'vacancy_location'   => array(
				'label' => __( 'Location', 'bestbuild' ),
				'type'  => 'text'
			),
			'vacancy_department'   => array(
				'label' => __( 'Department', 'bestbuild' ),
				'type'  => 'text'
			),
			'vacancy_job_type'   => array(
				'label' => __( 'Job Type', 'bestbuild' ),
				'type'  => 'text'
			),
			'vacancy_education'   => array(
				'label' => __( 'Education', 'bestbuild' ),
				'type'  => 'text'
			),
			'vacancy_compensation'   => array(
				'label' => __( 'Compensation', 'bestbuild' ),
				'type'  => 'text'
			)
		)
	) );
}

if( class_exists( 'STM_PostType' ) ){
	add_action( 'admin_init', 'add_metaboxes' );
}

function stm_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'stm_move_comment_field_to_bottom' );