<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_BA_Item_Address_Map extends GVAElement_Base{
    
   const NAME = 'gva_ba_item_address_map';
   const TEMPLATE = 'booking/item-address-map';
   const CATEGORY = 'tevily_ba_booking';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Address Map', 'tevily-themer');
   }

   public function get_keywords() {
      return [ 'booking', 'ba', 'item', 'book everthing', 'address', 'map' ];
   }


   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'tevily-themer'),
         ]
      );

      $this->add_control(
         'style',
         array(
            'label'       => esc_html__('Style', 'tevily-themer'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => array(
               'style-1'   => esc_html__('Map default','tevily-themer'),
               'style-2'   => esc_html__('Map with meeting point','tevily-themer')
            ),
            'default'     => 'style-1'
         )
      );

      $this->add_control(
         'title_text',
         [
            'label' => __( 'Title Text', 'tevily-themer' ),
            'type' => Controls_Manager::TEXT,
            'selectors' => [
               '{{WRAPPER}} .tevily-single-address-map .title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_control(
         'title_color',
         [
            'label' => __( 'Text Color', 'tevily-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tevily-single-address-map .title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .tevily-single-address .title',
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

$widgets_manager->register(new GVAElement_BA_Item_Address_Map());
