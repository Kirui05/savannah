<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

?>

<div class="tevily-single-rating">
   <div class="box-content">
      <?php echo BABE_Rating::post_stars_rendering($tevily_post->ID); ?>
   </div>
</div>

