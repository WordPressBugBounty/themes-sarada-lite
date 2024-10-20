jQuery(document).ready(function($) {

    if( sarada_lite_data.wow_animation == '1' ) {
        //wow
        new WOW().init();
    }

    //add class in parent when there is submenu
    if($('.site-header.style-one .nav-menu li').hasClass('menu-item-has-children')) {
        $('.site-header.style-one .nav-menu').addClass('has-submenu');
    } else {
        $('.site-header.style-one .nav-menu').removeClass('has-submenu');
    }

    //place site title in middle of menu
    $(window).on('load resize', function() {
        if($(this).width() < 1025) {
            $('.site-header.style-one .header-mid .secondary-nav .nav-menu > li').insertAfter('.site-header.style-one .header-mid .main-navigation .nav-menu > li:last-child').addClass('sec-menu-item');
        } else {
            $('.site-header.style-one .header-mid .main-navigation .nav-menu > li.sec-menu-item').appendTo('.site-header.style-one .header-mid .secondary-nav .nav-menu');
        }

        if( sarada_lite_data.sticky == '1' ) {
            $('.site-header.style-one > .sticky-header .secondary-nav .nav-menu > li').insertAfter('.site-header.style-one > .sticky-header .main-navigation .nav-menu > li:last-child').addClass('sec-menu-item');
        }
    }); 

    var slider_auto, slider_loop, rtl, winWidth;
    
    if( sarada_lite_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }

    if( sarada_lite_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( sarada_lite_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    //sticky t bar toggle
    $('.sticky-t-bar .close').on( 'click', function(){
        $('.sticky-bar-content').slideToggle();
        $('.sticky-t-bar').toggleClass('active');
    });

    //show/hide header social
    $(window).on( 'load', function() {
        var siteHeight = $(".site").outerHeight();
        var footHeight = $(".site-footer").outerHeight();
        var pageHeight = parseInt(siteHeight) - parseInt(footHeight);
        $(window).on( 'scroll', function() {
          if ($('.site-header.style-one').length == '1' || $('.site-header.style-four').length == '1'){
            var headerOffset = $(".site-header.style-one .header-mid, .site-header.style-four .header-mid").innerHeight();
            if ($(window).scrollTop() < headerOffset) {
                $(".site-header.style-one .header-social").fadeOut();
                $(".site-header.style-four .header-social").fadeOut();
            } else if ($(window).scrollTop() < pageHeight) {
                $(".site-header.style-one .header-social").fadeIn();
                $(".site-header.style-four .header-social").fadeIn();
            } else {
                $(".site-header.style-one .header-social").fadeOut();
                $(".site-header.style-four .header-social").fadeOut();
            }
          }
        });
    });
    

    $(".header-search .search-toggle").on( 'click', function(e) {
        $("body").addClass("search-active");
        $(this).siblings(".header-search-wrap").fadeIn("slow");
        $('.header-search .search-form .search-field').focus();
    });

    $(".header-search .search-form").on( 'click', function(e) {
        e.stopPropagation();
    });

    $(".header-search-wrap").on( 'click', function() {
        $("body").removeClass("search-active");
        $(this).fadeOut("slow");
    });
    
    //add dropdown arrow
    $('.nav-menu .menu-item-has-children').find('> a').after('<button class="submenu-toggle"><i class="fas fa-chevron-down"></i></button>');

    //toggle submenu
    $('.nav-menu .menu-item-has-children .submenu-toggle').on( 'click', function() {
        $(this).toggleClass('active');
        $(this).siblings('.sub-menu').slideToggle();
    });

    $('.nav-menu > li').each(function() {
        var liWidth = $(this).outerWidth();
        var submenuWidth = $('.sub-menu').width();
        var getHalfPos = (parseInt(liWidth) - parseInt(submenuWidth)) / 2;
        $(this).children('.sub-menu').css('margin-left', getHalfPos);
    });

    //toggle sticky newsletter
    $(window).on( 'scroll', function() {
        if($(this).scrollTop() > 250 ) {
            $('.sticky-newsletter-wrap').addClass('show');
            $('.responsive-systems-btn').addClass('show');
        } else {
            $('.sticky-newsletter-wrap').removeClass('show');
            $(".responsive-systems-btn").removeClass("show");
        }
    });
	$('.sticky-newsletter-wrap .newsletter-toggle').on( 'click', function(e) {
		e.stopPropagation();
		$(this).parent('.sticky-newsletter-wrap').toggleClass('active');
	});

	$('.sticky-newsletter-wrap .sticky-newsletter-inner').on( 'click', function(e) {
		e.stopPropagation();
	});

	$('body, html').on( 'click', function() {
		$('.sticky-newsletter-wrap').removeClass('active');
	});
    
    //Banner slider js
    if($('.site-banner:not(.static-banner).style-one').length == '1') {
        $('.site-banner.style-one .item-wrap').owlCarousel({
            loop: slider_loop,
            autoplay: slider_auto,
            items: 1,
            autoplaySpeed : 800,
            autoplayTimeout: 3000,
            animateOut : sarada_lite_data.animation,
            rtl: rtl,
            responsive : {
                0 : {
                    nav: false,
                    dots: true,
                }, 
                1025 : {
                    nav: true,
                    dots: false,
                }
            }
        });

        $(window).on('load resize', function() {
            $('.site-banner.style-one .owl-item.active, .site-banner.style-two .owl-item.active, .site-banner.style-three .owl-item.active').each(function() {
                var banItemHeight = $(this).outerHeight();
                var banCapHeight = $(this).children('.item').children('.banner-caption').outerHeight();
                var banTotalHeight = (((parseInt(banItemHeight) - parseInt(banCapHeight)) / 2) - 50) + parseInt(banCapHeight);
                $('.site-banner.style-two .owl-carousel .owl-nav, .site-banner.style-three .owl-carousel .owl-nav').css('top', banTotalHeight);
                $('.site-banner.style-one .owl-carousel .owl-nav').css('top', banCapHeight - 50);
               
                $('.site-banner.style-one .item-wrap, .site-banner.style-two .item-wrap, .site-banner.style-three .item-wrap').on('translated.owl.carousel', function() {
                    var banItemHeight = $('.owl-item.active').outerHeight();
                    var banCapHeight = $('.owl-item.active').children('.item').children('.banner-caption').outerHeight();
                    var banTotalHeight = (((parseInt(banItemHeight) - parseInt(banCapHeight)) / 2) - 50) + parseInt(banCapHeight);
                    $('.site-banner.style-two .owl-carousel .owl-nav, .site-banner.style-three .owl-carousel .owl-nav').css('top', banTotalHeight);
                    $('.site-banner.style-one .owl-carousel .owl-nav').css('top', banCapHeight - 50);
               });
            });
        });
    }

    //banner slider style four
    var itemLoop;
    if($('.site-banner.style-four .item-wrap .item').length > 3) {
        itemLoop = true;
    }else {
        itemLoop = false;
    }
    var sliderCarousel = $('.site-banner.style-four .item-wrap');
    sliderCarousel.on('initialized.owl.carousel', function(event) {
        sliderCarousel.find('.owl-item.active').eq(1).addClass('middle-item');
    });
    sliderCarousel.owlCarousel({
        items: 3,
        margin: 62,
        autoplay: false,
        loop: itemLoop,
        nav: true,
        dots: false,
        autoplaySpeed : 800,
        autoplayTimeout: 3000,
        animateOut : sarada_lite_data.animation,
        rtl: rtl,
        responsive : {
            0 : {
                items: 1,
                margin: 30,
            }, 
            768 : {
                items: 2,
                margin: 45,
                nav: false,
                dots: true,
            }, 
            1200 : {
                items: 3,
                margin: 45,
                nav: true,
                dots: false,
            }
        }
    });

    $('.site-banner.style-four .item-wrap .owl-next').on( 'click', function() {
        sliderCarousel.find('.owl-item.middle-item').next('.active').addClass('middle-item');
        sliderCarousel.find('.owl-item.middle-item').prev('.active').removeClass('middle-item');
    });

    $('.site-banner.style-four .item-wrap .owl-prev').on( 'click', function() {
        sliderCarousel.find('.owl-item.middle-item').prev('.active').addClass('middle-item');
        sliderCarousel.find('.owl-item.middle-item').next('.active').removeClass('middle-item');
    });

    sliderCarousel.on('changed.owl.carousel', function(event) {
        if(slider_auto == '1'){
            $('.owl-item').removeClass('middle-item');
            sliderCarousel.find('.owl-item.active').eq(2).addClass('middle-item');
        }
    });

    $(window).on('load resize', function(){
        var imgHolderHeight = $('.about-section .widget-featured-holder .img-holder').outerHeight();
        $('.about-section .widget-featured-holder').css('min-height', imgHolderHeight);
    });

    $(window).on("keyup", function(event) {
        if (event.key == "Escape") {
          $("body").removeClass("search-active");
          $(".header-search-wrap").fadeOut("slow");
          $('.sticky-newsletter-wrap').removeClass('active');
          $('.sarada-dark-mode-toggle').removeClass('active');
          $(".ed-color-wrap").removeClass("active");
        }
    });

    // animate main navigation
    $('.main-navigation .toggle-btn').on('click', function() {
        $(this).siblings('.primary-menu-list').animate({
            width: 'toggle'
        });
    });

    $('.main-navigation .close').on('click', function() {
        $(this).parents('.primary-menu-list').animate({
            width: 'toggle'
        });
    });

    //scroll to top js
    $(window).on( 'scroll', function(){
        if($(window).scrollTop() > 200){
            $('.back-to-top').addClass('active');
        }else {
            $('.back-to-top').removeClass('active');
        }
    });

    $('.back-to-top').on( 'click', function(){
        $('body,html').animate({
            scrollTop: 0,
        }, 600);
    });

    //menu item accessibility
    $('.main-navigation ul li a, .secondary-nav ul li a, .footer-menu ul li a, ul[class*="photos-"] li a').on( 'focus', function() {
        $(this).parents('li').addClass('hover');
    }).on( 'blur', function() {
        $(this).parents('li').removeClass('hover');
    });

    $("article a").on( 'focus', function() {
        $(this).parents('article').addClass('hover');
    }).on( 'blur', function() {
        $(this).parents('article').removeClass('hover');
    });

    $(".header-cart a").on( 'focus', function() {
        $(this).parents('.header-cart').addClass('hover');
    }).on( 'blur', function() {
        $(this).parents('.header-cart').removeClass('hover');
    });


    //alignfull js
    $(window).on('load resize', function() {
        var gbWindowWidth = $(window).width();
        var gbContainerWidth = $('.sarada-lite-has-blocks .site-content > .container').width();
        var gbContentWidth = $('.sarada-lite-has-blocks .site-main .entry-content').width();
        var gbMarginFull = (parseInt(gbContentWidth) - parseInt(gbWindowWidth)) / 2;
        var gbMarginFull2 = (parseInt(gbContentWidth) - parseInt(gbContainerWidth)) / 2;
        var gbMarginCenter = (parseInt(gbContentWidth) - parseInt(gbWindowWidth)) / 2;
        $(".sarada-lite-has-blocks.full-width .site-main .entry-content .alignfull").css({"max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginFull});
        $(".sarada-lite-has-blocks.fullwidth-centered .site-main .entry-content .alignfull").css({"max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginCenter});
        $(".sarada-lite-has-blocks.fullwidth-centered .site-main .entry-content .alignwide").css({"max-width": gbContainerWidth, "width": gbContainerWidth, "margin-left": gbMarginFull2});
    });

    //Ajax for Add to Cart
    $('.btn-simple').on( 'click', function() {        
        $(this).addClass('adding-cart');
        var product_id = $(this).attr('id');
        
        $.ajax ({
            url     : sarada_lite_data.url,  
            type    : 'POST',
            data    : 'action=sarada_lite_add_cart_single&product_id=' + product_id,    
            success : function(results){
                $('#'+product_id).replaceWith(results);
            }
        }).done(function(){
            var cart = $('#cart-'+product_id).val();
            $('.cart .number').html(cart);         
        });
    });
});