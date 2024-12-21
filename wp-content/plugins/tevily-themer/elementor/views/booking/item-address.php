<?php
   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);
?>

   <?php if(!empty($ba_post) && isset($ba_post['address']['address'])){ ?>
   <div class="tevily-single-address">
      <i class="flaticon-place"></i>
      <span><?php echo esc_html($ba_post['address']['address']); ?></span>
   </div>

<?php } ?>
