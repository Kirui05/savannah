<?php
   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   if (empty($ba_post) || !isset($ba_post['address']['address']) || !isset($ba_post['address']['latitude'])|| !isset($ba_post['address']['longitude'])){
      return;
   }

   $latitude  = BABE_Settings::$settings['google_map_start_lat'];
   $longitude = BABE_Settings::$settings['google_map_start_lng'];
   if (isset($babe_post['address']) && !empty($babe_post['address'])) {
      $location  = $babe_post['address'];
      $address   = $location['address'];
      $latitude  = $location['latitude'];
      $longitude = $location['longitude'];
   }
?>
       
<div class="tevily-single-address-map">
   <?php if($settings['title_text']){
      echo '<h2 class="title">' . esc_html($settings['title_text']) . '</h2>';
   } ?>

   <?php
      if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
         echo '<img src="' . GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/map-demo.jpg" />';
      }else{
         echo '<div class="content-inner">';
            if($settings['style'] == 'style-1'){
               echo BABE_html::block_address_map_with_direction($ba_post);
            }
            if($settings['style'] == 'style-2'){
               echo BABE_html::block_meeting_points($ba_post);
            }
         echo '</div>';
      }
   ?>
</div>

