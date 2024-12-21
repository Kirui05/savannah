<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Image_Content extends GVAElement_Base {
	const NAME = 'gva-image-content';
	const TEMPLATE = 'general/image-content';
	const CATEGORY = 'tevily_general';

   public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Image Content', 'tevily-themer' );
	}
	
	public function get_keywords() {
		return [ 'image', 'content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
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
					'skin-v1' => esc_html__('Style I', 'tevily-themer'),
					'skin-v2' => esc_html__('Style II', 'tevily-themer'),
					'skin-v3' => esc_html__('Style III', 'tevily-themer'),
					'skin-v4' => esc_html__('Style IV', 'tevily-themer'),
					'skin-v5' => esc_html__('Style V', 'tevily-themer'),
					'skin-v6' => esc_html__('Style VI', 'tevily-themer'),
					'skin-v7' => esc_html__('Style VII', 'tevily-themer')
				],
				'default' => 'skin-v1',
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'tevily-themer' ),
				'default' => __( 'Quality Standards', 'tevily-themer' ),
				'label_block' => true,
				'condition' => [
					'style' => ['skin-v1']
				],
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'tevily-themer' ),
				'default' => __( 'Quality Standards', 'tevily-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'tevily-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				],
			]
		);

		$this->add_control(
			'image_second',
			[
				'label' => __( 'Choose Image Second', 'tolips-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/image-2.jpg',
				],
				'condition' => [
					'style' => ['skin-v5']
				],
			]
		);
		
		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
	         'condition' => [
					'style!' => ['skin-v5'],
				]
         ]
      );
		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'tevily-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'tevily-themer' ),
				'condition' => [
					'style!' => ['skin-v1', 'skin-v2', 'skin-v3'],
				],
			]
		);
		
		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'tevily-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'tevily-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Text Link', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'tevily-themer' ),
				'default' => __( 'Read More', 'tevily-themer' ),
				'condition' => [
					'style!' => ['skin-v1'],
				],
			]
		);

		$this->end_controls_section();

		// Icon Box Content
		$this->start_controls_section(
			'section_icon_box_content',
			[
				'label' => __( 'Icon Box', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => ['skin-v1']
				],
			]
		);

		$this->add_control(
       	'selected_icon',
       	[
         	'label'      => __('Choose Icon', 'tevily-themer'),
         	'type'       => Controls_Manager::ICONS,
         	'default' => [
           		'value' => 'fas fa-home',
           		'library' => 'fa-solid',
         	]
       	]
     	);

		$this->add_control(
       	'icon_box_title',
       	[
         	'label'      => __('Title', 'tevily-themer'),
         	'type'       => Controls_Manager::TEXT,
         	'default' 	 => esc_html__('Book Tour Now', 'tevily-themer'),
       	]
     	);

     	$this->add_control(
       	'icon_box_desc',
       	[
         	'label'      => __('Description', 'tevily-themer'),
         	'type'       => Controls_Manager::TEXT,
         	'default' 	 => esc_html__('66888000', 'tevily-themer')
       	]
     	);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box', 'tevily-themer' ),
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
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v3 .box-background::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v3 .image::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['skin-v1'],
				],
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .title',
			]
		);

		$this->add_control(
			'title_space_bottom',
			[
				'label' => __( 'Space Bottom', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v2', 'skin-v4'],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .desc',
			]
		);

		$this->add_control(
			'content_space_bottom',
			[
				'label' => __( 'Space Bottom', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}

}

 $widgets_manager->register(new GVAElement_Image_Content());
