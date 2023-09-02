<?php
Redux::setSection( $opt_name, array(
  	'title' => esc_html__('Footer Options', 'tevily'),
  	'icon' => 'el-icon-compass',
  	'fields' => array(
	 	array(
			'id' 			=> 'copyright_default',
			'type' 		=> 'button_set',
			'title' 		=> esc_html__('Enable/Disable Copyright Text', 'tevily'),
			'options' 	=> array(
				'yes' 	=> esc_html__('Enable', 'tevily'),
				'no' 		=> esc_html__('Disable', 'tevily')
			),
			'default' 	=> 'yes'
	 	),
	 	array(
			'id' 			=> 'copyright_text',
			'type' 		=> 'editor',
			'title' 		=> esc_html__('Footer Copyright Text', 'tevily'),
			'default' 	=> esc_html__('Copyright - 2021 - Company - All rights reserved. Powered by WordPress.', 'tevily')
	 	),
  	)
));