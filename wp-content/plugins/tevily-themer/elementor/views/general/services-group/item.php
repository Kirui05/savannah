<?php 
	use Elementor\Icons_Manager;
	$has_icon = ! empty( $item['selected_icon']['value']); 
?>

<?php if($settings['style'] == 'style-1'): ?>
   <div class="service-item <?php echo esc_attr($settings['style']) ?>">
      <div class="service-item-content">
			
			<?php if($item['title']){ ?>
				<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
			<?php } ?>

			<?php if($item['desc']){ ?>
				<div class="desc"><?php echo $item['desc'] ?></div>
			<?php } ?>

			<?php if($item['link']['url']){ ?>
				<div class="read-more">
					<?php echo $this->gva_render_link_html(esc_html__('Read more', 'tevily-themer'), $item['link'], 'btn-inline' ) ?>
				</div>
			<?php } ?>

			<?php if ( $has_icon ){ ?>
				<span class="box-icon">
					<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			<?php } ?>

		</div>
		<div class="service-box-background"></div>
		<?php echo $this->gva_render_link_overlay($item['link']) ?>
	</div>		
<?php endif; ?>	

<!-- Style II -->
<?php if($settings['style'] == 'style-2'): ?>
   <div class="service-item <?php echo esc_attr($settings['style']) ?>">
      <div class="service-item-content">
			
			<?php if ( $has_icon ){ ?>
				<span class="box-icon">
					<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			<?php } ?>

			<?php if($item['title']){ ?>
				<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
			<?php } ?>

			<?php if($item['desc']){ ?>
				<div class="desc"><?php echo $item['desc'] ?></div>
			<?php } ?>

			<?php if($item['link']['url']){ ?>
				<div class="read-more">
					<?php echo $this->gva_render_link_html(esc_html__('Read more', 'tevily-themer'), $item['link'], 'btn-inline' ) ?>
				</div>
			<?php } ?>

		</div>
		<div class="service-box-background"></div>

		<?php echo $this->gva_render_link_overlay($item['link']) ?>
	</div>
<?php endif; ?>	