<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;

class GVAElement_BA_Booking_All extends GVAElement_Base{
	 
	const NAME = 'gva_ba_booking';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'tevily_ba_booking';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('BA Booking All Items', 'tevily-themer');
	}

	public function get_keywords() {
		return [ 'booking', 'ba', 'tour', 'book everthing', 'items' ];
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
		$categories = BABE_Post_types::get_categories_arr();
		$categories[0] =  esc_html__('- All Categories -', 'tevily-themer');
		 
		$output = array(0 => esc_html__('All', 'tevily-themer'));

		// Taxonomies
		$taxonomies_list = array();
	
		$taxonomies = get_terms(array(
			'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
			'hide_empty' => false
		));

		if(!is_wp_error($taxonomies) && ! empty($taxonomies)){
			foreach ($taxonomies as $tax_term) {
				$taxonomies_list[$tax_term->slug] = apply_filters('translate_text', $tax_term->name);
				foreach ($categories as $id => $title) {
					$categories_taxonomies = get_term_meta($id, 'categories_taxonomies', true);
				}
				$categories_taxonomies[$tax_term->slug] = get_term_meta($tax_term->term_id, 'categories_taxonomies', false);
			}
		}

		//--
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'tevily-themer'),
			]
		);

		$this->add_control(
			'category_ids',
			array(
				'label'   => esc_html__('Category', 'tevily-themer'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $categories,
				'default' => '0',
			)
		);

		$this->add_control(
			'ids',
			array(
				'label'       	=> esc_html__('Items', 'tevily-themer'),
				'description' 	=> esc_html__('Show selected items only with ID, example: 5,8,10,20,26', 'tevily-themer'),
				'type'        	=> 'text',
				'label_block' 	=> true,
				'placeholder'	=> '1,2,3,4,5'
			)
		);

		$this->add_control(
			'date_from',
			array(
				 'label'          => esc_html__('Date from','tevily-themer'),
				 'description'    => esc_html__('Show items which are available from selected date.','tevily-themer'),
				 'type'           => \Elementor\Controls_Manager::DATE_TIME,
				 'picker_options' => [
					  'dateFormat' => BABE_Settings::$settings['date_format'],
					  'enableTime' => false,
				 ],
			)
		);

		$this->add_control(
			'date_to',
			array(
				 'label'          => esc_html__('Date to','tevily-themer'),
				 'description'    => esc_html__('Show items which are available up to selected date.','tevily-themer'),
				 'type'           => \Elementor\Controls_Manager::DATE_TIME,
				 'picker_options' => [
					  'dateFormat' => BABE_Settings::$settings['date_format'],
					  'enableTime' => false,
				 ],
			)
		);

		$this->add_control(
			'per_page',
			array(
				'label'       => esc_html__('Per Page', 'tevily-themer'),
				'description' => esc_html__('How much items per page to show (-1 to show all items)', 'tevily-themer'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '12',
			)
		);

		$this->add_control(
			'sort',
			array(
				'label'       => esc_html__('Order By','tevily-themer'),
				'description' => '',
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => array(
					''						=> esc_html__('Default', 'tevily-themer'),
					'rating'          => esc_html__('Rating', 'tevily-themer'),
               'price_from'      => esc_html__('Price from', 'tevily-themer'),
               'post_title'      => esc_html__('Post title', 'tevily-themer'),
               'av_date_from'    => esc_html__('Date From', 'tevily-themer')
				),
				'default'     => 'rating'
			)
		);

		$this->add_control(
			'sortby',
			array(
				'label'       => esc_html__('Order','tevily-themer'),
				'description' => esc_html__('Designates the ascending or descending order. Default by DESC','tevily-themer'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => array(
				  	'ASC'  => esc_html__('Ascending','tevily-themer'),
				  	'DESC' => esc_html__('Descending','tevily-themer'),
				),
				'default'     => 'DESC',
			)
		);

		$this->add_control(
			'layout_heading',
			array(
				'label'   => esc_html__( 'Layout Settings', 'tevily-themer' ),
				'type'    => 'heading',
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'tevily-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'list-small'	=> esc_html__('List Small', 'tevily-themer'),
					'grid' 			=> esc_html__('Grid', 'tevily-themer'),
					'carousel' 		=> esc_html__('Carousel', 'tevily-themer')
				]
			)
		);
		$this->add_control(
         'pagination',
         [
             'label'     => __('Pagination', 'tevily-themer'),
             'type'      => Controls_Manager::SWITCHER,
             'default'   => 'no',
             'condition' => [
                 'layout' => 'grid'
             ],
         ]
     );

		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'tevily-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      => __( 'Item Block Style I', 'tevily-themer' ),
					'style-2'      => __( 'Item Block Style II', 'tevily-themer' ),
					'style-3'      => __( 'Item Block Style III', 'tevily-themer' )
				],
				'condition' => [
					'layout' => array('grid', 'carousel')
				]
			]
	  	);

	  	$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'tevily-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'full'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			self::NAME . '_taxonomy',
			[
				'label' => __('Taxonomies Option', 'tevily-themer'),
			]
		);
		if($taxonomies_list){
			foreach ($taxonomies_list as $key => $name){
				$taxonomies = $this->get_taxonomy_by_slug($key);
				$this->add_control(
					$key . '_ids',
					array(
						'label'       => $name,
						'description' => esc_html__('Show selected category of taxonomy. Input item title to see suggestions', 'tevily-themer'),
						'type'        => \Elementor\Controls_Manager::SELECT2,
						'multiple'    => true,
						'options'     => $taxonomies,
						'label_block' => true,
					)
				);
			}
		}
		$this->end_controls_section();


		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

	}

	protected function get_taxonomy_by_slug($slug){
		$taxonomy = get_term_by( 'slug', $slug, BABE_Post_types::$taxonomies_list_tax);
		$output = array();
		if (! is_wp_error($taxonomy) && ! empty($taxonomy)){
			$taxonomies = get_terms(array(
				'taxonomy' => BABE_Post_types::$attr_tax_pref . $taxonomy->slug,
				'hide_empty' => false
			));
			if ( ! is_wp_error( $taxonomies ) && ! empty( $taxonomies ) ) {
				foreach ($taxonomies as $tax_term) {
					$output[$tax_term->term_id] = $tax_term->name;
				}
			}
		}
		return $output;
	}

	public function all_items_shortcode(){
		$settings = $this->get_settings_for_display();
		$args = array();
		$category_id = $settings['category_ids'];

		if($category_id){
			$term_ids = '';
			$categories_taxonomies = get_term_meta($category_id, 'categories_taxonomies', true);
			$taxonomies = get_terms(array(
				'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
				'include'  => $categories_taxonomies,
				'hide_empty' => false
			));

			if (!is_wp_error( $taxonomies ) && ! empty( $taxonomies)){
				foreach ($taxonomies as $tax_term) {
					$setting_key =  $tax_term->slug . '_ids';
					if($settings[$setting_key]){
						$term_ids .= empty($term_ids) ? '' : ',';
						$term_ids .= implode(',', $settings[$setting_key]);
					}
				}
			}
			if($term_ids){
				$args[] = 'term_ids="' . $term_ids. '"'; 
			}
		}

      if($settings['category_ids']){
       	$args[] =  'category_ids="' . absint($settings['category_ids']) . '"';
      }

      if($settings['ids']){
       	$args[] =  'ids="' . $settings['ids'] . '"';
      }

		if(absint($settings['per_page'])){
      	$args[]  = 'per_page="' . intval($settings['per_page']) . '"';
		}

		if($settings['date_from']){
       	$args[] =  'date_from="' . esc_attr($settings['date_from']) . '"';
      }

      if($settings['date_to']){
       	$args[] =  'date_to="' . esc_attr($settings['date_to']) . '"';
      }

      if($settings['sort']){
       	$args[] =  'sort="' . esc_attr($settings['sort']) . '"';
      }

      if($settings['sortby']){
       	$args[] =  'sortby="' . esc_attr($settings['sortby']) . '"';
      }

      if($settings['pagination']){
      	$args[] = ' pagination=1';
      }

		return '[all-items ' . implode(' ', $args) . '][/all-items]';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		add_filter('babe_shortcode_all_items_item_html', array($this, 'shortcode_all_items_item_html'), 10, 3);
		add_filter( 'babe_shortcode_all_items_html', array($this, 'shortcode_all_items_html'), 10, 3 );

		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		if(isset($settings['layout']) && $settings['layout']){
			include $this->get_template('booking/all-items/' . $settings['layout'] . '.php');
		}
		print '</div>';
	}

	public function shortcode_all_items_item_html($content, $post, $babe_post){
		$settings = $this->get_controls_settings();
		$item_style = $settings['style'];
		ob_start();

		echo ($settings['layout'] == 'carousel' ? '<div class="swiper-slide">' : '');
		echo ($settings['layout'] == 'grid' ? '<div class="item-column">' : '');
		
		if($settings['layout'] == 'list-small'){
			$item_style = 'style-list-small';
			echo '<div class="item-list">';
		}

		include get_theme_file_path('templates/booking/block/item-' . $item_style . '.php');

		echo '</div>';
		
		return ob_get_clean();
	}

	public function shortcode_all_items_html($output, $args, $post_args){
		return BABE_shortcodes::get_posts_tile_view($post_args);

	}


}
$widgets_manager->register(new GVAElement_BA_Booking_All());
