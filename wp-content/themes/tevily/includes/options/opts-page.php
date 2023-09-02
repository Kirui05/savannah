<?php
Redux::setSection($opt_name, array(
   'icon'   => 'el-icon-th-list',
   'title'  => esc_html__('Page Options', 'tevily'),
   'fields' => array(
      array(
         'id'     => 'nf_page_info',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="margin-bottom-0">' . esc_html__('404 Page Settings', 'tevily') . '</h3>',
      ),
      array(
         'id'        => 'nfpage_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Color', 'tevily'),
         'default'   => '#1F2230'
      ),
      array(
         'id'        => 'nfpage_bg_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Background Image', 'tevily'),
         'default'   => '',
      ),
      array(
         'id'        => 'nfpage_primary_text',
         'type'      => 'text',
         'title'     => esc_html__('Primary Text', 'tevily'),
         'default'   => esc_html__('404', 'tevily'),
      ),
      array(
         'id'        => 'nfpage_title',
         'type'      => 'text',
         'title'     => esc_html__('Title Text', 'tevily'),
         'default'   => esc_html__('Page Not Found', 'tevily'),
      ),
      array(
         'id'        => 'nfpage_desc',
         'type'      => 'textarea',
         'title'     => esc_html__('Primary Text', 'tevily'),
         'default'   => esc_html('The page requested could not be found. This could be a spelling error in the URL or a removed page.', 'tevily')
      ),
      array(
         'id'        => 'nfpage_btn_title',
         'type'      => 'text',
         'title'     => esc_html__('Button Title', 'tevily'),
         'default'   => esc_html__('Back Homepage', 'tevily'),
      ),
      array(
         'id'        => 'nfpage_btn_link',
         'type'      => 'text',
         'title'     => esc_html__('Button Link', 'tevily'),
         'default'   => '',
      ),
   )
));  