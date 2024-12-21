<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Services_Group extends GVAElement_Base{
  	const NAME = 'gva-services-group';
  	const TEMPLATE = 'general/services-group/';
  	const CATEGORY = 'tevily_general';

  	public function get_name() {
	 	return self::NAME;
  	}

  	public function get_categories() {
	 	return array(self::CATEGORY);
  	}


	public function get_title() {
		return __('Services Group', 'tevily-themer');
	}

	public function get_keywords() {
		return [ 'services', 'content', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	 protected function register_controls() {
		  $this->start_controls_section(
				'section_content',
				[
					 'label' => __('Content', 'tevily-themer'),
				]
		  );
		  $this->add_control( // xx Layout
				'layout_heading',
				[
					 'label'   => __( 'Layout', 'tevily-themer' ),
					 'type'    => Controls_Manager::HEADING,
				]
		  );
			$this->add_control(
				'layout',
				[
					 'label'   => __( 'Layout Display', 'tevily-themer' ),
					 'type'    => Controls_Manager::SELECT,
					 'default' => 'grid',
					 'options' => [
						  'grid'      => __( 'Grid', 'tevily-themer' ),
						  'carousel'  => __( 'Carousel', 'tevily-themer' )
					 ]
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
					 ],
					 'default' => 'style-1',
				]
		  );
		  $repeater = new Repeater();
		  $repeater->add_control(
			 'title',
			 [
				'label'       => __('Title', 'tevily-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'desc',
			 [
				'label'       => __('Description', 'tevily-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do.',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
				'image',
				[
					 'label'      => __('Choose Image', 'tevily-themer'),
					 'default'    => [
						  'url' => GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/service-1.jpg',
					 ],
					 'type'       => Controls_Manager::MEDIA,
					 'show_label' => false,
					 'condition' => [
						  'style' => ['style-2'],
					 ],
				]
		  );
		  $repeater->add_control(
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
		  $repeater->add_control(
			 'link',
			 [
				'label'     => __( 'Link', 'tevily-themer' ),
				'type'      => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'tevily-themer' ),
				'label_block' => true
			 ]
		  );
		  
		  $this->add_control(
			 'services_content',
			 [
				'label'       => __('Service Content Item', 'tevily-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  array(
					 'title'  => esc_html__( 'Interior Design', 'tevily-themer' ),
				  ),
				  array(
					 'title'       => esc_html__( 'A rchitectures', 'tevily-themer' ),
				  ),
				  array(
					 'title'  => esc_html__( 'Desiging Solutions', 'tevily-themer' ),
				  ),
				  array(
					 'title'  => esc_html__( 'Redesigning Dreams', 'tevily-themer' ),
				  ),
				)
			 ]
		  );
		  
		  $this->end_controls_section();

		  $this->add_control_carousel(false, array('layout' => 'carousel'));

		  $this->add_control_grid(array('layout' => 'grid'));

		  // Icon Styling
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
				'label' => __( 'Icon Color', 'tevily-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .box-icon i' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content svg' => 'fill: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_size',
			 [
				'label' => __( 'Size', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 60
				],
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .box-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_space',
			 [
				'label' => __( 'Spacing', 'tevily-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 0,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				  'size'  => 5
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .title a' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-services-group .icon-box-item-content .title, {{WRAPPER}} .gsc-services-group .icon-box-item-content .title a',
			 ]
		  );

		  $this->add_control(
			 'heading_description',
			 [
				'label' => __( 'Description', 'tevily-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
				  'style' => ['style-2'],
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
				  '{{WRAPPER}} .gsc-services-group .icon-box-item-content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
				  'style' => ['style-2'],
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-services-group .icon-box-item-content',
				'condition' => [
				  'style' => ['style-2'],
				],

			 ]
		  );

		  $this->end_controls_section();
	 }

	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		if( !empty($settings['layout']) ){
			include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
		}
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Services_Group());
