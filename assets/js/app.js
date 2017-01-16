/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    content,
    $slider,
    $root = '/new';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {
                app.sizeSet();
            });
            $(document).ready(function($) {
                $body = $('body');
                $header = $('header');
                app.sizeSet();
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    content = State.data;
                    if (content.type == 'project') {
                        if ($slider) {
                            $slider.flickity('stopPlayer');
                        }
                        $body.attr('class', 'project-page loading');
                        $header.removeClass('opened');
                        app.loadContent(State.url, $('#content-container'), '#content-container .inner');
                    } else if (content.type == 'contact') {
                        $body.addClass('contact-page');
                        app.loadContent(State.url, $('#contact-container'), '#contact-container .inner');
                    } else {
                        app.goIndex();
                    }
                });
                $body.on('click', '[data-target]:not(".gallery-cell")', function(event) {
                    event.preventDefault();
                    var $el = $(this);
                    var target = $el.data('target');
                    if (target == 'project') {
                        if ($slider) {
                            $slider.flickity('stopPlayer');
                        }
                        $slider.flickity('selectCell', '[data-id="' + $el.data("id") + '"]');
                        $body.hasClass('project-page') ? timing = 0 : timing = 500;
                        setTimeout(function() {
                            History.pushState({
                                type: 'project'
                            }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                        }, timing);
                    } else if (target == 'contact') {
                        History.pushState({
                            type: 'contact'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else if (target == 'index') {
                        if ($body.hasClass('contact-page')) {
                            app.goIndex();
                        } else if ($el.is('#page-close')) {
                            app.goIndex();
                        } else {
                            $header.toggleClass('opened');
                        }
                    }
                });
                $body.on('click', '.kirby-plugin-oembed__thumb', function(event) {
                    event.preventDefault();
                    var wrapper = $(this).parent();
                    var embed = wrapper.find('iframe');
                    embed.attr('src', embed.data('src'));
                    $(this).remove();
                });
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                $(document).keyup(function(e) {
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                });
                //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                $(window).load(function() {
                    app.loadSlider();
                    app.mouseNav();
                    app.parallax();
                    $(".loader").fadeOut("fast");
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            $header.attr('style', '');
            $header.height($header.outerHeight(true));
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    isMobile = false;
                    //location.reload();
                }
            }
        },
        mouseNav: function(event) {
            if (!isMobile) {
                $(window).mousemove(function(event) {
                    posX = event.pageX;
                    posY = event.pageY;
                    $('#mouse-title').css({
                        top: posY,
                        left: posX
                    });
                    if (posX < width / 5) {
                        $body.removeClass('hover-right hover-center').addClass('hover-left');
                    } else if (posX > (width * 4 / 5)) {
                        $body.removeClass('hover-left hover-center').addClass('hover-right');
                    } else {
                        $body.removeClass('hover-left hover-right').addClass('hover-center');
                    }
                });
            }
        },
        loadSlider: function() {
            $slider = $('#projects-overview').flickity({
                cellSelector: '.gallery-cell',
                imagesLoaded: true,
                lazyLoad: 1,
                bgLazyLoad: 1,
                setGallerySize: false,
                autoPlay: 5000,
                //percentPosition: false,
                // selectedAttraction: 0.03,
                // friction: 0.5,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: false,
                pageDots: false,
                draggable: Modernizr.touchevents
            });
            flkty = $slider.data('flickity');
            if ($body.hasClass('project-page') && $slider) {
                $slider.flickity('stopPlayer');
            }
            $mouse_title = $('#mouse-title span');
            $slider.flickity('selectCell', '[data-id="' + $('#projects-overview').data("id") + '"]', true, true);
            selectProject();
            $slider.on('select.flickity', function() {
                selectProject();
            });
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement) {
                    return;
                }
                if (isMobile) {
                    if ($body.hasClass('hover-left')) {
                        app.goPrev($slider);
                    } else if ($body.hasClass('hover-right')) {
                        app.goNext($slider);
                    } else {
                        var $el = $(flkty.selectedElement);
                        History.pushState({
                            type: 'project'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    }
                }
            });
            $slider.click(function(event) {
                if (!isMobile) {
                  event.preventDefault();
                    if ($body.hasClass('hover-left')) {
                        app.goPrev($slider);
                    } else if ($body.hasClass('hover-right')) {
                        app.goNext($slider);
                    } else {
                        var $el = $(flkty.selectedElement);
                        History.pushState({
                            type: 'project'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    }
                }
            });
            $nav = $('nav#projects.sliding').flickity({
                cellSelector: '.cell',
                //percentPosition: false,
                // selectedAttraction: 0.03,
                // friction: 0.5,
                accessibility: false,
                prevNextButtons: false
            });

            function selectProject() {
                if (flkty) {
                    var projectTitle = $(flkty.selectedElement).attr('data-title');
                    if (typeof projectTitle !== typeof undefined && projectTitle !== false) {
                        $mouse_title.html(projectTitle);
                    }
                }
            }
        },
        goNext: function($slider) {
            if (!$body.hasClass('project-page')) {
                $slider.flickity('next', false);
            }
        },
        goPrev: function($slider) {
            if (!$body.hasClass('project-page')) {
                $slider.flickity('previous', false);
            }
        },
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
            $header.removeClass('opened');
            $body.attr('class', 'home');
            setTimeout(function() {
                app.sizeSet();
                $('#content-container').empty();
                if ($slider) {
                    $slider.flickity('playPlayer');
                }
            }, 1000);
        },
        loadContent: function(url, target, container) {
            setTimeout(function() {
                $body.scrollTop(0);
                $(target).load(url + ' ' + container, function(response) {
                    if (content.type == 'project') {
                        setTimeout(function() {
                            $body.addClass('loaded').removeClass('loading');
                            app.parallax();
                        }, 100);
                    }
                });
            }, 1000);
        },
        parallax: function() {
            var $parallaxItems = $(".content-item"); //elements
            var fixer = 0.0008; //experiment with the value
            $("#content-container").on("mousemove", function(event) {
                if (!isMobile) {
                    var pageX = event.pageX - (width * 0.5); //get the mouseX - negative on left, positive on right
                    var pageY = event.pageY - (height * 0.5); //same here, get the y. use console.log(pageY) to see the values
                    //here we move each item
                    $parallaxItems.each(function() {
                        var item = $(this);
                        var speedX = item.data("x");
                        var speedY = item.data("y");
                        /*TweenLite.to(item, 0.5, {
                          x: (item.position().left + pageX * speedX )*fixer,    //calculate the new X based on mouse position * speed 
                          y: (item.position().top + pageY * speedY)*fixer
                        });*/
                        //or use set - not so smooth, but better performance
                        TweenLite.set(item, {
                            x: (item.position().left + pageX * speedX) * fixer,
                            y: (item.position().top + pageY * speedY) * fixer
                        });
                    });
                }
            });
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
        }
    };
    app.init();
});