<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Price_From extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_price_from';
   const TEMPLATE = 'booking/item-price-from';
   const CATEGORY = 'tevily_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Price From', 'tevily-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'price', 'from' ];
   }

   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'tevily-themer'),
         ]
      );

      $this->add_control(
         'title_text',
         [
            'label'        => esc_html__( 'Title', 'tevily-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'tevily-themer' ),
            'default'      => esc_html__( 'From', 'tevily-themer' ),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'selected_icon',
         [
            'label'      => esc_html__('Choose Icon', 'tevily-themer'),
            'type'       => Controls_Manager::ICONS,
            'default' => [
              'value' => 'fas fa-home',
              'library' => 'fa-solid',
            ]
         ]
      );

      $this->add_control(
         'heading_style_title',
         [
            'label' => esc_html__( 'Style Title Text', 'tevily-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'title_color',
         [
            'label' => esc_html__( 'Text Color', 'tevily-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tevily-single-price_from .ba-meta-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .tevily-single-price_from .ba-meta-title',
         ]
      );

      $this->add_control(
         'heading_style_value',
         [
            'label' => esc_html__( 'Style Value Text', 'tevily-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'value_color',
         [
            'label' => esc_html__( 'Text Color', 'tevily-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tevily-single-price_from .item-value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'value_typography',
            'selector' => '{{WRAPPER}} .tevily-single-price_from .item-value',
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
               '{{WRAPPER}} .tevily-single-price_from .icon i' => 'color: {{VALUE}};',
               '{{WRAPPER}} .tevily-single-price_from .icon svg' => 'fill: {{VALUE}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'icon_size',
         [
            'label' => __( 'Size', 'tevily-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 32
            ],
            'range' => [
              'px' => [
                'min' => 20,
                'max' => 80,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .tevily-single-price_from .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
              '{{WRAPPER}} .tevily-single-price_from .icon svg' => 'width: {{SIZE}}{{UNIT}};'
            ],
         ]
      );

      $this->add_responsive_control(
         'icon_space',
         [
            'label' => __( 'Spacing', 'tevily-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 15,
            ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 50,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .tevily-single-price_from .icon' => 'padding-right: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_BA_Price_From());
