<?php
/**
	* $Desc
	*
	* @author     Gaviasthemes Team     
	* @copyright  Copyright (C) 2021 gaviasthemes. All Rights Reserved.
	* @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
	* 
*/

define('TEVILY_THEME_DIR', get_template_directory());
define('TEVILY_THEME_URL', get_template_directory_uri());

// Include list of files of theme.
require_once(TEVILY_THEME_DIR . '/includes/functions.php'); 
require_once(TEVILY_THEME_DIR . '/includes/template.php'); 
require_once(TEVILY_THEME_DIR . '/includes/hook.php'); 
require_once(TEVILY_THEME_DIR . '/includes/comment.php'); 
require_once(TEVILY_THEME_DIR . '/includes/metaboxes.php');
require_once(TEVILY_THEME_DIR . '/includes/customize.php'); 
require_once(TEVILY_THEME_DIR . '/includes/menu/megamenu.php'); 
require_once(TEVILY_THEME_DIR . '/includes/elementor/hooks.php');

//Load Woocommerce plugin
if(class_exists('WooCommerce')){
	add_theme_support('woocommerce');
	require_once(TEVILY_THEME_DIR . '/includes/woocommerce/functions.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/woocommerce/hooks.php'); 
}


if(defined('BABE_VERSION')){
	require_once(TEVILY_THEME_DIR . '/includes/booking/dashboard.php'); 
}

// Load Redux - Theme options framework
if(class_exists('Redux')){
	require(TEVILY_THEME_DIR . '/includes/options/init.php');
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-general.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-header.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-footer.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-styling.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-page.php'); 
	require_once(TEVILY_THEME_DIR . '/includes/options/opts-portfolio.php'); 
	if(class_exists('WooCommerce')){
		require_once(TEVILY_THEME_DIR . '/includes/options/opts-woo.php'); 
	}
}

// TGM plugin activation
if (is_admin()) {
	require_once(TEVILY_THEME_DIR . '/includes/tgmpa/class-tgm-plugin-activation.php');
	require(TEVILY_THEME_DIR . '/includes/tgmpa/config.php');
}
load_theme_textdomain('tevily', get_template_directory() . '/languages');

