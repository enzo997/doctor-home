jQuery(document).ready(function (a) {
    a(document).on("keyup", ".phone-bumber input", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "")
    }), 
    a(".slider-post .blog-content .row").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: !0,
        autoplaySpeed: 2e3,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: !0,
                dots: !1
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: !1,
                centerMode: !0,
                centerPadding: "0",
                dots: !0
            }
        }]
    }), 
    a(".list-comment").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: !1,
        dots: !0
    }),
    a(".library-img .row").slickLightbox({
        itemSelector: "a",
        navigateByKeyboard: !0,
        caption: "title"
    }), 
    768 > jQuery(window).width() && (a(".logo").clone().insertBefore(".header_aera .navbar-nav"), 
    a(".top-header .social-header").insertAfter(".header_aera .menu-main-menu-container .main_menu"), 
    a(".social-header .phone").insertAfter(".social-header .email"), 
    a("header .icon-menu img").click(function () {
        // e.preventDefault();
        a(".header .header_aera").toggleClass("active"), a(".bg-black, .btn-close").toggleClass("active"), a(".page-template").toggleClass("active-page"),
        a(".group-col-right").toggleClass("active-menu-mobile"),a("#hotline #phone").toggleClass("active-clear-hotline")
    }),  
    a(".header .header_aera .btn-close").click(function () {
        a(".header .header_aera").removeClass("active"), a(".bg-black, .btn-close").removeClass("active"), a(".page-template").removeClass("active-page"),
        a(".group-col-right").removeClass("active-menu-mobile"),a("#hotline #phone ").removeClass("active-clear-hotline")
    }), 
    a(".bg-black").click(function () {
        a(this).removeClass("active"), a(".header .header_aera, .btn-close").removeClass("active")
    }), 
    a(".home .about-us .row, .library-img .row").slick({
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: !1,
                autoplaySpeed: 2e3,
                dots: !0
            }
        }]
    }));
    var b = window.location.href;
    b = b.split("#");
    var c = "";
    1 < b.length && (c = b[1]), c && jQuery(".nav-link[href=\"#" + c + "\"]").trigger("click")
}), 
jQuery(document).ready(function ($) {
    var a = new HandleHideArrowPagination;
    a.init();
    
    if (document.documentElement.lang.toLowerCase() === "en-us") {
        768 > jQuery(window).width() && ($(".top-header .social-header").insertAfter(".header_aera .menu-main-menu-english-container .main_menu"))
    }

    function loading(sel) {
        jQuery(sel).attr('disabled', true);
        jQuery(sel).attr('data-loading', jQuery(sel).html());
        jQuery(sel).html('<i class="fa fa-spinner" style="color: #3959f4;font-size:15px"></i>');
    }
    function unloading(sel) {
        var loading = jQuery(sel).attr('data-loading');
        if (loading) {
            jQuery(sel).html(loading);
        }
        jQuery(sel).attr('disabled', false);
    }

    jQuery(document).delegate("#load_term_sv .load_paging", "click", function() {
        var data_limit = jQuery(this).attr('data-limit');
        var data_paging = jQuery(this).attr('data-paging');
        var data_role = jQuery(this).attr('data-role');


        jQuery('#load_term_sv').addClass('active_loading');
        jQuery("#load_term_sv").html('<div class="container"><div class="lds-circle"><img src="/wp-content/themes/drhome/images/default/loading-new.gif" alt="loading" ></div></div>');
        postbyurl('load_term_sv', hr.a_url + '?action=load_term_sv', 'data_limit=' + data_limit + '&data_paging=' + data_paging + '&data_role=' + data_role);
    });

    jQuery(document).delegate("#load--post-list .load_paging", "click", function() {
        var data_limit = jQuery(this).attr('data-limit');
        var data_paging = jQuery(this).attr('data-paging');
        var data_role = jQuery(this).attr('data-role');

        // setTimeout(function(){
        //     jQuery('html, body').animate({
        //         scrollTop: jQuery(".tab-service--new").offset().top
        //     }, 800);
        // }) 

        jQuery('#load--post-list').addClass('active_loading');
        jQuery("#load--post-list").html('<div class="container"><div class="lds-circle"><img src="/wp-content/themes/drhome/images/default/loading-new.gif" alt="loading" ></div></div>');
        postbyurl('load--post-list', hr.a_url + '?action=load_post_list', 'data_limit=' + data_limit + '&data_paging=' + data_paging + '&data_role=' + data_role);
    });

    jQuery(document).delegate("#tax-load--post-list .load_paging", "click", function() {
        var data_limit = jQuery(this).attr('data-limit');
        var data_paging = jQuery(this).attr('data-paging');
        var data_role = jQuery(this).attr('data-role');

        var data_term = jQuery('#tax-load--post-list').attr('data-term');

        // setTimeout(function(){
        //     jQuery('html, body').animate({
        //         scrollTop: jQuery(".tab-service--new").offset().top
        //     }, 800);
        // }) 

        jQuery('#tax-load--post-list').addClass('active_loading');
        jQuery("#tax-load--post-list").html('<div class="container"><div class="lds-circle"><img src="/wp-content/themes/drhome/images/default/loading-new.gif" alt="loading" ></div></div>');
        postbyurl('tax-load--post-list', hr.a_url + '?action=tax_load_post_list', 'data_limit=' + data_limit + '&data_paging=' + data_paging + '&data_role=' + data_role + '&data_term=' + data_term);
    });

    jQuery(document).delegate("#load_post_by_cat .load_paging", "click", function() {
        var data_limit = jQuery(this).attr('data-limit');
        var data_paging = jQuery(this).attr('data-paging');
        var data_cat = jQuery('#load_post_by_cat').attr('data-cat-id');


        jQuery('#load_post_by_cat').addClass('active_loading');
        jQuery("#load_post_by_cat").html('<div class="container"><div class="lds-circle"><img src="/wp-content/themes/drhome/images/default/loading-new.gif" alt="loading" ></div></div>');
        postbyurl('load_post_by_cat', hr.a_url + '?action=load_post_by_cat', 'data_limit=' + data_limit + '&data_paging=' + data_paging + '&data_cat=' + data_cat);
    });


    jQuery(document).delegate("#load_post_st .load_paging", "click", function() {
        var data_limit = jQuery(this).attr('data-limit');
        var data_paging = jQuery(this).attr('data-paging');
        var data_role = jQuery(this).attr('data-role');


        jQuery('#load_post_st').addClass('active_loading');
        jQuery("#load_post_st").html('<div class="container"><div class="lds-circle"><img src="/wp-content/themes/drhome/images/default/loading-new.gif" alt="loading" ></div></div>');
        postbyurl('load_post_st', hr.a_url + '?action=load_post_st', 'data_limit=' + data_limit + '&data_paging=' + data_paging + '&data_role=' + data_role);
    });

    jQuery('.load_paging').on('click', function(){
        setTimeout(function(){
            jQuery('html, body').animate({
                scrollTop: jQuery("#load-project-gallery").offset().top
            }, 800);
        }) 
    })
    

    var header_height = jQuery('#header').outerHeight(),
        mobile_header_height = jQuery('.header-mobile').outerHeight();

    if (jQuery(window).width() > 768) {
        jQuery('.main, .home-page, .post-type-archive .main, .single .main, .tax-danh-muc-dich-vu .main').css('padding-top', header_height + 'px');
    }
    else{
        jQuery('.main, .home-page, .post-type-archive .main, .single .main, .tax-danh-muc-dich-vu .main').css('padding-top', mobile_header_height + 'px');
    }

    jQuery(window).resize(function(){
        var header_height = jQuery('#header').outerHeight(),
        mobile_header_height = jQuery('.header-mobile').outerHeight();

    if (jQuery(window).width() > 768) {
        jQuery('.main, .home-page, .post-type-archive .main, .single .main, .tax-danh-muc-dich-vu .main').css('padding-top', header_height + 'px');
    }
    else{
        jQuery('.main, .home-page, .post-type-archive .main, .single .main, .tax-danh-muc-dich-vu .main').css('padding-top', mobile_header_height + 'px');
    }
    });
    // hotline scroll fixed
        jQuery(document).scroll(function(){
            if (jQuery(window).width() < 576) {
                if ((jQuery(window).scrollTop() + jQuery('#footer').outerHeight() >= jQuery('#footer').offset().top) ) {
                    jQuery('#hotline, #drift-widget-container').addClass('fixed');
                }
                else{
                    jQuery('#hotline, #drift-widget-container').removeClass('fixed');
                }
            }
            else{
                jQuery('#hotline, #drift-widget-container').removeClass('fixed');
            }
        });

        jQuery('.header .navbar-nav .menu-item-has-children ').append('<i class="fas fa-angle-down icon-dropdown"></i>');

        
        if (jQuery(window).width() < 769) {
            jQuery('.header .navbar-nav .menu-item-has-children .icon-dropdown').on('click', function(){
                jQuery(this).prev().toggleClass('show');
            })
        }

        // Block coppy content
            jQuery('*').bind('cut copy paste contextmenu', function (e) {
                e.preventDefault();
            })
        // End Block coppy content

});

