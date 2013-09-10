
var navi, folge, height, margin_after, browser_height, browser_width, classes;

function load_values(size_changed){

	if(size_changed){
		navi.removeClass(classes);
		folge.css('margin-top:', margin_after + 'px');
	}

	browser_height = window.innerHeight;
	browser_width = window.innerWidth;
	classes = 'scrolled';

	if(window.innerWidth > 1260){
		navi = jQuery("#site-nav");
		folge = jQuery('#main-wrap');
		height = navi.height();
		margin_after = height;
		if(jQuery('#header-slide').length > 0){
			navi = jQuery("#site-nav");
			folge = jQuery('#header-slide');
			height = height + 60;
			margin_after = 60;
		}
	}
	else {
		navi = jQuery('#mobile-nav');
		folge = jQuery('#main-wrap');
		height = navi.height();
		margin_after = height;
		if(jQuery('#header-slide') > 0){
			navi = jQuery('#mobile-nav');
			folge = jQuery('#header-slide');
			height = navi.height() + 50;
			margin_after = height + 50;
		}
	}

	dist_to_top = navi.position().top;

	if(jQuery('#wpadminbar') > 0){
		height = height + 28;
		margin_after = margin_after + 28;
		classes = 'wp-admin-scroll';
	}
	return true;
}

function checkScroll(){
		if((browser_width != window.innerWidth) || (browser_height != window.innerHeight)){
			load_values(true);
		}
		if ( window.pageYOffset > dist_to_top) {
			navi.addClass(classes);
			folge.css('margin-top', height + 'px');
		}
		else {
			navi.removeClass(classes);
			folge.css('margin-top', margin_after + 'px');
		}
		return true;
}

jQuery(window).load(function() {
	load_values(false);
});
jQuery(window).scroll(function(){
	checkScroll();
});

