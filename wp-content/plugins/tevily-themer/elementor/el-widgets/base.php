<?php
if(!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

abstract class GVAElement_Base extends Elementor\Widget_Base {
  
   public function get_icon() {
      return 'tevily-icon-theme';
   }

   private function get_preview_post_default($post_type){
      $query = new WP_Query([
         'post_type'          => $post_type,
         'posts_per_page'     => 1,
         'numberposts'        => 1,
         'post_status'        => 'publish',
         'orderby'            => 'ID',
         'order'              => 'desc'
      ]);
      $post_id = 0;
       foreach ($query->posts as $post) {
         if($post->ID > 0){
            $post_id = $post->ID;
         }
      }
      wp_reset_postdata();
      return $post_id;
   }

   protected function render(){

      global $tevily_post, $post, $tevily_term_id;
      
      $post_type = get_post_type();
      $post_id = get_the_ID();
      $post_preview = 0;
      if ($post_type === 'gva__template' || $post_type === 'elementor_library'){
      	
      	$document = Plugin::instance()->documents->get($post_id);
      	$template_type = get_post_meta(get_the_ID(), 'gva_template_type', true);

      	$preview_post_id = 0;
      	$tevily_term_id = 0;
      	$post_preview = $document->get_settings('tevily_post_preview');

      	switch ($template_type){
      		case 'post_single_layout':
      			$preview_post_id = $post_preview ? $post_preview : $this->get_preview_post_default('post');
      			break;
      		case 'single_booking_layout':	
      			$preview_post_id = $post_preview ? $post_preview : $this->get_preview_post_default('to_book');
      			break;
      		case 'archive_booking_layout':
      			$tevily_term_id = $post_preview ? $post_preview : 37;
      	}

         $tevily_post =  get_post($preview_post_id);
      }else{
      	$tevily_post = $post;

      	//term_id
      	$object = get_queried_object();

         if(!empty($object)){
             $tevily_term_id = isset($object->term_id) && $object->term_id ? $object->term_id : $post_preview;
         }
      }
   }

   protected function add_control_image_size($default, $key = 'tevily_image', $label = ''){
        if (empty($label)) {
            $label = esc_html__('Image Thumbnail', 'tevily-themer');
        }
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
               'name' => $key,
               'label' => $label,
               'default' => $default
            ]
        );
    }

  protected function add_control_carousel($single_item, $condition = array()) {
	  	$this->start_controls_section(
			'section_carousel_options',
			[
				'label' => __('Carousel Options', 'tevily-themer'),
				'type'  => Controls_Manager::SECTION,
				'condition' => $condition,
			]
	  	);

	  	if($single_item != 'always_single'){
		 	$this->add_control(
			 	'ca_items_lg',
			 	[
					'label'     => __('Columns for Large Screen', 'tevily-themer'),
					'type'      => Controls_Manager::SELECT,
					'default'   => $single_item == true ? 1 : 3,
					'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
			 	]
		 	);

		  	$this->add_control(
			 	'ca_items_md',
			 	[
					'label'     => __('Columns for Medium Screen', 'tevily-themer'),
					'type'      => Controls_Manager::SELECT,
					'default'   => $single_item == true ? 1 : 3,
					'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
			 	]
		  	);

			$this->add_control(
				'ca_items_sm',
				[
				  	'label'     => __('Columns for Small Screen', 'tevily-themer'),
				  	'type'      => Controls_Manager::SELECT,
				  	'default'   => $single_item == true ? 1 : 2,
				  	'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
				]
			);

			$this->add_control(
				'ca_items_xs',
				[
				  'label'     => __('Columns for Extra Small Screen', 'tevily-themer'),
				  'type'      => Controls_Manager::SELECT,
				  'default'   => 1,
				  'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
				]
			);

			$this->add_control(
				'ca_items_xx',
				[
				  'label'     => __('Columns for Very Extra Small Screen', 'tevily-themer'),
				  'type'      => Controls_Manager::SELECT,
				  'default'   => 1,
				  'options'   => array(1=>1, 2=>2, 3=>3)
				]
		 	);
		 	$this->add_control(
				'space_between',
				[
				  'label'     => __('Space Between Items', 'tevily-themer'),
				  'type'      => Controls_Manager::NUMBER,
					'default'	=> 30
				]
		 	);
		}  

		$this->add_control(
			'ca_effect',
			[
				'label'     => __('Effect', 'tevily-themer'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slide',
				'options'   => array(
					'slide'		=>	__('Slide', 'tevily-themer'),
					'coverflow'	=>	__('coverflow', 'tevily-themer'),
				)
			]
		);
		$this->add_control(
			'ca_loop',
			[
				'label'     => __('Loop', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'ca_speed',
			[
				'label'     => __('Speed', 'tevily-themer'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 600,
			]
		);

		  $this->add_control(
			 'ca_autoplay',
			 [
				'label'     => __('Auto Play', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			 ]
		  );

		  $this->add_control(
			 'ca_autoplay_delay',
			 [
				'label'     => __('Auto Play Delay', 'tevily-themer'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 4500,
			 ]
		  );

		  $this->add_control(
			 'ca_autoplay_hover',
			 [
				'label'     => __('Play Hover', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			 ]
		  );

		  $this->add_control(
			 'ca_navigation',
			 [
				'label'     => __('Navigation', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			 ]
		  );

		  $this->add_control(
			 'ca_pagination',
			 [
				'label'     => __('Pagination', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			 ]
		  );

		$this->add_control(
		 	'ca_pagination_type',
		 	[
				'label'     => __('Pagination Type', 'tevily-themer'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bullets',
				'options'   => array(
					'bullets'		=> esc_html__( 'Bullets', 'tevily-themer'),
					'fraction'		=> esc_html__( 'Fraction', 'tevily-themer'),
					'progressbar'	=> esc_html__( 'Progressbar', 'tevily-themer')
				)
			]
		);

		$this->add_control(
			'ca_dynamic_bullets',
			[
				'label'     => __('Dynamic Bullets', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			]
		);

		$this->add_responsive_control(
		  'spacing_dots',
		  	[
			 	'label' => __( 'Dots Spacing', 'tevily-themer' ),
			 	'type' => Controls_Manager::SLIDER,
			 	'default' => [
					'size' => 0,
			 	],
			 	'range' => [
					'px' => [
					  	'min' => 0,
					  	'max' => 200,
					],
			 	],
			 	'selectors' => [
					'{{WRAPPER}} .swiper-slider-wrapper .swiper-pagination' => 'margin-top: {{SIZE}}px;',
			 	],
		  	]
		);
		
		$this->end_controls_section();
	 }

	 protected function add_control_grid($condition = array()) {
	  $this->start_controls_section(
		  'section_grid_options',
		  [
			 'label' => __('Grid Options', 'tevily-themer'),
			 'type'  => Controls_Manager::SECTION,
			 'condition' => $condition,
		  ]
	  );

	  $this->add_control(
		  'grid_items_lg',
		  [
			 'label'     => __('Columns for Large Screen', 'tevily-themer'),
			 'type'      => Controls_Manager::SELECT,
			 'default'   => 3,
			 'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
		  ]
	  );

		$this->add_control(
		  'grid_items_md',
		  [
			 'label'     => __('Columns for Medium Screen', 'tevily-themer'),
			 'type'      => Controls_Manager::SELECT,
			 'default'   => 3,
			 'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
		  ]
		);

		  $this->add_control(
			 'grid_items_sm',
			 [
				'label'     => __('Columns for Small Screen', 'tevily-themer'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 2,
				'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
			 ]
		  );

		  $this->add_control(
			 'grid_items_xs',
			 [
				'label'     => __('Columns for Extra Small Screen', 'tevily-themer'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 1,
				'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
			 ]
		  );

		  $this->add_control(
			 'grid_items_xx',
			 [
				'label'     => __('Columns for Very Extra Small Screen', 'tevily-themer'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 1,
				'options'   => array(1=>1, 2=>2, 3=>3)
			 ]
		  );
  
		  $this->add_control(
			 'grid_remove_padding',
			 [
				'label'     => __('Remove Padding', 'tevily-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
			 ]
		  );
		  $this->end_controls_section();
	 }

	 protected function get_thumbnail_size(){
		  global $_wp_additional_image_sizes; 
		  $results = array(
				'full'      => 'full',
				'large'     => 'large',
				'medium'    => 'medium',
				'thumbnail' => 'thumbnail'
		  );
		  foreach ($_wp_additional_image_sizes as $key => $size) {
				$results[$key] = $key;
		  }
		  return $results;
	 }

	 protected function get_carousel_settings(){
		$settings = $this->get_settings_for_display();
		$carousel_options = array(
		  'items'               => isset($settings['ca_items_lg']) ? intval($settings['ca_items_lg']) : 1,
		  'items_lg'            => isset($settings['ca_items_lg']) ? intval($settings['ca_items_lg']) : 1,
		  'items_md'            => isset($settings['ca_items_md']) ? intval($settings['ca_items_md']) : 1,
		  'items_sm'            => isset($settings['ca_items_sm']) ? intval($settings['ca_items_sm']) : 1,
		  'items_xs'            => isset($settings['ca_items_xs']) ? intval($settings['ca_items_xs']) : 1,
		  'items_xx'            => isset($settings['ca_items_xx']) ? intval($settings['ca_items_xx']) : 1,
		  'effect'					=> isset($settings['ca_effect']) ? $settings['ca_effect'] : 'slide',
		  'space_between'			=> isset($settings['space_between']) ? intval($settings['space_between']) : 20,
		  'loop'                => $settings['ca_loop'] === 'yes' ? 1 : 0,
		  'speed'               => $settings['ca_speed'],
		  'autoplay'           	=> $settings['ca_autoplay'] === 'yes' ? 1 : 0,
		  'autoplay_delay'   	=> $settings['ca_autoplay_delay'],
		  'autoplay_hover'     	=> $settings['ca_autoplay_hover'] === 'yes' ? 1 : 0,
		  'navigation'          => $settings['ca_navigation'] === 'yes' ? 1 : 0,
		  'pagination'          => $settings['ca_pagination'] === 'yes' ? 1 : 0,
		  'dynamic_bullets'		=> $settings['ca_dynamic_bullets'] === 'yes' ? 1: 0,
		  'pagination_type'		=> $settings['ca_pagination_type']
		);
		return htmlspecialchars(json_encode($carousel_options));
	 }

	 protected function get_grid_settings($classes = '') {
		$settings = $this->get_settings_for_display();
		if($classes){
		  $this->add_render_attribute('grid', 'class', $classes);
		}
		$this->add_render_attribute('grid', 'class', 'lg-block-grid-' . $settings['grid_items_lg']);
		$this->add_render_attribute('grid', 'class', 'md-block-grid-' . $settings['grid_items_md']);
		$this->add_render_attribute('grid', 'class', 'sm-block-grid-' . $settings['grid_items_sm']);
		$this->add_render_attribute('grid', 'class', 'xs-block-grid-' . $settings['grid_items_xs']);
		$this->add_render_attribute('grid', 'class', 'xx-block-grid-' . $settings['grid_items_xx']);
	 }


	 public function gva_render_button($classes = ''){
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['button_url']['url'] ) ) {
		  $this->add_render_attribute( 'button', 'href', $settings['button_url']['url'] );

		  if(!empty($classes)){
			 $this->add_render_attribute( 'button', 'class', $classes );
		  }else{
			 $this->add_render_attribute( 'button', 'class', 'btn-theme' );
		  }

		  if ( $settings['button_url']['is_external'] ) {
			 $this->add_render_attribute( 'button', 'target', '_blank' );
		  }
		  if ( $settings['button_url']['nofollow'] ) {
			 $this->add_render_attribute( 'button', 'rel', 'nofollow' );
		  }
		  ?>
		  <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
			 <span><?php echo esc_html( $settings['button_text'] ) ?></span>
		  </a>

		  <?php
		}
	 }

	 public function gva_render_link_begin($link = array(), $classes = ''){
		$r = gaviasthemer_random_id();
		if ( ! empty( $link['url'] ) ) {
		  $this->add_render_attribute( '_base_link_0' . $r, 'href', $link['url'] );

		  if(!empty($classes)){
			 $this->add_render_attribute( '_base_link_0' . $r, 'class', $classes );
		  }

		  if ( $link['is_external'] ) {
			 $this->add_render_attribute( '_base_link_0' . $r, 'target', '_blank' );
		  }
		  if ( $link['nofollow'] ) {
			 $this->add_render_attribute( '_base_link_0' . $r, 'rel', 'nofollow' );
		  }
		  ?>
		  <a <?php echo $this->get_render_attribute_string( '_base_link_0' . $r ); ?>>
		  <?php
		}
	 }

	 public function gva_render_link_end($link = array()){
		if ( ! empty( $link['url'] ) ) { 
		  echo '</a>';
		}
	 }

	public function gva_render_link_html($html = '', $link = array(), $classes = ''){ 
		$r = gaviasthemer_random_id();
		if ( ! empty( $link['url'] ) ) {
		  $this->add_render_attribute( '_base_link_1' . $r, 'href', $link['url'] );

		  if(!empty($classes)){
			 $this->add_render_attribute( '_base_link_1' . $r, 'class', $classes );
		  }

		  if ( $link['is_external'] ) {
			 $this->add_render_attribute( '_base_link_1' . $r, 'target', '_blank' );
		  }
		  if ( $link['nofollow'] ) {
			 $this->add_render_attribute( '_base_link_1' . $r, 'rel', 'nofollow' );
		  }
		  ?>
		  <a <?php echo $this->get_render_attribute_string( '_base_link_1' . $r ); ?>>
			 <?php echo $html; ?>
		  </a>
		  <?php
		}else{
		  echo $html;
		}
	}

		public function gva_render_link_html_2($html = '', $link = array(), $classes = ''){ 
			$r = gaviasthemer_random_id();
			if ( ! empty( $link['url'] ) ) {
			  $this->add_render_attribute( '_base_link_1' . $r, 'href', $link['url'] );

			  if(!empty($classes)){
				 $this->add_render_attribute( '_base_link_1' . $r, 'class', $classes );
			  }

			  if ( $link['is_external'] ) {
				 $this->add_render_attribute( '_base_link_1' . $r, 'target', '_blank' );
			  }
			  if ( $link['nofollow'] ) {
				 $this->add_render_attribute( '_base_link_1' . $r, 'rel', 'nofollow' );
			  }
			  ?>
			  <a <?php echo $this->get_render_attribute_string( '_base_link_1' . $r ); ?>>
				 <?php echo $html; ?>
			  </a>
			  <?php
			}
		}

	public function gva_render_link_overlay($link = array(), $classes = 'link-overlay'){
		$r = gaviasthemer_random_id();
		if ( ! empty( $link['url'] ) ) {
		  $this->add_render_attribute( '_base_link_1' . $r, 'href', $link['url'] );

		  if(!empty($classes)){
			 $this->add_render_attribute( '_base_link_1' . $r, 'class', $classes );
		  }

		  if ( $link['is_external'] ) {
			 $this->add_render_attribute( '_base_link_1' . $r, 'target', '_blank' );
		  }
		  if ( $link['nofollow'] ) {
			 $this->add_render_attribute( '_base_link_1' . $r, 'rel', 'nofollow' );
		  }
		  ?>
		  <a <?php echo $this->get_render_attribute_string( '_base_link_1' . $r ); ?>></a>
		  <?php
		}
	}


	public function get_template($template_name = null){
		$template_path = apply_filters('gva-elementor/template-path', 'templates/elementor/');
		$template = locate_template( $template_path . $template_name );
		if ( ! $template ){
			$template = GAVIAS_TEVILY_PLUGIN_DIR  . 'elementor/views/' . $template_name;
		}
		if(file_exists($template)){
			return $template;
		}else{
			return false;
		}
	}

  	function tevily_get_template_part($slug, $name = null, $data = []){
		global $posts, $post;
		do_action( "get_template_part_{$slug}", $slug, $name );

		$templates = array();
		$name      = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "{$slug}-{$name}.php";
		}

		$templates[] = "{$slug}.php";

		do_action( 'get_template_part', $slug, $name, $templates );
		$template = locate_template($templates, false);
	
		if (!$template) {
			return;
		}

		if ($data) {
			extract($data);
		}
	 
		include($template);
  	}

  	public function pagination( $query = false ){
	 	global $wp_query;   
	 	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

	 	if( ! $query ) $query = $wp_query;
	 
	 	$translate['prev'] =  esc_html__('Prev page', 'winnex');
	 	$translate['next'] =  esc_html__('Next page', 'winnex');
	 	$translate['load-more'] = esc_html__('Load more', 'winnex');
	 
	 	$query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;  
	 
	 	if( empty( $paged ) ) $paged = 1;
	 	$prev = $paged - 1;                         
	 	$next = $paged + 1;
	 
	 	$end_size = 1;
	 	$mid_size = 2;
	 	$show_all = false;
	 	$dots = false;

	 	if( ! $total = $query->max_num_pages ) $total = 1;
	 
	 	$output = '';
	 	if( $total > 1 ){   
			$output .= '<div class="column one pager_wrapper">';
			  $output .= '<div class="pager">';
				 $output .= '<div class="paginations">';
					if( $paged >1 && !is_home()){
					  $output .= '<a class="prev_page" href="'. previous_posts(false) .'"><i class="fas fa-chevron-left"></i></a>';
					}
					for( $i=1; $i <= $total; $i++ ){
					  if ( $i == $current ){
						 $output .= '<a href="'. get_pagenum_link($i) .'" class="page-item active">'. $i .'</a>';
						 $dots = true;
					  } else {
						 if ( $show_all || ( $i <= $end_size || ( $current && $i >= $current - $mid_size && $i <= $current + $mid_size ) || $i > $total - $end_size ) ){
							$output .= '<a href="'. get_pagenum_link($i) .'" class="page-item">'. $i .'</a>';
							$dots = true;
						 } elseif ( $dots && ! $show_all ) {
							$output .= '<span class="page-item">... </span>';
							$dots = false;
						 }
					  }
					}
					if( $paged < $total && !is_home()){
					  $output .= '<a class="next_page" href="'. next_posts(0,false) .'"><i class="fas fa-chevron-right"></i></a>';
					}
				 $output .= '</div>';
					
			  $output .= '</div>';
			$output .= '</div>'."\n";    
	 	}
	 
	 	return $output;
  	}
}