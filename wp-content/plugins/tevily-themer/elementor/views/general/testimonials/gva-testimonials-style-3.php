<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Group_Control_Image_Size;

   if($settings['style'] != 'style-3'){ return false;}

   $classes = array();
   $classes[] = 'gva-testimonial-carousel';
   $classes[] = $settings['style'];
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">   
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php
            foreach ($settings['testimonials'] as $testimonial): ?>
               $avatar = (isset($testimonial['testimonial_image']['url']) && $testimonial['testimonial_image']['url']) ? $testimonial['testimonial_image']['url'] : '';
               ?>
               <div class="item swiper-slide">
                  <div class="testimonial-item">
                     <div class="testimonial-item-content">
                       
                        <div class="testimonial-content">
                           <?php echo $testimonial['testimonial_content']; ?>
                        </div>
                        <div class="testimonial-meta clearfix">
                           <?php if($avatar){ ?>
                              <div class="testimonial-image">
                                 <img src="<?php echo esc_url($avatar) ?>" alt="<?php echo $testimonial['testimonial_name']; ?>" />
                                 <span class="icon-quote">“</span>
                              </div>
                           <?php } ?>   
                           <div class="testimonial-information">
                              <span class="testimonial-name"><?php echo $testimonial['testimonial_name']; ?></span>
                              <span class="testimonial-job"><?php echo $testimonial['testimonial_job']; ?></span>
                           </div>
                        </div>

                     </div>   
                  </div>
               </div>   
            <?php endforeach; ?>
         </div>   
     </div> 
   </div>
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
