<?php
function tevily_themer_path_demo_content(){
  return (__DIR__.'/demo-data/');
}
add_filter('wbc_importer_dir_path', 'tevily_themer_path_demo_content');

//Way to set menu, import revolution slider, and set home page.
function tevily_themer_import_sample($demo_active_import , $demo_directory_path){

  	reset($demo_active_import);
  	$current_key = key($demo_active_import);

  	if ( class_exists( 'RevSlider' ) ) {
    	$wbc_sliders_array = array( 'slider-1.zip' );
    	$slider = new RevSlider();
    	foreach ($wbc_sliders_array as $s) {
      	if(file_exists( tevily_themer_path_demo_content() . 'main/'. $s )){
        		$slider->importSliderFromPost(true, true, tevily_themer_path_demo_content().'main/'.$s);
      	}
    	}
  	}

  	//Setting Menus
  	$wbc_menu_array = array( 'main' );
  	if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
    	$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    	if ( isset( $top_menu->term_id ) ) {
      	set_theme_mod( 'nav_menu_locations', array(
          	'primary' => $top_menu->term_id
        	)
      );
    }
  	}

  	//Set HomePage
  	$wbc_home_pages = array(
    	'main' => 'Home 1'
  	);
  	if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
    	$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
    	if (isset($page->ID)) {
      	update_option( 'page_on_front', $page->ID );
      	update_option( 'show_on_front', 'page' );
    	}
  	}

   if(class_exists('BABE_Post_types') && class_exists('BABE_Functions')){
      $taxonomies = get_terms(
         array(
            'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
           'hide_empty' => false
         )
      );
      $tax_ids = array();
      if(!is_wp_error($taxonomies) && ! empty($taxonomies)){
         foreach($taxonomies as $item){
           $tax_ids[] = $item->term_id;
         }
      }

      $cat_tour_id = 0;
      $categories = BABE_Post_types::get_categories_arr();
      foreach ($categories as $key => $name) {
         update_term_meta($key, 'categories_taxonomies', $tax_ids);
         if($name == "Tour"){
         	$cat_tour_id = $key;
         }
      }

      global $wpdb;
      //Rate
      $wpdb->query( "ALTER TABLE {$wpdb->prefix}babe_av_cal ADD av_guests INT DEFAULT 0, ADD KEY av_guests (av_guests), ADD KEY booking_obj_date_from_guests_in_schedule (booking_obj_id,date_from,guests,in_schedule), ADD KEY booking_obj_date_from_av_guests_in_schedule (booking_obj_id,date_from,av_guests,in_schedule)" );
      
      $ages = BABE_Post_types::get_ages_arr();
      $age_1 = isset($ages[0]['age_id']) ? $ages[0]['age_id'] : 0;
      $age_2 = isset($ages[1]['age_id']) ? $ages[1]['age_id'] : 0;
      $age_3 = isset($ages[2]['age_id']) ? $ages[2]['age_id'] : 0;

      $rate_apply_days = 'a:7:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;}';
      $rate_start_days = 'a:7:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;}';
      $rate_price_from = array(39, 49, 59, 69, 129, 119, 511);
      $rate_price_general = array();
      $rate_price_general[] = "a:3:{i:{$age_1};d:39;i:{$age_2};d:29;i:{$age_3};d:0;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:59;i:{$age_2};d:45;i:{$age_3};d:39;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:89;i:{$age_2};d:69;i:{$age_3};d:39;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:119;i:{$age_2};d:109;i:{$age_3};d:69;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:159;i:{$age_2};d:139;i:{$age_3};d:129;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:129;i:{$age_2};d:129;i:{$age_3};d:119;}";
      $rate_price_general[] = "a:3:{i:{$age_1};d:699;i:{$age_2};d:599;i:{$age_3};d:511;}";
      $images = array();
      foreach (array(975, 969, 967, 970, 974) as $image){
         $images[] = array(
            'image_id'    => $image,
            'image'       => wp_get_attachment_url($image),
            'description' => 'Image ' . $image,
         );
      }

      $post_ids = get_posts([
         'post_type'          => 'to_book',
         'posts_per_page'     => 18,
         'numberposts'        => 18,
         'post_status'        => 'publish',
         'orderby'            => 'ID',
         'order'              => 'desc',
         'fields'             => 'ids'
      ]);
      $sql = "INSERT INTO {$wpdb->prefix}babe_rates (booking_obj_id, rate_title, apply_days, start_days, price_from, price_general, prices_conditional) VALUES ";
      $i = 0;
      foreach($post_ids as $pid){
         $_rand = rand(0, 6);
         $i++;
         $sql .= "({$pid}, 'General', '{$rate_apply_days}', '{$rate_start_days}', '{$rate_price_from[$_rand]}', '{$rate_price_general[$_rand]}', 'a:0:{}')";
         $sql .= $i < count($post_ids) ? ', ' : '';

         $start_date = new DateTime('-3 days');
         $start_date = BABE_Calendar_functions::date_from_sql($start_date->format('Y-m-d'));
         update_post_meta($pid, 'start_date', $start_date);
         
         $end_date = new DateTime('+1 year');
         $end_date = BABE_Calendar_functions::date_from_sql($end_date->format('Y-m-d'));
         update_post_meta( $pid, 'end_date', $end_date);

         $schedule = get_post_meta($pid, 'schedule', true);
         $schedule = empty($schedule) ? array() : $schedule;

         BABE_Calendar_functions::update_av_cal($pid, $start_date, $end_date, $schedule, 1, 8);
         
         if( empty(get_post_meta($pid, 'images', true)) ){
           update_post_meta($pid, 'images', $images);
         }
      }
      $wpdb->query($sql);

      wp_reset_postdata();

      $options_ba = array(
         'booking_obj_post_slug' => 'booking',
         'booking_obj_post_name' => 'Booking',
         'booking_obj_post_name_general' => 'Booking',
         'booking_obj_menu_name' => 'Book Everything',
         'results_per_page' => 12,
         'posts_per_taxonomy_page' => 12,
         'max_guests_select' => 12,
         'av_calendar_max_months' => 12,
         'services_to_booking_form'	=> 1,
         'results_without_av_check'  => 1,
         'criteria_arr' => array('quality', 'location', 'amenities', 'services', 'price'),
         'currency' => 'USD',
         'currency_place' => 'left',
         'price_thousand_separator' => '',
         'price_decimal_separator' => '.',
         'price_decimals' => 2,
         'use_extended_wp_import' => '0',
         'google_map_active' => 1,
         'google_map_marker' => 1,
      );

      $ba_search_page = get_page_by_title('Tours Page');
      if(isset($ba_search_page->ID)){
       	$options_ba['search_result_page'] = $ba_search_page->ID;
      }

      $languages = BABE_Functions::get_all_languages();
      foreach( $languages as $lang_code => $language ) {
         $ba_settings = wp_parse_args($options_ba, get_option('babe_settings_' . $lang_code, []));
         update_option('babe_settings_' . $lang_code, $ba_settings);
      }
      
      $ba_settings = wp_parse_args($options_ba, get_option('babe_settings', []));
      update_option('babe_settings', $ba_settings);

      $search_form_tabs = array( 
      	'tour'  => array(
          'title' => 'Tour',
          'categories' => array("{$cat_tour_id}" => "{$cat_tour_id}")
      	)
      );
      update_option('babe_search_form_tabs', $search_form_tabs);
      update_option('babe_search_form_general_settings', maybe_unserialize('a:1:{s:17:"show_price_slider";i:1;}'));
      update_option('babe_search_form_fields', maybe_unserialize('a:1:{s:4:"tour";a:9:{s:7:"keyword";a:3:{s:5:"title";s:7:"Keyword";s:6:"active";i:0;s:8:"extended";i:0;}s:11:"ba_location";a:3:{s:5:"title";s:12:"Destinations";s:6:"active";i:1;s:8:"extended";i:0;}s:7:"ba_type";a:3:{s:5:"title";s:8:"Activity";s:6:"active";i:1;s:8:"extended";i:0;}s:9:"date_from";a:3:{s:5:"title";s:9:"Date From";s:6:"active";i:1;s:8:"extended";i:0;}s:6:"guests";a:3:{s:5:"title";s:6:"Guests";s:6:"active";i:1;s:8:"extended";i:1;}s:7:"date_to";a:3:{s:5:"title";s:7:"Date to";s:6:"active";i:0;s:8:"extended";i:0;}s:11:"ba_features";a:3:{s:5:"title";s:8:"Features";s:6:"active";i:0;s:8:"extended";i:0;}s:11:"ba_language";a:3:{s:5:"title";s:9:"Languages";s:6:"active";i:1;s:8:"extended";i:0;}s:12:"ba_amenities";a:3:{s:5:"title";s:9:"Amenities";s:6:"active";i:1;s:8:"extended";i:0;}}}'));
      update_option('babe_search_form_fields_order', maybe_unserialize('a:9:{s:7:"keyword";i:1;s:11:"ba_location";i:2;s:7:"ba_type";i:3;s:9:"date_from";i:4;s:6:"guests";i:5;s:7:"date_to";i:6;s:11:"ba_features";i:7;s:11:"ba_language";i:8;s:12:"ba_amenities";i:9;}'));
      update_option('babe_search_form_fields_icons', maybe_unserialize('a:9:{s:7:"keyword";s:25:"flaticon-magnifying-glass";s:11:"ba_location";s:17:"flaticon-location";s:7:"ba_type";s:17:"flaticon-recovery";s:9:"date_from";s:13:"flaticon-time";s:6:"guests";s:15:"flaticon-family";s:7:"date_to";s:0:"";s:11:"ba_features";s:11:"far fa-user";s:11:"ba_language";s:11:"far fa-user";s:12:"ba_amenities";s:11:"far fa-user";}'));
      update_option('babe_search_form_fields_advanced', maybe_unserialize('a:6:{s:7:"keyword";i:0;s:11:"ba_location";i:0;s:7:"ba_type";i:0;s:11:"ba_features";i:1;s:11:"ba_language";i:1;s:12:"ba_amenities";i:1;}'));

      update_option( 'elementor_experiment-e_dom_optimization', 'inactive' );
      update_option( 'elementor_experiment-a11y_improvements', 'inactive' );
      update_option( 'elementor_editor_break_lines', '1' );
      update_option( 'elementor_unfiltered_files_upload', '1' );
      update_option( 'elementor_experiment-container', 'inactive' );
      update_option( 'elementor_experiment-e_optimized_assets_loading', 'inactive' );
      update_option( 'elementor_experiment-additional_custom_breakpoints', 'inactive' );
      update_option( 'elementor_experiment-e_swiper_latest', 'inactive' );
      update_option( 'elementor_experiment-e_optimized_css_loading', 'inactive' );
      update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
   }
      
}

add_action('wbc_importer_after_content_import', 'tevily_themer_import_sample', 10, 2);