//-------- Register sidebar default in theme -----------
//------------------------------------------------------
function tevily_widgets_init() {
	register_sidebar(array(
		'name' 				=> esc_html__('Default Sidebar', 'tevily'),
		'id' 					=> 'default_sidebar',
		'description' 		=> esc_html__('Appears in the Default Sidebar section of the site.', 'tevily'),
		'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	));

	if(class_exists('WooCommerce')){
		register_sidebar( array(
			'name' 				=> esc_html__('WooCommerce Shop Sidebar', 'tevily'),
			'id' 					=> 'woocommerce_sidebar',
			'description' 		=> esc_html__('Appears in the Plugin WooCommerce section of the site.', 'tevily'),
			'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'	 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title"><span>',
			'after_title' 		=> '</span></h3>',
		));
		register_sidebar( array(
			'name' 				=> esc_html__('WooCommerce Product Sidebar', 'tevily'),
			'id' 					=> 'woocommerce_single_sidebar',
			'description' 		=> esc_html__('Appears in the Plugin WooCommerce section of the site.', 'tevily'),
			'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'	 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title"><span>',
			'after_title' 		=> '</span></h3>',
		));
	}
	register_sidebar(array(
		'name' 				=> esc_html__('After Offcanvas Mobile', 'tevily'),
		'id' 					=> 'offcanvas_sidebar_mobile',
		'description' 		=> esc_html__('Appears in the Offcanvas section of the site.', 'tevily'),
		'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	));
	
}
add_action('widgets_init', 'tevily_widgets_init');


if ( ! function_exists('tevily_fonts_url') ) :
/**
 *
 * @return string Google fonts URL for the theme.
 */
function tevily_fonts_url() { 
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';
	$protocol = is_ssl() ? 'https' : 'http';
	/*
		* Translators: If there are characters in your language that are not supported
		* by Noto Sans, translate this to 'off'. Do not translate into your own language.
	*/
	if('off' !== _x('on', 'DM Sans font: on or off', 'tevily')){
		$fonts[] = 'DM+Sans:wght@400;500;700';
	}
	if($fonts){
		$fonts_url = add_query_arg( array(
			'family' => (implode('&family=', $fonts)),
			'display' => 'swap',
		),  $protocol.'://fonts.googleapis.com/css2');
	}

	return $fonts_url;
}

endif;

function tevily_custom_styles() {
	$custom_css = get_option('tevily_theme_custom_styles');
	if($custom_css){
		wp_enqueue_style(
			'tevily-custom-style',
			TEVILY_THEME_URL . '/assets/css/custom_script.css'
		);
		wp_add_inline_style('tevily-custom-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'tevily_custom_styles', 9999);

function tevily_init_scripts(){
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';
	if ( is_singular() && comments_open() && get_option('thread_comments') ){
		wp_enqueue_script('comment-reply');
	}

	$theme = wp_get_theme('tevily');
	$theme_version = $theme['Version'];

	wp_enqueue_style('tevily-fonts', tevily_fonts_url(), array(), null );
	wp_enqueue_script('bootstrap', TEVILY_THEME_URL . '/assets/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script('mcustomscrollbar', TEVILY_THEME_URL . '/assets/js/scroll/jquery.mCustomScrollbar.min.js');
	wp_enqueue_script('jquery-magnific-popup', TEVILY_THEME_URL . '/assets/js/magnific/jquery.magnific-popup.min.js');
	wp_enqueue_script('jquery-cookie', TEVILY_THEME_URL . '/assets/js/jquery.cookie.js', array('jquery'));
	wp_enqueue_script('swiper', TEVILY_THEME_URL . '/assets/js/swiper/swiper.min.js');
	wp_enqueue_script('jquery-appear', TEVILY_THEME_URL . '/assets/js/jquery.appear.js');
	wp_enqueue_script('tevily-main', TEVILY_THEME_URL . '/assets/js/main.js', array('imagesloaded', 'jquery-masonry'));
  
	wp_enqueue_style('dashicons');
	wp_enqueue_style('swiper', TEVILY_THEME_URL .'/assets/js/swiper/swiper.min.css');
	wp_enqueue_style('magnific', TEVILY_THEME_URL .'/assets/js/magnific/magnific-popup.css');
	wp_enqueue_style('mcustomscrollbar', TEVILY_THEME_URL . '/assets/js/scroll/jquery.mCustomScrollbar.min.css');
	wp_enqueue_style('fontawesome', TEVILY_THEME_URL . '/assets/css/fontawesome/css/all.min.css');
	wp_enqueue_style('line-awesome', TEVILY_THEME_URL . '/assets/css/line-awesome/css/line-awesome.min.css');

	wp_enqueue_style('tevily-style', TEVILY_THEME_URL . '/style.css');
	wp_enqueue_style('bootstrap', TEVILY_THEME_URL . '/assets/css/bootstrap.css', array(), $theme_version , 'all'); 
	wp_enqueue_style('tevily-template', TEVILY_THEME_URL . '/assets/css/template.css', array(), $theme_version , 'all');
	
	//Booking Everything
	if(defined('BABE_VERSION')){
	wp_enqueue_style('tevily-booking', TEVILY_THEME_URL . '/assets/css/booking.css', array(), $theme_version , 'all');
	}

	//Woocommerce
	if(class_exists('WooCommerce')){
		wp_enqueue_script('tevily-woocommerce', TEVILY_THEME_URL . '/assets/js/woocommerce.js');
		wp_dequeue_script('wc-add-to-cart');
		wp_enqueue_script('wc-add-to-cart', TEVILY_THEME_URL . '/assets/js/add-to-cart.js' , array('jquery'));
		wp_enqueue_style('tevily-woocoomerce', TEVILY_THEME_URL . '/assets/css/woocommerce.css', array(), $theme_version , 'all'); 
	}
} 
add_action('wp_enqueue_scripts', 'tevily_init_scripts', 999);
