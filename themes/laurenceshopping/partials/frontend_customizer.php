<div id="frontend_customizer" style="left: -276px;">
    <div class="customizer_wrapper">

        <h3><?php _e('Navigation', 'bestbuild'); ?></h3>
        <div class="customizer_element">
            <div class="stm_switcher" id="navigation_type">
                <div class="switcher_label disable"><?php _e('Static', 'bestbuild'); ?></div>
                <div class="switcher_nav"></div>
                <div class="switcher_label enable"><?php _e('Sticky', 'bestbuild'); ?></div>
            </div>
        </div>

	    <h3><?php _e('Layout', 'bestbuild'); ?></h3>
	    <div class="customizer_element">
		    <div class="stm_switcher" id="site_layout">
			    <div class="switcher_label disable"><?php _e('Wide', 'bestbuild'); ?></div>
			    <div class="switcher_nav"></div>
			    <div class="switcher_label enable"><?php _e('Boxed', 'bestbuild'); ?></div>
		    </div>
	    </div>

	    <div class="customizer_bg_image" style="display: none;">
		    <h3><?php _e('Background Image', 'bestbuild'); ?></h3>
		    <div class="customizer_element">
			    <div class="customizer_colors" id="bg_images">
				    <span class="image_type active" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_1.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_1.jpg'); "></span>
				    <span class="image_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_2.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_2.jpg'); "></span>
				    <span class="pattern_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_3.png" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_3.png'); "></span>
				    <span class="pattern_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_4.png" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_4.png'); "></span>
				    <span class="pattern_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_5.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_5.png'); "></span>
			    </div>
		    </div>
	    </div>

        <h3><?php _e('Color Skin', 'bestbuild'); ?></h3>
        <div class="customizer_element">
            <div class="customizer_colors" id="skin_color">
                <span id="skin_default" style="background: #dac725; border-color: #dac725; "></span>
                <span id="skin_red" style="background: #ff6262; border-color: #ff6262; "></span>
                <span id="skin_yellow" style="background: #feb900; border-color: #feb900; "></span>
                <span id="skin_orange" style="background: #f7963f; border-color: #f7963f; "></span>
                <span id="skin_green" style="background: #34ef5c; border-color: #34ef5c; "></span>
            </div>
        </div>
        <hr/>
        <button id="customizer_reset" class="customizer_reset_button"><?php _e('Reset', 'bestbuild'); ?></button>
    </div>
    <div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";

        $(window).load(function () {
            $("#frontend_customizer").animate({left: -233}, 300);
        });

        $("#frontend_customizer_button").live('click', function () {
	        if( $("#frontend_customizer").hasClass( 'open' ) ){
		        $("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
	        }else{
		        $("#frontend_customizer").animate({left: 0}, 300);
	            $("#frontend_customizer").addClass('open');
	        }            
        });
       
        
        $('#wrapper').click(function (kik) {
	        if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
	            $("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
	        }
	    });

        $("#customizer_reset").live("click", function () {
            location.reload();
        });

        var default_logo = $("#header .logo img").attr("src");

        if($("body").hasClass("sticky_header")){
            $("#navigation_type").addClass("active");
        }

        $("#navigation_type").live("click", function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $("body").removeClass('sticky_header');
            } else {
                $(this).addClass('active');
                $("body").addClass('sticky_header');
            }
        });

	    $("#site_layout").live("click", function () {
		    if ($(this).hasClass('active')) {
			    $(this).removeClass('active');
			    $("body").removeClass('boxed_layout');
			    $(".customizer_bg_image").hide();
		    } else {
			    $(this).addClass('active');
			    $("body").addClass('boxed_layout');
			    $(".customizer_bg_image").show();
			    $('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
			    if( $("#bg_images span.active").hasClass('image_type') ){
				    $('body').addClass('boxed_bg_image_default');
			    }else{
				    $('body').addClass('boxed_bg_image_pattern');
			    }
			    $('body').css({'background-image' : 'url(' + $("#bg_images span.active").attr('data-image') + ')'});
		    }
	    });

        if($("body").hasClass("sticky_header")){
            $("#navigation_type").addClass("active");
        }

	    if($("body").hasClass("boxed_layout")){
		    $("#site_layout").addClass("active");
		    $(".customizer_bg_image").slideDown(150);
	    }


        if($("body").hasClass("skin_red")){
            $("#skin_color #skin_red").addClass("active");
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_red.png');
        }else if($("body").hasClass("skin_green")){
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_green.png');
            $("#skin_color #skin_green").addClass("active");
        }else if($("body").hasClass("skin_yellow")){
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_yellow.png');
            $("#skin_color #skin_yellow").addClass("active");
        }else if($("body").hasClass("skin_orange")){
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_orange.png');
            $("#skin_color #skin_orange").addClass("active");
        }else{
            $("#skin_color #skin_default").addClass("active");
        }

        $("#skin_color span").live('click', function () {
            $("#skin_color .active").removeClass("active");
            $(this).addClass("active");
	        if($(this).attr('id') == 'skin_red'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_red.png');

	        }else if($(this).attr('id') == 'skin_green'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_green.png');
	        }else if($(this).attr('id') == 'skin_yellow'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_yellow.png');
	        }else if($(this).attr('id') == 'skin_orange'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_orange.png');
	        }else{
		        $("#header .logo img").attr("src", default_logo );
	        }
            $("body").removeClass("skin_red skin_yellow skin_green skin_default skin_orange");
            $("body").addClass($(this).attr("id"));
        });

	    $("#bg_images span").live('click', function () {
		    $("#bg_images .active").removeClass("active");
		    $(this).addClass("active");
		    $('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
		    if( $(this).hasClass('image_type') ){
			    $('body').addClass('boxed_bg_image_default');
		    }else{
			    $('body').addClass('boxed_bg_image_pattern');
		    }
		    $('body').css({'background-image' : 'url(' + $(this).attr('data-image') + ')'});
	    });
	    
	    $("#header_style").on("change", function(){
		    var oldURL = window.location.href;
			var index = 0;
			var newURL = oldURL;
			index = oldURL.indexOf('?');
			if(index == -1){
			    index = oldURL.indexOf('#');
			}
			if(index != -1){
			    newURL = oldURL.substring(0, index);
			}
			if( newURL == '<?php echo esc_attr( home_url( '/' ) ) ?>' && $(this).val() == '?header_demo=transparent' ){
				window.location.href  = '<?php echo esc_attr( home_url( '/home-transparent/' ) ) ?>' + $(this).val();
				return;
			}
			window.location.href = newURL + $(this).val();
	    });
	    
	    if(window.location.href.indexOf("?header_demo=dark&top_bar=show") > -1) {
			$("#header_style_dark").attr('selected', 'selected');
	    }else if(window.location.href.indexOf("?header_demo=white&top_bar=show") > -1){
		    $("#header_style_white").attr('selected', 'selected');
	    }else if(window.location.href.indexOf("?header_demo=transparent") > -1){
		    $("#header_style_transparent").attr('selected', 'selected');
	    }

    });

</script>