<?php
  	Redux::setSection( $opt_name, array(
	 	'title' 	=> esc_html__('Header Options', 'tevily'),
	 	'icon' 	=> 'el-icon-compass',
	 	'fields' => array(
			array(
			  'id' 		=> 'header_logo', 
			  'type' 	=> 'media',
			  'url' 		=> true,
			  'title' 	=> esc_html__('Logo in header default', 'tevily'), 
			  'default' => ''
			),  
			array(
			  'id'  		=> 'header_mobile_settings',
			  'type'  	=> 'info',
			  'raw' 		=> '<h3 class="margin-bottom-0">' . esc_html__('Header Mobile settings', 'tevily') . '</h3>'
			),
			array(
			  'id' 		=> 'hm_logo',
			  'type' 	=> 'media',
			  'url' 		=> true,
			  'title' 	=> esc_html__('Header Mobile | Logo', 'tevily'),
			  'default' => ''
			),
			array(
			  'id' 		=> 'hm_show_topbar',
			  'type' 	=> 'button_set',
			  'title' 	=> esc_html__('Show Topbar', 'tevily'),
			  'options' => array('yes' => 'Enable', 'no' => 'Disable'),
			  'default' => 'yes'
			),
			array(
	        'id' 		=> 'hm_topbar_information',
	        'type' 	=> 'editor',
	        'title' 	=> esc_html__('Topbar Information', 'tevily'),
	        'default' => '<a href="#">BECOME A LOCAL GUIDE</a>'
	      ),
			
			//-- Socials --
			array(
			  'id'  		=> 'header_mobile_socials_settings',
			  'type'  	=> 'info',
			  'raw' 		=> '<h3 class="margin-bottom-0">' . esc_html__('Social Header Mobile Settings', 'tevily') . '</h3>'
			),
			array(
				'id'			=> 'hm_social_facebook',
				'type' 		=> 'text',
				'title' 		=> esc_html__('Facebook', 'tevily'),
				'desc'		=> esc_html__('Enter your Facebook profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_instagram',
				'type'		=> 'text',
				'title'		=> esc_html__('Instagram', 'tevily'),
				'desc'		=> esc_html__('Enter your Instagram profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_twitter',
				'type'		=> 'text',
				'title'		=> esc_html__('Twitter', 'tevily'),
				'desc'		=> esc_html__('Enter your Twitter profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_linkedin',
				'type'		=> 'text',
				'title'		=> esc_html__('LinedIn', 'tevily'),
				'desc'		=> esc_html__('Enter your LinkedIn profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_pinterest',
				'type'		=> 'text',
				'title'		=> esc_html__('Pinterest', 'tevily'),
				'desc'		=> esc_html__('Enter your Pinterest profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_tumblr',
				'type'		=> 'text',
				'title'		=> esc_html__('Tumblr', 'tevily'),
				'desc'		=> esc_html__('Enter your Tumblr profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_vimeo',
				'type'		=> 'text',
				'title'		=> esc_html__('Vimeo', 'tevily'),
				'desc'		=> esc_html__('Enter your Vimeo profile URL.', 'tevily'),
				'default'	=> ''
			),
			array(
				'id'			=> 'hm_social_youtube',
				'type'		=> 'text',
				'title'		=> esc_html__('YouTube', 'tevily'),
				'desc'		=> esc_html__('Enter your YouTube profile URL.', 'tevily'),
				'default'	=> ''
			)
	 	)
  	));