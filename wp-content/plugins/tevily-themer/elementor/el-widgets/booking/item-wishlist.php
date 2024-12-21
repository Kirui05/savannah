<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Wishlist extends GVAElement_Base{
	 
	const NAME = 'gva_ba_item_wishlist';
	const TEMPLATE = 'booking/item-wishlist';
	const CATEGORY = 'tevily_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Item Wishlist', 'tevily-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'item', 'book everthing', 'wishlist' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'tevily-themer'),
			]
		);

		$this->end_controls_section();

	}

	protected function render(){
		parent::render();
		
		global $tevily_post;

   	if(!$tevily_post){ return; }

  	 	if($tevily_post->post_type != BABE_Post_types::$booking_obj_post_type){ return;}

		$settings = $this->get_settings_for_display();
		printf('<div class="tevily-%s tevily-element">', $this->get_name());
			echo '<div class="tevily-single-wishlist">';
				if(class_exists('Tevily_Addons_Wishlist_Ajax')){ 
         		echo Tevily_Addons_Wishlist_Ajax::html_icon($tevily_post->ID, esc_html__('Wishlist', 'tevily-themer'));
         	} 
			echo '</div>';
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_BA_Item_Wishlist());
