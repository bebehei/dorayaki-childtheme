<?php
/**
 * The themes Header file.
 *
 * Displays all of the <head> section and everything up till the header image / slider
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
 ?><!DOCTYPE html>
<html id="doc" class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php 
	$options = get_option('dorayaki_theme_options');
	if( $options['custom_favicon'] != '' ) : ?>
<link rel="shortcut icon" type="image/ico" href="<?php echo $options['custom_favicon']; ?>" />
<?php endif  ?>
<?php 
	$options = get_option('dorayaki_theme_options');
	if( $options['custom_apple_icon'] != '' ) : ?>
<link rel="apple-touch-icon" href="<?php echo $options['custom_apple_icon']; ?>" />
<?php endif  ?>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script type="text/javascript" src="/wp-content/themes/elmastudio-themebundle/child_dorayaki/js/navbar_scroll.js"></script>
</head>

<body <?php body_class(); ?>>

	<header id="masthead" class="clearfix">

		<div class="headerinfo-wrap">
			<div id="site-title">
				<?php $options = get_option('dorayaki_theme_options');
				if( $options['custom_logo'] != '' ) : ?>
					<a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
				<?php else: ?>
					<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif  ?>
			</div><!-- end #site-title -->

		</div><!-- .headerinfo-wrap -->

		<div class="mobile-nav-container">
			<a href="" id="desktop-search-btn"><span><?php _e('Search', 'dorayaki') ?></span></a>
			<div id="mobile-nav">
			<div id="search-wrap">
				<?php get_search_form(); ?>
			</div>
			
			<?php if ( is_active_sidebar( 'sidebar-header' ) ) : ?>
				<div class="header-widget-wrap">
					<?php dynamic_sidebar( 'sidebar-header' ); ?>
				</div><!-- .header-widget-wrap -->
			<?php endif; ?>
			
			</div><!-- end #mobile-nav-container -->

			<a href="#nav-mobile" id="mobile-search-btn" class="search-icon"><span><?php _e('Search', 'dorayaki') ?></span></a>
			<a href="#nav-mobile" id="mobile-menu-btn" class="menu-icon"><span><?php _e('Menu', 'dorayaki') ?></span></a>
			</div>
			<nav id="site-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- end #site-nav -->

		</header><!-- end #masthead -->

		<?php $header_image = get_header_image();
		if ( $header_image ) : $header_image_width = get_theme_support( 'custom-header', 'width' ); ?>

		<?php
			// The header image
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
			if ( is_singular() && has_post_thumbnail( $post->ID ) &&
					( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
					$image[1] >= $header_image_width ) :
					// Houston, we have a new header image!
					echo '<div class="header-img">';
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					echo '</div>';
				else :
					$header_image_width  = get_custom_header()->width;
					$header_image_height = get_custom_header()->height;
				?>
				<?php if (is_front_page() ) : ?>
				<div class="header-img">
					<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
				</div><!-- end .header-img -->
				<?php endif; ?>

			<?php endif; // end check for featured image or standard header ?>
		<?php endif; // end check for removed header image ?>

		<?php // Include Responsive Slider, see Dorayaki Theme Options
			$options = get_option('dorayaki_theme_options');
			if( $options['use-slider'] ) : ?>
			<?php if(is_front_page() ) { ?>
				<div class="header-slider" id="header-slide">
				<?php echo do_shortcode( '[responsive_slider]' ); ?>
				</div><!-- end .header-slider -->
			<?php } ?>
		<?php endif; ?>
