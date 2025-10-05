// Run jQuery-dependent behavior only if jQuery is present
if (typeof window.jQuery !== 'undefined') {
    (function ($) {
        "use strict";

        // Spinner
        var spinner = function () {
            setTimeout(function () {
                if ($('#spinner').length > 0) {
                    $('#spinner').removeClass('show');
                }
            }, 1);
        };
        spinner();

        // Initiate the wowjs
        try { new WOW().init(); } catch(e) {}

        // Fixed Navbar
        $(window).scroll(function () {
            if ($(window).width() < 992) {
                if ($(this).scrollTop() > 45) {
                    $('.fixed-top').addClass('bg-dark shadow');
                } else {
                    $('.fixed-top').removeClass('bg-dark shadow');
                }
            } else {
                if ($(this).scrollTop() > 45) {
                    $('.fixed-top').addClass('bg-dark shadow').css('top', -45);
                } else {
                    $('.fixed-top').removeClass('bg-dark shadow').css('top', 0);
                }
            }
        });

        // Back to top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn('slow');
            } else {
                $('.back-to-top').fadeOut('slow');
            }
        });
        $('.back-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
            return false;
        });

        // Causes progress
        $('.causes-progress').waypoint(function () {
            $('.progress .progress-bar').each(function () {
                $(this).css("width", $(this).attr("aria-valuenow") + '%');
            });
        }, {offset: '80%'});

        // Testimonials carousel
        $(".testimonial-carousel").owlCarousel({
            autoplay: false,
            smartSpeed: 1000,
            center: true,
            dots: false,
            loop: true,
            nav : true,
            navText : [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ],
            responsive: {
                0:{ items:1 },
                768:{ items:2 }
            }
        });
    })(jQuery);
} else {
    // Fallback: if jQuery didn't load (e.g., CDN blocked), hide spinner using vanilla JS
    (function(){
        function hideSpinner(){
            var sp = document.getElementById('spinner');
            if (sp) { sp.classList.remove('show'); }
        }
        document.addEventListener('DOMContentLoaded', hideSpinner);
        window.addEventListener('load', hideSpinner);
        setTimeout(hideSpinner, 800);
    })();
}

