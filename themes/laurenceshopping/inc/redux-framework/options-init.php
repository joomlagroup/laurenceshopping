<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 *
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "stm_option";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'opt_name'              => 'stm_option',
	'display_name'          => 'BestBuild',
	'display_version'       => 'v.2.2.1',
	'page_title'            => __( 'Theme Options', 'bestbuild' ),
	'menu_title'            => __( 'Theme Options', 'bestbuild' ),
	'update_notice'         => false,
	'admin_bar'             => true,
	'dev_mode'              => false,
	'menu_icon'             => 'dashicons-hammer',
	'menu_type'             => 'menu',
	'allow_sub_menu'        => true,
	'page_parent_post_type' => '',
	'default_mark'          => '',
	'hints'                 => array(
		'icon_position' => 'right',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color' => 'light',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'duration' => '500',
				'event'    => 'mouseleave unfocus',
			),
		),
	),
	'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => true,
	'network_sites'         => true
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

Redux::setSection( $opt_name, array(
	'title'   => __( 'General', 'bestbuild' ),
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Logo', 'bestbuild' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo_default.png' ),
			'subtitle' => __( 'Upload your logo file here.', 'bestbuild' ),
		),
		array(
			'id'       => 'logo_transparent',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'White-text Logo', 'bestbuild' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo_transparent.png' ),
			'subtitle' => __( 'For our dark header options, we need your logo to be in white to stand out. Upload it here if you choose our dark or transparent header options', 'bestbuild' ),
		),
		array(
			'id'             => 'logo_margin',
			'type'           => 'spacing',
			'output'         => array('.logo, body.header_style_dark .logo'),
			'mode'           => 'margin',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => __('Logo Margin', 'bestbuild'),
			'subtitle'       => '',
			'desc'           => __('Set your logo margin in px. Just use the number', 'bestbuild'),
			'default'        => array(
				'units'          => 'px',
			)

		),
		array(
			'id'      => 'logo_dimensions',
			'type'    => 'dimensions',
			'title'   => __( 'Logo Dimensions (px)', 'bestbuild' ),
			'output'  => array( '.logo img' ),
			'units'   => 'px',
			'default'  => array(
				'width'   => '226',
				'height'  => '44'
			),
		),
		array(
			'id'       => 'favicon',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Favicon', 'bestbuild' ),
			'default'  => '',
			'subtitle' => __( 'Upload a 16px x 16px .png or .gif image here', 'bestbuild' ),
		),
		array(
			'id'       => 'smooth_scroll',
			'type'     => 'switch',
			'title'    => __('Smooth Scroll', 'bestbuild'),
			'default'  => true,
		),
		array(
			'id'       => 'site_boxed',
			'type'     => 'switch',
			'title'    => __('Boxed Version', 'bestbuild'),
			'default'  => false,
		),
		array(
			'id'       => 'boxed_background_image_type',
			'type'     => 'button_set',
			'title'    => __( 'Background Image Type', 'bestbuild' ),
			'options'  => array(
				'boxed_bg_image_default'     => __( 'Default', 'bestbuild' ),
				'boxed_bg_image_pattern' => __( 'Pattern', 'bestbuild' ),
				'boxed_bg_image_custom'        => __( 'Custom', 'bestbuild' )
			),
			'default'  => 'boxed_bg_image_default',
			'required' => array( 'site_boxed', '=', true, ),
		),
		array(
			'id'       => 'boxed_background_image',
			'type'     => 'image_select',
			'title'    => __('Background Image', 'bestbuild'),
			'tiles'    => true,
			'options'  => array(
				get_template_directory_uri() . '/assets/images/bg/img_1.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_1.jpg'
				),
				get_template_directory_uri() . '/assets/images/bg/img_2.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_2.jpg'
				)
			),
			'default'  => get_template_directory_uri() . '/assets/images/bg/img_1.jpg',
			'required' => array(
				array( 'boxed_background_image_type', '=', 'boxed_bg_image_default' ),
				array( 'site_boxed', '=', true, )
			),
			'output'   => array(
				'background-image' => 'body'
			)
		),
		array(
			'id'       => 'boxed_background_pattern',
			'type'     => 'image_select',
			'title'    => __('Background Pattern', 'bestbuild'),
			'tiles'    => true,
			'options'  => array(
				get_template_directory_uri() . '/assets/images/bg/img_3.png'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_3.png'
				),
				get_template_directory_uri() . '/assets/images/bg/img_4.png'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_4.png'
				),
				get_template_directory_uri() . '/assets/images/bg/img_5.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_5.jpg'
				)
			),
			'default'  => get_template_directory_uri() . '/assets/images/bg/img_3.png',
			'required' => array(
				array( 'boxed_background_image_type', '=', 'boxed_bg_image_pattern', ),
				array( 'site_boxed', '=', true, )
			),
			'output'   => array(
				'background-image' => 'body'
			)
		),
		array(
			'id'       => 'boxed_background_custom_image',
			'type'     => 'background',
			'title'    => __('Custom Background', 'bestbuild'),
			'required' => array(
				array( 'boxed_background_image_type', '=', 'boxed_bg_image_custom', ),
				array( 'site_boxed', '=', true, )
			),
			'output'   => array(
				'background-image' => 'body'
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Header', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el-icon-file',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'header_style',
			'type'     => 'button_set',
			'title'    => __( 'Header Style Options', 'bestbuild' ),
			'subtitle' => __( 'Select your header style option', 'bestbuild' ),
			'options'  => array(
				'header_style_default'     => __( 'Default', 'bestbuild' ),
				'header_style_transparent' => __( 'Transparent', 'bestbuild' ),
				'header_style_dark'        => __( 'Dark', 'bestbuild' ),
				'header_style_white'       => __( 'White', 'bestbuild' ),
			),
			'default'  => 'header_style_default'
		),
		array(
			'id'       => 'mobile_header_style',
			'type'     => 'button_set',
			'title'    => __( 'Mobile Header Style Options', 'bestbuild' ),
			'subtitle' => __( 'Select your mobile header style option', 'bestbuild' ),
			'options'  => array(
				'mobile_header_style_dark'        => __( 'Dark', 'bestbuild' ),
				'mobile_header_style_white'       => __( 'White', 'bestbuild' )
			),
			'default'  => 'mobile_header_style_dark'
		),
		array(
			'id'      => 'sticky_header',
			'type'    => 'switch',
			'title'   => __( 'Enable fixed header on scroll.', 'bestbuild' ),
			'default' => false
		),
		array(
			'id'      => 'header_wpml',
			'type'    => 'switch',
			'title'   => __( 'Enable Header WPML Switcher', 'bestbuild' ),
			'default' => false
		),
		array(
			'id'      => 'header_social',
			'type'    => 'switch',
			'title'   => __( 'Enable header social media icons', 'bestbuild' ),
			'default' => true
		),
		array(
			'id'       => 'header_use_social',
			'type'     => 'checkbox',
			'title'    => __( 'Select Social Media icons to display', 'bestbuild' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'bestbuild' ),
			'required' => array( 'header_social', '=', true, ),
			'default'  => array(
				'facebook' => '1',
				'twitter' => '1',
				'instagram' => '1'
			),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
			),
		),
		array(
			'id'      => 'header_address',
			'type'    => 'textarea',
			'title'   => __( 'Address', 'bestbuild' ),
			'default' => __( '<strong>1010 Avenue of the Moon</strong><span>New York, NY 10018 US.</span>', 'bestbuild' ),
		),
		array(
			'id'      => 'header_address_icon',
			'type'    => 'button_set',
			'title'   => __( 'Address Icon', 'bestbuild' ),
			'options' => array(
				'fa-map-marker'  => __( 'Address', 'bestbuild' ),
				'fa-phone'  => __( 'Phone', 'bestbuild' ),
				'fa-clock-o' => __( 'Hours', 'bestbuild' )
			),
			'default' => 'fa-map-marker'
		),
		array(
			'id'      => 'working_hours',
			'type'    => 'textarea',
			'title'   => __( 'Working Hours', 'bestbuild' ),
			'default' => __( '<strong>Mon - Sat 8.00 - 18.00</strong><span>Sunday CLOSED</span>', 'bestbuild' ),
		),
		array(
			'id'      => 'header_working_hours_icon',
			'type'    => 'button_set',
			'title'   => __( 'Working Hours Icon', 'bestbuild' ),
			'options' => array(
				'fa-map-marker'  => __( 'Address', 'bestbuild' ),
				'fa-phone'  => __( 'Phone', 'bestbuild' ),
				'fa-clock-o' => __( 'Hours', 'bestbuild' )
			),
			'default' => 'fa-clock-o'
		),
		array(
			'id'      => 'header_phone',
			'type'    => 'textarea',
			'title'   => __( 'Phone number', 'bestbuild' ),
			'default' => __( '<strong>212 386 5575</strong><span>Free call</span>', 'bestbuild' ),
		),
		array(
			'id'      => 'header_phone_icon',
			'type'    => 'button_set',
			'title'   => __( 'Phone number Icon', 'bestbuild' ),
			'options' => array(
				'fa-map-marker'  => __( 'Address', 'bestbuild' ),
				'fa-phone'  => __( 'Phone', 'bestbuild' ),
				'fa-clock-o' => __( 'Hours', 'bestbuild' )
			),
			'default' => 'fa-phone'
		),
	)
) );

