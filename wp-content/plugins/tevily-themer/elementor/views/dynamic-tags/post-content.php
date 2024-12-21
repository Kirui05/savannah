<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $tevily_post;
   if (!$tevily_post){
      return;
   }
   ?>
   
   <div class="post-content">
         <?php 
            echo apply_filters ('the_content', $tevily_post->post_content);
            
         ?>
   </div>      

