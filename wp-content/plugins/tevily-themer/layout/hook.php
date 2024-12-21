<?php
class GVA_Layout_Frontend_Hook extends GVA_Layout_Model{
   
   function __construct(){
      add_action('tevily/layouts/page', array($this, 'layout_page'));
      add_action('tevily/layouts/single/post', array($this, 'layout_single_post'));
      add_action('tevily/layouts/archive/post', array($this, 'layout_archive_post'));

      add_action('tevily/layouts/single/template', array($this, 'single_template'));

      add_action('tevily/layouts/single/booking', array($this, 'layout_single_booking'));
      add_action('tevily/layouts/archive/booking', array($this, 'layout_archive_booking'));

      add_action('wp_enqueue_scripts', array($this, 'tevily_themer_elementor_load_css_header'), 500);

   }

   public function tevily_themer_elementor_load_css_header(){
      if (!class_exists( 'Elementor\Core\Files\CSS\Post')){
         return;
      }
      global $post;
      
      $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
      if($active_kit_id){
         $css_file = new Elementor\Core\Files\CSS\Post($active_kit_id);
         $css_file->enqueue();
      }

      if($post && $post->post_type == 'to_book'){
         $template_id = $this->get_template_default('single_booking_layout');
         if($template_id){
            $css_file = new Elementor\Core\Files\CSS\Post($template_id);
            $css_file->enqueue();
         }
      }
   }

   public function layout_page(){
      global $post;
      $post_id = $post->ID;
      if(class_exists('WooCommerce') && is_shop()){
         $post_id = wc_get_page_id('shop');
      }
      $page_template = $this->get_template_default('page_layout');

      $post_meta_template = get_post_meta($post_id, 'tevily_template_layout', true);

      if($post_meta_template == '_without_layout' || empty($post_meta_template) || !metadata_exists('post', $post_id, 'tevily_template_layout')){
         get_template_part('templates/page/single');
         return;
      }
      if( !empty($post_meta_template) && $post_meta_template != '_default_active' && is_numeric($post_meta_template) ){
         $page_template = $post_meta_template;
      }
      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         echo $content_page;
      }else{ 
         get_template_part('templates/page/content');
      }
   }
 
   public function layout_single_post(){
      global $post;
      $page_template = $this->get_template_default('post_single_layout');
      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/single');
   }

   public function layout_archive_post(){
      global $post;
      $page_template = $this->get_template_default('post_archive_layout');

      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/archive');
   }


   public function layout_single_booking(){
      global $post;
      $post_id = $post->ID;
      $template_id = $this->get_template_default('single_booking_layout');
      $post_template_id = get_post_meta($post_id, 'tevily_template_layout', true);
      if( !empty($post_template_id) && $post_template_id && $post_template_id != '_default_active' && is_numeric($post_template_id) ){
         $template_id = $post_template_id;
      }
      if($template_id){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/single');
   }

   public function layout_archive_booking(){
      global $post;
      $template_id = $this->get_template_default('archive_booking_layout');
      if($template_id){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/booking/layout/archive');
   }

   public function single_template(){
      echo apply_filters('the_content', get_the_content());
   }

}

new GVA_Layout_Frontend_Hook();

