<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $tevily_post;
   if (!$tevily_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['tevily_image_size'];

   if(has_post_thumbnail($tevily_post)){
      echo get_the_post_thumbnail($tevily_post, $thumbnail_size);
   }
?>

