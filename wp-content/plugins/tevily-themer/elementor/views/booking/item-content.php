<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}
?>

<div class="tevily-single-content">
   <?php
      echo apply_filters ('the_content', $tevily_post->post_content);
   ?>
</div>

