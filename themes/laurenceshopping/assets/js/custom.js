jQuery(document).ready(function ($) {
    "use strict";

    $(window).load(function () {
        var $el, leftPos, newWidth,
            $mainNav = $(".top_nav .top_nav_wrapper > ul, .top_nav .main_menu_nav > ul"),
            $otherNav = $("body.header_style_transparent .top_nav .top_nav_wrapper > ul, body.header_style_transparent .top_nav .main_menu_nav > ul, body.header_style_dark .top_nav .top_nav_wrapper > ul, body.header_style_dark .top_nav .main_menu_nav > ul, body.header_style_white .top_nav .top_nav_wrapper > ul, body.header_style_white .top_nav .main_menu_nav > ul");

        if( $mainNav.length > 0 && $otherNav.length == 0 ){
            $mainNav.append("<li id='magic-line'></li>");
            var $magicLine = $("#magic-line");
            var $magicLineWidth = 0;
            var $magicLineLeft = 0;
            if( $mainNav.find(".current_page_item").length || $mainNav.find(".current-menu-parent").length ){
                $magicLineWidth = $(".current_page_item, .current-menu-parent").width();
                $magicLineLeft = $(".current_page_item, .current-menu-parent").position().left;
            }
            $magicLine.width($magicLineWidth)
                .css("left", $magicLineLeft)
                .data("origLeft", $magicLine.position().left)
                .data("origWidth", $magicLine.width());

            $mainNav.find(' > li').hover(function () {
                $el = $(this);
                leftPos = $el.position().left;
                newWidth = $el.width();
                $magicLine.stop().animate({
                    left: leftPos,
                    width: newWidth
                }, 200);
            }, function () {
                $magicLine.stop().animate({
                    left: $magicLine.data("origLeft"),
                    width: $magicLine.data("origWidth")
                }, 200);
            });
        }
    });

    $.fn.is_on_screen = function(){
        var win = $(window);
        var viewport = {
            top : win.scrollTop(),
            left : win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    };

    $("body .wpb_video_widget .wpb_wrapper .wpb_video_wrapper .play_video").live('click', function () {
        $(this).parent().find('iframe').attr( 'src', $(this).parent().find('iframe').attr( 'src' ) + '?autoplay=1').delay();
        $(this).hide();
        $(this).parent().find('img').hide();
        $(this).parent().find('.video').show();
        return false;
    });

    $(".staff_read_more").live('click', function () {
        $(this).closest('.stm_staff_2').find('.full_description').slideToggle(150);
        return false;
    });

    $('select').select2({ width: '100%' });

    $('#menu_toggle').live('click', function () {
        $(this).toggleClass('open');
        $('.mobile_header .top_nav_mobile').slideToggle(300);
        return false;
    });

    $(".mobile_header .top_nav_mobile .main_menu_nav > li.menu-item-has-children > a").after('<span class="arrow"><i class="fa fa-chevron-down"></i></span>');
    $(".mobile_header .top_nav_mobile .main_menu_nav > li.menu-item-has-children > .sub-menu > .menu-item-has-children > a").after('<span class="arrow"><i class="fa fa-chevron-down"></i></span>');

    $(".mobile_header .top_nav_mobile .main_menu_nav > li.menu-item-has-children .arrow").live('click', function () {
        $(this).toggleClass('active');
        $(this).closest('li').find('> ul').slideToggle(300);
    });

    $(".mobile_header .top_nav_mobile .main_menu_nav > li.menu-item-has-children > a").live('click', function () {
        if( $(this).attr('href') == '#' ){
            $(this).closest('li').find('ul').slideToggle(300);
            $(this).closest('li').find('.arrow').toggleClass('active');
        }
    });

    // Quantity actions
    $('.quantity_actions span').on('click', function() {
        var quantityContainer = $(this).closest('.quantity'),
            quantityInput = quantityContainer.find('.qty'),
            quantityVal = quantityInput.attr('value');

        if( $(this).hasClass('plus') ) {
            quantityInput.attr('value', parseInt(quantityVal) + 1);
        } else if( $(this).hasClass('minus') ) {
            if( quantityVal > 1 ) {
                quantityInput.attr('value', parseInt(quantityVal) - 1);
            }
        }
    });

    $('#header div.top_nav').affix({
        offset: {
            top: $("#header").innerHeight() - $("#header div.top_nav").innerHeight()
        }
    });
    

    $(window).on('load', function () {
        $('#wrapper').css({'padding-bottom' : $('#footer').height()});
        $("#header").css({'min-height':$("#header").innerHeight()});
    });

    $(".top_bar_info_switcher a").live( 'click', function () {
        var id = $(this).attr( 'href' );
        var title = $(this).text();
        $(".top_bar_info").hide();
        $(id).show();
        $(".top_bar_info_switcher .active").text(title);
        return false;
    });

    if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
        stm_animate_block();
    }else{
        $(".stm_animation").css('opacity', 1);
    }

    jQuery(window).scroll(function(){
        if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
            stm_animate_block();
        }else{
            $(".stm_animation").css('opacity', 1);
        }
    });
	
	$('.single-product .product-type-variable table.variations select').live("change", function() {
		$(this).parent().find('.select2-selection__rendered').text($(this).find('option[value="'+ $(this).val() +'"]').text());
	});

});

function stm_animate_block(){
    jQuery('.stm_animation').each(function(){
        if(jQuery(this).attr('data-animate')) {
            var animation_blocks = jQuery(this).children('*');
            var animationName = jQuery(this).attr('data-animate'),
                animationDuration = jQuery(this).attr('data-animation-duration') + 's',
                animationDelay = jQuery(this).attr('data-animation-delay');
            var style = 'opacity:1;-webkit-animation-delay:'+animationDelay+'s;-webkit-animation-duration:'+animationDuration+'; -moz-animation-delay:'+animationDelay+'s;-moz-animation-duration:'+animationDuration+'; animation-delay:'+animationDelay+'s;';
            var container_style = 'opacity:1;-webkit-transition-delay: '+(animationDelay)+'s; -moz-transition-delay: '+(animationDelay)+'s; transition-delay: '+(animationDelay)+'s;';
            if (isAppear(jQuery(this))) {
                jQuery(this).attr( 'style', container_style );
                jQuery.each( animation_blocks, function(index,value){
                    jQuery(this).attr('style', style);
                    jQuery(this).addClass('animated').addClass(animationName);
                });
            }
        }
    });
}

function isAppear(id) {
    var window_scroll = jQuery(window).scrollTop();
    var window_height = jQuery(window).height();

    if (jQuery(id).hasClass('stm_viewport')) {
        var start_effect = jQuery(id).data('viewport_position');
    }

    if (typeof(start_effect) === 'undefined' || start_effect == '') {
        var percentage = 2;
    }else {
        var percentage = 100 - start_effect;
    }
    var element_top = jQuery(id).offset().top;
    var position = element_top - window_scroll;

    var cut = window_height - (window_height * (percentage / 100));
    if (position <= cut) {
        return true;
    }else {
        return false;
    }
};