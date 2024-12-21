<?php
   use Elementor\Icons_Manager;

   if(!defined('ABSPATH')){ exit; }

   global $tevily_post, $post;
   
   if(!$tevily_post){ return; }

   if($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return; }

   $post = $tevily_post;
?>

<div class="tevily-single-comment">
   <?php
      if(comments_open($tevily_post->ID) || get_comments_number($tevily_post->ID)) {
         echo '<div class="listing-comment">';
            comments_template();
         echo '</div>';   
      }
   ?>
   <div class="avg-total-tmp hidden">
      <div class="content-inner">
         <span class="value">5.00</span>
         <span class="avg-title"><?php echo esc_html__('Average Rating', 'tevily-themer') ?></span>
      </div>   
   </div>
</div>

