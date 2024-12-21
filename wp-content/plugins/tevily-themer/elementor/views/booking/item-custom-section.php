<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   if( !isset($ba_post['custom_section']) || (isset($ba_post['custom_section']) && empty($ba_post['custom_section'])) ){ return; }

?>
   <div class="tevily-single-custom-section">
      <div class="content-inner">
            <?php 
               foreach($ba_post['custom_section'] as $item){ 
                  echo '<div class="custom-section-item">';
                     echo '<div class="content-inner">';
                        echo '<div class="box-heading">';
                           if(isset($item['title'])){
                              echo '<h4 class="title">' . $item['title'] . '</h4>';
                           }
                        echo '</div>';
                        echo '<div class="box-content">';
                           echo apply_filters ('the_content', $item['content']);
                        echo '</div>';
                     echo '</div>';
                  echo '</div>';
               }
            ?>  
      </div>
   </div>

