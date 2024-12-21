<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Calendar extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_calendar';
   const TEMPLATE = 'booking/item-calendar';
   const CATEGORY = 'tevily_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Calendar', 'tevily-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'calendar' ];
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
            'type'         => Controls_Manager::TEXTAREA,
            'placeholder'  => esc_html__( 'Enter your title', 'tevily-themer' ),
            'default'      => esc_html__( 'Calendar & Price', 'tevily-themer' ),
            'label_block'  => true
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
               '{{WRAPPER}} .tevily-single-calendar .ba-meta-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .tevily-single-calendar .ba-meta-title',
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

$widgets_manager->register(new GVAElement_BA_Item_Calendar());
