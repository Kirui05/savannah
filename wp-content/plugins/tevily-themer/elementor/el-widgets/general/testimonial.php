<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Testimonial extends GVAElement_Base{
    const NAME = 'gva-testimonials';
    const TEMPLATE = 'general/testimonials/';
    const CATEGORY = 'tevily_general';

    public function get_name() {
        return self::NAME;
    }

    public function get_categories() {
        return array(self::CATEGORY);
    }

    public function get_title() {
        return __('Testimonials', 'tevily-themer');
    }

    public function get_keywords() {
        return [ 'testimonial', 'content', 'carousel' ];
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
            'section_testimonial',
            [
                'label' => __('Testimonials', 'tevily-themer'),
            ]
        );
        $this->add_control(
            'style',
            array(
                'label'   => esc_html__( 'Style', 'tevily-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                  'style-1' => esc_html__('Carousel I', 'tevily-themer'),
                  'style-2' => esc_html__('Carousel II', 'tevily-themer'),
                  'style-3' => esc_html__('Carousel III', 'tevily-themer'),
                ]
            )
         );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'testimonial_content',
            [
                'label'       => __('Content', 'tevily-themer'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );
        $repeater->add_control(
            'testimonial_image',
            [
                'label'      => __('Choose Image', 'tevily-themer'),
                'default'    => [
                    'url' => GAVIAS_TEVILY_PLUGIN_URL . 'elementor/assets/images/testimonial.png',
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => __('Name', 'tevily-themer'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $repeater->add_control(
            'testimonial_job',
            [
                'label'   => __('Job', 'tevily-themer'),
                'default' => 'Designer',
                'type'    => Controls_Manager::TEXT,
            ]
        );        
 
        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Content Item', 'tevily-themer'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
                'default'     => array(
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.', 'tevily-themer' ),
                        'testimonial_name'     => esc_html__( 'Christine Eve', 'tevily-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'tevily-themer' ),
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.', 'tevily-themer' ),
                        'testimonial_name'     => esc_html__( 'Kevin Smith', 'tevily-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'tevily-themer' ),
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.', 'tevily-themer' ),
                        'testimonial_name'     => esc_html__( 'Jessica Brown', 'tevily-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'tevily-themer' ),
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.', 'tevily-themer' ),
                        'testimonial_name'     => esc_html__( 'David Anderson', 'tevily-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'tevily-themer' ),
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the moling services, not lorem ipsum is simply free text of used by refreshing. Neque porro este qui dolorem ipsum quia.', 'tevily-themer' ),
                        'testimonial_name'     => esc_html__( 'Susan Neill', 'tevily-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'tevily-themer' ),
                    ),
                ),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', 
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'style' => array('style-1', 'style-2')
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'tevily-themer'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();

         $this->add_control_carousel( false,
            array(
               'style' => ['style-1', 'style-2', 'style-3']
            )
         );

        // Style.
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'tevily-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Text Color', 'tevily-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-content .testimonial-quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .gva-testimonial-carousel .testimonial-item .testimonial-content .testimonial-quote',
            ]
        );

        $this->end_controls_section();

        // Image Styling
        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => __('Image', 'tevily-themer'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __('Image Size', 'tevily-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'tevily-themer'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Styling
        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('Name', 'tevily-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'tevily-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .dot' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .testimonial-name',
            ]
        );

        $this->end_controls_section();

        // Job Styling
        $this->start_controls_section(
            'section_style_job',
            [
                'label' => __('Job', 'tevily-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Text Color', 'tevily-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-job, {{WRAPPER}} .testimonial-job a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
      $settings = $this->get_settings_for_display();
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
      if(isset($settings['style']) && $settings['style']){
         include $this->get_template(self::TEMPLATE . 'gva-testimonials-' . $settings['style'] . '.php');
      }
      print '</div>';
    }
}

$widgets_manager->register(new GVAElement_Testimonial());
