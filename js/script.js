var $grid;

(function($) {
    'use strict';

    var fns = {
        menuAnimate: function() {
            $('.main-navigation').html($('.navigation-full').html());
            $('.toggle-mobile-menu').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $('.main-navigation').removeClass('main-nav-open');
                } else {
                    $(this).addClass('active');
                    $('.main-navigation').addClass('main-nav-open');
                }
            });
            $(document).click(function(e) {
                if ($('.main-navigation').hasClass('main-nav-open')) {
                    e.stopPropagation();
                    $('.toggle-mobile-menu').removeClass('active');
                    $('.main-navigation').removeClass('main-nav-open');
                }
            });
        },
        searchAnimate: function() {
            var header = $('.site-header');
            var trigger = $('#trigger-overlay');
            var overlay = header.find('.overlay');
            var input = header.find('.hideinput, .header-search .fa-search');
            trigger.click(function(e) {
                $(this).hide();
                overlay.addClass('open').find('input').focus();
            });
            $('.overlay-close').click(function(e) {
                $('.site-header .overlay').addClass('closed').removeClass('open');
                setTimeout(function() {
                    $('.site-header .overlay').removeClass('closed');
                },
                400);
                $('#trigger-overlay').show();
            });
            $(document).on('click',
            function(e) {
                var target = $(e.target);
                if (target.is('.overlay') || target.closest('.overlay').length) return true;
                $('.site-header .overlay').addClass('closed').removeClass('open');
                setTimeout(function() {
                    $('.site-header .overlay').removeClass('closed');
                },
                400);
                $('#trigger-overlay').show();
            });
            $('#trigger-overlay').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        },
        hotNews: function() {
            $('#slider-hot-news a').each(function() {
                var title = $(this).attr('title');
                $(this).find('img:first').attr('title', title);
            });
            $('#slider-hot-news').nivoSlider();
            var $li = $('#hothit_news_tab li');
            var $ul = $('#hothit_news_content ul');
            $li.mouseover(function() {
                var $this = $(this);
                var $t = $this.index();
                $li.removeClass();
                $this.addClass('current');
                $ul.css('display', 'none');
                $ul.eq($t).css('display', 'block');
            })
        },
        skipLinkFocusFix: function() {
            var is_webkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
            is_opera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
            is_ie = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

            if ((is_webkit || is_opera || is_ie) && document.getElementById && window.addEventListener) {
                window.addEventListener('hashchange',
                function() {
                    var id = location.hash.substring(1),
                    element;
                    if (! (/^[A-z0-9_-]+$/.test(id))) return;
                    element = document.getElementById(id);
                    if (element) {
                        if (! (/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                            element.tabIndex = -1;
                        }
                        element.focus();
                    }
                },
                false);
            }
        },       
        specialEffect:function(){
                $("#masonry-container").delegate(".item","mouseover",
                        function(){ $(this).find('h2 a').css("color","#ee5b2e");}
                );
                $("#masonry-container").delegate(".item","mouseout",
                        function(){$(this).find('h2 a').css("color","#333");}
                );
        }      
    };
    $(function() {
        fns.hotNews();
        fns.skipLinkFocusFix();
        fns.menuAnimate();
        fns.searchAnimate();
        fns.specialEffect();
       
    });   
})(jQuery);