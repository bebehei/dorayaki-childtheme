/*
 * General Explanation:
 * To create a dockbar, you always have to use 2 elements. One, class-toggling
*/
var dockbarWanted = true;
if(dockbarWanted){
	var scrolledBeforeMenu = 0;
	var navi, folge, height, marginAfter, browserHeight, browserWidth, distToTop, classes;

	function dockbarLoadValues(sizeChanged){
		classes = 'scrolled';
		regex = 'px';

		/* refresh the store of the browser-size */
		browserHeight = window.innerHeight;
		browserWidth = window.innerWidth;

		/* if the size is changed, we have to delete the old
			 classes from the navi and folge elements */
		if(sizeChanged == true){
			navi.removeClass(classes);
			folge.css('margin-top:', marginAfter + 'px');
		}
		/* select elements, depending on size and displayed header-slide*/
		navi = jQuery('#mobile-nav');
		folge = jQuery('#main-wrap');
		if(window.innerWidth > 1260){
			navi = jQuery("#site-nav");
		}
		if(jQuery('#header-slide').length > 0){
			folge = jQuery('#header-slide');
		}
		
		/* read the height and the margin of the selected elements */
		height = navi.height() + parseInt(folge.css('marginTop').replace(regex, ''));
		marginAfter = parseInt(folge.css('marginTop').replace(regex, ''));
		
		/* Use other class if WP-Adminbar is displayed,
			 so the navigation docks at 28px top */
		if(jQuery('#wpadminbar').length > 0){
			classes = 'wp-admin-scroll';
		}

		distToTop = navi.position().top;

		return true;
	}

	function dockbarCheckScroll(){
			if((browserWidth != window.innerWidth) || (browserHeight != window.innerHeight)){
				dockbarLoadValues(true);
			}
			if(window.pageYOffset > distToTop){
				navi.addClass(classes);
				folge.css('margin-top', height + 'px');
			}
			else {
				navi.removeClass(classes);
				folge.css('margin-top', marginAfter + 'px');
			}
			return true;
	}

	jQuery(window).load(function() {
		dockbarLoadValues(false);

		jQuery(window).scroll(function(){
			dockbarCheckScroll();
		});
		jQuery(window).resize(function(){
			dockbarCheckScroll();
		});

		jQuery(document).ready(function(){
			jQuery('#site-nav').hide();
	
			jQuery('a#mobile-menu-btn').unbind('click');
			jQuery('a#mobile-menu-btn').click(function () {
				if(scrolledBeforeMenu == 0){
					scrolledBeforeMenu = window.pageYOffset;
					var itHadBeenZero = true;
				}
				jQuery('#site-nav').slideToggle('100');
				jQuery('a#mobile-menu-btn').toggleClass('menu-btn-open');
				if(itHadBeenZero){
					jQuery('body,html').animate({ scrollTop: distToTop }, 800);
				}
				else {
					jQuery('body,html').animate({ scrollTop: scrolledBeforeMenu }, 800);
					scrolledBeforeMenu = 0;
				}
			});
		});
	});
}
