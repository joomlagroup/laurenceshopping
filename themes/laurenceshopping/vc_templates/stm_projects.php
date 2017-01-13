<?php
extract( shortcode_atts( array(
	'title'             => '',
	'title_link'        => '',
	'title_color'       => '',
	'title_strip_color' => '',
	'img_size'          => 'projects_gallery',
	'category'          => 'all',
	'category_filter'   => '',
	'full_width'        => '',
	'infinite'          => '',
	'arrows'            => '',
	'dots'              => '',
	'autoplay'          => '0',
	'columns_desktop'   => '3',
	'columns_tablet'    => '2',
	'columns_mobile'    => '1',
	'css'               => '',
	'bg_image_retina'   => '',
	'bg_position'       => '',
	'bg_size'           => '',
	'class'  			=> '',
), $atts ) );

wp_enqueue_script( 'slick.min.js' );
wp_enqueue_style( 'slick.css' );

$categories = get_terms( 'project_category' );

$css_class   = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class_2 = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ) );
$title_link = vc_build_link( $title_link );

$params = array(
	'post_type' => 'project',
	'suppress_filters' => 0,
	'posts_per_page' => -1
);

if ( $category != 'all' ) {
	$params['project_category'] = $category;
}

$all_projects = get_posts( $params );

$output = '';

