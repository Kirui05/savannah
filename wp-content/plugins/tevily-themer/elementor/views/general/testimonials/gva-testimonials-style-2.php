<?php
	use Elementor\Group_Control_Image_Size;

	if(!defined('ABSPATH')){ exit; }

	if($settings['style'] != 'style-2'){return false;}

	$classes = array();
   $classes[] = 'gva-testimonial-carousel swiper-slider-wrapper';
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
						<?php 
							$avatar = (isset($testimonial['testimonial_image']['url']) && $testimonial['testimonial_image']['url']) ? $testimonial['testimonial_image']['url'] : '';
						?>
						<div class="item swiper-slide">
							<div class="testimonial-item">
								<?php if($avatar){ ?>
									<div class="testimonial-image">
										<img src="<?php echo esc_url($avatar) ?>" alt="<?php echo $testimonial['testimonial_name']; ?>" />
									</div>
								<?php } ?>
								<div class="testimonial-content">
									<div class="testimonial-stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</div>
									<div class="testimonial-quote">
										<?php echo $testimonial['testimonial_content']; ?>
									</div>
									<div class="testimonial-meta">
										<span class="testimonial-name"><?php echo $testimonial['testimonial_name']; ?></span>
										<span class="testimonial-job"><?php echo $testimonial['testimonial_job']; ?></span>
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
