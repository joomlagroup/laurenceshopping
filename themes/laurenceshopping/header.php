<?php global $stm_option; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div class="content_wrapper">
		<?php if( ! is_404() ){ ?>
			<header id="header">
				<?php if ( is_top_bar() ) { ?>
					<div class="top_bar clearfix">
						<div class="container">
							<?php
								if( stm_option( 'top_bar_wpml' ) ){
									stm_wpml_lang_switcher();
								}
							?>
							<?php
							$top_bar_info = array();
							for($i=1; $i <= 10; $i++ ){
								if( ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['office'] = $stm_option['top_bar_info_'. $i .'_office'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_address'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['address'] = $stm_option['top_bar_info_'. $i .'_address'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_address'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_address_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['address_icon'] = $stm_option['top_bar_info_'. $i .'_address_icon'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_hours'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['hours'] = $stm_option['top_bar_info_'. $i .'_hours'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_hours'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_hours_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['hours_icon'] = $stm_option['top_bar_info_'. $i .'_hours_icon'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_phone'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['phone'] = $stm_option['top_bar_info_'. $i .'_phone'];
								}
								if( ! empty( $stm_option['top_bar_info_'. $i .'_phone'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_phone_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
									$top_bar_info[$i]['phone_icon'] = $stm_option['top_bar_info_'. $i .'_phone_icon'];
								}
							}
							?>
							<?php if( count( $top_bar_info ) > 1 ){ ?>
								<div class="top_bar_info_switcher">
									<div class="active"><?php echo balanceTags( $top_bar_info[1]['office'], true ); ?></div>
									<ul>
										<?php foreach( $top_bar_info as $key => $val ){ ?>
											<li><a href="#top_bar_info_<?php echo esc_attr( $key ); ?>"><?php _e( balanceTags( $val['office'], true ) ); ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
							<?php if( $top_bar_info ){
								foreach( $top_bar_info as $key => $val ){
								?>
								<ul class="top_bar_info" id="top_bar_info_<?php echo $key; ?>"<?php if( $key == 1 ){ echo ' style="display: block;"'; } ?>>
									<?php if( $val['address'] ){ ?>
										<li><i class="fa <?php echo esc_attr( $val['address_icon'] ); ?>"></i> <?php _e( balanceTags( $val['address'], true ) ); ?></li>
									<?php } ?>
									<?php if( $val['phone'] ){ ?>
										<li><i class="fa <?php echo esc_attr( $val['phone_icon'] ); ?>"></i> <?php _e( balanceTags( $val['phone'], true ) ); ?></li>
									<?php } ?>
									<?php if( $val['hours'] ){ ?>
										<li><i class="fa <?php echo esc_attr( $val['hours_icon'] ); ?>"></i> <?php _e( balanceTags( $val['hours'], true ) ); ?></li>
									<?php } ?>
								</ul>
							<?php } ?>
							<?php } ?>
							<?php if ( stm_option( 'top_bar_social' ) ) { ?>
								<div class="top_bar_socials">
									<?php
									if( stm_option( 'top_bar_use_social' ) ){
										foreach ( $stm_option['top_bar_use_social'] as $key => $val ) {
											if ( ! empty( $stm_option[$key] ) && $val == 1 ) {
												echo "<a target='_blank' href='{$stm_option[$key]}'><i class='fa fa-{$key}'></i></a>";
											}
										}
									}
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php if( get_header_style() != 'header_style_dark' && get_header_style() != 'header_style_white' ){ ?>
					<div class="header_top clearfix">
						<div class="container">
							<?php
							if( stm_option( 'header_wpml' ) ){
								stm_wpml_lang_switcher();
							}
							?>
							<?php if ( stm_option( 'header_social' ) ) { ?>
								<div class="header_socials">
									<?php
										if( stm_option( 'header_use_social' ) ){
											foreach ( $stm_option['header_use_social'] as $key => $val ) {
												if ( ! empty( $stm_option[$key] ) && $val == 1 ) {
													echo "<a target='_blank' href='{$stm_option[$key]}'><i class='fa fa-{$key}'></i></a>";
												}
											}
										}
									?>
								</div>
							<?php } ?>
							<div class="logo">
								<?php
								if( get_header_style() == 'header_style_transparent' || get_header_style() == 'header_style_dark' ){
									$logo = stm_option( 'logo_transparent', false, 'url' );
								}else{
									$logo = stm_option( 'logo', false, 'url' );
								}
								if ( $logo ){ ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php }else{ ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
								<?php } ?>
							</div>
							<?php if( $header_address = stm_option( 'header_address' ) ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_address_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( $header_address, true ); ?>
									</div>
								</div>
							<?php } ?>
							<?php if( $header_hours = stm_option( 'working_hours' ) ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_working_hours_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( $header_hours, true ); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<div class="top_nav">
					<div class="container">
						<div class="top_nav_wrapper clearfix">
							<?php if( get_header_style() == 'header_style_dark' || get_header_style() == 'header_style_white' ){ ?>
								<div class="logo">
									<?php
									if( get_header_style() == 'header_style_transparent' || get_header_style() == 'header_style_dark' ){
										$logo = stm_option( 'logo_transparent', false, 'url' );
									}else{
										$logo = stm_option( 'logo', false, 'url' );
									}
									if ( $logo ){ ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
									<?php }else{ ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>
							<?php
								wp_nav_menu( array(
										'theme_location' => 'primary_menu',
										'container' => false,
										'menu_class' => 'main_menu_nav'
									)
								);
							?>
							<?php if( stm_option( 'header_phone' ) && get_header_style() != 'header_style_dark' && get_header_style() != 'header_style_white' ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_phone_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( stm_option( 'header_phone' ), true ); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="mobile_header">
					<?php if( stm_option( 'header_social' ) || function_exists( 'icl_get_languages' ) ){ ?>
						<div class="mobile_header_top_bar clearfix">
							<?php stm_wpml_lang_switcher(); ?>
							<?php if ( stm_option( 'header_social' ) ) { ?>
								<div class="header_socials">
									<?php
									if( stm_option( 'header_use_social' ) ){
										foreach ( $stm_option['header_use_social'] as $key => $val ) {
											if ( ! empty( $stm_option[$key] ) && $val == 1 ) {
												echo "<a target='_blank' href='{$stm_option[$key]}'><i class='fa fa-{$key}'></i></a>";
											}
										}
									}
									?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="logo_wrapper clearfix">
						<div class="logo">
							<?php
							if( isset( $_GET['header_demo'] ) && $_GET['header_demo'] == 'white' ){
								$logo = stm_option( 'logo_transparent', false, 'url' );
							}elseif( stm_option( 'mobile_header_style', 'mobile_header_style_dark' ) == 'mobile_header_style_dark' ){
								$logo = stm_option( 'logo', false, 'url' );
							}else{
								$logo = stm_option( 'logo_transparent', false, 'url' );
							}
							if ( $logo ){ ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
							<?php }else{ ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							<?php } ?>
						</div>
						<div id="menu_toggle">
							<button></button>
						</div>
					</div>
					<div class="header_info">
						<div class="top_nav_mobile">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary_menu',
									'container' => false,
									'menu_class' => 'main_menu_nav'
								)
							);
							?>
						</div>
						<div class="icon_texts">
							<?php if( $header_phone = stm_option( 'header_phone' ) ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_phone_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( $header_phone, true ); ?>
									</div>
								</div>
							<?php } ?>
							<?php if( $header_hours = stm_option( 'working_hours' ) ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_working_hours_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( $header_hours, true ); ?>
									</div>
								</div>
							<?php } ?>
							<?php if( $header_address = stm_option( 'header_address' ) ){ ?>
								<div class="icon_text clearfix">
									<div class="icon"><i class="fa <?php echo stm_option( 'header_address_icon' ); ?>"></i></div>
									<div class="text">
										<?php echo balanceTags( $header_address, true ); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</header>
		<?php } ?>
		<div id="main">
			<div class="container">