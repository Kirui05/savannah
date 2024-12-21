<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   $content = '';

   if($settings['type'] == 'included'){
      $content = isset($ba_post['tevily_included']) ? $ba_post['tevily_included'] : false;
   }else{
      $content = isset($ba_post['tevily_excluded']) ? $ba_post['tevily_excluded'] : false;
   }
   
?>

<div class="tevily-single-in-ex type-<?php echo esc_attr($settings['type']) ?>">
   <div class="content-inner">
      <?php echo wp_kses($content, true); ?>
   </div>
</div>

