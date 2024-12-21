<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $tevily_post;
   if (!$tevily_post){
      return;
   }
   ?>
   
   <div class="post-category">
      <?php 
         if($settings['show_icon']){ 
            echo '<i class="far fa-folder-open"></i>';
         }
         echo get_the_category_list( ", ", '', $tevily_post->ID ) . '</span>';
      ?>
   </div>      

