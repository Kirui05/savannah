<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Included_Excluded extends GVAElement_Base{
	 
	const NAME = 'gva_ba_item_included_excluded';
	const TEMPLATE = 'booking/item-included-excluded';
	const CATEGORY = 'tevily_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Item Included/Excluded', 'tevily-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'item', 'book everthing', 'included', 'excluded' ];
	}


	protected function register_controls(){
		//--
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => esc_html__('Content', 'tevily-themer'),
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __( 'Type', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'included'      => __( 'Included', 'tevily-themer' ),
					'excluded'      => __( 'Excluded', 'tevily-themer' ),
				],
				'default' => 'included',
			]
		);

		$this->add_control(
			'heading_style_value',
			[
				'label' => esc_html__( 'Style Text', 'tevily-themer' ),
				'type' => Controls_Manager::HEADING
			]
		);


		 $this->add_control(
			'list_item_space',
			[
				'label' => esc_html__( 'List Item space', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 8
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 30,
				  ],
				],
				'selectors' => [
					'{{WRAPPER}} .tevily-single-in-ex ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => esc_html__( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tevily-single-in-ex ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
				'selector' => '{{WRAPPER}} .tevily-single-in-ex ul li',
			]
		);

		// --- Style Icon ---
		$this->add_control(
			'heading_style_icon',
			[
				'label' => esc_html__( 'Style Icon', 'tevily-themer' ),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tevily-single-in-ex ul li:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 14
				],
				'range' => [
				  'px' => [
					 'min' => 5,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .tevily-single-in-ex ul li:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 10,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .tevily-single-in-ex ul li:before' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

	}

	protected function render(){
		parent::render();

		$settings = $this->get_settings_for_display();
		printf( '<div class="tevily-%s tevily-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_BA_Item_Included_Excluded());
