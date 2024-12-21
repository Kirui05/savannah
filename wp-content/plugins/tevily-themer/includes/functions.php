<?php
if(!function_exists('gaviasthemer_random_id')){
  function gaviasthemer_random_id($length=4){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
  }
}  

function gaviasthemer_get_select_term( $taxonomy ) {
  global $wpdb;
  $cats = array();
  $query = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = '{$taxonomy}' and b.parent = 0";

  $categories = $wpdb->get_results($query);
  $cats['Choose Category'] = '';
  foreach ($categories as $category) {
     $cats[html_entity_decode($category->name, ENT_COMPAT, 'UTF-8')] = $category->slug;
  }
  return $cats;
}

  
function tevily_themer_get_theme_option($key, $default = ''){
  $tevily_theme_options = get_option( 'tevily_theme_options' );
  if(isset($tevily_theme_options[$key]) && $tevily_theme_options[$key]){
     return $tevily_theme_options[$key];
  }else{
     return $default;
  }
  return false;
}

function tevily_themer_get_term_count( $taxonomy = 'category', $term = '', $args = [] ){
    if (!$term && !is_number() ){
      return false;
    }
    if ( $taxonomy !== 'category' ) {
      $taxonomy = filter_var( $taxonomy, FILTER_SANITIZE_STRING );
      if ( !taxonomy_exists( $taxonomy ) ){
        return false;
      }
    }

    if ($args) {
      if (!is_array($args)){
        return false;
      }
    }

    $default = [
      'posts_per_page' => 1,
      'fields'         => 'ids'
    ];

    $default['tax_query'] = [
      [
        'taxonomy' => $taxonomy,
        'terms'    => $term
      ]
    ];

    $combined_args = wp_parse_args($args, $default);
    $q = new WP_Query($combined_args);
    return $q->found_posts;
}

