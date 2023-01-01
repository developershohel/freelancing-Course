/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014 Twitter, Inc.
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see http://creativecommons.org/licenses/by/3.0/.
 */

// See the Getting Started docs for more information:
// http://getbootstrap.com/getting-started/#support-ie10-width

(function () {
  'use strict';
  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
      document.createTextNode(
        '@-ms-viewport{width:auto!important}'
      )
    )
    document.querySelector('head').appendChild(msViewportStyle)
  }
})();

/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('name')){
          var videoName = 'fitvid' + $.fn.fitVids._count;
          $this.attr('name', videoName);
          $.fn.fitVids._count++;
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
  
  // Internal counter for unique video names.
  $.fn.fitVids._count = 0;
  
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

/*! npm.im/object-fit-images 3.2.3 */
var objectFitImages = (function () {
'use strict';

var OFI = 'bfred-it:object-fit-images';
var propRegex = /(object-fit|object-position)\s*:\s*([-\w\s%]+)/g;
var testImg = typeof Image === 'undefined' ? {style: {'object-position': 1}} : new Image();
var supportsObjectFit = 'object-fit' in testImg.style;
var supportsObjectPosition = 'object-position' in testImg.style;
var supportsOFI = 'background-size' in testImg.style;
var supportsCurrentSrc = typeof testImg.currentSrc === 'string';
var nativeGetAttribute = testImg.getAttribute;
var nativeSetAttribute = testImg.setAttribute;
var autoModeEnabled = false;

function createPlaceholder(w, h) {
	return ("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='" + w + "' height='" + h + "'%3E%3C/svg%3E");
}

function polyfillCurrentSrc(el) {
	if (el.srcset && !supportsCurrentSrc && window.picturefill) {
		var pf = window.picturefill._;
		// parse srcset with picturefill where currentSrc isn't available
		if (!el[pf.ns] || !el[pf.ns].evaled) {
			// force synchronous srcset parsing
			pf.fillImg(el, {reselect: true});
		}

		if (!el[pf.ns].curSrc) {
			// force picturefill to parse srcset
			el[pf.ns].supported = false;
			pf.fillImg(el, {reselect: true});
		}

		// retrieve parsed currentSrc, if any
		el.currentSrc = el[pf.ns].curSrc || el.src;
	}
}

function getStyle(el) {
	var style = getComputedStyle(el).fontFamily;
	var parsed;
	var props = {};
	while ((parsed = propRegex.exec(style)) !== null) {
		props[parsed[1]] = parsed[2];
	}
	return props;
}

function setPlaceholder(img, width, height) {
	// Default: fill width, no height
	var placeholder = createPlaceholder(width || 1, height || 0);

	// Only set placeholder if it's different
	if (nativeGetAttribute.call(img, 'src') !== placeholder) {
		nativeSetAttribute.call(img, 'src', placeholder);
	}
}

function onImageReady(img, callback) {
	// naturalWidth is only available when the image headers are loaded,
	// this loop will poll it every 100ms.
	if (img.naturalWidth) {
		callback(img);
	} else {
		setTimeout(onImageReady, 100, img, callback);
	}
}

function fixOne(el) {
	var style = getStyle(el);
	var ofi = el[OFI];
	style['object-fit'] = style['object-fit'] || 'fill'; // default value

	// Avoid running where unnecessary, unless OFI had already done its deed
	if (!ofi.img) {
		// fill is the default behavior so no action is necessary
		if (style['object-fit'] === 'fill') {
			return;
		}

		// Where object-fit is supported and object-position isn't (Safari < 10)
		if (
			!ofi.skipTest && // unless user wants to apply regardless of browser support
			supportsObjectFit && // if browser already supports object-fit
			!style['object-position'] // unless object-position is used
		) {
			return;
		}
	}

	// keep a clone in memory while resetting the original to a blank
	if (!ofi.img) {
		ofi.img = new Image(el.width, el.height);
		ofi.img.srcset = nativeGetAttribute.call(el, "data-ofi-srcset") || el.srcset;
		ofi.img.src = nativeGetAttribute.call(el, "data-ofi-src") || el.src;

		// preserve for any future cloneNode calls
		// https://github.com/bfred-it/object-fit-images/issues/53
		nativeSetAttribute.call(el, "data-ofi-src", el.src);
		if (el.srcset) {
			nativeSetAttribute.call(el, "data-ofi-srcset", el.srcset);
		}

		setPlaceholder(el, el.naturalWidth || el.width, el.naturalHeight || el.height);

		// remove srcset because it overrides src
		if (el.srcset) {
			el.srcset = '';
		}
		try {
			keepSrcUsable(el);
		} catch (err) {
			if (window.console) {
				console.warn('https://bit.ly/ofi-old-browser');
			}
		}
	}

	polyfillCurrentSrc(ofi.img);

	el.style.backgroundImage = "url(\"" + ((ofi.img.currentSrc || ofi.img.src).replace(/"/g, '\\"')) + "\")";
	el.style.backgroundPosition = style['object-position'] || 'center';
	el.style.backgroundRepeat = 'no-repeat';
	el.style.backgroundOrigin = 'content-box';

	if (/scale-down/.test(style['object-fit'])) {
		onImageReady(ofi.img, function () {
			if (ofi.img.naturalWidth > el.width || ofi.img.naturalHeight > el.height) {
				el.style.backgroundSize = 'contain';
			} else {
				el.style.backgroundSize = 'auto';
			}
		});
	} else {
		el.style.backgroundSize = style['object-fit'].replace('none', 'auto').replace('fill', '100% 100%');
	}

	onImageReady(ofi.img, function (img) {
		setPlaceholder(el, img.naturalWidth, img.naturalHeight);
	});
}

function keepSrcUsable(el) {
	var descriptors = {
		get: function get(prop) {
			return el[OFI].img[prop ? prop : 'src'];
		},
		set: function set(value, prop) {
			el[OFI].img[prop ? prop : 'src'] = value;
			nativeSetAttribute.call(el, ("data-ofi-" + prop), value); // preserve for any future cloneNode
			fixOne(el);
			return value;
		}
	};
	Object.defineProperty(el, 'src', descriptors);
	Object.defineProperty(el, 'currentSrc', {
		get: function () { return descriptors.get('currentSrc'); }
	});
	Object.defineProperty(el, 'srcset', {
		get: function () { return descriptors.get('srcset'); },
		set: function (ss) { return descriptors.set(ss, 'srcset'); }
	});
}

function hijackAttributes() {
	function getOfiImageMaybe(el, name) {
		return el[OFI] && el[OFI].img && (name === 'src' || name === 'srcset') ? el[OFI].img : el;
	}
	if (!supportsObjectPosition) {
		HTMLImageElement.prototype.getAttribute = function (name) {
			return nativeGetAttribute.call(getOfiImageMaybe(this, name), name);
		};

		HTMLImageElement.prototype.setAttribute = function (name, value) {
			return nativeSetAttribute.call(getOfiImageMaybe(this, name), name, String(value));
		};
	}
}

function fix(imgs, opts) {
	var startAutoMode = !autoModeEnabled && !imgs;
	opts = opts || {};
	imgs = imgs || 'img';

	if ((supportsObjectPosition && !opts.skipTest) || !supportsOFI) {
		return false;
	}

	// use imgs as a selector or just select all images
	if (imgs === 'img') {
		imgs = document.getElementsByTagName('img');
	} else if (typeof imgs === 'string') {
		imgs = document.querySelectorAll(imgs);
	} else if (!('length' in imgs)) {
		imgs = [imgs];
	}

	// apply fix to all
	for (var i = 0; i < imgs.length; i++) {
		imgs[i][OFI] = imgs[i][OFI] || {
			skipTest: opts.skipTest
		};
		fixOne(imgs[i]);
	}

	if (startAutoMode) {
		document.body.addEventListener('load', function (e) {
			if (e.target.tagName === 'IMG') {
				fix(e.target, {
					skipTest: opts.skipTest
				});
			}
		}, true);
		autoModeEnabled = true;
		imgs = 'img'; // reset to a generic selector for watchMQ
	}

	// if requested, watch media queries for object-fit change
	if (opts.watchMQ) {
		window.addEventListener('resize', fix.bind(null, imgs, {
			skipTest: opts.skipTest
		}));
	}
}

fix.supportsObjectFit = supportsObjectFit;
fix.supportsObjectPosition = supportsObjectPosition;

hijackAttributes();

return fix;

}());

jQuery(document).ready(function($) {

    ;(function () {
        var $navbarFixed = $('.op-navbar.op-navbar-fixed');
        var $removableTop = $('.op-removable-top');
        var $wpAdminBar = $('#wpadminbar');
        var animateTimeout;
        var removableTop = document.querySelector('.op-removable-top');
        var currentRemovableTopAfterContent = '';
        var currentWpAdminBarPosition = '';
        var currentWpAdminBarHeight = $wpAdminBar.height();

        if (removableTop) {
            currentRemovableTopAfterContent = window.getComputedStyle(removableTop, '::after').getPropertyValue('content');
        }

        if ($navbarFixed.length === 0) {
            return false;
        }

        /**
         * Calculates the position of site header;
         *
         */
        function set_fixed_header() {

            var forceRecalculation = false;
            var removableTopHeight = $removableTop.outerHeight();
            var removableTopAfterContent = '';
            var removableTopHeight = 0;
            removableTopOuterHeight = 0;
            var navbarFixedHeight;
            var wpAdminBarFixedHeight = $wpAdminBar.css('position') === 'fixed' ? $wpAdminBar.height() : 0;

            // We tie up the removableTop element (which
            // should be hidden on mobile) to the
            // media query in css (text applied
            // via content css atribute
            // enables us to do this)
            if (removableTop) {
                removableTopAfterContent = window.getComputedStyle(document.querySelector('.op-removable-top'), '::after').getPropertyValue('content');
            }


            // In some cases we need to force racalculation of menu position
            // ...when menu changes due to OP grid changes
            if (removableTopAfterContent !== currentRemovableTopAfterContent) {
                currentRemovableTopAfterContent = removableTopAfterContent;
                forceRecalculation = true;
            }

            // ...when position of the wp admin bar changes
            if (currentWpAdminBarPosition !== $wpAdminBar.css('position')) {
                forceRecalculation = true;
                currentWpAdminBarPosition = $wpAdminBar.css('position');
            }

            // ...or when wp admin bar height changes
            if (currentWpAdminBarHeight !== $wpAdminBar.height()) {
                forceRecalculation = true;
                currentWpAdminBarHeight = $wpAdminBar.height();
            }

            // We position the menu as fixed
            // when the user scrolls below
            // 100px on the screen
            if ($(window).scrollTop() > $navbarFixed.height()) {

                if (!$navbarFixed.hasClass('fixed') || forceRecalculation) {

                    $navbarFixed.addClass('fixed');
                    removableTopOuterHeight = $removableTop.length > 0 ? $removableTop.outerHeight() : 0;
                    navbarFixedHeight = $navbarFixed.height();
                    removableTopHeight = removableTopAfterContent.indexOf('op-removable-top-hidden') > -1 ? 0 : removableTopOuterHeight;

                    // Negative margin is here as a help for animating
                    // the element. CSS transition is set to 'top'
                    // so we instantly position the nav outside
                    // of the screen with marginTop, and then
                    // setting top triggers CSS transition
                    $navbarFixed.css({
                        marginTop: -navbarFixedHeight,
                        top: navbarFixedHeight + wpAdminBarFixedHeight - removableTopHeight
                    });

                }

            } else {

                // If WP admin bar is fixed, we need
                // to take into account its height
                if ($wpAdminBar.css('position') !== 'fixed') {
                    wpAdminBarFixedHeight = $wpAdminBar.height();
                }

                // If the user is not logged in, there is no admin bar
                if (typeof wpAdminBarFixedHeight !== "number") wpAdminBarFixedHeight = 0;

                $navbarFixed.css({
                    marginTop: 0,
                    top: 0 + wpAdminBarFixedHeight
                }).removeClass('fixed');

            }
        }

        // We set the position of the site header with
        // a timeout to ensure jank-free experience
        var eventTimeout;
        $(window).on('scroll resize', function () {
            clearTimeout(eventTimeout);
            eventTimeout = setTimeout(function () {
                set_fixed_header();
            }, 100);
        });

        // Set the header immediately
        // when the page is opened
        set_fixed_header();
    }());


    var topVal;
    var $opEntry = $('#primary > .op-entry');

    if ($opEntry.length > 0) {
        var opEntryPadding = parseInt($opEntry.css('padding-top'), 10);
        var entryOffset = $opEntry.offset().top + opEntryPadding;
        var $fixedDynamic = $('.fixed-dynamic');
        var fixedDynamicPosition = $fixedDynamic.hasClass('left') ? 'left' : 'right';
        var $navbarFixed = $('.op-navbar.op-navbar-fixed');
        // if ($('#wpadminbar').length) {
        //     top = $('#wpadminbar').height();
        // }

        var onScroll = function () {
            opEntryPadding = parseInt($opEntry.css('padding-top'), 10);
            entryOffset = $opEntry.offset().top + opEntryPadding;
            topVal = entryOffset - $(window).scrollTop();
            if ($navbarFixed.length > 0) {
                opEntryPadding = opEntryPadding + $navbarFixed.outerHeight();
            }

            if (topVal < opEntryPadding) {
                topVal = opEntryPadding;
            }
            $fixedDynamic.css({top: topVal});
        }

        if ($fixedDynamic.length > 0) {
            if (fixedDynamicPosition === 'left') {
                $('#primary .op-entry > .row, #colophon .op-footer').addClass('fixed-dynamic-content-padding-left');
            } else {
                $('#primary .op-entry > .row, #colophon .op-footer .op-container > .row,  .optin-box-optimizetheme-before-footer').addClass('fixed-dynamic-content-padding-' + fixedDynamicPosition);
            }
            $(window).unbind('scroll', onScroll);
            $(window).unbind('resize', onScroll);
            $(window).bind('scroll', onScroll).trigger('scroll');
            $(window).bind('resize', onScroll).trigger('scroll');
        }
    }

    function set_sm_fixed() {
        if ($(".sm-wrap").hasClass("no") == 'false') {
            if ($(window).width() < 1268) {
                $('.sm-wrap').removeClass('fixed-dynamic');
            } else {
                $('.sm-wrap').addClass('fixed-dynamic');
            }
        }
    }

    set_sm_fixed();

    $(window).bind('resize', function () {
        set_sm_fixed();
    });

    $('.op-navbar .nav-close-wrap .closenav').click(function () {
        $('.op-navbar #navbar').animate({'right': '100%'}, 'fast');
    });

    $('.op-navbar .navbar-toggle').click(function () {
        $('.op-navbar #navbar').animate({'right': 0}, 'fast');
    });

    $("#op_search_link").click(function () {
        op_do_search_toggle();
        return false;
    });

    $("#op_remove_search_link").click(function () {
        // $(".op-search-form-top-menu").val('');
        op_do_search_toggle();
        return false;
    });

    // $( ".menu-item-search-form, .menu-item-remove-search-link, .divider-top-menu-first" ).addClass('menu-item-hidden');
    function op_do_search_toggle() {
        $('.op-navbar .menu-item:not(.menu-item-search-form)').toggleClass('menu-item-hidden');
        $('.op-navbar .menu-item-search-form .menu-item-search-toggle').toggleClass('menu-item-hidden');
        // $( ".menu-item-type-post_type, .menu-item-type-custom, .menu-item-type-taxonomy" ).toggleClass('menu-item-hidden'); /*'on' by default*/
        // $( ".menu-item-search-form, .menu-item-remove-search-link, .divider-top-menu-first" ).toggleClass('menu-item-hidden'); /*'off' by default*/

        var $topMenu = $('.op-navbar  .menu-item-search-form .op-search-form-top-menu');
        if ($topMenu.is(':visible')) {
            $topMenu.focus();
        }
    }

    // Fitvids - makes all embeded videos play nicely,
    // but doesn't touch OP videos, since they're
    // already handled on OP side
    $("#primary").fitVids({ignore: '.video-plugin-new, .video-plugin-frame, .op3-video-wrapper'});

    // Swipebox gallery
    //$('.op-hero-gallery .gallery-item a').swipebox();


    // Menu enhancments + mobile functionality
    ;(function () {

        var $navbar = $('.navbar-nav');

        if (!("ontouchstart" in window) && !(navigator.msMaxTouchPoints)) {
            $('body').addClass('op-not-touch-device');
        }

        /**
         * Checks if submenu dropdown is out
         * of the bounds of the screen,
         * and if so, it positions
         * it the opposite side
         * of the screen
         *
         * @param jQuery element
         * @return void
         */
        var checkSubmenuPosition = function ($el) {
            var $subMenu = $el.find('> .sub-menu');

            if ($subMenu.length === 0) {
                return false;
            }

            // If submenu is out of bounds to the left
            // (when submenu is flowing to the left)
            if ($subMenu.hasClass('sub-menu--alt') && $subMenu.offset().left < 0) {

                $subMenu.removeClass('sub-menu--alt')
                    .find('.sub-menu').removeClass('sub-menu--alt');

                // If submenu is out of the bounds to the right
                // (when positioned to the right)
            } else if ($subMenu.offset().left + $subMenu.outerWidth() > window.innerWidth) {

                $subMenu.addClass('sub-menu--alt')
                    .find('.sub-menu').addClass('sub-menu--alt');

            }
        }

        var menuTimeoutDuration = 600;

        $navbar.find('.menu-item-has-children').each(function () {
            var $this = $(this);
            var menuTimeout;

            if (!("ontouchstart" in window) && !(navigator.msMaxTouchPoints)) {

                // not a touch device
                $this
                    .on('mouseenter', function () {
                        clearTimeout(menuTimeout);
                        // $navbar.find('.menu-item--hover').removeClass('menu-item--hover');
                        $this.siblings('.menu-item--hover').removeClass('menu-item--hover');
                        $this.addClass('menu-item--hover');
                        checkSubmenuPosition($this);
                    })
                    .on('mouseleave', function () {
                        menuTimeout = setTimeout(function () {
                            $this.removeClass('menu-item--hover');
                        }, menuTimeoutDuration);
                    });

            } else {

                // touch device
                $this.on('click', function (e) {
                    var $link;

                    // If mobile menu is visible, we don't
                    // have to handle any submenus
                    if ($('#navbar .nav-close-wrap').is(':visible')) {
                        return true;
                    }

                    $this.siblings('.sub-menu--active').removeClass('sub-menu--active')
                        .find('.sub-menu--active').removeClass('sub-menu--active');

                    if ($this.hasClass('menu-item-has-children')) {
                        $link = $this.find('> a');
                        if ($this.hasClass('sub-menu--active')
                            && $link.attr('href') && $link.attr('href') !== '#') {
                            return true;
                        }
                        $this.toggleClass('sub-menu--active');
                        checkSubmenuPosition($this);

                        return false;
                    }

                });
            }

            // Close the hamburger menu if a
            // user clicks on a hash link
            $navbar.on('click', 'a', function () {
                var $closeWrap = $('#navbar .nav-close-wrap');
                var href = $(this).attr('href');

                // Ensures both '#link' and '/page#link' work
                if ($closeWrap.is(':visible') && href.indexOf('#') > -1) {
                    $closeWrap.find('.closenav').trigger('click');
                }
            });

        });

    }());

    /**
     * Social media icons sharing functionality
     */
    ;(function () {
        $('.sm-item-share').on('click', function () {
            window.open($(this).attr('href'), 'sharer', 'toolbar=0,status=0,width=548,height=325');
            return false;
        });
    }());

    ;(function () {
        var $contentGridRow = $('.op-content-grid-row');
        if ($contentGridRow.length > 0) {
            $('body').on('post-load', function () {
                $('.infinite-loader').remove();

                setTimeout(function () {
                    var $handle = $contentGridRow.find('#infinite-handle');
                    if ($handle.length === 0) {
                        $contentGridRow.append('<div class="dummyElement"></div>');
                        $contentGridRow.addClass('op-content-grid-row--show-all');
                    }
                }, 1);
            });
        }
    }());

    // Initialize object-fit polyfil
    ;(function () {
        objectFitImages();
    }());


    // initialize
    ;(function ($, window, document) {
        ;(function () {
            var siteKey = (typeof OP3ST !== "undefined" && typeof(OP3ST.GoogleRecaptcha) !== "undefined" && OP3ST.GoogleRecaptcha !== null) ? OP3ST.GoogleRecaptcha.googleRecaptchaSiteKey : '';
            var $form = $('[data-op3-form="op3-smart-form"]');
            $form.each(function(){
                // adding Recaptcha token
                if (siteKey !== '' && typeof grecaptcha !== "undefined") {
                    var that = $(this);
                    grecaptcha.ready(function () {
                        grecaptcha.execute(siteKey, {action: 'op3optin'}).then(function (token) {
                            // append hidden field with google's token
                            var grecaptchTokenField = $('<input>').attr({
                                type: 'hidden',
                                name: 'op3-grecaptcha-token',
                                value: token
                            });

                            that.append(grecaptchTokenField);

                            // show Google badge as it is needed
                            var badge = $('.grecaptcha-badge');
                            badge.show();
                            badge.css("visibility", "visible");

                        });
                    });
                }

                $(this).on("submit", function (e) {
                    e.preventDefault();
                    var $form = $(this).closest('form');
                    var params = $form.serialize();
                    var redirectUrl = $form.find('input[name="redirect"]').val();
                    var successMessage = $form.find('input[name="successMessage"]').val();

                    $.ajax({
                        url: $form.attr('action'),
                        type: "post",
                        data: params,
                        success: function(data) {
                            if (redirectUrl !== '' && typeof redirectUrl !== "undefined") {
                                window.location.href = redirectUrl;
                            } else if (successMessage !== '' && typeof successMessage !== "undefined") {
                                var notification = $("<div />")
                                    .text(successMessage)
                                    .addClass("op3-form-notification");

                                notification.insertBefore($form);
                                $form.remove();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            if (redirectUrl === '' && typeof redirectUrl === "undefined") {
                                var notification = $("<div />")
                                    .text("ERROR: " + errorThrown)
                                    .addClass("op3-form-notification error");

                                notification.insertBefore($form);
                                $form.remove();
                            }
                        },
                    });
                });
            });
        }());

    })(jQuery, window, document);
});

/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://github.com/Automattic/smart/pull/136
 */
( function() {
    var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
        is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
        is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

    if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var id = location.hash.substring( 1 ),
                element;

            if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                return;
            }

            element = document.getElementById( id );

            if ( element ) {
                if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false );
    }
})();
