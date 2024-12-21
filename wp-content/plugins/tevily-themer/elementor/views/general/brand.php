<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Group_Control_Image_Size;

   $classes = array();
   $classes[] = 'gva-brand-carousel';
   $classes[] = $settings['style'];
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['brands'] as $brand): ?>
               <div class="swiper-slide item brand-item">
                  <div class="brand-item-content">
                     <?php
                        $image_url = $brand['image']['url']; 
                        $image_html = '<img src="' . esc_url($image_url) .'" alt="" class="brand-img"/>';
                        echo $image_html;
                     ?>
                     <?php echo $this->gva_render_link_overlay($brand['link']) ?>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
      </div>   
   </div>
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
