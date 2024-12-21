<?php
   use Elementor\Icons_Manager;
   
   $classes = array();
   $classes[] = 'swiper-slider-wrapper gsc-services-group layout-carousel';
   if($settings['style'] == 'style-1'){ $classes[] = 'no-gutter'; }
   $classes[] = $settings['style'];
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">   
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['services_content'] as $item): ?>
               <div class="swiper-slide">
                  <?php include $this->get_template('general/services-group/item.php'); ?>
               </div>
            <?php endforeach; ?>
         </div> 
      </div>
   </div>   
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
