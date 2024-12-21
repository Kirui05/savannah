<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Heading_Block extends GVAElement_Base {
	const NAME = 'gva-heading-block';
   const TEMPLATE = 'general/heading-block';
   const CATEGORY = 'tevily_general';

    public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Heading Block', 'tevily-themer' );
	}

	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	public function get_script_depends() {
		return [
			'typed',
			'gavias.elements',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'tevily-themer' ),
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Sub Title', 'tevily-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'tevily-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your title', 'tevily-themer' ),
				'default' => __( 'Add Your Heading Text Here', 'tevily-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'tevily-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'tevily-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' => esc_html__('Style I', 'tevily-themer'),
					'style-2' => esc_html__('Style II', 'tevily-themer'),
					'style-3' => esc_html__('Style III', 'tevily-themer'),
					'style-4' => esc_html__('Style IV', 'tevily-themer'),
					'style-5' => esc_html__('Style V', 'tevily-themer')
				],
				'default' => 'style-1',
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
			'align',
			[
				'label' => __( 'Alignment Text', 'tevily-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'tevily-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tevily-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'tevily-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'box_align',
			[
				'label' => __( 'Alignment Box', 'tevily-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'tevily-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tevily-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'tevily-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label' => __( 'Max Width (px)', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1170,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'auto_responsive',
			[
				'label' => __( 'Auto Responsive', 'tevily-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Auto Responsive size of title', 'tevily-themer' ),
				'default' => 'yes'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_icon',
			[
				'label' => __( 'Icon', 'tevily-themer' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'tevily-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Enable/Disable Icon Heading', 'tevily-themer' ),
				'default' => 'no'
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'tevily-themer' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_video',
			[
				'label' => __( 'Video Top', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'video',
			[
				'label' 			=> __( 'Video', 'tevily-themer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> __( 'Enable/Disable Video Heading', 'tevily-themer' ),
				'default' 		=> 'no'
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' 			=> __( 'Video Youtube or Vimeo URL', 'tevily-themer' ),
				'label_block'	=> true,
				'type' 			=> Controls_Manager::TEXT,
				'condition' => [
					'video' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( //** Section Button
			'section_button',
			[
				'label' => __( 'Button', 'tevily-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 	=> __( 'Button URL', 'tevily-themer' ),
				'type' 	=> Controls_Manager::URL,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'tevily-themer' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> 'Read More'
			]
		);
		$this->add_control(
			'button_style',
			[
				'label' 	=> __( 'Button Style', 'tevily-themer' ),
				'type' 	=> Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 		=> esc_html__('Button Theme', 'tevily-themer'),
					'btn-theme-2' 		=> esc_html__('Button Theme Second', 'tevily-themer'),
					'btn-white' 		=> esc_html__('Button White', 'tevily-themer'),
					'btn-black' 		=> esc_html__('Button Black', 'tevily-themer')
				],
				'default' => 'btn-theme',
			]
		);
		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'tevily-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> esc_html__('Button Size Default', 'tevily-themer'),
					'btn-size-small' 	=> esc_html__('Button Small', 'tevily-themer'),
					'btn-medium' 		=> esc_html__('Button Medium', 'tevily-themer')
				],
				'default' => '',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color Hover', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover',
			[
				'label' => __( 'Button Background Hover', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_video_style',
			[
				'label' => __( 'Video Button', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video' => 'yes',
				],
			]
		);
		$this->add_control(
			'video_background_primary',
			[
				'label' => __( 'Primary Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_background_second',
			[
				'label' => __( 'Primary Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_color',
			[
				'label' => __( 'Text Button Video Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'video_size',
			[
				'label' => __( 'Video Button Size', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 92,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'tevily-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		$this->add_responsive_control(
			'box_space',
			[
				'label' => __( 'Heading Element Space Bottom', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-heading .title',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Title Spacing', 'tevily-themer' ),
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
					'{{WRAPPER}} .gsc-heading .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => __( 'Sub Title', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_line_color',
			[
				'label' => __( 'Line Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_space',
			[
				'label' => __( 'Sub Title Spacing', 'tevily-themer' ),
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
					'{{WRAPPER}} .gsc-heading .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-heading .sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => __( 'Description', 'tevily-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-heading .title-desc',
			]
		);

		$this->add_responsive_control(
			'description_space',
			[
				'label' => __( 'Description Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
              'top'       => 20,
              'right'     => 0,
              'left'      => 0,
              'bottom'    => 0,
              'unit'      => 'px'
          	],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_Heading_Block());
