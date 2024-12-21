<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $tevily_post;
   if (!$tevily_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="tevily-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($tevily_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   