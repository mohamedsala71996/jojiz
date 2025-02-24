(function ($) {
    var RESHOP = {};

    var
        $filterGridWrapper = $('.filter__grid-wrapper'),
        $collectionOfFilterBtn = $('.filter__btn'),
        $primarySlider = $('#hero-slider'),
        $navSlider = $('#nav-slider'),
        $testimonialSlider = $('#testimonial-slider'),
        $collectionaClickScroll = $('[data-click-scroll]'),
        $collectionProductSlider = $('.product-slider'),
        $collectionCategorySlider = $('.category-slider'),
        $collectionTabSlider = $('.tab-slider'),
        $collectionInputCounter = $('.input-counter'),
        $collectionCountDown = $('[data-countdown]'),
        $collectionCartModalLink = $('[data-modal="modal"]'),
        $defaultAddressCheckbox = $('#get-address'),
        $collectionFormBill = $('[data-bill]'),
        $collectionPostGallery = $('.post-gallery'),
        $blogMasonry = $('.blog-m'),
        $collectionPostVideo = $('.post-video-block'),
        $collectionEmbedVideo = $('iframe[src*="youtube"]'),
        $productDetailElement = $('#pd-o-initiate'),
        $productDetailElementThumbnail = $('#pd-o-thumbnail'),
        $shopCategoryToggleSpan = $('.shop-w__category-list .has-list > .js-shop-category-span'), // Recursive
        $shopGridBtn = $('.js-shop-grid-target'),
        $shopListBtn = $('.js-shop-list-target'),
        $shopPerspectiveRow = $('.shop-p__collection > div'),
        $shopFilterBtn = $('.js-shop-filter-target');



    RESHOP.initScrollUp = function () {
        $.scrollUp({
            scrollName: 'topScroll',
            scrollText: '<i class="fas fa-long-arrow-alt-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade',
            zIndex: 100
        });
    };

    RESHOP.initScrollSpy = function () {
        var $bodyScrollSpy = $('#js-scrollspy-trigger');
        if ($bodyScrollSpy.length) {
            $bodyScrollSpy.scrollspy({
                target: '#init-scrollspy'
            });
        }
    };

    RESHOP.onClickScroll = function () {
        $collectionaClickScroll.on('click', function (e) {
            e.preventDefault();
            var target = $(this).data('click-scroll');
            if ($(target).length) {
                $('html').animate({
                    scrollTop: $(target).offset().top
                }, 1000, function () { });
            }
        });
    };

    RESHOP.initTooltip = function () {

        $('[data-tooltip="tooltip"]').tooltip({
            trigger: 'hover'
        });
    };

    RESHOP.initModal = function () {
        if ($collectionCartModalLink.length) {
            $collectionCartModalLink.on('click', function () {
                var getElemId = $(this).data('modal-id');
                $(getElemId).modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });


            });
        }

    };

    RESHOP.defaultAddressCheckbox = function () {
        if ($defaultAddressCheckbox.length) {
            $defaultAddressCheckbox.change(function () {
                if (this.checked) {
                    $collectionFormBill.prop("disabled", true);
                    $('#make-default-address').prop("checked", false);
                } else {
                    $collectionFormBill.prop("disabled", false);
                }
            });

        }
    };





    RESHOP.reshopNavigation = function () {
        $('#navigation').shopNav();
        $('#navigation1').shopNav();
        $('#navigation2').shopNav();
        $('#navigation3').shopNav();
    };

    RESHOP.onTabActiveRefreshSlider = function () {
        $('.tab-list [data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var currentID = $(e.target).attr('href');
            $(currentID + '.active').find('.tab-slider').trigger('refresh.owl.carousel');
        });
    };

    RESHOP.primarySlider = function () {
        if ($primarySlider.length) {
            $primarySlider.owlCarousel({
                autoplay: true,
                items: 1,
                loop: true,
                margin: -1,
                dots: false,
                smartSpeed: 1500,
                rewind: false,
                nav:false,
                responsive: {
                    992: {
                        dots: false,
                    }
                }
            });
        }
        
    };

    // top nav slider
    RESHOP.navSlider = function () {
        if ($navSlider.length) {
            $navSlider.owlCarousel({
                autoplay: true,
                items: 1,
                loop: true,
                margin: -1,
                dots: false,
                smartSpeed: 1500,
                rewind: false,
                nav: false,
                responsive: {
                    992: {
                        dots: true
                    }
                }
            });
        }
    };

    RESHOP.productSlider = function () {
        // 0 is falsy value, 1 is truthy
        if ($collectionProductSlider.length) {
            $collectionProductSlider.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).each(function () {
                var thisInstance = $(this);
                var itemPerLine = thisInstance.data('item');
                thisInstance.owlCarousel({
                    autoplay: false,
                    loop: false,
                    dots: false,
                    rewind: true,
                    smartSpeed: 1500,
                    nav: true,
                    navElement: 'div',
                    navClass: ['p-prev', 'p-next'],
                    navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                    responsive: {
                        0: {
                          items: 2,
                        },
                        768: {
                          items: itemPerLine - 3,
                        },
                        991: {
                          items: 4, // Show 4 products on large devices
                        },
                        1200: {
                          items: 6, // Show 5 products on extra-large devices
                        },
                      },
                });
            });
        }
    };


    RESHOP.categorySlider = function () {
        if ($collectionCategorySlider.length) {
            $collectionCategorySlider.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).each(function () {
                var thisInstance = $(this);
                var itemPerLine = thisInstance.data('item');
                thisInstance.owlCarousel({
                    autoplay: true,
                    loop: true,
                    dots: false,
                    rewind: true,
                    smartSpeed: 1500,
                    nav: true,
                    navElement: 'div',
                    navClass: ['p-prev', 'p-next'],
                    navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                    responsive: {
                        0: {
                            items: 4
                        },
                        600: {
                            items: 4
                        },
                        768: {
                            items: itemPerLine + 1
                        },
                        991: {
                            items: itemPerLine + 3
                        },
                        1200: {
                            items: itemPerLine + 3
                        }
                    }
                });
            });
        }
    };


    RESHOP.tabSlider = function () {
        if ($collectionTabSlider.length) {
            $collectionTabSlider.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).each(function () {
                var thisInstance = $(this);
                var itemPerLine = thisInstance.data('item');
                thisInstance.owlCarousel({
                    autoplay: false,
                    loop: false,
                    dots: false,
                    rewind: true,
                    smartSpeed: 1500,
                    nav: true,
                    navElement: 'div',
                    navClass: ['t-prev', 't-next'],
                    navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: itemPerLine - 2
                        },
                        991: {
                            items: itemPerLine - 1
                        },
                        1200: {
                            items: itemPerLine
                        }
                    }
                });
            });
        }
    };

    RESHOP.brandSlider = function () {
        var $brandSlider = $('#brand-slider');
        if ($brandSlider.length) {
            var itemPerLine = $brandSlider.data('item');
            $brandSlider.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).owlCarousel({
                autoplay: false,
                loop: false,
                dots: false,
                rewind: true,
                margin: 10,
                nav: true,
                navElement: 'div',
                navClass: ['b-prev', 'b-next'],
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 3,
                    },
                    991: {
                        items: itemPerLine
                    },
                    1200: {
                        items: itemPerLine
                    }
                }

            });
        }
    };

    RESHOP.testimonialSlider = function () {
        if ($testimonialSlider.length) {
            $testimonialSlider.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).owlCarousel({
                items: 1,
                autoplay: false,
                loop: false,
                dots: true,
                rewind: false,
                smartSpeed: 1500,
                nav: false
            });
        }
    };
    RESHOP.appConfiguration = function () {
        $('body').removeAttr('class');
        $('.preloader').removeClass('is-active');
    };

    RESHOP.isotopeFilter = function () {

        if ($filterGridWrapper.length) {

            $filterGridWrapper.isotope({
                itemSelector: '.filter__item',
                filter: '*'
            });
        }

        if ($collectionOfFilterBtn.length) {
            $collectionOfFilterBtn.on('click', function () {
                var selectorValue = $(this).attr('data-filter');
                var productCount = $(this).attr('data-product-count');
                $filterGridWrapper.isotope({
                    filter: selectorValue
                });

                if (productCount > 1) {
                    console.log(productCount);
                    $('#more-product').css('display', 'block');
                } else {
                    $('#more-product').css('display', 'none');
                }

                $(this).closest('.filter-category-container').find('.js-checked').removeClass('js-checked');
                $(this).addClass('js-checked');


                if ($filterGridWrapper.isotope('getFilteredItemElements').length === 0) {
                    // If no products found, show "No Data Found" message
                    $('#no-products-message').show();
                } else {
                    // Hide "No Data Found" message if products exist
                    $('#no-products-message').hide();
                }
            });
        }
    };

    // RESHOP.isotopeFilter = function () {
    //     if ($filterGridWrapper.length) {
    //         // Initialize Isotope
    //         $filterGridWrapper.isotope({
    //             itemSelector: '.filter__item',
    //             layoutMode: 'fitRows', // Ensure items are arranged properly
    //             filter: '*' // Default to show all items
    //         });
    //     }

    //     if ($collectionOfFilterBtn.length) {
    //         $collectionOfFilterBtn.on('click', function () {
    //             var selectorValue = $(this).attr('data-filter');

    //             // Filter items based on the selected category
    //             $filterGridWrapper.isotope({ filter: selectorValue });

    //             // Get filtered items after applying the filter
    //             var filteredItems = $filterGridWrapper.isotope('getFilteredItemElements');

    //             // Show only the first 12 items
    //             $(filteredItems).each(function (index, item) {
    //                 if (index < 12) {
    //                     $(item).show(); // Show item
    //                 } else {
    //                     $(item).hide(); // Hide item
    //                 }
    //             });

    //             // Handle "More Products" button visibility
    //             if (filteredItems.length > 12) {
    //                 $('#more-product').css('display', 'block'); // Show "More Products" button
    //             } else {
    //                 $('#more-product').css('display', 'none'); // Hide the button
    //             }

    //             // Update active filter button styling
    //             $collectionOfFilterBtn.removeClass('js-checked'); // Remove from all buttons
    //             $(this).addClass('js-checked'); // Add to the clicked button

    //             // Show "No Data Found" message if no products exist
    //             if (filteredItems.length === 0) {
    //                 $('#no-products-message').show(); // Show "No Products" message
    //             } else {
    //                 $('#no-products-message').hide(); // Hide the message
    //             }
    //         });
    //     }
    // };



    RESHOP.timerCountDown = function () {
        if ($collectionCountDown.length) {
            $collectionCountDown.each(function () {
                var $this = $(this),
                    finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    $this.html(event.strftime('<div class="countdown__content"><div><span class="countdown__value">%D</span><span class="countdown__key">Days</span></div></div><div class="countdown__content"><div><span class="countdown__value">%H</span><span class="countdown__key">Hours</span></div></div><div class="countdown__content"><div><span class="countdown__value">%M</span><span class="countdown__key">Mins</span></div></div><div class="countdown__content"><div><span class="countdown__value">%S</span><span class="countdown__key">Secs</span></div></div>'));
                });
            });
        }

    };

    RESHOP.initInputCounter = function () {
        if ($collectionInputCounter.length) {
            $collectionInputCounter.find('.input-counter__plus').on('click', function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) + 1;
                $input.val(count).change();
            });
            $collectionInputCounter.find('.input-counter__minus').on('click', function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                $input.val(count).change();

            });
            $collectionInputCounter.find('input').change(function () {
                var $this = $(this);
                var min = $this.data('min');
                var max = $this.data('max');
                var val = parseInt($this.val());
                if (!val) {
                    val = 1;
                }
                val = Math.min(val, max);
                val = Math.max(val, min);
                $this.val(val);
            });
        }
    };


    RESHOP.blogPostGallery = function () {
        if ($collectionPostGallery.length) {
            $collectionPostGallery.on('initialize.owl.carousel', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            }).each(function () {
                $(this).owlCarousel({
                    items: 1,
                    autoplay: false,
                    loop: false,
                    dots: false,
                    rewind: true,
                    smartSpeed: 1500,
                    nav: true,
                    navElement: 'div',
                    navClass: ['post-prev', 'post-next'],
                    navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                });
            });
        }
    };

    RESHOP.blogPostMasonry = function () {
        if ($blogMasonry.length) {
            $blogMasonry.find('.blog-m-init').isotope({
                itemSelector: '.blog-m__element',
                layoutMode: 'masonry'
            });
        }
    };

    RESHOP.blogPostVideo = function () {
        if ($collectionPostVideo.length) {
            $collectionPostVideo.on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                var myVideo = $this.find('.post-video')[0];
                $(myVideo).on('ended', function () {
                    $this.removeClass('process');
                });
                if (myVideo.paused) {
                    myVideo.play();
                    $(this).addClass('process');
                    if ($(this).hasClass('pause')) {
                        $(this).removeClass('pause');
                    }
                } else {
                    myVideo.pause();
                    $(this).addClass('pause');
                }
            });
        }
    };


    RESHOP.blogPostEmbedVideo = function () {
        if ($collectionEmbedVideo.length) {
            $collectionEmbedVideo.parent().fitVids();
        }
    };





    RESHOP.productDetailInit = function () {
        if ($productDetailElement.length && $productDetailElementThumbnail.length) {

            var ELEVATE_ZOOM_OBJ = {
                borderSize: 1,
                autoWidth: true,
                zoomWindowWidth: 540,
                zoomWindowHeight: 540,
                zoomWindowOffetx: 10,
                borderColour: '#e9e9e9',
                cursor: 'pointer',
            };
            $productDetailElement.on('init', function () {
                $(this).closest('.slider-fouc').removeClass('slider-fouc');
            });

            $productDetailElement.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                arrows: false,
                dots: false,
                fade: true,
                asNavFor: $productDetailElementThumbnail,
            });
            // $('#pd-o-initiate .slick-current img').elevateZoom(ELEVATE_ZOOM_OBJ);

            // $productDetailElement.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            //     var $img = $(slick.$slides[nextSlide]).find('img');
            //     $('.zoomWindowContainer,.zoomContainer').remove();
            //     $($img).elevateZoom(ELEVATE_ZOOM_OBJ);
            // });

            //========= mouse zoom ========
            $(document).ready(function () {
                var isMobileView = window.innerWidth <= 1024;
            
                if (!isMobileView) {
                    $('#pd-o-initiate .slick-current img').elevateZoom(ELEVATE_ZOOM_OBJ);
            
                    $productDetailElement.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                        var $img = $(slick.$slides[nextSlide]).find('img');
                        $('.zoomWindowContainer,.zoomContainer').remove();
                        $($img).elevateZoom(ELEVATE_ZOOM_OBJ);
                    });
                }
            });
            
            

            $productDetailElement.lightGallery({
                selector: '.pd-o-img-wrap',
                download: false,
                thumbnail: false,
                autoplayControls: false,
                actualSize: false,
                hash: false,
                share: false,
            });
            $productDetailElementThumbnail.on('init', function () {
                $(this).closest('.slider-fouc').removeAttr('class');
            });

            $productDetailElementThumbnail.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                arrows: true,
                dots: false,
                focusOnSelect: true,
                asNavFor: $productDetailElement,
                prevArrow: '<div class="pt-prev"><i class="fas fa-angle-left"></i>',
                nextArrow: '<div class="pt-next"><i class="fas fa-angle-right"></i>',
                responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    }
                }
                ]
            });
        }
    };

    RESHOP.shopCategoryToggle = function () {
        if ($shopCategoryToggleSpan.length) {
            $shopCategoryToggleSpan.on('click', function () {
                $(this).toggleClass('is-expanded');
                $(this).next('ul').stop(true, true).slideToggle();
            });
        }
    };

    RESHOP.shopPerspectiveChange = function () {
        if ($shopGridBtn.length && $shopListBtn.length) {
            $shopGridBtn.on('click', function () {
                $(this).addClass('is-active');
                $shopListBtn.removeClass('is-active');
                $shopPerspectiveRow.removeClass('is-list-active');
                $shopPerspectiveRow.addClass('is-grid-active');
            });
            $shopListBtn.on('click', function () {
                $(this).addClass('is-active');
                $shopGridBtn.removeClass('is-active');
                $shopPerspectiveRow.removeClass('is-grid-active');
                $shopPerspectiveRow.addClass('is-list-active');
            });
        }
    };
    RESHOP.shopSideFilter = function () {
        if ($shopFilterBtn.length) {
            $shopFilterBtn.on('click', function () {
                $(this).toggleClass('is-active');
                var target = $(this).attr('data-side');
                $(target).toggleClass('is-open');
            });
        }
    };

    $(window).on('load', function () {
        if ($primarySlider.length) {
            $primarySlider.data('owl.carousel').options.autoplay = true;
            $primarySlider.trigger('refresh.owl.carousel');
        }
    });


    RESHOP.initScrollUp();
    RESHOP.initTooltip();
    RESHOP.initModal();
    RESHOP.defaultAddressCheckbox();
    RESHOP.initScrollSpy();
    RESHOP.onClickScroll();
    RESHOP.reshopNavigation();
    RESHOP.primarySlider();
    RESHOP.productSlider();
    RESHOP.categorySlider();
    RESHOP.tabSlider();
    RESHOP.onTabActiveRefreshSlider();
    RESHOP.brandSlider();
    RESHOP.testimonialSlider();
    RESHOP.appConfiguration();
    RESHOP.isotopeFilter();
    RESHOP.timerCountDown();
    RESHOP.initInputCounter();
    RESHOP.blogPostGallery();
    RESHOP.blogPostVideo();
    RESHOP.blogPostEmbedVideo();
    RESHOP.blogPostMasonry();
    RESHOP.productDetailInit();
    RESHOP.shopCategoryToggle();
    RESHOP.shopPerspectiveChange();
    RESHOP.shopSideFilter();

    $('.input-counter__minus').click(function (e) {
        e.preventDefault();
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        $input.val(count).change();
    });
})(jQuery);