$top_bar_fields = array(
	array(
		'title'   => __( 'Enable Top Bar', 'bestbuild' ),
		'id'      => 'top_bar',
		'type'    => 'switch',
		'default' => false
	),
	array(
		'id'      => 'top_bar_wpml',
		'type'    => 'switch',
		'title'   => __( 'Enable Top Bar WPML Switcher', 'bestbuild' ),
		'default' => false
	),
	array(
		'id'      => 'top_bar_social',
		'type'    => 'switch',
		'title'   => __( 'Enable Top Bar Social Media icons', 'bestbuild' ),
		'default' => true
	),
	array(
		'id'       => 'top_bar_use_social',
		'type'     => 'checkbox',
		'title'    => __( 'Select Social Media Icons to display', 'bestbuild' ),
		'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'bestbuild' ),
		'required' => array(
			array( 'top_bar_social', '=', true, )
		),
		'options'  => array(
			'facebook'   => 'Facebook',
			'twitter'    => 'Twitter',
			'instagram'  => 'Instagram',
			'behance'    => 'Behance',
			'dribbble'   => 'Dribbble',
			'flickr'     => 'Flickr',
			'git'        => 'Git',
			'linkedin'   => 'Linkedin',
			'pinterest'  => 'Pinterest',
			'yahoo'      => 'Yahoo',
			'delicious'  => 'Delicious',
			'dropbox'    => 'Dropbox',
			'reddit'     => 'Reddit',
			'soundcloud' => 'Soundcloud',
			'google'     => 'Google',
			'skype'      => 'Skype',
			'youtube'    => 'Youtube',
			'tumblr'     => 'Tumblr',
			'whatsapp'   => 'Whatsapp',
		),
	),
	array(
		'id'      => 'top_bar_info_1_section_start',
		'type'    => 'section',
		'title'   => __( 'Location 1', 'bestbuild' ),
		'indent'  => true
	),
	array(
		'id'      => 'top_bar_info_1_office',
		'type'    => 'text',
		'title'   => __( 'Office (for dropdown options)', 'bestbuild' ),
		'default' => __( 'New York Office', 'bestbuild' ),
	),
	array(
		'id'      => 'top_bar_info_1_address',
		'type'    => 'text',
		'title'   => __( 'Address', 'bestbuild' ),
		'default' => __( '1010 Moon ave, New York, NY US', 'bestbuild' ),
	),
	array(
		'id'      => 'top_bar_info_1_address_icon',
		'type'    => 'button_set',
		'title'   => __( 'Address Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-map-marker'
	),
	array(
		'id'      => 'top_bar_info_1_hours',
		'type'    => 'text',
		'title'   => __( 'Working Hours', 'bestbuild' ),
		'default' => __( 'Mon - Sat 8.00 - 18.00', 'bestbuild' ),
	),
	array(
		'id'      => 'top_bar_info_1_hours_icon',
		'type'    => 'button_set',
		'title'   => __( 'Hours Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-clock-o'
	),
	array(
		'id'      => 'top_bar_info_1_phone',
		'type'    => 'text',
		'title'   => __( 'Phone number', 'bestbuild' ),
		'default' => __( 'Call Free:  +1 212-226-3126', 'bestbuild' ),
	),
	array(
		'id'      => 'top_bar_info_1_phone_icon',
		'type'    => 'button_set',
		'title'   => __( 'Phone Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-phone'
	),
	array(
		'id'      => 'top_bar_info_1_section_end',
		'type'   => 'section',
		'indent' => false
	)
);

for($i=2; $i <= 10; $i++ ){
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_section_start',
		'type'    => 'section',
		'title'   => sprintf( __( 'Location %s', 'bestbuild' ), $i ),
		'indent'  => true
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_office',
		'type'    => 'text',
		'title'   => __( 'Office (for dropdown options)', 'bestbuild' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_address',
		'type'    => 'text',
		'title'   => __( 'Address', 'bestbuild' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_address_icon',
		'type'    => 'button_set',
		'title'   => __( 'Address Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-map-marker'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_hours',
		'type'    => 'text',
		'title'   => __( 'Working Hours', 'bestbuild' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_hours_icon',
		'type'    => 'button_set',
		'title'   => __( 'Hours Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-clock-o'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_phone',
		'type'    => 'text',
		'title'   => __( 'Phone number', 'bestbuild' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_phone_icon',
		'type'    => 'button_set',
		'title'   => __( 'Phone Icon', 'bestbuild' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'bestbuild' ),
			'fa-phone'  => __( 'Phone', 'bestbuild' ),
			'fa-clock-o' => __( 'Hours', 'bestbuild' )
		),
		'default' => 'fa-phone'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_section_end',
		'type'   => 'section',
		'indent' => false
	);
}

Redux::setSection( $opt_name, array(
	'title'   => __( 'Top Bar', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el el-website',
	'submenu' => true,
	'fields'  => $top_bar_fields
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Blog', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el-icon-pencil',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'blog_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => __( 'Grid view', 'bestbuild' ),
				'list' => __( 'List view', 'bestbuild' )
			),
			'default' => 'grid',
			'title'   => __( 'Blog Layout', 'bestbuild' )
		),
		array(
			'id'    => 'blog_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Sidebar', 'bestbuild' )
		),
		array(
			'id'      => 'blog_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Sidebar - Position', 'bestbuild' ),
			'options' => array(
				'left'  => __( 'Left', 'bestbuild' ),
				'none'  => __( 'No Sidebar', 'bestbuild' ),
				'right' => __( 'Right', 'bestbuild' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Styling', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el-icon-tint',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'color_skin',
			'type'    => 'button_set',
			'title'   => __( 'Color Skin', 'bestbuild' ),
			'options' => array(
				''                  => __( 'Default', 'bestbuild' ),
				'skin_red'          => __( 'Red', 'bestbuild' ),
				'skin_yellow'       => __( 'Yellow', 'bestbuild' ),
				'skin_orange'       => __( 'Orange', 'bestbuild' ),
				'skin_green'        => __( 'Green', 'bestbuild' ),
				'skin_custom_color' => __( 'Custom color', 'bestbuild' ),
			),
			'default' => ''
		),
		array(
			'id'       => 'primary_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Primary Color Scheme', 'bestbuild' ),
			'default'  => '#dac725',
			'required' => array( 'color_skin', '=', 'skin_custom_color' ),
			'output'   => array(
				'background-color'    => '
body.skin_custom_color #magic-line,
body.skin_custom_color h1:before,
body.skin_custom_color .h1:before,
body.skin_custom_color h2:before,
body.skin_custom_color .h2:before,
body.skin_custom_color h3:before,
body.skin_custom_color .h3:before,
body.skin_custom_color h4:before,
body.skin_custom_color .h4:before,
body.skin_custom_color h5:before,
body.skin_custom_color .h5:before,
body.skin_custom_color h6:before,
body.skin_custom_color .h6:before,
body.skin_custom_color .button,
body.skin_custom_color .form-submit .submit,
body.skin_custom_color .button.white:hover,
body.skin_custom_color .button.white:active,
body.skin_custom_color .button.white:focus,
body.skin_custom_color .button.grey:hover,
body.skin_custom_color .button.grey:active,
body.skin_custom_color .button.grey:focus,
body.skin_custom_color .button_3d span,
body.skin_custom_color .button_3d.white span::before,
body.skin_custom_color .button_3d.white:hover span::before,
body.skin_custom_color .button_3d.white:focus span::before,
body.skin_custom_color .slider_line,
body.skin_custom_color .entry-header,
body.skin_custom_color .projects_tabs h2:before,
body.skin_custom_color .footer_widgets .widget_title h4:before,
body.skin_custom_color .slick_prev:hover,
body.skin_custom_color .slick_next:hover,
body.skin_custom_color .slick-dots li.slick-active button,
body.skin_custom_color .icon_button a:hover,
body.skin_custom_color .icon_button.skype a,
body.skin_custom_color .project_grid_filter ul li.active a,
body.skin_custom_color .project_grid .project .view_more:hover,
body.skin_custom_color .project_grid .project .view_more:active,
body.skin_custom_color .project_grid .project .view_more:focus,
body.skin_custom_color .projects_carousel .project .view_more:hover,
body.skin_custom_color .projects_carousel .project .view_more:active,
body.skin_custom_color .projects_carousel .project .view_more:focus,
body.skin_custom_color .our_partners > ul > li:hover .text h5:before,
body.skin_custom_color .page-numbers .page-numbers:hover,
body.skin_custom_color .page-numbers .page-numbers.current,
body.skin_custom_color .page-links > span,
body.skin_custom_color .page-links > a:hover,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .widget_recent_entries li:hover:before,
body.skin_custom_color .stm_post_tags a:hover,
body.skin_custom_color .tp-leftarrow.default:hover,
body.skin_custom_color .tp-rightarrow.default:hover,
body.skin_custom_color .page_404 .button:hover,
body.skin_custom_color .vc_call_to_action,
body.skin_custom_color .vc_custom_heading > *:before,
body.skin_custom_color .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-state-active a,
body.skin_custom_color .vc_grid-item.services:hover .vc_gitem-post-data-source-post_title > *:before,
body.skin_custom_color .vc_btn-orange,
body.skin_custom_color a.vc_btn-orange,
body.skin_custom_color button.vc_btn-orange,
body.skin_custom_color .wpb_content_element .wpb_tabs_nav li.ui-tabs-active:before,
body.skin_custom_color.woocommerce div.product .product_meta .tagged_as a:hover,
body.skin_custom_color .woocommerce-tabs:before,
body.skin_custom_color .woocommerce .quantity_actions span:hover,
body.skin_custom_color .button.button-outline:active,
body.skin_custom_color .button.button-outline:focus,
body.skin_custom_color .button.button-outline:hover,
body.skin_custom_color.woocommerce form.woocommerce-product-search:hover:before,
body.skin_custom_color.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
body.skin_custom_color .woocommerce.widget_product_tag_cloud .tagcloud a:hover,
body.skin_custom_color #frontend_customizer_button,
body.skin_custom_color .customizer_reset_button:hover,
body.skin_custom_color .widget.widget_calendar #today,
body.skin_custom_color .widget.widget_recent_comments ul li:hover:before,
body.skin_custom_color .ls-construct .ls-nav-prev:hover,
body.skin_custom_color .ls-construct .ls-nav-next:hover,
body.skin_custom_color .vacancy_table th.headerSortDown,
body.skin_custom_color .vacancy_table th.headerSortUp,
body.skin_custom_color .vc_btn3.vc_btn3-color-grey.vc_btn3-style-outline:hover,
body.skin_custom_color .vc_btn3.vc_btn3-color-grey.vc_btn3-style-outline:focus,
body.skin_custom_color .wpb_tour .ui-tabs-nav li.ui-tabs-active a:before,
body.skin_custom_color .widget_search button[type="submit"]:hover,
body.skin_custom_color .select2-container--default .select2-results__option--highlighted[aria-selected],
body.skin_custom_color.woocommerce .quantity_actions span:hover,
body.skin_custom_color .ls-l.layer_line,
body.skin_custom_color .button.dark:hover,
body.skin_custom_color .button.dark:active,
body.skin_custom_color .button.dark:focus,
body.skin_custom_color .top_bar_info_switcher .active,
body.skin_custom_color .top_bar_info_switcher ul
',
				'color'               => '
body.skin_custom_color a:hover,
body.skin_custom_color a:active,
body.skin_custom_color a:focus,
body.skin_custom_color .icon_text .icon,
body.skin_custom_color mark,
body.skin_custom_color .header_socials a:hover,
body.skin_custom_color .icon_text .icon,
body.skin_custom_color .entry-header .entry-title-right .button.cart_link .fa,
body.skin_custom_color .info_box ul li:before,
body.skin_custom_color .text_block ul li:before,
body.skin_custom_color .comment-info ul li:before,
body.skin_custom_color .wpb_content_element ul li:before,
body.skin_custom_color .projects_tabs .tabs a:hover,
body.skin_custom_color .projects_tabs .tabs a.active,
body.skin_custom_color .icon_box .icon,
body.skin_custom_color .stats_counter .icon,
body.skin_custom_color .posts_grid .sticky h4 a,
body.skin_custom_color .posts_grid .post_date .fa,
body.skin_custom_color .prev_next_post a:hover,
body.skin_custom_color .wpb_gallery_slidesslick_slider_2.slider_main .slider_info span,
body.skin_custom_color .widget_pages.vc_widgets li a:hover,
body.skin_custom_color .widget_pages.vc_widgets li.current_page_item a,
body.skin_custom_color .our_partners .text h5 a:hover,
body.skin_custom_color .stm_staff_2 .staff_socials li a:hover,
body.skin_custom_color .stm_post_details .comments_num .fa,
body.skin_custom_color ul.comment-list .comment .comment-meta a:hover,
body.skin_custom_color .comment-awaiting-moderation,
body.skin_custom_color .vc_call_to_action a.vc_btn:after,
body.skin_custom_color .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover,
body.skin_custom_color .wpb_wrapper .widget_contacts .icon,
body.skin_custom_color .vc_grid-item.services .vc_gitem-post-data-source-post_title a:hover,
body.skin_custom_color .vc_gitem-post-data-source-post_date:before,
body.skin_custom_color ul.products .added_to_cart:before,
body.skin_custom_color ul.products .added_to_cart:hover,
body.skin_custom_color.woocommerce-page p.stars a,
body.skin_custom_color .woocommerce .shop_table.cart td.product-remove a:hover,
body.skin_custom_color .woocommerce .shop_table.cart td.product-name a:hover,
body.skin_custom_color .widget_shopping_cart .cart_list li a.remove:hover,
body.skin_custom_color .widget_product_categories > ul > li:before,
body.skin_custom_color .widget_product_categories > ul > li > a:hover,
body.skin_custom_color.woocommerce .product_list_widget a:hover,
body.skin_custom_color.woocommerce .product_list_widget .product-title:hover,
body.skin_custom_color .widget.widget_nav_menu .menu > li > a:hover,
body.skin_custom_color .widget.widget_nav_menu.footer_widgets .menu > li > a:hover,
body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current_page_item > a,
body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current_page_item.menu-item-has-children .arrow,
body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current-menu-parent > a,
body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current-menu-parent.menu-item-has-children .arrow,
body.skin_custom_color .widget.footer_widgets ul li:before,
body.skin_custom_color .info_box .read_more:hover,
body.skin_custom_color .projects_tabs h2 a:hover,
body.skin_custom_color .vc_custom_heading a:hover,
body.skin_custom_color #stm_wpml_lang_switcher li a:hover,
body.skin_custom_color .vacancy_table th:hover:after,
body.skin_custom_color .wpb_content_element .dropcarps_bordered:first-letter,
body.skin_custom_color .wpb_content_element ul.style_1 li:before,
body.skin_custom_color ul.style_1 li:before,
body.skin_custom_color .wpb_content_element ul.style_2 li:before,
body.skin_custom_color ul.style_2 li:before,
body.skin_custom_color .wpb_content_element ul.style_3 li:before,
body.skin_custom_color ul.style_3 li:before,
body.skin_custom_color .wpb_content_element ul.style_4 li:before,
body.skin_custom_color ul.style_4 li:before,
body.skin_custom_color .wpb_content_element ul.style_5 li:before,
body.skin_custom_color ul.style_5 li:before,
body.skin_custom_color .pricing-table_content ul li:before,
body.skin_custom_color .project_grid_filter ul li a:hover,
body.skin_custom_color.header_style_2 .header_socials a:hover,
body.skin_custom_color.header_style_2 .breadcrumbs .current,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li > a:hover,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li > a:hover,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li ul li:hover > a,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li ul li.current-menu-item > a,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li ul li:hover > a,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li ul li.current-menu-item > a,
body.skin_custom_color.header_style_dark .top_nav .top_nav_wrapper > ul > li > a:hover,
body.skin_custom_color.header_style_dark .top_nav .main_menu_nav > ul > li > a:hover,
body.skin_custom_color.header_style_dark .top_nav .top_nav_wrapper > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_dark .top_nav .main_menu_nav > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_dark .top_nav .top_nav_wrapper > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_dark .top_nav .main_menu_nav > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_white .top_nav .top_nav_wrapper > ul > li > a:hover,
body.skin_custom_color.header_style_white .top_nav .main_menu_nav > ul > li > a:hover,
body.skin_custom_color.header_style_white .top_nav .top_nav_wrapper > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_white .top_nav .main_menu_nav > ul > li.current-menu-item > a,
body.skin_custom_color.header_style_white .top_nav .top_nav_wrapper > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_white .top_nav .main_menu_nav > ul > li.current-menu-parent > a,
body.skin_custom_color.header_style_dark .top_nav .top_nav_wrapper > ul > li ul li:hover > a,
body.skin_custom_color.header_style_dark .top_nav .top_nav_wrapper > ul > li ul li.current-menu-item > a,
body.skin_custom_color.header_style_dark .top_nav .main_menu_nav > ul > li ul li:hover > a,
body.skin_custom_color.header_style_dark .top_nav .main_menu_nav > ul > li ul li.current-menu-item > a,
body.skin_custom_color.header_style_white .top_nav .top_nav_wrapper > ul > li ul li:hover > a,
body.skin_custom_color.header_style_white .top_nav .top_nav_wrapper > ul > li ul li.current-menu-item > a,
body.skin_custom_color.header_style_white .top_nav .main_menu_nav > ul > li ul li:hover > a,
body.skin_custom_color.header_style_white .top_nav .main_menu_nav > ul > li ul li.current-menu-item > a,
body.skin_custom_color .top_bar .top_bar_socials a:hover,
body.skin_custom_color.header_style_transparent .breadcrumbs .current,
body.skin_custom_color .button.bordered:hover,
body.skin_custom_color .top_bar .top_bar_info li .fa
',
				'border-color'        => '
body.skin_custom_color .project_info.style_2,
body.skin_custom_color .widget_pages.vc_widgets,
body.skin_custom_color .icon_button a:hover,
body.skin_custom_color .icon_button.skype a,
body.skin_custom_color .project_grid_switcher:hover,
body.skin_custom_color .our_partners > ul > li:hover .logo,
body.skin_custom_color .stm_staff_2 .staff_socials li a:hover,
body.skin_custom_color .page-numbers .page-numbers:hover,
body.skin_custom_color .page-numbers .page-numbers.current,
body.skin_custom_color .page-links > span,
body.skin_custom_color .page-links > a:hover,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-state-active a,
body.skin_custom_color .wpb_video_widget .wpb_wrapper .wpb_video_wrapper .play_video:hover,
body.skin_custom_color.woocommerce div.product .product_meta .tagged_as a:hover,
body.skin_custom_color .button.button-outline:active,
body.skin_custom_color .button.button-outline:focus,
body.skin_custom_color .button.button-outline:hover,
body.skin_custom_color .woocommerce.widget_product_tag_cloud .tagcloud a:hover,
body.skin_custom_color .vc_btn3.vc_btn3-color-grey.vc_btn3-style-outline:hover,
body.skin_custom_color .vc_btn3.vc_btn3-color-grey.vc_btn3-style-outline:focus,
body.skin_custom_color .wpb_content_element .dropcarps_bordered:first-letter,
body.skin_custom_color .button.bordered:hover
				',
				'border-left-color'   => '
body.skin_custom_color blockquote,
body.skin_custom_color .widget_services li.active:before,
body.skin_custom_color .widget_pages.vc_widgets li:before,
body.skin_custom_color .widget_categories li:before,
body.skin_custom_color .wpb_content_element .widget_categories li:before,
body.skin_custom_color .wpb_video_widget .wpb_wrapper .wpb_video_wrapper .play_video:hover:after,
body.skin_custom_color.woocommerce .myaccount_user
				',
				'border-right-color'  => '
body.skin_custom_color .icon_button i,
body.skin_custom_color .company_history_header .year,
body.skin_custom_color #frontend_customizer_button:before
				',
				'border-top-color'    => '
body.skin_custom_color .wpb_accordion .wpb_accordion_wrapper .ui-state-default:hover .ui-icon,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.menu-item-has-children > a:hover:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.menu-item-has-children > a:hover:after,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.page_item_has_children > a:hover:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.page_item_has_children > a:hover:after,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.menu-item-has-children.current-menu-item > a:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.menu-item-has-children.current-menu-item > a:after,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.page_item_has_children.current_page_item > a:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.page_item_has_children.current_page_item > a:after,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.menu-item-has-children.current-menu-parent > a:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.menu-item-has-children.current-menu-parent > a:after,
body.skin_custom_color.header_style_transparent .top_nav .top_nav_wrapper > ul > li.page_item_has_children.current-menu-parent > a:after,
body.skin_custom_color.header_style_transparent .top_nav .main_menu_nav > ul > li.page_item_has_children.current-menu-parent > a:after
				',
				'border-bottom-color' => '
					body.skin_custom_color.woocommerce ul.cart_list li:last-child
				'

			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Shop', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el el-shopping-cart',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'    => 'shop_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Sidebar', 'bestbuild' )
		),
		array(
			'id'      => 'shop_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Sidebar - Position', 'bestbuild' ),
			'options' => array(
				'left'  => __( 'Left', 'bestbuild' ),
				'none'  => __( 'No Sidebar', 'bestbuild' ),
				'right' => __( 'Right', 'bestbuild' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Typography', 'bestbuild' ),
	'icon'    => 'el-icon-font',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => __( 'Body', 'bestbuild' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'body' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for your main body text.', 'bestbuild' ),
			'default'        => array(
				'color'       => "#777777",
				'font-family' => 'Roboto',
				'font-size'   => '14px',
			)
		),
		array(
			'id'             => 'font_heading',
			'type'           => 'typography',
			'title'          => __( 'Heading', 'bestbuild' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for headings', 'bestbuild' ),
			'default'        => array(
				'color'       => "#333333",
				'font-family' => 'Roboto',
				'font-weight' => '900',
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => __( 'H1', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '40px',
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => __( 'H2', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '30px',
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => __( 'H3', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '22px',
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => __( 'H4', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h4,.h4' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '16px',
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => __( 'H5', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h5,.h5' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '14px',
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => __( 'H6', 'bestbuild' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h6,.h6' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '13px',
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Pages', 'bestbuild' ),
	'icon'    => 'el-icon-file-new',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'    => 'projects_page',
			'type'  => 'select',
			'data'  => 'pages',
			'title' => __( 'Projects Page', 'bestbuild' )
		),
		array(
			'id'    => 'services_page',
			'type'  => 'select',
			'data'  => 'pages',
			'title' => __( 'Services Page', 'bestbuild' )
		),
		array(
			'id'    => 'vacancies_page',
			'type'  => 'select',
			'data'  => 'pages',
			'title' => __( 'Vacancies Page', 'bestbuild' )
		),
		array(
			'id'      => 'page_background_section_start',
			'type'    => 'section',
			'title'   => __( 'Page Background Default Settings', 'bestbuild' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_background_bg_image',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Background Image', 'bestbuild' )
		),
		array(
			'id'       => 'page_background_bg_position',
			'type'     => 'text',
			'title'    => __( 'Background Position', 'bestbuild' )
		),
		array(
			'id'       => 'page_background_bg_repeat',
			'type'     => 'button_set',
			'title'    => __( 'Background Repeat', 'bestbuild' ),
			'default'  => 'no-repeat',
			'options'  => array(
				'repeat' => __( 'Repeat', 'bestbuild' ),
				'no-repeat' => __( 'No Repeat', 'bestbuild' ),
				'repeat-x' => __( 'Repeat-X', 'bestbuild' ),
				'repeat-y' => __( 'Repeat-Y', 'bestbuild' )
			)
		),
		array(
			'id'      => 'page_background_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'page_title_box_section_start',
			'type'    => 'section',
			'title'   => __( 'Title Box Default Settings', 'bestbuild' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_title_box_title',
			'type'     => 'button_set',
			'title'    => __( 'Title', 'bestbuild' ),
			'default'  => 'show',
			'options'  => array(
				'show' => __( 'Show', 'bestbuild' ),
				'hide' => __( 'Hide', 'bestbuild' )
			),
		),
		array(
			'id'       => 'page_title_box_sub_title',
			'type'     => 'text',
			'title'    => __( 'Sub Title', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_bg_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Background Color', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_font_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Font Color', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_line_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Line Color', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_sub_title_line_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Sub Title Line Color', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_bg_image',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Background Image', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_bg_position',
			'type'     => 'text',
			'title'    => __( 'Background Position', 'bestbuild' )
		),
		array(
			'id'       => 'page_title_box_bg_repeat',
			'type'     => 'button_set',
			'title'    => __( 'Background Repeat', 'bestbuild' ),
			'default'  => 'no-repeat',
			'options'  => array(
				'repeat' => __( 'Repeat', 'bestbuild' ),
				'no-repeat' => __( 'No Repeat', 'bestbuild' ),
				'repeat-x' => __( 'Repeat-X', 'bestbuild' ),
				'repeat-y' => __( 'Repeat-Y', 'bestbuild' )
			)
		),
		array(
			'id'       => 'page_title_box_overlay',
			'type'     => 'checkbox',
			'title'    => __( 'Overlay', 'bestbuild' ),
			'default'  => array(
				'yes' => '0'
			),
			'options'  => array(
				'yes'   => __( 'Yes', 'bestbuild' )
			),
		),
		array(
			'id'       => 'page_title_box_small',
			'type'     => 'checkbox',
			'title'    => __( 'Small', 'bestbuild' ),
			'default'  => array(
				'yes' => '0'
			),
			'options'  => array(
				'yes'   => __( 'Yes', 'bestbuild' )
			),
		),
		array(
			'id'      => 'page_title_box_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'page_breadcrumbs_section_start',
			'type'    => 'section',
			'title'   => __( 'Page Breadcrumbs Default Settings', 'bestbuild' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_breadcrumbs_breadcrumbs',
			'type'     => 'button_set',
			'title'    => __( 'Breadcrumbs', 'bestbuild' ),
			'default'  => 'hide',
			'options'  => array(
				'show' => __( 'Show', 'bestbuild' ),
				'hide' => __( 'Hide', 'bestbuild' )
			),
		),
		array(
			'id'       => 'page_breadcrumbs_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Breadcrumbs Color', 'bestbuild' )
		),
		array(
			'id'      => 'page_breadcrumbs_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'title_box_button_section_start',
			'type'    => 'section',
			'title'   => __( 'Title Box Button Default Settings', 'bestbuild' ),
			'indent'  => true
		),
		array(
			'id'       => 'title_box_button_text',
			'type'     => 'text',
			'title'    => __( 'Button Text', 'bestbuild' )
		),
		array(
			'id'       => 'title_box_button_url',
			'type'     => 'text',
			'title'    => __( 'Button URL', 'bestbuild' )
		),
		array(
			'id'       => 'title_box_button_border_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Border Color', 'bestbuild' ),
			'default' => '#ffffff'
		),
		array(
			'id'       => 'title_box_button_font_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Font Color', 'bestbuild' ),
			'default' => '#333333'
		),
		array(
			'id'       => 'title_box_button_font_color_hover',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Font Color (hover)', 'bestbuild' ),
			'default' => '#333333'
		),
		array(
			'id'       => 'title_box_button_arrow_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Arrow Color', 'bestbuild' ),
			'default' => '#ffffff'
		),
		array(
			'id'      => 'title_box_button_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'prev_next_buttons_section_start',
			'type'    => 'section',
			'title'   => __( 'Prev/Next Buttons Default Settings', 'bestbuild' ),
			'indent'  => true
		),
		array(
			'id'       => 'prev_next_buttons',
			'type'     => 'checkbox',
			'title'    => __( 'Prev/Next Buttons', 'bestbuild' ),
			'default'  => array(
				'enable' => '0'
			),
			'options'  => array(
				'enable'   => __( 'Enable', 'bestbuild' )
			),
		),
		array(
			'id'       => 'prev_next_buttons_border_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Border Color', 'bestbuild' ),
			'default' => '#ffffff'
		),
		array(
			'id'       => 'prev_next_buttons_border_color_hover',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Border Color (hover)', 'bestbuild' ),
			'default' => '#dac725'
		),
		array(
			'id'      => 'prev_next_buttons_section_end',
			'type'   => 'section',
			'indent' => false
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Footer', 'bestbuild' ),
	'desc'    => '',
	'icon'    => 'el-icon-photo',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'footer_widgets',
			'type'    => 'switch',
			'title'   => __( 'Enable footer widgets area.', 'bestbuild' ),
			'default' => true,
		),
		array(
			'id'       => 'footer_columns',
			'type'     => 'button_set',
			'title'    => __( 'Footer Columns', 'bestbuild' ),
			'desc'     => __( 'Select the number of columns to display in the footer.', 'bestbuild' ),
			'type'     => 'button_set',
			'default'  => '4',
			'required' => array( 'footer_widgets', '=', true, ),
			'options'  => array(
				'1' => __( '1 Columns', 'bestbuild' ),
				'2' => __( '2 Columns', 'bestbuild' ),
				'3' => __( '3 Columns', 'bestbuild' ),
				'4' => __( '4 Columns', 'bestbuild' ),
			),
		),
		array(
			'id'       => 'copyright',
			'type'     => 'textarea',
			'title'    => __( 'Footer Copyright', 'bestbuild' ),
			'subtitle' => __( 'Enter the copyright text.', 'bestbuild' ),
			'default'  => __( 'Copyright &copy; 2015 Construct Theme by <a target="_blank" href="http://www.stylemixthemes.com/">Stylemix Themes</a>', 'bestbuild' )
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Social Media', 'bestbuild' ),
	'icon'    => 'el-icon-address-book',
	'desc'    => __( 'Enter social media urls here and then you can enable them for footer or header. Please add full URLs including "http://".', 'bestbuild' ),
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'facebook',
			'type'     => 'text',
			'title'    => __( 'Facebook', 'bestbuild' ),
			'subtitle' => '',
			'default' => 'https://www.facebook.com/',
			'desc'     => __( 'Enter your Facebook URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'twitter',
			'type'     => 'text',
			'title'    => __( 'Twitter', 'bestbuild' ),
			'subtitle' => '',
			'default' => 'https://www.twitter.com/',
			'desc'     => __( 'Enter your Twitter URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'instagram',
			'type'     => 'text',
			'title'    => __( 'Instagram', 'bestbuild' ),
			'subtitle' => '',
			'default' => 'https://www.instagram.com/',
			'desc'     => __( 'Enter your Instagram URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'behance',
			'type'     => 'text',
			'title'    => __( 'Behance', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Behance URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'dribbble',
			'type'     => 'text',
			'title'    => __( 'Dribbble', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dribbble URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'flickr',
			'type'     => 'text',
			'title'    => __( 'Flickr', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Flickr URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'git',
			'type'     => 'text',
			'title'    => __( 'Git', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Git URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'linkedin',
			'type'     => 'text',
			'title'    => __( 'Linkedin', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Linkedin URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'pinterest',
			'type'     => 'text',
			'title'    => __( 'Pinterest', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Pinterest URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'yahoo',
			'type'     => 'text',
			'title'    => __( 'Yahoo', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Yahoo URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'delicious',
			'type'     => 'text',
			'title'    => __( 'Delicious', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Delicious URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'dropbox',
			'type'     => 'text',
			'title'    => __( 'Dropbox', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dropbox URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'reddit',
			'type'     => 'text',
			'title'    => __( 'Reddit', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Reddit URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'soundcloud',
			'type'     => 'text',
			'title'    => __( 'Soundcloud', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Soundcloud URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'google',
			'type'     => 'text',
			'title'    => __( 'Google', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Google URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'skype',
			'type'     => 'text',
			'title'    => __( 'Skype', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Skype URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'youtube',
			'type'     => 'text',
			'title'    => __( 'Youtube', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Youtube URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'tumblr',
			'type'     => 'text',
			'title'    => __( 'Tumblr', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Tumblr URL.', 'bestbuild' ),
		),
		array(
			'id'       => 'whatsapp',
			'type'     => 'text',
			'title'    => __( 'Whatsapp', 'bestbuild' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Whatsapp URL.', 'bestbuild' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Custom CSS', 'bestbuild' ),
	'icon'    => 'el-icon-css',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'site_css',
			'type'     => 'ace_editor',
			'title'    => __( 'CSS Code', 'bestbuild' ),
			'subtitle' => __( 'Paste your custom CSS code here.', 'bestbuild' ),
			'mode'     => 'css',
			'default'  => ""
		)
	)
));

Redux::setSection( $opt_name, array(
	'icon'       => 'el-refresh',
	'icon_class' => 'el-icon-large',
	'title'      => __('One Click Update', 'bestbuild'),
	'desc'    => __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'bestbuild' ),
	'submenu'    => true,
	'fields'     => array(
		array(
			'id'       =>'envato_username',
			'type'     => 'text',
			'title'    => __('ThemeForest Username', 'bestbuild'),
			'subtitle' => '',
			'desc'     => __('Enter here your ThemeForest (or Envato) username account (i.e. Stylemixthemes).', 'bestbuild'),
		),
		array(
			'id'       =>'envato_api',
			'type'     => 'text',
			'title'    => __('ThemeForest Secret API Key', 'bestbuild'),
			'subtitle' => '',
			'desc'     => __('Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'bestbuild'),
		),
	)
));

/*
 * <--- END SECTIONS
 */

if ( ! function_exists( 'stm_option' ) ) {
	function stm_option( $id, $fallback = false, $key = false ) {
		global $stm_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $stm_option[ $id ] ) && $stm_option[ $id ] !== '' ) ? $stm_option[ $id ] : $fallback;
		if ( ! empty( $stm_option[ $id ] ) && $key ) {
			$output = $stm_option[ $id ][ $key ];
		}

		return $output;
	}
}