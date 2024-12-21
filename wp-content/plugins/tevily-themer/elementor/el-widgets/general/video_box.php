<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Video_Box extends GVAElement_Base {  
	const NAME = 'gva-video-box';
   const TEMPLATE = 'general/video-box';
   const CATEGORY = 'tevily_general';

   public function get_categories(){
      return array(self::CATEGORY);
   }
    
   public function get_name(){
      return self::NAME;
   }

	public function get_title() {
		return __( 'Video Box', 'tevily-themer' );
	}

	public function get_keywords() {
		return [ 'video', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Content', 'tevily-themer' ),
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Title', 'tevily-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'style', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I', 'tevily-themer' ),
					'style-2' 		=> __( 'Style II', 'tevily-themer' ),
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'tevily-themer' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
               'url' => GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/video.jpg',
				],
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link Video (Youtube/Vimeo)', 'tevily-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'tevily-themer' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1 .icon-inner::before, {{WRAPPER}} .gsc-icon-box-styles.style-1 .icon-inner::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .block-content::before, {{WRAPPER}} .gsc-icon-box-styles.style-2 .block-content::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'tevily-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Primary Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}. gsc-icon-box-styles .icon-inner .icon' => 'color: {{VALUE}};'
				],
			]
		);


		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box.right .highlight-icon' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box.left .highlight-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box.top .highlight-icon' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .highlight-icon' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'tevily-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'tevily-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .title, {{WRAPPER}} .gsc-icon-box-styles .title a',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'tevily-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .highlight_content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .highlight_content .desc',
				'condition' => [
					'style' => 'style-1',
				],

			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
			[
				'label' => __( 'Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_Video_Box());
