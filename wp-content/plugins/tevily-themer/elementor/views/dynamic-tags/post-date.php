<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $tevily_post;
   if (!$tevily_post){
      return;
   }
   ?>
   
   <div class="post-date">
         <?php 
            if($settings['show_icon']){ 
               echo '<i class="far fa-calendar"></i>';
            }
            echo get_the_date( get_option('date_format'), $tevily_post->ID);
         ?>
   </div>      

