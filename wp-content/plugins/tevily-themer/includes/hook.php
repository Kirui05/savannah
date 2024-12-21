<?php

function tevily_themer_mime_types($mimes) {
   $mimes['svg'] = 'image/svg+xml';
   return $mimes;
}
add_filter('upload_mimes', 'tevily_themer_mime_types');

add_action( 'init', 'tevily_init_options', 1 );
function tevily_init_options(){
   if( empty(get_option( 'tribeEventsTemplate', '' )) ){
      update_option('tribeEventsTemplate', 'default');
   }
   if( empty(get_option( 'views_v2_enabled', '' )) ){
      update_option('views_v2_enabled', '0');
   }
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

remove_filter( 'import_start', array( 'BABE_Import_export', 'import_taxonomy_first' ) );
remove_filter( 'wp_import_terms', array( 'BABE_Import_export', 'correct_taxonomy_id' ) );
remove_filter( 'wp_import_post_data_raw', array( 'BABE_Import_export', 'post_parser' ) );
remove_filter( 'import_end', array( 'BABE_Import_export', 'correct_imported_data' ) );

remove_filter( 'wp_import_post_comments', array( 'BABE_Import_export', 'map_comment' ) );
remove_filter( 'wp_import_insert_comment', array( 'BABE_Import_export', 'map_imported_comment' ) );
remove_filter( 'wp_import_posts', array( 'BABE_Import_export', 'validate_posts_before_import' ) );

add_filter('wpcf7_autop_or_not', '__return_false');

add_post_type_support( 'page', 'excerpt' );