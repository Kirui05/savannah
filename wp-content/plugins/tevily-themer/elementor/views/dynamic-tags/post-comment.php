<?php
   if (!defined('ABSPATH')){ exit; }

   global $tevily_post, $post;

   if(!$tevily_post){ return; }
   $post = $tevily_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($tevily_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'tevily-themer') . '</div>';
         }
      }
   ?>
</div>      

