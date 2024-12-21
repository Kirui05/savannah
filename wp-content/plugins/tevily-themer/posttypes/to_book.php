<?php
class Gavias_Themer_To_Book{

   public function __construct(){ 
      $tevily_register_taxonomy = get_option('tevily_register_taxonomy', 'enable');
      if($tevily_register_taxonomy == 'enable'){
         add_action('init', array($this, 'register_locations'));
         add_action('init', array($this, 'register_type'));
         add_action('init', array($this, 'register_amenities'));
         add_action('init', array($this, 'register_language'));
         add_action('init', array($this, 'register_features'));
      }
      //BABE_Install::setup_ages();
   }


   public function register_locations(){
      $slug = BABE_Post_types::$attr_tax_pref . 'location';
      $name = esc_html__('Booking Locations', 'tevily-themer');

      if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'location'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }

      // $labels = array(
      //    'name'              => $name,
      //    'singular_name'     => $name,
      //    'search_items'      => sprintf(__( 'Search %s', 'tevily-themer' ), $name),
      //    'all_items'         => sprintf(__( 'All %s', 'tevily-themer' ), $name),
      //    'parent_item'       => sprintf(__( 'Parent %s', 'tevily-themer' ), $name),
      //    'parent_item_colon' => sprintf(__( 'Parent %s:', 'tevily-themer' ), $name),
      //    'edit_item'         => sprintf(__( 'Edit %s', 'tevily-themer' ), $name),
      //    'update_itm'        => sprintf(__( 'Update %s', 'tevily-themer' ), $name),
      //    'add_new_item'      => sprintf(__( 'Add New %s', 'tevily-themer' ), $name),
      //    'new_item_name'     => sprintf(__( 'New %s', 'tevily-themer' ), $name),
      //    'menu_name'         => sprintf(__( '%s', 'tevily-themer' ), $name),
      // );

      // register_taxonomy( 'ba_location', array(BABE_Post_types::$booking_obj_post_type), array(
      //    'labels'               => $labels,
      //    'hierarchical'         => true,
      //    'query_var'            => $slug,
      //    'public'               => true,
      //    'show_ui'              => true,
      //    'show_in_nav_menus'    => true,
      //    'show_admin_column'    => true,
      //    'show_in_menu'         => true,
      //    'show_in_rest'         => true
      // ));
   }

   public function register_type(){
      $slug = BABE_Post_types::$attr_tax_pref . 'type';
      $name = esc_html__('Booking Type', 'tevily-themer');

      if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'type'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_amenities(){
     $slug = BABE_Post_types::$attr_tax_pref . 'amenities';
     $name = esc_html__('Amenities', 'tevily-themer');

     if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'amenities'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_language(){
     $slug = BABE_Post_types::$attr_tax_pref . 'language';
     $name = esc_html__('Languages', 'tevily-themer');

     if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'language'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }

   public function register_features(){
      $slug = BABE_Post_types::$attr_tax_pref . 'features';
      $name = esc_html__('Features', 'tevily-themer');

      if(!taxonomy_exists($slug)){
         $inserted_term = wp_insert_term($name,   
            BABE_Post_types::$taxonomies_list_tax, 
            array(
               'description' => $name,
               'slug'        => 'features'
            )
         );

         if (!is_wp_error($inserted_term)){
            BABE_Post_types::init_taxonomies_list();
            update_term_meta($inserted_term['term_id'], 'gmap_active', 0);
            update_term_meta($inserted_term['term_id'], 'select_mode', 'multi_checkbox');
            update_term_meta($inserted_term['term_id'], 'frontend_style', 'col_3');
         }
      }
   }
}

new Gavias_Themer_To_Book();