if ( $all_projects ) {

	$id = time();

	$image_size     = $img_size;
	$img_size_array = explode( 'x', $image_size );
	if ( count( $img_size_array ) > 1 ) {
		$image_size = $img_size_array;
	}

	$css_style = array();

	if ( $bg_position ) {
		$css_style['background-position'] = 'background-position: ' . $bg_position . ' !important;';
	}

	if ( $bg_size ) {
		$css_style['background-size'] = 'background-size: ' . $bg_size . ' !important;';
	}
	if ( $bg_image_retina ) {
		$bg_image_retina = wp_get_attachment_image_src( $bg_image_retina, 'full' );
	}

	$output .= '<div class="projects_tabs' . $css_class . ' ' . $class . ' ' . ( ( $full_width ) ? 'full_width' : '' ) . '" ' . ( ( $css_style ) ? 'style="' . implode( ' ', $css_style ) . '"' : '' ) . '>';
	if ( $category_filter == 'show' && $category == 'all' ) {
		$output .= '<div class="projects_tabs_header clearfix">';
		if ( $title_strip_color || $bg_image_retina ) {
			$output .= '<style type="text/css">';
			if ( $title_strip_color ) {
				$output .= '
				                .projects_tabs h2:before{
                                    background: ' . $title_strip_color . ';
                                }
				            ';
			}
			if ( $bg_image_retina ) {
				$output .= '
				                @media all and (-webkit-min-device-pixel-ratio: 1.5) {
									.' . $css_class_2 . ' {
										background-image: url("' . $bg_image_retina[0] . '") !important;
									}
								}
				            ';
			}
			$output .= '</style>';
		}
		if ( $title ) {
			if ( $title_link['url'] ) {
				if ( ! $title_link['target'] ) {
					$title_link['target'] = '_self';
				}
				$output .= '<h2' . ( ( $title_color ) ? ' style="color: ' . $title_color . '"' : '' ) . '><a target="' . $title_link['target'] . '" href="' . $title_link['url'] . '">' . $title . '</a></h2>';
			}else{
				$output .= '<h2' . ( ( $title_color ) ? ' style="color: ' . $title_color . '"' : '' ) . '>' . $title . '</h2>';
			}
		}
		$output .= '<div class="tabs">';
		$output .= '<a href="#projects_carousel_all" class="active">' . __( 'All Projects', 'bestbuild' ) . '</a>';
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$output .= '<a href="#projects_carousel_' . str_replace( '-', '_', $category->slug ) . '">' . $category->name . '</a>';
			}
		}
		$output .= '</div>';
		$output .= '</div>';
	}
	$output .= '<div id="projects_carousel-' . $id . '" class="projects_carousel active' . ( ( $columns_desktop > 1 ) ? ' multiple_project' : '' ) . '">';
	foreach ( $all_projects as $project ) {
		$output .= '<div class="project">
                                        <div class="project_wr">
                                            ' . get_the_post_thumbnail( $project->ID, $image_size ) . '
                                            <div class="overlay"></div>
                                            <h4>' . get_the_title( $project->ID ) . '</h4>
                                            <a href="' . get_the_permalink( $project->ID ) . '" class="button view_more">' . __( 'View More', 'bestbuild' ) . '</a>
                                        </div>
                                    </div>';
	}
	$output .= '</div>';
	$output .= '
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            "use strict";
                            var slick_' . $id . ' = $("#projects_carousel-' . $id . '");
                            slick_' . $id . '.slick({
                                ' . ( ( $infinite ) ? 'infinite: true,' : 'infinite: false,' ) . '
                                ' . ( ( $arrows ) ? 'arrows: true,' : 'arrows: false,' ) . '
                                ' . ( ( $dots ) ? 'dots: true,' : 'dots: false,' ) . '
                                ' . ( ( $autoplay != 0 ) ? 'autoplaySpeed: ' . $autoplay . ', autoplay: true,' : '' ) . '
                                slidesToShow: ' . $columns_desktop . ',
                                prevArrow: "<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",
                                nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",
                                cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
                                responsive: [
                                    {
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: ' . $columns_tablet . '
                                        }
                                    },
                                    {
                                        breakpoint: 479,
                                        settings: {
                                            slidesToShow: ' . $columns_mobile . '
                                        }
                                    }
                                ]
                            });

                            $(".projects_tabs .tabs a").live("click", function () {
                                var id = $(this).attr("href");
                                if( ! $(this).hasClass("active") ){
                                    $(this).closest(".projects_tabs").find(".tabs a.active").removeClass("active");
	                                $(this).addClass("active");
	                                var cat_id = id.substring(1);
	                                var slide_count = slick_' . $id . '.slick("getSlick").slideCount - 1;

	                                $("#projects_carousel-' . $id . '.multiple_project .project").animate({top: -$("#projects_carousel-' . $id . '.multiple_project .project").first().height()}, {
	                                    duration: 200,
	                                    complete: function(){
	                                        for(var i=0; i <= slide_count; slide_count--){
			                                    slick_' . $id . '.slick("slickRemove", slide_count);
			                                }
	                                    }
	                                });
									for(var k in projects_array[cat_id]){
	                                    slick_' . $id . '.slick("slickAdd", projects_array[cat_id][k]);
	                                }
	                                $("#projects_carousel-' . $id . '.multiple_project .project").each(function(){
	                                    $(this).animate({top: $("#projects_carousel-' . $id . '.multiple_project .project").first().height()}, 200);
	                                });
		                            $("#projects_carousel-' . $id . '.multiple_project .project").each(function(){
		                                $(this).animate({top: 0}, 200);
		                            });
                                }

                                return false;
                            });

                        });
                    var projects_array;
                ';

	$projects_array = array();
	foreach ( $all_projects as $project ) {
		$projects_array['projects_carousel_all'][] = '<div class="project">
                                                                    <div class="project_wr">
                                                                        ' . get_the_post_thumbnail( $project->ID, $image_size ) . '
                                                                        <div class="overlay"></div>
                                                                        <h4>' . get_the_title( $project->ID ) . '</h4>
                                                                        <a href="' . get_the_permalink( $project->ID ) . '" class="button view_more">' . __( 'View More', 'bestbuild' ) . '</a>
                                                                    </div>

                                                                    </div>';
	}

	if ( $categories ) {
		foreach ( $categories as $category ) {
			$projects = get_posts( array( 'post_type' => 'project', 'project_category' => $category->slug, 'posts_per_page' => -1  ) );
			if ( $projects ) {
				$cat = 'projects_carousel_' . str_replace( '-', '_', $category->slug );
				foreach ( $projects as $val ) {
					$projects_array[ $cat ][] = '<div class="project">
                                                            <div class="project_wr">
                                                                ' . get_the_post_thumbnail( $val->ID, $image_size ) . '
                                                                <div class="overlay"></div>
                                                                <h4>' . get_the_title( $val->ID ) . '</h4>
                                                                <a href="' . get_the_permalink( $val->ID ) . '" class="button view_more">' . __( 'View More', 'bestbuild' ) . '</a>
                                                            </div>
                                                            </div>';
				}
			}
		}
	}

	if ( $projects_array ) {
		$output .= 'projects_array = ' . json_encode( $projects_array ) . ';';
	}

	$output .= '</script>';
	$output .= '</div>';
}

echo $output;