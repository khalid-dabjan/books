;(function($, window, document, undefined) {

    "use strict";

    /*============================*/
    /* 01 - VARIABLES */
    /*============================*/
    var swipers = [],
        winW, winH, winScr, _isresponsive, smPoint = 768,
        mdPoint = 992,
        lgPoint = 1200,
        addPoint = 1600,
        _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);


    /*========================*/
    /* 02 - PAGE CALCULATIONS */
    /*========================*/
    function pageCalculations() {
        winW = $(window).width();
        winH = $(window).height();
    }

    /*=================================*/
    /* 03 - FUNCTION ON DOCUMENT READY */
    /*=================================*/
    pageCalculations();

    /*============================*/
    /* 04 - FUNCTION ON PAGE LOAD */
    /*============================*/
    $(window).on('load ', function() {
        $('#loading').fadeOut(400);
        izotope_portfolio();
        initSwiper();
        wpc_add_img_bg('.inv-bg-block .inv-img', '.inv-bg-block');
        wpc_add_img_bg('.inv-clients-img-wrap img', '.inv-clients-img-wrap');
        wpc_add_img_bg('.inv-works-img-wrap img', '.inv-works-img-wrap');
        wpc_add_img_bg('.inv-listing-img img', '.inv-listing-img');
        wpc_add_img_bg('.inv-listing3-img img', '.inv-listing3-img');
        wpc_add_img_bg('.inv-bg-block3 .inv-img', '.inv-bg-block3');
        wpc_add_img_bg('.inv-srories-audio-img img', '.inv-srories-audio-img');
        wpc_add_img_bg('.inv-blog-slides img', '.inv-blog-slides');
        wpc_add_img_bg('.inv-comment-img-bg img', '.inv-comment-img-bg');
        wpc_add_img_bg2('.inv-bg-block2 .inv-img', '.inv-bg-block2');
        wpc_add_img_bg2('.inv-places2-head img', '.inv-places2-head');
        wpc_add_img_bg2('.inv-category-head img', '.inv-category-head');
        wpc_add_img_bg2('.inv-places-item img', '.inv-places-item');
        wpc_add_img_bg2('.inv-stories-img img', '.inv-stories-img');
        wpc_add_img_bg2('.listing-slide-wrap img', '.listing-slide-wrap');


        block_height('.inv-places2-row');
        block_height('.inv-pricing-head');
        block_height('.inv-pricing-row');
    });

    $(window).on('resize', function() {
        izotope_portfolio();
    });

    $(window).on('scroll', function() {
        onScroll();
        counters();
    });

    /*==============================*/
    /* 05 - FUNCTION ON PAGE RESIZE */
    /*==============================*/
    function resizeCall() {
        pageCalculations();
        $('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function() {
            var thisSwiper = swipers['swiper-' + $(this).attr('id')],
                $t = $(this),
                slidesPerViewVar = updateSlidesPerView($t),
                centerVar = thisSwiper.params.centeredSlides;
            thisSwiper.params.slidesPerView = slidesPerViewVar;
            thisSwiper.reInit();
            if (!centerVar) {
                var paginationSpan = $t.find('.pagination span');
                var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                else $t.removeClass('pagination-hidden');
                paginationSlice.show();
            }
        });
    }
    if (!_ismobile) {
        $(window).on('resize', function() {
            resizeCall();
        });
    } else {
        window.addEventListener("orientationchange", function() {
            resizeCall();
        }, false);
    }

    /*=====================*/
    /* 06 - SWIPER SLIDERS */
    /*=====================*/
    function initSwiper() {
        var initIterator = 0;
        $('.swiper-container').each(function() {
            var $t = $(this);

            var index = 'swiper-unique-id-' + initIterator;

            $t.addClass('swiper-' + index + ' initialized').attr('id', index);
            $t.find('.pagination').addClass('pagination-' + index);

            var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
            var mode = $t.attr('data-mode');
            var slidesPerViewVar = $t.attr('data-slides-per-view');
            if (slidesPerViewVar == 'responsive') {
                slidesPerViewVar = updateSlidesPerView($t);
            }
            else if (slidesPerViewVar == 'auto') {
                slidesPerViewVar = 'auto';
            }
            else slidesPerViewVar = parseInt(slidesPerViewVar, 10);

            var loopVar = parseInt($t.attr('data-loop'), 10);
            var speedVar = parseInt($t.attr('data-speed'), 10);
            var centerVar = parseInt($t.attr('data-center'), 10);
            swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
                speed: speedVar,
                pagination: '.pagination-' + index,
                loop: loopVar,
                paginationClickable: true,
                autoplay: autoPlayVar,
                slidesPerView: slidesPerViewVar,
                keyboardControl: true,
                calculateHeight: true,
                simulateTouch: true,
                roundLengths: true,
                loopedSlides: 3,
                centeredSlides: centerVar,
                mode: mode || 'horizontal',
                onInit: function(swiper) {
                    $t.find('.swiper-slide').addClass('active');
                },
                onSlideChangeEnd: function(swiper) {
                    var activeIndex = (loopVar === 1) ? swiper.activeLoopIndex : swiper.activeIndex;
                    swiper.startAutoplay();
                },
                onSlideChangeStart: function(swiper) {
                    $t.find('.swiper-slide.active').removeClass('active');
                }
            });
            swipers['swiper-' + index].reInit();
            if ($t.attr('data-slides-per-view') == 'responsive') {
                var paginationSpan = $t.find('.pagination span');
                var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                else $t.removeClass('pagination-hidden');
                paginationSlice.show();
            }

            if ($t.find('.default-active').length) {
                swipers['swiper-' + index].swipeTo($t.find('.swiper-slide').index($t.find('.default-active')), 0);
            }

            initIterator++;
        });
    }

    function updateSlidesPerView(swiperContainer) {
        if (winW >= addPoint) return parseInt(swiperContainer.attr('data-add-slides'), 10);
        else if (winW >= lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'), 10);
        else if (winW >= mdPoint) return parseInt(swiperContainer.attr('data-md-slides'), 10);
        else if (winW >= smPoint) return parseInt(swiperContainer.attr('data-sm-slides'), 10);
        else return parseInt(swiperContainer.attr('data-xs-slides'), 10);
    }

    //swiper arrows
    $('.swiper-arrow-left').on('click', function() {
        swipers['swiper-' + $(this).parent().attr('id')].swipePrev();
        swipers['swiper-' + $(this).parent().attr('id')].startAutoplay();
    });

    $('.swiper-arrow-right').on('click', function() {
        swipers['swiper-' + $(this).parent().attr('id')].swipeNext();
        swipers['swiper-' + $(this).parent().attr('id')].startAutoplay();
    });

    $('.swiper-outer-left').on('click', function() {
        swipers['swiper-' + $(this).parent().find('.swiper-container').attr('id')].swipePrev();
        swipers['swiper-'+ $(this).parent().find('.swiper-container').attr('id')].startAutoplay();
    });

    $('.swiper-outer-right').on('click', function() {
        swipers['swiper-' + $(this).parent().find('.swiper-container').attr('id')].swipeNext();
        swipers['swiper-'+ $(this).parent().find('.swiper-container').attr('id')].startAutoplay();
    });

    ////////////////////////////////
    // TABS
    ////////////////////////////////
    $('.inv-start-block-slider').on('click', '.inv-slider-item', function(event) {
        event.preventDefault();
        var that = $(this),
         dataTab = that.attr('data-tab');
        if (that.hasClass('avtive-tab')) {
            return false;
        }
        else{
            that.closest('.inv-start-block-slider').find('.inv-slider-item').removeClass('avtive-tab')
            that.addClass('avtive-tab')
            $('.inv-index5-form .inv-start-form').hide()
            $('' + dataTab).show()
        }
    });

    $('.tabs-header').on('click', 'li', function(e) {
        e.preventDefault();

        var index_el = $(this).index();

        $(this).addClass('active').siblings().removeClass('active');
        $(this).closest('.tabs').find('.tabs-item').removeClass('active').eq(index_el).addClass('active');
    });

    ////////////////////////////////
    // ISOTOPE
    ////////////////////////////////
    function izotope_portfolio() {
        if ( $('.izotope-container').length ) {
            var $container = $('.izotope-container  ');
            var $filter = $('#filters ');
                /* Init isotope */
                if( $container.hasClass('hawa_masonry') ) {
                    $container.isotope({
                        itemSelector: '.item',
                        layoutMode: 'masonry',
                        masonry: {
                            columnWidth: '.item'
                        }
                    });
                } else {
                    $container.isotope({
                        itemSelector: '.item',
                        layoutMode: 'fitRows'
                    });
                }
                /* Filter */
                $filter.on('click', '.but', function(e) {
                    e.preventDefault();

                    $filter.find('.but').removeClass('activbut');
                    $(this).addClass('activbut');

                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});
                });
            }
        }

        function crossUpdate(value, slider) {
            // Set the value
            slider.noUiSlider.set(value);
        }

    ////////////////////////////////
    // RANGE SLIDER
    ////////////////////////////////
    if ($("#len").length) {
        var elem = document.getElementById('len');
        var html5Go = document.getElementById('slider1');

        noUiSlider.create(html5Go, {
            start: 0,
            range: {
                'min': 0,
                'max': 500
            }
        });

        var elem = document.getElementById('len');
        html5Go.noUiSlider.on('update', function(values, handle) {
            var value = values[handle];
            if (handle) {
                elem.innerHTML =  value + 'km';
            } else {
                elem.innerHTML = Math.round(value) + ' km';
            }
        });
    }

    if ($("#input-select").length) {
        // range slider for listing filter
        var select = document.getElementById('input-select');
        var html5Slider = document.getElementById('html5');

        noUiSlider.create(html5Slider, {
            start: [35, 299],
            connect: true,
            range: {
                'min': 0,
                'max': 1000
            }
        });

        var inputNumber = document.getElementById('input-number');
        html5Slider.noUiSlider.on('update', function(values, handle) {
            var value = values[handle];
            if (handle) {
                inputNumber.value =  value;
            } else {
                select.value = Math.round(value);
            }
        });

        select.addEventListener('change', function() {
            html5Slider.noUiSlider.set([ this.value, null]);
        });

        inputNumber.addEventListener('change', function() {
            html5Slider.noUiSlider.set([null, this.value]);
        });
    }

    ////////////////////////////////
    // LIST STYLE
    ////////////////////////////////
    $('.inv-listing-result .inv-listing-header a').on('click', function(event) {
        event.preventDefault();
        var that = $(this),
            newStyle = $('.inv-listing-result-js '),
            newStyle2 = $('.inv-listing-result-js2 '),
            thatAttr = that.attr('data-list');

        if (newStyle.length) {

            if (that.hasClass('active')) {
                return false;
            }
            else {
                that.parent('.inv-list-btn').find('a').removeClass('active')
                that.addClass('active')
                if (newStyle.hasClass('inv-listing-result-style2')) {
                    newStyle.removeClass('inv-listing-result-style2')
                    newStyle.find('.inv-places2-item').parent().removeClass('col-sm-12').addClass('col-sm-6')
                    newStyle.addClass(thatAttr)
                }
                else {
                    newStyle.find('.inv-places2-item').parent().removeClass('col-sm-6').addClass('col-sm-12')
                    newStyle.removeClass('inv-listing-result-style1')
                    newStyle.addClass(thatAttr)
                }
            }
        }
        if (newStyle2.length) {
            var sizeElem = $('.change-block-size');
            if (that.hasClass('active')) {
                return false;
            }
            else {
                that.parent('.inv-list-btn').find('a').removeClass('active')
                that.addClass('active')
                if (sizeElem.hasClass('col-lg-4')) {
                    newStyle2.removeClass('inv-listing-result-style1')
                    sizeElem.removeClass('col-lg-4 col-sm-6').addClass('col-xs-12')
                    newStyle2.addClass(thatAttr)
                }
                else {
                    sizeElem.removeClass('col-xs-12 ').addClass('col-lg-4 col-sm-6')
                    newStyle2.removeClass('inv-listing-result-style2')
                    newStyle2.addClass(thatAttr)
                }
            }
        }
    });

    ////////////////////////////////
    // POP UP
    ////////////////////////////////
    // $('.inv-poput-login').hide();
    $('.popup-form').magnificPopup({
        type: 'inline',
        preloader: false,

        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                $(" .inv-poput-login").show();
            },
            afterClose: function() {
                $(" .inv-poput-login").hide();
            }
        }
    });

    ////////////////////////////////
    // RESPONSIVE THUMBNAIL GALLERY
    ////////////////////////////////
    if ($('#gallery').length) {
        var gallery = new $.ThumbnailGallery($('#gallery'), {
            thumbImages: 'images/plaginImg/thumbs/thumb',
            smallImages: 'images/plaginImg/small/image',
            largeImages: 'images/plaginImg/large/image',
            count: 4,
            thumbImageType: 'jpg',
            imageType: 'jpg',
            breakpoint: 600,
            shadowStrength: 1
        });
    }

    ////////////////////////////////
    // TIME PICKER
    ////////////////////////////////
    if ($('.timepicker').length) {
        $('.timepicker').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });
    }

    ////////////////////////////
    // COUNT
    ////////////////////////////////
    var counters = function() {
        $('.inv-places-count span ').not('.animated').each(function() {
            if ($(window).scrollTop() >= $(this).offset().top - $(window).height() * 0.7) {
                $(this).addClass('animated').countTo();
            }
        });
    }

    ////////////////////////////
    // MAP
    ////////////////////////////////
    var map;
    var infowindow;

    function initMap() {
        var pyrmont = {lat: -33.867, lng: 151.195};
        var infowindow;
        var styles = [{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":60}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#d5d5d5"},{"lightness":40},{"saturation":-40}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fea88d"},{"lightness":40},{"saturation":"0"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#6dd2ff"},{"lightness":40}]}]
        var image =['images/marker.png', 'images/marker1.png', 'images/marker2.png', 'images/marker3.png', 'images/marker4.png', 'images/marker5.png', 'images/marker6.png', 'images/marker7.png', 'images/marker9.png', 'images/marker10.png', 'images/marker11.png'];
        var contentString ='<div id="content" class="inv-map-post">'+
                                '<div id="siteNotice" class="inv-map-post-img-bg">'+
                                    '<img src="images/i78.jpg">'+
                                '</div>'+
                                '<div id="bodyContent" class="inv-map-post-content">'+
                                    '<h1 id="firstHeading" class="firstHeading">The Name Of The Place</h1>' +
                                    '<span class="inv-map-city  fa fa-map-marker">Melbourne, Australia</span>' +
                                    '<span class="inv-map-rating  inv-listing-rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '</div>'+
                            '</div>';

        if($('.wpc-map').data('type') == 'satellite') {
            var type = google.maps.MapTypeId.SATELLITE;
        }
        else {
            var type = google.maps.MapTypeId.ROADMAP;
        }

        map = new google.maps.Map(document.querySelector('.wpc-map'), {
            center: pyrmont,
            zoom: 18,
            scrollwheel: false,
            draggable: !_ismobile,
            mapTypeId: type
        });

        var service = new google.maps.places.PlacesService(map);

        pyrmont = {
          lat: $('.wpc-map').data('lat'),
          lng: $('.wpc-map').data('lng')
        };
        // Try HTML5 geolocation.
        $('.get-geolocation-btn').on('click', function () {
          navigator.geolocation.watchPosition(function(position) {
            pyrmont = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            map.setCenter(pyrmont);
            service.nearbySearch({
                location: pyrmont,
                radius: mapRadius,
                types: categoryType,
                draggable: !_ismobile,
                scrollwheel: false,
                keyword: $('.js-map-keyword').val()
            }, mapCallback);
            createLocationMarker(pyrmont);
          },
          function (error) {
            if (error.code == error.PERMISSION_DENIED)
                console.log("you denied me :-(");
          });
        })

        map.setCenter(pyrmont);

        var categoryType = [];
        var mapRadius = 300;

        if ($('select.js-map-categories').val() === 'All') {
            var selectOptions = $('select.js-map-categories > option');
            for (var i = 1; i < selectOptions.length; i++) {
                categoryType.push($(selectOptions[i]).val());
            }
        }
        else {
            categoryType = [$('select.js-map-categories').val()];
        }
        service.nearbySearch({
            location: pyrmont,
            radius: mapRadius,
            types: categoryType,
            draggable: !_ismobile,
            scrollwheel: false,
            keyword: $('.js-map-keyword').val()
        }, mapCallback);

        createLocationMarker(pyrmont);


        map.setOptions({styles: styles});

        function mapCallback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                createMarker(results[i], image[i]);
                }
            }
        }

        var iwOuter = $('.gm-style-iw');
               var iwBackground = iwOuter.prev();

               iwOuter.children(':nth-child(1)').css({'display' : 'block'});
               // Remove the background shadow DIV
               iwBackground.children(':nth-child(2)').css({'opacity' : '0', 'visibility' : 'hidden'});
               iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'none', 'border': 'none'});
        function createLocationMarker(place, icon) {
           if( icon === undefined) {
               icon = 'images/marker8.png';
           }
           var marker = new google.maps.Marker({
               map: map,
               position: place,
               icon: icon
           });
        }
        function createMarker(place, icon) {
            if( icon === undefined) {
                icon = 'images/marker.png';
            }
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map: map,
                position: placeLoc,
                icon: icon
            });
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            google.maps.event.addListener(marker, 'click', function() {
                //infoWindow.setContent(place.name);
                infoWindow.open(map, this);
                wpc_add_img_bg('.inv-map-post-img-bg img', '.inv-map-post-img-bg');
            });
            google.maps.event.addListener(infoWindow, 'domready', function() {

               // Reference to the DIV which receives the contents of the infowindow using jQuery
               var iwOuter = $('.gm-style-iw');
               var iwBackground = iwOuter.prev();

               iwOuter.children(':nth-child(1)').css({'display' : 'block'});
               // Remove the background shadow DIV
               iwBackground.children(':nth-child(2)').css({'opacity' : '0', 'visibility' : 'hidden'});
               iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'none', 'border': 'none'});
               // Remove the white background DIV
               iwBackground.children(':nth-child(4)').css({'opacity' : '0', 'visibility' : 'hidden'});

                var iwCloseBtn = iwOuter.next();

            // Apply the desired effect to the close button
            iwCloseBtn.css({
              opacity: '1', // by default the close button has an opacity of 0.7
              right: '37px', top: '34px', // button repositioning
              });

            });
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

    if ($('.wpc-map').length > 0) {
            initMap();
            $('.js-map-init').on('click', function () {
            initMap();
        })
    }

    ////////////////////////////
    // ON SCROLL
    ////////////////////////////////
    function onScroll(event) {
        // var scroll_top = $(document).scrollTop();

        var scrollTop = window.pageYOffset,
            scrollMenu = $('.inv-header'),
            hideMenu = $('.inv-top-menus'),
            exploreMap = $('.directory-explore');

        if (scrollTop > 5) {
            scrollMenu.addClass('active-scroll');
            hideMenu.addClass('active-hide');
            exploreMap.addClass('explore-map-fixed');
        }
        else {
            scrollMenu.removeClass('active-scroll');
            hideMenu.removeClass('active-hide');
            exploreMap.removeClass('explore-map-fixed');

        }
        if (scrollTop > winH) {
            $('.toTop').addClass('visible');
        }
        else {
            $('.toTop').removeClass('visible');
        }
    }

    $('a.toTop').on('click', function(e){
        $('html,body').animate({
            scrollTop: 0
        },1000);
        e.preventDefault();
    });

    ////////////////////////////////
    // BACKGROUND BLOCK WITH IMAGES
    ////////////////////////////////
    // backround block with image
    function wpc_add_img_bg2(img_sel, parent_sel) {

        if (!img_sel) {
            console.info('no img selector');
            return false;
        }
        var $parent, _this;

        $(img_sel).each(function() {
            _this = $(this);
            $parent = _this.closest(parent_sel);
            $parent = $parent.length ? $parent : _this.parent();
            $parent.css('background-image', 'url(' + this.src + ')');
            _this.css('visibility', 'hidden');
        });

    }

    function wpc_add_img_bg(img_sel, parent_sel) {

        if (!img_sel) {
            console.info('no img selector');
            return false;
        }
        var $parent, _this;

        $(img_sel).each(function() {
            _this = $(this);
            $parent = _this.closest(parent_sel);
            $parent = $parent.length ? $parent : _this.parent();
            $parent.css('background-image', 'url(' + this.src + ')');
            _this.hide();
        });

    }

    ////////////////////////////////
    // BLOCK HEIGHT
    ////////////////////////////////
    function block_height (items) {
        $(items).matchHeight({
            property: 'height'
        });
    }

    ////////////////////////////
    // MENU
    ////////////////////////////////
    var $first_child_link = $('.menu-item-has-children > a').append('<span class="fa fa-angle-down"></span>');

    $('.nav-menu-icon').on('click', function(e) {
        $(this).toggleClass('active');
        $('.wpc-navigation').toggleClass('active');
        $('html').toggleClass('over-hide');
    });

    $first_child_link.find('span').on( 'click', function(e) {
        $(this).closest('li').siblings('.menu-item.menu-item-has-children').removeClass('active');
        $(this).closest('li').toggleClass('active');
    });

    ///////////////////////////////
    // MENU SEARCH FORM
    ///////////////////////////////

    $('.search-ntn').on('click', function(e) {
        e.preventDefault()
        $('.search-form').addClass('active-search')
            // body...
    })
    $('.close-form-js').on('click', function(e) {
        e.preventDefault()
        $('.search-form').removeClass('active-search')
            // body...
    })

    ///////////////////////////////
    // ICON HEART
    ///////////////////////////////
    $('.inv-places2-head').on('click', 'i.fa', function(e) {
        $(this).toggleClass('fa-heart').toggleClass('fa-heart-o');
        e.preventDefault();
    });

    ///////////////////////////////
    // BUTTON SEARCH
    ///////////////////////////////
    $('#searchList, #searchList2, #searchList3, #searchList4, #searchList5, #searchList6').on('click', function(){
       $(location).attr('href', 'listing.html');
    })

    ///////////////////////////////
    // RATING
    ///////////////////////////////
    $('.wpc-star-rate').raty({
        number: 5,
        half: false,
        starOff: 'fa fa-star-o',
        starOn: 'fa fa-star rated',
        score: function() {
            return $(this).attr('data-score');
        }
    })

    ///////////////////////////////
    // RADIUS BAR
    ///////////////////////////////
        $('.radius .compas').on('click', function() {
          $('.radius__popup').fadeIn();
        })
        $('.radius .radius__close').on('click', function() {
          $('.radius__popup').fadeOut();
        })

        $('.radius__bar').on('change', function () {
          $('.js-radius').html($(this).val());
        })

})(jQuery, window, document);
