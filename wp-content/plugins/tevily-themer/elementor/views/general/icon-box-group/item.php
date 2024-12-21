<?php 
use Elementor\Icons_Manager;
	
$has_icon = ! empty( $item['selected_icon']['value']); 

?>
<div class="icon-box-item elementor-repeater-item-<?php echo $item['_id'] ?><?php echo ($item['active']=='yes' ? ' active' : '') ?>">
	<div class="icon-box-content">
		
		<?php if( $settings['style'] == 'style-1' || $settings['style'] == 'style-2' ){ ?>
			
			<?php if ($has_icon){ ?>
				<div class="box-icon">
					<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php } ?>

			<?php if($item['title']){ ?>
				<h3 class="title"><?php echo $item['title'] ?></h3>
			<?php } ?>

		<?php } ?>	

	</div>  	
	<?php $this->gva_render_link_html('', $item['link'], 'link-overlay'); ?>
</div>