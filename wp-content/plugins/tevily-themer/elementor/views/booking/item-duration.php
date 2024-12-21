<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   $has_icon = ! empty( $settings['selected_icon']['value']);

   //$times_arr = BABE_Post_types::get_post_av_days($ba_post);
   $arr = array();
   $output = '';
   if (!empty($ba_post) && isset($ba_post['duration']) && !empty($ba_post['duration'])){            
      if ( !empty($ba_post['duration']['d']) ) {
         $arr[] = $ba_post['duration']['d'] . ' ' . ($ba_post['duration']['d'] == '1' ? __('day', 'tevily-themer') : __('days', 'tevily-themer'));
      }
      if ( !empty($ba_post['duration']['h']) ) {
         $arr[] = $ba_post['duration']['h'] . ' ' . ($ba_post['duration']['h'] == '1' ? __('hour', 'tevily-themer') : __('hours', 'tevily-themer'));
      }
      if ( !empty($ba_post['duration']['i']) ) {
         $arr[] = $ba_post['duration']['i'] . ' ' . ($ba_post['duration']['i'] == '1' ? __('minute', 'tevily-themer') : __('minutes', 'tevily-themer'));

      }
      $output .= implode(' ', $arr);
   }
   
?>

   <div class="tevily-single-duration">
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
               //if($times_arr){
                  echo '<div class="item-value">' . $output . '</div>';
               //}
            ?>
         </div>
      </div>
   </div>

