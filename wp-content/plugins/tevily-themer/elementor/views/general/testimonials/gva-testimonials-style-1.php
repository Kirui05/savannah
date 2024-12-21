<?php
   if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly.
   }
   use Elementor\Group_Control_Image_Size;
?>
   
<?php if( $settings['style'] != 'style-1' ){ return false;}
   $this->add_render_attribute('wrapper', 'class', ['gva-testimonial-carousel' , $settings['style'] ]);
?>
   <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div class="swiper-content-inner">
         <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
            <div class="swiper-wrapper">
               <?php foreach ($settings['testimonials'] as $testimonial): 
                  $avatar = (isset($testimonial['testimonial_image']['url']) && $testimonial['testimonial_image']['url']) ? $testimonial['testimonial_image']['url'] : '';
                  ?>
                  <div class="item swiper-slide">
                     <div class="testimonial-item">
                        <div class="testimonial-content">
                           <?php if($avatar){ ?>
                              <div class="testimonial-image"><img src="<?php echo esc_url($avatar) ?>" alt="<?php echo $testimonial['testimonial_name']; ?>" /></div>
                           <?php } ?>
                           <div class="testimonial-content-inner">
                              <div class="testimonial-quote"><?php echo $testimonial['testimonial_content']; ?></div>
                              <div class="testimonial-meta">
                                 <div class="testimonial-information">
                                    <span class="testimonial-name"><?php echo $testimonial['testimonial_name']; ?>,</span>
                                    <span class="testimonial-job"><?php echo $testimonial['testimonial_job']; ?></span>
                                 </div>
                              </div>
                              <span class="quote-icon"><i class="fi flaticon-quote"></i></span>
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
