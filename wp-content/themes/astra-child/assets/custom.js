jQuery(document).ready(function(){
    jQuery('.featured-content__block-wrapper .featured-content-wrapper').slick({
        dots: false,
        infitnite: false,
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });



    jQuery('#new-main-menu-btn').click(function(){
        jQuery(this).toggleClass('menu-toggled');
        jQuery('#myTopnav').toggle();
    });




    if (jQuery('.ast-merged-advanced-header').length) {
        jQuery('#content').addClass('with-fixed-header');
    }

    jQuery('a[href^="#"]').click(function () {
        let val = jQuery('[name="' + jQuery.attr(this, 'href').substr(1) + '"]').offset().top - 200;

        jQuery('html, body').animate({
            scrollTop: val
        }, 500);

        jQuery('.leftsidebar-menu a').removeClass('active');
        jQuery(this).addClass('active');

        return false;
    });

    jQuery('.leftsidebar-menu li:first-child a').addClass('active');

    if (jQuery('.leftsidebar-menu').length) {

        jQuery(window).scroll(function(){
            let windowScrollTop = jQuery(window).scrollTop();
            setActive(windowScrollTop)
        })

        function setActive(windowScrollTop) {
            jQuery('.entry-content h2[id], .entry-content h3[id], .entry-content h4[id]').each(function(){
                let title = jQuery(this);
                let titleOffset = title.offset();
                let titleOffsetTop = titleOffset.top;
                let titleId = title.attr('id');

                if (windowScrollTop >= titleOffsetTop) {
                    jQuery('.leftsidebar-menu li a').each(function(){
                        jQuery(this).removeClass('active');

                        let id = jQuery(this).attr('href');
                        id = id.replace('#', '');

                        if (id == titleId) {
                            jQuery(this).addClass('active');
                        }
                    });
                }
            });
        }
    }

    jQuery('.tabs__item').each(function (){
        let color = jQuery(this).attr('data-color');
        jQuery(this).find('.tabs__line').addClass(color);
    });
    jQuery('.tabs__inner').closest('.has-background').addClass('tabs-section-bg');
    jQuery('.tabs__item:first-child').addClass('active');
    jQuery('.tabs__item').on('mouseenter', function (event) {
        let target = jQuery(event.target);
        if (!target.hasClass('tabs__item')) {
            target = target.closest('.tabs__item')
        }
        let targetId = target.attr('data-tab-index');
        let targetColor = target.attr('data-color');
        jQuery('.tabs__inner').closest('.has-background').removeClass('lightblue');
        jQuery('.tabs__inner').closest('.has-background').removeClass('mushroom');
        jQuery('.tabs__inner').closest('.has-background').removeClass('charcoal mint');
        jQuery('.tabs__inner').closest('.has-background').removeClass('mint');
        target.closest('.has-background').addClass(targetColor);
        jQuery('.tabs__item').removeClass('active');
        jQuery('.tabs__item[data-tab-index="' + targetId + '"]').addClass('active');
    });


    if (jQuery('.accordion-main-wrapper').length) {
        jQuery('.accordion-title-main-wrapper').each(function(){
            jQuery(this).closest('.wp-block-columns').siblings('.wp-block-columns').css('display', 'none');
        });

        jQuery('.accordion-title-main-wrapper').click(function(){
            jQuery(this).toggleClass('clicked');
            jQuery(this).closest('.wp-block-columns').siblings('.wp-block-columns').toggle();
        });
    }
    
    jQuery('#top-navigation-primary li').each(function(){
        jQuery(this).hover(function(event){
            if (jQuery(this).attr('id') != 'menu-item-12037') {
                jQuery('.second-menu').removeClass('visible');
            } else {
                jQuery('.second-menu').addClass('visible');
            }
        });
    });

    jQuery('.second-menu').hover(function(){
        jQuery('.second-menu').addClass('visible');
    });
    jQuery('.second-menu').mouseleave(function(event){
        jQuery('.second-menu').removeClass('visible');
    });
});

