jQuery(function($) {

    /* -----------------------------------------
    Floating Header
    ----------------------------------------- */
    if ( $("body").hasClass("floating-header") ){
        const header = document.querySelector('.adore-header');
        var lastScroll = 0;
        window.onscroll = function() {
            if (window.pageYOffset > 200) {
                header.classList.add('fix-header');
                setTimeout(function() { //give them a second to finish scrolling before doing a check
                    var scroll = $(window).scrollTop();
                    if (scroll > lastScroll + 30) {
                        $("body").removeClass("scroll-up");
                    } else if (scroll < lastScroll - 30) {
                        $("body").addClass("scroll-up");
                    }
                    lastScroll = scroll;
                }, 1000);
            } else {
                header.classList.remove('fix-header');
            }
        };
        $(window).on('load resize', function() {
            $(document).ready(function() {
                var divHeight = $('.bottom-header-part').height();
                $('.bottom-header-outer-wrapper').css('min-height', divHeight + 'px');
            });
        });
    }

/* -----------------------------------------
Post Carousel
----------------------------------------- */
    $('.5-column.post-carousel-wrapper').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
        slidesToShow: 5,
        nextArrow: null,
        prevArrow: null,
        responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
    });
    $('.4-column.post-carousel-wrapper').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        nextArrow: null,
        prevArrow: null,
        responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
    });
    $('.3-column.post-carousel-wrapper').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
        slidesToShow: 3,
        nextArrow: null,
        prevArrow: null,
        responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
    });
    $('.2-column.post-carousel-wrapper').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
        slidesToShow: 2,
        nextArrow: null,
        prevArrow: null,
        responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
    });

});