function HandleHideArrowPagination() {
    var a = this;
    return this.totalElementPaging = jQuery(".thenativePagination li").length, this.init = function () {
        a.totalElementPaging && (jQuery(".thenativePagination li:nth-child(2)").length && jQuery(".thenativePagination li:nth-child(2)").hasClass("active") && jQuery(".thenativePagination li:nth-child(1)").hide(), jQuery(".thenativePagination li:nth-child(" + (a.totalElementPaging - 1) + ")").hasClass("active") && jQuery(".thenativePagination li:last-child").hide())
    }, this
}


    // Google map
        (function($) {

            /*
            *  new_map
            *
            *  This function will render a Google Map onto the selected jQuery element
            *
            *  @type	function
            *  @date	8/11/2013
            *  @since	4.3.0
            *
            *  @param	$el (jQuery element)
            *  @return	n/a
            */

            function new_map( $el ) {
                
                // var
                var $markers = $el.find('.marker');
                
                
                // vars
                var args = {
                    zoom		: 16,
                    center		: new google.maps.LatLng(0, 0),
                    mapTypeId	: google.maps.MapTypeId.ROADMAP
                };
                
                
                // create map	        	
                var map = new google.maps.Map( $el[0], args);
                
                
                // add a markers reference
                map.markers = [];
                
                
                // add markers
                $markers.each(function(){
                    
                    add_marker( $(this), map );
                    
                });
                
                
                // center map
                center_map( map );
                
                
                // return
                return map;
                
            }

            /*
            *  add_marker
            *
            *  This function will add a marker to the selected Google Map
            *
            *  @type	function
            *  @date	8/11/2013
            *  @since	4.3.0
            *
            *  @param	$marker (jQuery element)
            *  @param	map (Google Map object)
            *  @return	n/a
            */

            function add_marker( $marker, map ) {

                // var
                var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

                // create marker
                var marker = new google.maps.Marker({
                    position	: latlng,
                    map			: map,
                    title:    'Dr-home',
                    icon:     document.location.origin + '/wp-content/themes/drhome/images/logo-dr-home_map_30.png'
                });

                // add to array
                map.markers.push( marker );

                // if marker contains HTML, add it to an infoWindow
                if( $marker.html() )
                {
                    // create info window
                    var infowindow = new google.maps.InfoWindow({
                        content		: $marker.html()
                    });

                    // show info window when marker is clicked
                    google.maps.event.addListener(marker, 'click', function() {

                        infowindow.open( map, marker );

                    });
                }

            }

            /*
            *  center_map
            *
            *  This function will center the map, showing all markers attached to this map
            *
            *  @type	function
            *  @date	8/11/2013
            *  @since	4.3.0
            *
            *  @param	map (Google Map object)
            *  @return	n/a
            */

            function center_map( map ) {

                // vars
                var bounds = new google.maps.LatLngBounds();

                // loop through all markers and create bounds
                $.each( map.markers, function( i, marker ){

                    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

                    bounds.extend( latlng );

                });

                // only 1 marker?
                if( map.markers.length == 1 )
                {
                    // set center of map
                    map.setCenter( bounds.getCenter() );
                    map.setZoom( 15 );
                }
                else
                {
                    // fit to bounds
                    map.fitBounds( bounds );
                }

            }

            /*
            *  document ready
            *
            *  This function will render each map when the document is ready (page has loaded)
            *
            *  @type	function
            *  @date	8/11/2013
            *  @since	5.0.0
            *
            *  @param	n/a
            *  @return	n/a
            */
            // global var
            var map = null;

            $(document).ready(function(){

                $('.acf-map').each(function(){

                    // create map
                    map = new_map( $(this) );

                });

            });

        })(jQuery);
    // End Google map