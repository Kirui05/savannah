<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__('General Options', 'tevily'),
	'icon' => 'el-icon-wrench',
	'fields' => array(
		array(
			'id'           => 'color_theme',
			'type'         => 'color',
			'title'        => esc_html__( 'Custom Color Theme', 'tevily' ),
			'desc'         => esc_html__( 'Used custom color theme instead of Skin Colors Available.', 'tevily' ),
			'default'      => '',
			'transparent'  => false,
			'validate'     => 'color'
		),
		array(
			'id'           => 'page_layout',
			'type'         => 'button_set',
			'title'        => esc_html__('Page Layout', 'tevily'),
			'subtitle'     => esc_html__('Select the page layout type', 'tevily'),
			'options'      => array(
				'boxed'     => esc_html__('Boxed', 'tevily'),
				'fullwidth' => esc_html__('Fullwidth', 'tevily')
			),
			'default' => 'fullwidth'
		),
		array(
		  'id' => 'map_api_key',
		  'type' => 'text',
		  'title' => esc_html__('Google Map API key', 'tevily'),
		  'default' => ''
		),

		// Breadcrumb Default Settings
		array(
         'id'     => 'breadcrumb_default',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="margin-bottom-0">' . esc_html__('Breadcrumb Settings Without Elementor', 'tevily') . '</h3>',
      ),
		array(
         'id'        => 'breadcrumb_title',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb Title', 'tevily'),
         'options'   => array(
            1 => esc_html__('Enable', 'tevily'),
            0 => esc_html__('Disable', 'tevily')
         ),
         'default'   => 1
      ),
      array(
         'id'        => 'breadcrumb_padding_top',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'tevily'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_padding_bottom',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'tevily'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Overlay Color', 'tevily'),
         'default'   => ''
      ),
      array(
         'id'        => 'breadcrumb_bg_opacity',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Ovelay Color Opacity', 'tevily'),
         'default'   => 50,
         'min'       => 0,
         'max'       => 100,
         'step'      => 2,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_bg_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Breadcrumb Background Image', 'tevily'),
         'default'   => '',
         'required'  => array('woo_breadcrumb_bg', '=', 1 )
      ),
      array(
         'id'        => 'breadcrumb_text_stype',
         'type'      => 'select',
         'title'     => esc_html__('Breadcrumb Text Stype', 'tevily'),
         'options'   => 
         array(
            'text-light'     => esc_html__('Light', 'tevily'),
            'text-dark'      => esc_html__('Dark', 'tevily')
         ),
         'default' => 'text-light'
      )

	)
));