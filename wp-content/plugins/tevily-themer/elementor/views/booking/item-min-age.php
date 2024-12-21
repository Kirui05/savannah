<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   $has_icon = ! empty( $settings['selected_icon']['value']);

   $min_age = isset($ba_post['tevily_booking_min_age']) ? $ba_post['tevily_booking_min_age'] : false;

?>

   <div class="tevily-single-min_age">
      <div class="content-inner">
         <div class="icon">
            <?php if ($has_icon){ ?>
               <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
            <?php } ?>
         </div>
         <div class="box-content">
            <?php 
               if($settings['title_text']){ 
                  echo '<h4 class="ba-meta-title">' . esc_html($settings['title_text']) . '</h4>';
               }
               if($min_age){
                  echo '<div class="item-value">' . esc_html($min_age) . '</div>';
               }
            ?>
         </div>
      </div>
   </div>

