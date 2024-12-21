<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }

   global $tevily_post;

   if (!$tevily_post){ return; }

   if ($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

   $ba_post = BABE_Post_types::get_post($tevily_post->ID);

   if( !isset($ba_post['steps']) || (isset($ba_post['steps']) && empty($ba_post['steps'])) ){ return; }

   $i = 0;
?>
   <div class="tevily-single-steps">
      <div class="content-inner">
         <div class="accordion" id="single-steps-<?php echo wp_rand(5) ?>">
            <?php foreach($ba_post['steps'] as $step){ 
               $item_id = 'acc-item-' . wp_rand(5);
               $i++;
               if( isset($step['attraction']) && isset($step['title']) ){ ?>
                  <div class="accordion-item">
                     <div class="accordion-header" id="<?php echo esc_attr($item_id) ?>-headingOne">
                        <a class="accordion-button<?php echo($i == 1 ? '' : ' collapsed') ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($item_id) ?>-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                           <?php echo apply_filters( 'translate_text', $step['title'] ); ?>
                        </a>
                     </div>

                     <div id="<?php echo esc_attr($item_id) ?>-collapseOne" class="accordion-collapse collapse<?php echo($i == 1 ? ' show' : '') ?>" aria-labelledby="<?php echo esc_attr($item_id) ?>-headingOne">
                        <div class="accordion-body">
                        	<?php //echo apply_filters ('the_content', $step['attraction']); ?>
                          <?php echo do_shortcode( wpautop($step['attraction']) ); ?>
                        </div>
                     </div>

                  </div>
               <?php }
            } ?>
         </div>   
      </div>
   </div>

