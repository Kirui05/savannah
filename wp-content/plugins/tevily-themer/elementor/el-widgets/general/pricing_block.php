<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Pricing_Block extends GVAElement_Base {
	const NAME = 'gva-pricing-block';
   const TEMPLATE = 'general/pricing-block';
   const CATEGORY = 'tevily_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Pricing Block', 'tevily-themer' );
	}

	public function get_keywords() {
		return [ 'pricing', 'block' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I: Default', 'tevily-themer' ),
					'style-2' 		=> __( 'Style II: Scale 0.95', 'tevily-themer' )
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'tevily-themer' ),
				'default' => __( 'Standard', 'tevily-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Private amenities', 'tevily-themer' ),
				'default' => __( 'Private amenities', 'tevily-themer' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_text',
			[
				'label' => __( 'Description', 'tevily-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Your Description', 'tevily-themer' ),
				'default' => __( 'There are many new variatns of pasages of available text.', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '60.00', 'tevily-themer' ),
				'default' => __( '60.00', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Currency', 'tevily-themer' ),
				'default' => __( '$', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Monthly', 'tevily-themer' ),
				'default' => __( 'Monthly', 'tevily-themer' ),
			]
		);

		$repeater = new Repeater();
      $repeater->add_control(
         'pricing_features',
			[
	         'label'       => __('Pricing Features', 'tevily-themer'),
	         'type'        => Controls_Manager::TEXT,
	         'default'     => 'Free text goes here',
	         'label_block' => true,
	         'rows'        => '10',
	     	]
	   );
		$this->add_control(
         'pricing_content',
         [
            'label'       => __('Pricing Features', 'tevily-themer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ pricing_features }}}',
            'default'     => array(
               array(
                  'pricing_features'  => esc_html__( '3D Visualization', 'tevily-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Planning Solution', 'tevily-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Selection of Materials', 'tevily-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( '10 Construction Drawings', 'tevily-themer' )
               )
            ),
         ]
      );

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_Button',
			[
				'label' => __( 'Button', 'tevily-themer' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'tevily-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Read More'
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 		=> esc_html__('Button Theme', 'tevily-themer'),
					'btn-theme-2' 		=> esc_html__('Button Theme Second', 'tevily-themer'),
					'btn-white' 		=> esc_html__('Button White', 'tevily-themer'),
					'btn-black' 		=> esc_html__('Button Black', 'tevily-themer')
				],
				'default' => 'btn-white',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-pricing .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price Text', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_price_text',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Pricing_Block());
