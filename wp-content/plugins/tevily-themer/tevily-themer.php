<?php 
/**
 * Plugin Name: Tevily Themer
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.6.1
 * Author: Gaviasthemes Team
 */
define( 'GAVIAS_TEVILY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GAVIAS_TEVILY_PLUGIN_DIR', plugin_dir_path( __FILE__ )  );

class Gavias_Tevily_Themer{
   private static $instance = null;
   public static function instance() {
      if ( is_null( self::$instance ) ) {
         self::$instance = new self();
      }
      return self::$instance;
   }

	public function __construct(){

		$this->include_files();
      add_filter('single_template', array($this, 'single_template'), 99, 1);

      add_action('wp_head', array($this, 'gaviasthemer_ajax_url'));
      add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
      add_action('admin_enqueue_scripts', array($this, 'register_scripts_admin'));
      add_action('init', array($this, 'init'));
      $this->gavias_plugin_update();
	}
   
   public function gaviasthemer_ajax_url(){
      echo '<script> var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
   }

   public function init(){
      load_plugin_textdomain('tevily-themer', false, 'tevily-themer/languages/');
   }
	public function include_files(){

      // Post Types
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'posttypes/portfolio.php');
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'posttypes/template.php');

      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'redux/init.php');
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'includes/functions.php');
		require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'includes/hook.php');
      
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'sample/init.php'); 
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'add-ons/init.php'); 
      require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'widgets/recent_posts.php'); 

      //Template & Layout
      if(class_exists('Elementor\Plugin')){
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'elementor/init.php'); 
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'layout/model.php'); 
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'layout/layout.php');
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'layout/hook.php');
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'layout/elementor.php');
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'layout/frontend.php');
      }

      // Load BA Booking Plugin
      if(defined('BABE_VERSION')){
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . 'posttypes/to_book.php');
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . '/booking/manager.php'); 
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . '/booking/hooks.php'); 
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . '/booking/ratings.php'); 
         require_once(GAVIAS_TEVILY_PLUGIN_DIR . '/booking/my-account.php'); 
      }
	}

   public function single_template($single_template){
      global $post;

      if(!$post || empty($post)) return;

      $post_type = $post->post_type;

      if($post_type == 'footer'){ 
         $single_template = trailingslashit( plugin_dir_path( __FILE__ ) .'templates' ) . 'single-builder-footer.php';
      }
      if($post_type == 'gva_header'){
         $single_template = trailingslashit( plugin_dir_path( __FILE__ ) .'templates' ) . 'single-builder-header.php';
      }
      if($post_type == 'gva__template'){
         $single_template = trailingslashit( plugin_dir_path( __FILE__ ) .'templates' ) . 'single-template.php';
         $template_type = get_post_meta($post->ID, 'gva_template_type', true);
         if($template_type == 'header_layout'){
            $single_template = trailingslashit( plugin_dir_path( __FILE__ ) .'templates' ) . 'single-builder-header.php';
         }
         if($template_type == 'footer_layout'){
            $single_template = trailingslashit( plugin_dir_path( __FILE__ ) .'templates' ) . 'single-builder-footer.php';
         }
      } 
      return $single_template;
   }

   public function register_scripts(){
      $js_dir = plugin_dir_url( __FILE__ ).'assets/js';
      $css_dir = plugin_dir_url( __FILE__ ).'assets/css';
      wp_register_script('gavias-themer', $js_dir.'/main.min.js', array('jquery'), null, true);
      wp_enqueue_style('tevily-themer', $css_dir . '/style.css');
      wp_enqueue_script('gavias-themer');
   }


   public function register_scripts_admin() {
      $css_dir = plugin_dir_url( __FILE__ ).'assets/css';
      wp_enqueue_style('tevily-icons-custom', GAVIAS_TEVILY_PLUGIN_URL . 'assets/icons/flaticon.min.css' );
   }

   public function gavias_plugin_update() {
      require 'plugin-update/plugin-update-checker.php';
      Puc_v4_Factory::buildUpdateChecker(
         'http://gaviasthemes.com/plugins/dummy_data/tevily-themer-update-plugin.json',
         __FILE__,
         'tevily-themer'
      );
   }
}

new Gavias_Tevily_Themer();

