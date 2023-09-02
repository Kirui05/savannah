<?php
Redux::setSection( $opt_name, array(
   'icon'   => 'el-icon-shopping-cart',
   'title'  => esc_html__('WooCommerce', 'tevily'),
   'fields' => array(
      array(
        'id'        => 'products_per_page',
        'type'      => 'text',
        'title'     => esc_html__('Products Per Page', 'tevily'),
        'subtitle'  => esc_html__('Number value.', 'tevily'),
        'desc'      => esc_html__('The amount of products you would like to show per page on shop/category pages.', 'tevily'),
        'validate'  => 'numeric',
        'default'   => '24'
      )       
   )
));

Redux::setSection( $opt_name, array(
   'icon'         => 'el-icon-shopping-cart',
   'title'        => esc_html__('Shop Page Options', 'tevily'),
   'subsection'   => true,
   'fields'       => array(
      array(
         'id'        => 'product_columns_lg',
         'type'      => 'select',
         'title'     => esc_html__('Display Columns for Large Screen', 'tevily'),
         'subtitle'  => esc_html__('Choose the number of columns to display on shop/category pages.', 'tevily'),
         'options'   => array(
            '1'      => '1',
            '2'      => '2',
            '3'      => '3',
            '4'      => '4',
            '5'      => '5',
            '6'      => '6',
         ),
         'default'   => '3'
      ),

      array(
         'id'        => 'product_columns_md',
         'type'      => 'select',
         'title'     => esc_html__('Display Columns for Medium Screen', 'tevily'),
         'subtitle'  => esc_html__('Choose the number of columns to display on shop/category pages.', 'tevily'),
         'options'   => array(
            '1'      => '1',
            '2'      => '2',
            '3'      => '3',
            '4'      => '4',
            '5'      => '5',
            '6'      => '6',
         ),
         'default'   => '3'
      ),

      array(
         'id'        => 'product_columns_sm',
         'type'      => 'select',
         'title'     => esc_html__('Display Columns for Small Screen', 'tevily'),
         'subtitle'  => esc_html__('Choose the number of columns to display on shop/category pages.', 'tevily'),
         'options'   => array(
            '1'      => '1',
            '2'      => '2',
            '3'      => '3',
            '4'      => '4',
            '5'      => '5',
            '6'      => '6',
         ),
         'default'   => '2'
      ),

      array(
         'id'        => 'product_columns_xs',
         'type'      => 'select',
         'title'     => esc_html__('Display Columns for Extra Small Screen', 'tevily'),
         'subtitle'  => esc_html__('Choose the number of columns to display on shop/category pages.', 'tevily'),
         'options'   => array(
            '1'      => '1',
            '2'      => '2',
            '3'      => '3',
            '4'      => '4',
            '5'      => '5',
            '6'      => '6',
         ),
         'default'   => '1'
      )
   )
));

Redux::setSection( $opt_name, array(
   'icon'         => 'el-icon-shopping-cart',
   'title'        => esc_html__('Product Page Options', 'tevily'),
   'subsection'   => true,
   'fields'       => array(
      array(
         'id'        => 'upsell_heading_text',
         'type'      => 'text',
         'title'     => esc_html__('Upsell Heading Text', 'tevily'),
         'default'   => esc_html__('Complete the look', 'tevily')
      ),
      array(
         'id'        => 'related_heading_text',
         'type'      => 'text',
         'title'     => esc_html__('Related Heading Text', 'tevily'),
         'default'   => esc_html__('Related Products', 'tevily')
      ),

      array(
        'id'  => 'woo_product_page_breadcrumb',
        'type'  => 'info',
        'icon'  => true,
        'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Breacrumb Settings', 'tevily' ) . '</h3>',
      ),

      array(
         'id'        => 'woo_breadcrumb',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb On Product Page', 'tevily'),
         'options'   => array(
            1 => esc_html__('Enable', 'tevily'),
            0 => esc_html__('Disable', 'tevily')
         ),
         'default'   => 1
      ),

      array(
         'id'        => 'woo_breadcrumb_title',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb Title', 'tevily'),
         'options'   => array(
            1 => esc_html__('Enable', 'tevily'),
            0 => esc_html__('Disable', 'tevily')
         ),
         'default'   => 1
      ),
      array(
         'id'        => 'woo_breadcrumb_padding_top',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'tevily'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'woo_breadcrumb_padding_bottom',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'tevily'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'woo_breadcrumb_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Overlay Color', 'tevily'),
         'default'   => ''
      ),
      array(
         'id'        => 'woo_breadcrumb_bg_opacity',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Ovelay Color Opacity', 'tevily'),
         'default'   => 50,
         'min'       => 0,
         'max'       => 100,
         'step'      => 2,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'woo_breadcrumb_bg',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb Image', 'tevily'),
         'options'   => array( 
            1 => esc_html__('Enable', 'tevily'),
            0 => esc_html__('Disable', 'tevily')
         ),
         'default'   => '1'
      ),
      array(
         'id'        => 'woo_breadcrumb_bg_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Breadcrumb Background Image', 'tevily'),
         'default'   => '',
         'required'  => array('woo_breadcrumb_bg', '=', 1 )
      ),
      array(
         'id'        => 'woo_breadcrumb_text_stype',
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